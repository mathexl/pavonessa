(function(document, window){
  require.config({
    baseUrl: 'public/js/',
  })

  require(['routes','formdataConfig','run','directives','controllers','ng-s3upload','services'],
    function(routes, formdataConfig, run){
      var config = {apihandle:"//" + window.location.host + "/core/controllers/",projectdir:"//" + window.location.host + "/"};

      String.prototype.hash = function() {
        var str = this;
        var hash = 0, i, chr, len;
        if (str.length == 0) return hash;
        for (i = 0, len = str.length; i < len; i++) {
          chr   = str.charCodeAt(i);
          hash  = ((hash << 5) - hash) + chr;
          hash |= 0; // Convert to 32bit integer
        }
        return hash;
      };

      angular.module('pavonessa',['ngRoute','pavonessa.directives','pavonessa.controllers', 'pavonessa.services','ngS3upload'])
      .constant('config',config)
      .config(routes)
      .config(formdataConfig)
      .run(run);

      angular.bootstrap(document, ['pavonessa']);

    }
  );
})(document, window);
