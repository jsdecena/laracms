var app = angular.module('laracms.blog.controller',[]);

app.controller('GetPostsController', ['$scope', function($scope, $http) {
    $http({
        url     : 'api/v1/posts'
    }).success(function(res) {
        return res;
    });
}]);