'use strict';
angular.module('EVOLUCIONSTREAM',[])
.controller('Reproductor',function($scope){

    $scope.CambiarTema = function(ClaseTema){
          $scope.tema=ClaseTema;
    }

    $scope.CambiarColor = function(){
        if($('#colorpicker input').attr('value')[0]=="#")
            $scope.color=$('#colorpicker input').attr('value').substring(1);
        else
            $scope.color=$('#colorpicker input').attr('value')
    }
    
});