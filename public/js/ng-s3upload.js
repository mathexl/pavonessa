(function(window, document) {
  define([], function(){

// Create all modules and define dependencies to make sure they exist
// and are loaded in the correct order to satisfy dependency injection
// before all nested files are concatenated by Grunt

// Config
angular.module('ngS3upload.config', []).
  value('ngS3upload.config', {
      debug: true
  }).
  config(['$compileProvider', function($compileProvider){
    if (angular.isDefined($compileProvider.urlSanitizationWhitelist)) {
      $compileProvider.urlSanitizationWhitelist(/^\s*(https?|ftp|mailto|file|data):/);
    } else {
      $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|file|data):/);
    }
  }]);

// Modules
angular.module('ngS3upload.directives', []);
angular.module('ngS3upload',
    [
        'ngS3upload.config',
        'ngS3upload.directives',
        'ngS3upload.services',
        'ngSanitize'
    ]);
angular.module('ngS3upload.config', []).
  constant('ngS3Config', {
    theme: 'bootstrap2'
  });angular.module('ngS3upload.services', []).
  service('S3Uploader', ['$http', '$q', '$window', function ($http, $q, $window) {
    this.uploads = 0;
    var self = this;
    console.log('inthefile');

    this.getUploadOptions = function (uri) {
      var deferred = $q.defer();
      $http.get(uri).
        success(function (response, status) {
          deferred.resolve(response);
        }).error(function (error, status) {
          deferred.reject(error);
        });

      return deferred.promise;
    };

    this.randomString = function (length) {
      var chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      var result = '';
      for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
      return result + (new Date().getTime());
    };


    this.upload = function (scope, uri, key, acl, type, accessKey, policy, signature, file) {
      var deferred = $q.defer();
      scope.attempt = true;

      var fd = new FormData();
      fd.append('key', key);
      fd.append('acl', acl);
      fd.append('Content-Type', file.type);
      fd.append('AWSAccessKeyId', accessKey);
      fd.append('policy', policy);
      fd.append('signature', signature);
      fd.append("file", file);

      var xhr = new XMLHttpRequest();
      xhr.upload.addEventListener("progress", uploadProgress, false);
      xhr.addEventListener("load", uploadComplete, false);
      xhr.addEventListener("error", uploadFailed, false);
      xhr.addEventListener("abort", uploadCanceled, false);
      scope.$emit('s3upload:start', xhr);

      // Define event handlers
      function uploadProgress(e) {
        scope.$apply(function () {
          if (e.lengthComputable) {
            scope.progress = Math.round(e.loaded * 100 / e.total);
          } else {
            scope.progress = 'unable to compute';
          }
          var msg = {type: 'progress', value: scope.progress};
          scope.$emit('s3upload:progress', msg);
          if (typeof deferred.notify === 'function') {
            deferred.notify(msg);
          }

        });
      }
      function uploadComplete(e) {
        var xhr = e.srcElement || e.target;
        scope.$apply(function () {
          self.uploads--;
          scope.uploading = false;
          if (xhr.status === 204) { // successful upload
            scope.success = true;
            deferred.resolve(xhr);
            scope.$emit('s3upload:success', xhr, {path: uri + key});
          } else {
            scope.success = false;
            deferred.reject(xhr);
            scope.$emit('s3upload:error', xhr);
          }
        });
      }
      function uploadFailed(e) {
        var xhr = e.srcElement || e.target;
        scope.$apply(function () {
          self.uploads--;
          scope.uploading = false;
          scope.success = false;
          deferred.reject(xhr);
          scope.$emit('s3upload:error', xhr);
        });
      }
      function uploadCanceled(e) {
        var xhr = e.srcElement || e.target;
        scope.$apply(function () {
          self.uploads--;
          scope.uploading = false;
          scope.success = false;
          deferred.reject(xhr);
          scope.$emit('s3upload:abort', xhr);
        });
      }

      // Send the file
      scope.uploading = true;
      this.uploads++;
      xhr.open('POST', uri, true);
      xhr.send(fd);

      return deferred.promise;
    };

    this.isUploading = function () {
      return this.uploads > 0;
      scope.uploading = true;
    };
  }]);
angular.module('ngS3upload.directives', []).
  directive('s3Upload', ['$parse', 'S3Uploader', 'ngS3Config', function ($parse, S3Uploader, ngS3Config) {
    return {
      restrict: 'AC',
      require: '?ngModel',
      replace: false,
      transclude: true,
      scope: true,
      controller: ['$scope', '$element', '$attrs', '$transclude', function ($scope, $element, $attrs, $transclude) {
        $scope.attempt = false;
        $scope.success = false;
        $scope.uploading = false;

        $scope.barClass = function () {
          return {
            "bar-success": $scope.attempt && !$scope.uploading && $scope.success
          };
        };
      }],
      compile: function (element, attr, linker) {
        return {
          pre: function ($scope, $element, $attr) {
            $scope.text = $attr.text;
            if (angular.isUndefined($attr.bucket)) {
              throw Error('bucket is a mandatory attribute');
            }
          },
          post: function (scope, element, attrs, ngModel) {
            // Build the opts array
            var opts = angular.extend({}, scope.$eval(attrs.s3UploadOptions || attrs.options));
            opts = angular.extend({
              submitOnChange: true,
              getOptionsUri: '/getS3Options',
              acl: 'public-read',
              uploadingKey: 'uploading',
              folder: '',
              enableValidation: true,
              targetFilename: null
            }, opts);
            var bucket = scope.$eval(attrs.bucket);

            // Bind the button click event
            var button = angular.element(element.children().children()[0]),
              file = angular.element(element.find("input")[0]);
            button.bind('click', function (e) {
              file[0].click();
            });

            // Update the scope with the view value
            ngModel.$render = function () {
              scope.filename = ngModel.$viewValue;
            };

            var uploadFile = function () {
              var selectedFile = file[0].files[0];
              var filename = selectedFile.name;
              var ext = filename.split('.').pop();

              S3Uploader.getUploadOptions(opts.getOptionsUri).then(function (s3Options) {
                if (opts.enableValidation) {
                  ngModel.$setValidity('uploading', false);
                }

                var s3Uri = 'https://' + bucket + '.s3.amazonaws.com/';
                var key = opts.targetFilename ? scope.$eval(opts.targetFilename) : opts.folder + (new Date()).getTime() + '-' + S3Uploader.randomString(16) + "." + ext;
                S3Uploader.upload(scope,
                    s3Uri,
                    key,
                    opts.acl,
                    selectedFile.type,
                    s3Options.key,
                    s3Options.policy,
                    s3Options.signature,
                    selectedFile
                  ).then(function () {
                    ngModel.$setViewValue(s3Uri + key);
                    scope.filename = ngModel.$viewValue;

                    if (opts.enableValidation) {
                      ngModel.$setValidity('uploading', true);
                      ngModel.$setValidity('succeeded', true);
                    }
                  }, function () {
                    scope.filename = ngModel.$viewValue;

                    if (opts.enableValidation) {
                      ngModel.$setValidity('uploading', true);
                      ngModel.$setValidity('succeeded', false);
                    }
                  });

              }, function (error) {
                throw Error("Can't receive the needed options for S3 " + error);
              });

            };

            element.bind('change', function (nVal) {
              if (opts.submitOnChange) {
                scope.$apply(function () {
                  uploadFile();
                });
              } else {
                scope.$apply(function () {
                  $rootScope.user.propic = scope.filename;
                  var selectedFile = file[0].files[0];
                    var fr = new FileReader();
                    fr.onloadend = function(ev){
                        angular.element('img', element).attr('src',fr.result);
                    };
                    fr.readAsDataURL(selectedFile)
                });
              }
            });

            if (angular.isDefined(attrs.doUpload)) {
              scope.$watch(attrs.doUpload, function(value) {
                if (value) uploadFile();
              });
            }
          }
        };
      },
      templateUrl: 'public/js/directives/fileuploader/fileupload.html'
    };
  }]);
})
})(window, document);
