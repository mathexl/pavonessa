(function(document, window){
    define([], function(){
        var run = function ($route, $rootScope, $location, $q, $http, config) {
            var original = $location.path;
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

            $(document).scroll(function(ev){
                $rootScope.$broadcast('upScroll', {scrollTop: $(document).scrollTop()});
                $rootScope.$broadcast('upBottomPage');
            });

            $rootScope.$on("$locationChangeStart", function(ev, next, current){

                if(next.match(/.*\/#\/logout/i)) {
                    return;
                }
                if($rootScope.user){
                    if($rootScope.user.accountsetup < 1){
                        $location.path('/set-account', true);
                        return;
                    } else if(next.match('/set-account.*')){
                        $location.path('/dashboard', true);
                        return;
                    }
                }
                $rootScope.$broadcast("locationChanged", {data: next.match(/\/#\/.*/i)});
            });
        }

        run.$inject = ['$route', '$rootScope', '$location', '$q', '$http'];
        return run;
    })
})(document, window);