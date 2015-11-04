(function(document, window){
  require.config({
    baseUrl: 'public/js/',
  })

  require(['routes','formdataConfig','run','directives','controllers','ng-s3upload','services','playground'], 
    function(routes, formdataConfig, run){
      var config = {apihandle:"//" + window.location.host + "/core/controllers/",projectdir:"//" + window.location.host + "/"};

      Date.prototype.yyyymmdd = function() {
         var yyyy = this.getFullYear().toString();
         var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
         var dd  = this.getDate().toString();
         return yyyy + '-' + (mm[1]?mm:"0"+mm[0]) + '-' +  (dd[1]?dd:"0"+dd[0]); // padding
      };

      Date.prototype.mmdd = function() {
         var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
         var dd  = this.getDate().toString();
         return (mm[1]?mm:"0"+mm[0]) + '/' +  (dd[1]?dd:"0"+dd[0]); // padding
      };

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

      angular.module('pavonessa',['ngRoute','pavonessa.directives','pavonessa.controllers', 'pavonessa.services','ngS3upload','pavonessa.playground'])
      .constant('config',config)
      .config(routes)
      .config(formdataConfig)
      .run(run);

      angular.bootstrap(document, ['pavonessa']);

    }
  );
})(document, window);