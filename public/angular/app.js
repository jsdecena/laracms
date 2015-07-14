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
          
          var posts =   { 
                            created : Date.parse(value.post['created_at']),
                            author  : value.author['firstname'],
                            title   : value.post['title'],
                            content : value.post['content']
                        };

          //ASSIGN THE OBJECT TO SCOPE VARIABLE
          $scope.postsList.push(posts);

        });
        
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