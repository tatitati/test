// Define the `phonecatApp` module
var bbcRadioApp = angular.module('bbcRadioApp', []);

// Define the `PhoneListController` controller on the `phonecatApp` module
bbcRadioApp.controller('bbcProductController', function bbcProductController($scope, $http) {
    $scope.search_string  = "";
    $scope.search_results = false;

    $scope.searchByString = function () {
        $scope.loading = true;
        $http({
            method: 'GET',
            url: '/product/' + $scope.search_string
        }).then(function successCallback(response) {
            $scope.search_results = response.data.atoz.tleo_titles;
            $scope.loading        = false;
        }, function errorCallback(response) {

        });
    };

    $scope.$watch('search_string', function(nVal, oVal) {
        $scope.search_results = false;
        if (nVal !== oVal) {
            $scope.searchByString();
        }
    });
});