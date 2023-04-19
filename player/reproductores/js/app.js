'use strict';
angular.module('EVOLUCIONSTREAM', [ ])
.controller('Reproductor',function($scope){
    $scope.obj = [{'id':1,
               'color':'#ff0000',
                'name':'final'},
                 {'id':2,
               'color':'#ffff99',
                'name':'start'}];
		
    //Colores Reproductor
    $scope.CambiarColor = function(ClaseColor){
          $scope.color=ClaseColor;
    }
    
    
    $scope.invertColor = function (hexTripletColor) {
        var color = hexTripletColor;
        color = color.substring(1);           // remove #
        color = parseInt(color, 16);          // convert to integer
        color = 0xFFFFFF ^ color;             // invert three bytes
        color = color.toString(16);           // convert to hex
        color = ("000000" + color).slice(-6); // pad with leading zeros
        color = "#" + color;                  // prepend #
        return color;
    }
});