(function(document, window){
	define([
		'controllers/mainCtrl',
		'controllers/navCtrl'
		],
	function(mainCtrl,navCtrl){
		angular.module('pavonessa.controllers',['ngRoute','pavonessa.services'])
			.controller('mainCtrl', mainCtrl)
			.controller('navController', navCtrl);
	})
})();
