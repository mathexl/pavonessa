(function(window, document){
	define([], function(){
		return function($http, $q, $rootScope, config){
			return {
				getProfile: function(id){
					var defer = $q.defer();
					$http.get(config.apihandle + ("profile.php?_id={{id}}").replace("{{id}}", id))
						.then(
							function success(res){
								defer.resolve(res.data)
							}
						)
					return defer.promise;
				},
				resources: {
							get: function(tbl, ofst, lim, key){
										var defer = $q.defer();
										console.log(("resources.php?table={{tbl}}&offset={{ofst}}&limit={{lim}}&key={{key}}")
										.replace("{{tbl}}",tbl).replace("{{ofst}}", ofst).replace("{{lim}}", lim).replace("{{key}}", key));
										$http.get(config.apihandle + ("resources.php?table={{tbl}}&offset={{ofst}}&limit={{lim}}")
										.replace("{{tbl}}",tbl).replace("{{ofst}}", ofst).replace("{{lim}}", lim))
										.then(
												function success(res){
												defer.resolve(res.data)
												}
										)
										return defer.promise;
							}
				}
			}
		}
	})
})();
