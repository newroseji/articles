var myApp = angular.module('myApp',[]);

myApp.controller('AppMainController', ['$scope','$http',
    function($scope,$http) {

    $scope.greeting = 'Hola!';

    $scope.testMe = function(){
        console.log('Yup, it is working!');
    };
}]);