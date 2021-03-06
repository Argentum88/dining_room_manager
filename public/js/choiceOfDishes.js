var choiceOfDishes = angular.module('choiceOfDishes', []);

choiceOfDishes.directive('items', function(){
    return {
        restrict: 'E',
        template: '<div ng-include="templateUrl"></div>',
        controller: function($scope, $http) {        //TODO добавить обработку ошибок
            $scope.data = data;
            $scope.templateUrl = '/public/template/itemDishes.phtml';
            if ('parent' in $scope.data[0])
                $scope.templateUrl = '/public/template/typeDishes.phtml';
            $scope.checkTypeDishes = function(){
                $http.get('/Customer/getDishes?id='+this.item.id).success(function(data){
                    $scope.data = data;
                    if ('item_type_id' in $scope.data[0])
                        $scope.templateUrl = '/public/template/itemDishes.phtml';
                });
            };
            $scope.takeOrder = function(index){
                $http.get('/Customer/takeOrder?id='+this.item.id+'&quantity='+document.getElementsByClassName('quantity')[index].value);
            };
        }
    }
});
