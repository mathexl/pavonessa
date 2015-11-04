(function(window, document){
	define([], function(){
		return function($scope, $http, $rootScope, $anchorScroll, $window, $timeout, $location, config, notifications){

				$rootScope.$on('$routeChangeSuccess', function(newRoute, oldRoute) {
				    $location.hash($routeParams.scrollTo);
				    $anchorScroll();
				  });

		    $scope.$watch('$window.innerWidth', function(value) {
		        if(value < 670)
		            $rootScope.$displayview = 'mobile';
		        else if(value < 900)
		            $rootScope.$displayview = 'tablet';
		        else
		            $rootScope.$displayview = 'desktop';
		    });

				function timeDifference(current, previous) {

						var msPerMinute = 60 * 1000;
						var msPerHour = msPerMinute * 60;
						var msPerDay = msPerHour * 24;
						var msPerMonth = msPerDay * 30;
						var msPerYear = msPerDay * 365;
						var elapsed = current - previous;

						if (elapsed < msPerMinute) {
								return Math.round(elapsed/1000) + ' sec';
						}
						else if (elapsed < msPerHour) {
								return Math.round(elapsed/msPerMinute) + ' min';
						}

						else if (elapsed < msPerDay ) {
								return Math.round(elapsed/msPerHour ) + ' hours';
						}

						else if (elapsed < msPerMonth) {

								if (Math.round(elapsed/msPerDay) == 1){
								return ' ' + Math.round(elapsed/msPerDay) + ' day';
								}
								else {
									return ' ' + Math.round(elapsed/msPerDay) + ' days';
								}

						}

						else if (elapsed < msPerYear) {
								return ' ' + Math.round(elapsed/msPerMonth) + ' months';
						}

						else {
								return ' ' + Math.round(elapsed/msPerYear ) + ' years';
						}
				}

		    $scope.$on('upNotif', function(ev, data){
		    	console.log(data);


					data.time = new Date(data.time.replace(' ', 'T')).getTime();
					data.time = timeDifference(Math.floor(new Date().getTime()),data.time);

					if(!$scope.notifPopups){
						$scope.notifPopups = [];
					}
					$scope.notifPopups.push(data);
					$scope.notifs.unshift(data);
					console.log($scope.notifs);
					$rootScope.notifPopups = $scope.notifPopups;




				})

				$http.get(config.apihandle + 'notifications.php?all=true')
				.then(function(res){
					$scope.unseen = 0;

					for(i=0;i < res.data.length;i++)
					{
					res.data[i].time = new Date(res.data[i].time.replace(' ', 'T')).getTime();
					res.data[i].time = timeDifference(Math.floor(new Date().getTime()),res.data[i].time);
					if(res.data[i].seen != 1){
						$scope.unseen++;
					}

					}

					$scope.notifs =  res.data;


					console.log($scope.notifs);
				})

				$scope.notifsshow = false;

				$scope.notifstoggle = function(){
					if($scope.notifsshow == true){
						$scope.notifsshow = false;
					} else {
						$scope.notifsshow = true;
					}
				}

				$scope.notifsseen = function(target){
					$scope.unseen = 0;
					console.log(target);
					$http.post(config.apihandle + 'seen.php',{
						"target" : target
					})
					.then(function(res){
					})
				}


			}
			})
})(window, document);
