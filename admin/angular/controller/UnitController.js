app.controller('unitCtrl', function ($scope, unitService, NgTableParams) {
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
    };
    $scope.reset_edit_model = function () {
        // init edit model
        $scope.current_edit_model.name = '';
        $scope.current_edit_model.note = '';
    };
    $scope.init_model = function () {
        $scope.reset_add_model();
        $scope.reset_edit_model();
    };

    $scope.load_edit_unit = function (unit) {
        $scope.current_edit_model['id'] = unit.id;
        $scope.current_edit_model['name'] = unit.name;
        $scope.current_edit_model['note'] = unit.note;
    };

    $scope.load_remove_unit = function (unit) {
        $scope.current_remove_model['id'] = unit.id;
        $scope.current_remove_model['name'] = unit.name;
    };
    //</editor-fold>

    $scope.units = [];

    //<editor-fold defaultstate="collapsed" desc="Service function: get, add, edit, remove">
    $scope.getUnit = function () {
        var request_data = getRequestObject('get_unit');

        unitService.unitAction(request_data).then(function (response) {
            $scope.units = response.data.data;
        });
    };

    $scope.addUnit = function () {
        var request_data = getRequestObject('add_unit');
        request_data['name'] = $scope.current_add_model.name;
        request_data['note'] = $scope.current_add_model.note;

        unitService.unitAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Thêm mới đơn vị thành công', 'success');
            $('#myModalAdd').modal('hide');
            $scope.reset_add_model()
            $scope.getUnit();
        });
    };

    $scope.editUnit = function () {
        var request_data = getRequestObject('edit_unit');
        request_data['id'] = $scope.current_edit_model.id;
        request_data['name'] = $scope.current_edit_model.name;
        request_data['note'] = $scope.current_edit_model.note;

        unitService.unitAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Sửa đơn vị thành công', 'warning');
            $('#myModalEdit').modal('hide');
            $scope.reset_edit_model()
            $scope.getUnit();
        });
    };

    $scope.removeUnit = function () {
        var request_data = getRequestObject('remove_unit');
        request_data['id'] = $scope.current_remove_model.id;

        unitService.unitAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Xóa đơn vị thành công', 'warning');
            $('#myModalRemove').modal('hide');
            $scope.getUnit();
        });
    };
    //</editor-fold>

    //<editor-fold defaultstate="collapsed" desc="Init: auto call function first time">
    $scope.getUnit();
    $scope.init_model();
    //</editor-fold>

});
