
requirejs.config({
  baseUrl: 'public/js/'
})
requirejs(['routes','formdataConfig','run','directives','controllers','ng-s3upload','services'],
  function(){
    var config = {
        apihandle: "//" + window.location.host + "/core/controllers/",
        projectdir: "//" + window.location.host
    };

    function hash(str) {
      var hash = 0, i, chr, len;
      if (str.length == 0) return hash;
      for (i = 0, len = str.length; i < len; i++) {
        chr   = str.charCodeAt(i);
        hash  = ((hash << 5) - hash) + chr;
        hash |= 0; // Convert to 32bit integer
      }
      return hash;
    };


var pavonessa = angular.module('pavonessa', ['ngRoute', 'pavonessa.directives']);

pavonessa
.constant('config',config)
.config(function($httpProvider){
    // Use x-www-form-urlencoded Content-Type
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';

    /**
    * The workhorse; converts an object to x-www-form-urlencoded serialization.
    * @param {Object} obj
    * @return {String}
    */
    var param = function(obj) {
    var query = '', name, value, fullSubName, subName, subValue, innerObj, i;

    for(name in obj) {
      value = obj[name];

      if(value instanceof Array) {
        for(i=0; i<value.length; ++i) {
          subValue = value[i];
          fullSubName = name + '[' + i + ']';
          innerObj = {};
          innerObj[fullSubName] = subValue;
          query += param(innerObj) + '&';
        }
      }
      else if(value instanceof Object) {
        for(subName in value) {
          subValue = value[subName];
          fullSubName = name + '[' + subName + ']';
          innerObj = {};
          innerObj[fullSubName] = subValue;
          query += param(innerObj) + '&';
        }
      }
      else if(value !== undefined && value !== null)
        query += encodeURIComponent(name) + '=' + encodeURIComponent(value) + '&';
    }

    return query.length ? query.substr(0, query.length - 1) : query;
    };

    // Override $http service's default transformRequest
    $httpProvider.defaults.transformRequest = [function(data) {
    return angular.isObject(data) && String(data) !== '[object File]' ? param(data) : data;
    }];
})
.config(function($routeProvider){

    $routeProvider
    .when('/', {
        templateUrl: 'public/views/landing.php'
//      controller: 'earlyaccessController'
    })
    .when('/login/', {
        templateUrl: 'public/views/login.php',
        controller: 'loginController'
    })
    .when('/password-reset',{
        templateUrl: 'public/views/password-reset.php',
        controller: 'passwordresetController'
    })
    .when('/signup',{
        templateUrl: 'public/views/signup-beta.php',
        controller: 'signupbetaController'
    })
    .when('/create/:id', {
        templateUrl: 'public/views/create.php',
        controller: 'createController'
    })
    .when('/reset/:id', {
        templateUrl: 'public/views/reset.php',
        controller: 'resetController'
    })
    .otherwise({
      templateUrl: 'public/views/splash-earlyaccess.php',
      controller:'earlyaccessController'
    })
})




.run(['$route', '$rootScope', '$location', function ($route, $rootScope, $location) {
    var original = $location.path;
    console.log($location.path());

    $location.path = function (path, reload) {
        if (reload === false) {
            var lastRoute = $route.current;
            var un = $rootScope.$on('$locationChangeSuccess', function () {
                $route.current = lastRoute;
                un();
            });
        }
        return original.apply($location, [path]);
    };

}])



.controller('loginController', function($scope, $http, $location, $rootScope){
    $scope.formdata = {
        email: "",
        pw: ""
    }

    $scope.login = function(redir){
        console.log($scope.formdata.pw);
        console.log(config);
        console.log({
            email: $scope.formdata.email,
            pw: hash($scope.formdata.pw + $scope.email)
        });
        console.log(config.apihandle + "login.php");
        $http.post(config.apihandle + "login.php", {
            email: $scope.formdata.email,
            pw: hash($scope.formdata.pw + $scope.email)
        })
        .then(function( res ){

            if(res.data === "false"){
                $scope.failed = true;
            } else {
                location.reload();
//                }
            }
        });

    }
})



.controller('signupController', function($scope, $http, $routeParams, $location, $rootScope){
    $scope.formdata = {
        fname: "",
        lname: "",
        _cid: 0,
        email: "",
        pw: "",
        highschool: "",
        user_type: $routeParams.type
    }
    $rootScope.transparentnav = true;
    $scope.type=$routeParams.type;

    $scope.submit = function(){
        if($scope.formdata.email.indexOf(".edu") > -1)
        {
            $scope.formdata.pw = hash($scope.formdata.pw + $scope.email);
            console.log($scope.formdata);
            $http.post(config.apihandle + "create.php", $scope.formdata)
            .then(function( res ){
                if(res.data.status === 1){
                    $scope.failed = true;
                } else {
    //              $location.path('/set-account');
                    console.log(res.data);
//                    window.location.replace("https://www.pavonessa.com/create/" + )

                }
            });
        }
        else{
          $scope.dotedu = true;
        }
    }


})



.controller('createController', function($scope, $http, $routeParams, $location, $rootScope){


    $scope.data = {
      id: $routeParams.id
    }

    $http.post(config.apihandle + "create.php", $scope.data)
    .then(function( res ){
        if(res.data === 'false'){
            alert(res.data.details);
        } else {
            console.log(res.data);
            $scope.complete = true;
            location.reload();
        }
    })


})



.controller('resetController', function($scope, $http, $routeParams, $location, $rootScope){


    $scope.data = {
      pw_set: $routeParams.id,
      pw: hash(""),
      source: $location.path()
    }


    $http.post(config.apihandle + "get_email_from_reset_code.php", $scope.data)
    .then(function( res ){
        if(res.data === 'false'){
      //      alert(res.data.details);
        } else {
            $scope.data.email = res.data.email;
        }
    })


    $scope.submit = function(){
      console.log($scope.formdata.pw);
      $scope.data.pw = hash($scope.formdata.pw + $scope.emasdkjadsail); //something random
      console.log($scope.data);
      $http.post(config.apihandle + "reset.php", $scope.data)
      .then(function( res ){
              console.log(res.data);
              $scope.complete = true;

      })
    }


})



.controller('passwordresetController', function($scope, $http, $routeParams, $location, $rootScope){
    $scope.formdata = {
        email: "",
        source: $location.path()
    }
    $rootScope.transparentnav = true;
    $scope.type=$routeParams.type;

    $scope.submit = function(){
        $http.post(config.apihandle + "password-review.php", $scope.formdata)
        .then(function(res){
           if(res.data != 'false')
           {
                console.log(res);
                $scope.complete = true;
            } else {
              $scope.emaildoesntexist = true;
            }
        });
    }
})



function hash(str) {
  var hash = 0, i, chr, len;
  if (str.length == 0) return hash;
  for (i = 0, len = str.length; i < len; i++) {
    chr   = str.charCodeAt(i);
    hash  = ((hash << 5) - hash) + chr;
    hash |= 0; // Convert to 32bit integer
  }
  return hash;
};

      angular.bootstrap(document, ['pavonessa']);

  })
