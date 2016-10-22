// Define the `phonecatApp` module
var bbcRadioApp = angular.module('bbcRadioApp', []);

// Define the `PhoneListController` controller on the `phonecatApp` module
bbcRadioApp.controller('bbcProductController', function bbcProductController($scope, $http) {
    $scope.search_string  = "";
    $scope.search_results = false;

    $scope.searchByString = function () {
        $http({
            method: 'GET',
            url: '/product/' + $scope.search_string
        }).then(function successCallback(response) {
            $scope.search_results = response.data.atoz.tleo_titles;

        }, function errorCallback(response) {

        });
    };
});