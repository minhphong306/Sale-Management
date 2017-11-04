app.controller('loginCtrl', function ($scope, loginService) {
    //<editor-fold defaultstate="collapsed" desc="Until model & function">
    function getRequestObject(mode) {
        var object = {};
        object['mode'] = mode;
        return object;
    }

    function show_notify(title, text, type) {
        (new PNotify({
            title: title,
            text: text,
            type: type
        }));
    }

    //</editor-fold>

    $scope.username = '';
    $scope.password = '';
    
    
    $scope.login = function () {
        var obj = {};
        obj.username = $scope.username;
        obj.password = $scope.password;
        
        loginService.loginAction(obj).then(function(response){
            console.log(response.data.status);
            if(response.data.status == true){
                alert('true');
                window.location.href = 'index.php';
            } else {
                alert('Login again');
            }
        });
    };

});
