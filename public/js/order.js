var order = angular.module('order', []);

order.controller('orderController', function($scope, $http) {
    $scope.goSearch = function() {
        var requiredUser = document.getElementById('search-order').value;
        $http.get('/Cook/getOrder?login='+requiredUser).success(function(data) {
            $scope.order = [];
            for (var key in data) {
                $scope.order.push({dishes: key, quantity: data[key]});
            }
            $('#orderModal').modal('show');
        });
    }
});
