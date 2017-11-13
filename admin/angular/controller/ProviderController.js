app.controller('providerCtrl', function ($scope, providerService) {
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
        $scope.current_add_model.phone = '';
        $scope.current_add_model.email = '';
        $scope.current_add_model.address = '';
        $scope.current_add_model.note = '';
    };
    $scope.reset_edit_model = function () {
        // init edit model
        $scope.current_edit_model.name = '';
        $scope.current_add_model.phone = '';
        $scope.current_add_model.email = '';
        $scope.current_add_model.address = '';
        $scope.current_edit_model.note = '';
    };
    $scope.init_model = function () {
        $scope.reset_add_model();
        $scope.reset_edit_model();
    };

    $scope.load_edit_provider = function (provider) {
        $scope.current_edit_model['id'] = provider.id;
        $scope.current_edit_model['name'] = provider.name;
        $scope.current_edit_model['phone'] = provider.phone;
        $scope.current_edit_model['email'] = provider.email;
        $scope.current_edit_model['address'] = provider.address;
        $scope.current_edit_model['note'] = provider.note;
    };

    $scope.load_remove_provider = function (provider) {
        $scope.current_remove_model['id'] = provider.id;
        $scope.current_remove_model['name'] = provider.name;
        $scope.current_remove_model['phone'] = provider.name;
        $scope.current_remove_model['email'] = provider.name;
        $scope.current_remove_model['address'] = provider.name;
        $scope.current_remove_model['note'] = provider.name;
    };
    //</editor-fold>

    $scope.providers = [];

    //<editor-fold defaultstate="collapsed" desc="Service function: get, add, edit, remove">
    $scope.getProvider = function () {
        var request_data = getRequestObject('get_provider');

        providerService.providerAction(request_data).then(function (response) {
            $scope.providers = response.data.data;
        });
    };
    
    $scope.addProvider = function () {
        var request_data = getRequestObject('add_provider');
        request_data['name'] = $scope.current_add_model.name;
        request_data['phone'] = $scope.current_add_model.phone;
        request_data['email'] = $scope.current_add_model.email;
        request_data['address'] = $scope.current_add_model.address;
        request_data['note'] = $scope.current_add_model.note;

        providerService.providerAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Thêm mới NCC thành công', 'success');
            $('#myModalAdd').modal('hide');
            $scope.reset_add_model()
            $scope.getProvider();
        });
    };
    
    $scope.editProvider = function () {
        var request_data = getRequestObject('edit_provider');
        request_data['id'] = $scope.current_edit_model.id;
        request_data['name'] = $scope.current_edit_model.name;
        request_data['phone'] = $scope.current_edit_model.phone;
        request_data['email'] = $scope.current_edit_model.email;
        request_data['address'] = $scope.current_edit_model.address;
        request_data['note'] = $scope.current_edit_model.note;

        providerService.providerAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Sửa NCC thành công', 'warning');
            $('#myModalEdit').modal('hide');
            $scope.reset_edit_model()
            $scope.getProvider();
        });
    };

    $scope.removeProvider = function () {
        var request_data = getRequestObject('remove_provider');
        request_data['id'] = $scope.current_remove_model.id;

        providerService.providerAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Xóa NCC thành công', 'warning');
            $('#myModalRemove').modal('hide');
            $scope.getProvider()();
        });
    };

    //</editor-fold>

    //<editor-fold defaultstate="collapsed" desc="Init: auto call function first time">
    $scope.getProvider();
    $scope.init_model();
    //</editor-fold>
});