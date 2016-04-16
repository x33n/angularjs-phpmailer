var myApp = angular.module('contactApp',[]);

myApp.controller("contactController", ['$scope', '$http', '$log', function($scope, $http, $log) {

    $scope.title = "Send E-Mail With angularJS & PHPMailer";
    $scope.sendValue = false;
    $scope.isProcessing = true;
    $scope.formData = {};
    // process the form
    $scope.processForm = function (formFields) {
        $scope.sendValue = true;
        var data = $.param($scope.formData);
        var config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'} };
        $http.post('process.php', data, config)
        .then(function(response){

            if (response.data.errors) {
                $log.info(response);
                // if not successful, bind errors to error variables
                $scope.messageFailed = response.data.message;
                $scope.errorName = response.data.errors.fullname;
                $scope.errorEmail = response.data.errors.email;
                $scope.errorMobile = response.data.errors.mobile;
                $scope.errorSubject = response.data.errors.subject;
                $scope.errorContent = response.data.errors.content;
                $scope.sendValue = false;
            }
            else {
                $log.info(response);
                // if successful, bind success message to messageSuccess and bind errors variables to empty
                $scope.messageSuccess = response.data.message;
                $scope.errorName = '';
                $scope.errorEmail = '';
                $scope.errorMobile = '';
                $scope.errorSubject = '';
                $scope.errorContent = '';
                $scope.messageFailed = '';
                $scope.formData = {};
                $scope.sendValue = false;
                // console.log('Sent');
                // console.log($scope.messageSuccess);
            }

        },
        function(response){
            $log.info(response);
        });
    }
}]);