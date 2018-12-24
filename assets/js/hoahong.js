var app = angular.module("hoahong", []);

app.controller("mainCtrl",['$scope',function ($scope){
    $scope.hoahong = [];
    if (typeof hoahong != 'undefined') $scope.hoahong = hoahong;

    $scope.textHoaHong = function(){
        return angular.toJson($scope.hoahong);
    }
    $scope.addHoaHong = function(){
        var h = {min: 0,max: 0, percent: 0};
        $scope.hoahong.push(h);
    }
    $scope.deleteHoaHong = function (h){
        $scope.hoahong.splice(h.id,1);
        for (var i=0; i<$scope.hoahong.length;i++){
            var tmp = $scope.hoahong[i];
            tmp.id = i;
        }
    }
    $scope.submit = function(){
        $('#resellerForm').submit();
    }
}]);
app.directive('numberFormat', ['$filter', '$parse', function ($filter, $parse) {
    return {
        require: 'ngModel',
        link: function (scope, element, attrs, ngModelController) {
            var decimals = $parse(attrs.decimals)(scope);

            ngModelController.$parsers.push(function (data) {
                //convert data from view format to model format
                var num = element.val();
                num = num.replace(/,/gi, "");
                num = parseFloat(num).toString();
                if (num == 'NaN') num = 0;
                num = num.split("").reverse().join("");

                var num2 = RemoveRougeChar(num.replace(/(.{3})/g, "$1,").split("").reverse().join(""));
                element.val(num2);
                return num2;
            });
        }
    }
}]);

function RemoveRougeChar(convertString) {
if (convertString.substring(0, 1) == ",") {
    return convertString.substring(1, convertString.length)
}
return convertString;
}