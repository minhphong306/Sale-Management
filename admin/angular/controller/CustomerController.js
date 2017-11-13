app.controller('customerCtrl', function ($scope, customerService) {
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


    $scope.current_add_model = {};
    $scope.current_edit_model = {};
    $scope.current_remove_model = {};

    $scope.reset_add_model = function () {
        // init add model
        $scope.current_add_model.name = '';
        $scope.current_add_model.note = '';
        $scope.is_error = false;
        $scope.error_message = "";
    };
    $scope.reset_edit_model = function () {
        // init edit model
        $scope.current_edit_model.name = '';
        $scope.current_edit_model.note = '';
        $scope.is_error = false;
        $scope.error_message = "";
    };
    $scope.init_model = function () {
        $scope.reset_add_model();
        $scope.reset_edit_model();
    };

    $scope.load_edit_customer = function (customer) {
        $scope.current_edit_model['id'] = customer.id;
        $scope.current_edit_model['name'] = customer.name;
        $scope.current_edit_model['phone'] = customer.phone;
        $scope.current_edit_model['email'] = customer.email;
        $scope.current_edit_model['password'] = customer.password;
        $scope.current_edit_model['address'] = customer.address;
        $scope.current_edit_model['facebook'] = customer.facebook;
        $scope.current_edit_model['note'] = customer.note;
        $scope.is_error = false;
        $scope.error_message = "";
    };

    $scope.load_remove_customer = function (customer) {
        $scope.current_remove_model['id'] = customer.id;
        $scope.current_remove_model['name'] = customer.name;
        $scope.is_error = false;
        $scope.error_message = "";
    };
    //</editor-fold>

    $scope.is_error = false;
    $scope.error_message = "haha";

    $scope.customerSortType = '';
    $scope.customerSortReverse = '';
    $scope.customerSortSearchQuery = '';

    $scope.customers = [];

    //<editor-fold defaultstate="collapsed" desc="Service function: get, add, edit, remove">
    $scope.getCustomer = function () {
        var request_data = getRequestObject('get_customer');

        customerService.customerAction(request_data).then(function (response) {
            $scope.customers = response.data.data;
        });
    };

    $scope.addCustomer = function () {
        var request_data = getRequestObject('add_customer');
        request_data['name'] = $scope.current_add_model.name;
        request_data['phone'] = $scope.current_add_model.phone;
        request_data['email'] = $scope.current_add_model.email;
        request_data['password'] = $scope.current_add_model.password;
        request_data['address'] = $scope.current_add_model.address;
        request_data['facebook'] = $scope.current_add_model.facebook;
        request_data['note'] = $scope.current_add_model.note;

        // Check error 
        if (!$scope.current_add_model.name) {
            $scope.is_error = true;
            $scope.error_message = "Vui lòng nhập vào tên khách hàng";
            return;
        }

        customerService.customerAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Thêm mới khách hàng thành công', 'success');
            $('#myModalAdd').modal('hide');
            $scope.reset_add_model();
            $scope.getCustomer();
        });
    };

    $scope.editCustomer = function () {
        var request_data = getRequestObject('edit_customer');
        request_data['id'] = $scope.current_edit_model.id;
        request_data['name'] = $scope.current_edit_model.name;
        request_data['phone'] = $scope.current_edit_model.phone;
        request_data['email'] = $scope.current_edit_model.email;
        request_data['password'] = $scope.current_edit_model.password;
        request_data['address'] = $scope.current_edit_model.address;
        request_data['facebook'] = $scope.current_edit_model.facebook;
        request_data['note'] = $scope.current_edit_model.note;


// Check error 
        if (!$scope.current_edit_model.name) {
            $scope.is_error = true;
            $scope.error_message = "Vui lòng nhập vào tên khách hàng";
            return;
        }
        customerService.customerAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Sửa khách hàng thành công', 'warning');
            $('#myModalEdit').modal('hide');
            $scope.reset_edit_model()
            $scope.getCustomer();
        });
    };

    $scope.removeCustomer = function () {
        var request_data = getRequestObject('remove_customer');
        request_data['id'] = $scope.current_remove_model.id;

        customerService.customerAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Xóa khách hàng thành công', 'warning');
            $('#myModalRemove').modal('hide');
            $scope.getCustomer();
        });
    };
    //</editor-fold>

    //<editor-fold defaultstate="collapsed" desc="Init: auto call function first time">
    $scope.getCustomer();
    $scope.init_model();
    //</editor-fold>

});
