var app = angular.module('laracms', []);

app.config(['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}]);

app.controller('GetPostsController', function($scope, $http, $sce) {
    
    $scope.postsList = [];

    $http({
        url     : 'api/v1/posts'
    }).success(function(res) {

        //ITERATE ON THE FETCHED DATA
        angular.forEach(res, function(value, key) {
          
          //MERGE THE TWO OBJECTS IN AN ARRAY
          var object = angular.merge({}, value.post, value.author)

          //ASSIGN THE OBJECT TO SCOPE VARIABLE
          $scope.postsList.push(object);

        });

        console.log($scope.postsList);
        
        $scope.getHtml = function(html){
            return $sce.trustAsHtml(html);
        };
    });
});

app.filter('html', function($sce) {
    return function(val) {
        return $sce.trustAsHtml(val);
    };
});