(function(window, document){
	define(['services/api', 'services/notifications'], function(api){
		angular.module('pavonessa.services', [])
			.constant('config',{apihandle:"//" + window.location.host + "/core/controllers/",projectdir:"//" + window.location.host + "/"})
			.factory('api', api)
	})
})(window)
