(function(window, document){
	define([], function(){
		var navCtrl = function($scope, $location, $rootScope, config, api, $http){
		    $scope.matcher = false;
		    $scope.showsearchbar = 0;
		    $scope.path = $location.path();
		    $scope.showprofiledropdown = 0;

		    $scope.$on('locationChanged',function(ev, data){

		        $scope.path = data.data[0];
		    })

		    $scope.hideprofile = function(ev){

		        $scope.showprofiledropdown = 0;
		        ev.stopPropagation();
		    }



		    $scope.toggleprofile = function(ev){
		        $scope.showprofiledropdown = ($scope.showprofiledropdown + 1) % 2;
		        ev.stopPropagation();
		    }

		    $scope.select = function(){
		        $scope.path = $location.path();
		    }

				$scope.resend = function(){
					$http.post(config.apihandle + 'resendconfirmation.php')
					.then(function(res){
						$scope.resent = true;
						console.log('das');
					})
				}

		    $scope.showsearch = function(ev){
		        $scope.showsearchbar = ($scope.showsearchbar + 1) % 2;
		    }

		    $scope.matcherq = function(ev){
		        $scope.matcher = true;
		        console.log($scope.matcher);

		    }

		    $scope.moneyerq = function(ev){
		        $scope.moneyer = true;

		    }





		};
		return navCtrl;
	})
})(window, document);
