var app = angular.module('laracms', []);

app.config(['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}]);

app.controller('GetPostsController', function($scope, $http) {
    
    $scope.postsList = [];

    $http({
        url     : 'api/v1/posts'
    }).success(function(res) {

        $scope.postsList = res;
        console.log($scope.postsList);
    });
});