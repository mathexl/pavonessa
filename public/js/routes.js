define([], function(){
	function config($routeProvider, config) {


	    function getUser($http, $rootScope, $location, config){
   			 return $http.get(config.apihandle + "authjs.php")
            	.then(
	                function success(res) {
	                    user = res.data;
	                    $rootScope.user = res.data;
	                    if(user.accountsetup < 1){
	                        $location.path('/set-account');
	                    }
											console.log(res.data);
	                    return (res.data);
	                },
	                function error(reason)     { return false; }
	            );
		}

	    $routeProvider
	    .when('/create/:id', {
	        redirectTo: '/set-account',
	        resolve: {
	            user: getUser
	        }
	    })
	    .when('/logout/', {
	        template: '<script>document.location="' + config.projectdir + '?pageid=logout"</script>',
	        resolve: {
	            user: getUser
	        }
	    })
			.when('/loading/', {
					templateUrl: 'public/views/loading.php',
					resolve: {
							user: getUser
					}
			})
	    .when('/login/', {
	        controller: function($scope, $location){
	            $location.path('/dashboard');
	        },
	        template: ' ',
	        resolve: {
	            user: getUser
	        }
	    })
	    .otherwise({
	        redirectTo: '/dashboard',
	        resolve: {
	            user: getUser
	        }
	    });
	}

	return config;
})
