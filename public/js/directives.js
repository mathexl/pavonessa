
(function(window, document){
      define([
        'directives/file'
        ], function(
            file
        ){

        angular.module('pavonessa.directives', ['ngSanitize','ngRoute','pavonessa.services','ui.mask'])
        .constant('config',{apihandle:"//" + window.location.host + "/core/controllers/",projectdir:"//" + window.location.host + "/"})
        .directive('file', file)
    })
})(window, document)
