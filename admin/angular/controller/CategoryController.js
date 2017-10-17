app.controller('categoryCtrl', function ($scope, categoryService, NgTableParams) {
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

    $scope.load_edit_category = function (category) {
        $scope.current_edit_model['id'] = category.id;
        $scope.current_edit_model['name'] = category.name;
        $scope.current_edit_model['note'] = category.note;
    };

    $scope.load_remove_category = function (category) {
        $scope.current_remove_model['id'] = category.id;
        $scope.current_remove_model['name'] = category.name;
    };
    //</editor-fold>

    $scope.data = [];

    //<editor-fold defaultstate="collapsed" desc="Service function: get, add, edit, remove">
    $scope.getCategory = function () {
        var request_data = getRequestObject('get_category');

        categoryService.categoryAction(request_data).then(function (response) {
            $scope.data = response.data.data;
        });
    };

    $scope.addCategory = function () {
        var request_data = getRequestObject('add_category');
        request_data['name'] = $scope.current_add_model.name;
        request_data['note'] = $scope.current_add_model.note;

        categoryService.categoryAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Thêm mới danh mục thành công', 'success');
            $('#myModalAdd').modal('hide');
            $scope.reset_add_model()
            $scope.getCategory();
        });
    };

    $scope.editCategory = function () {
        var request_data = getRequestObject('edit_category');
        request_data['id'] = $scope.current_edit_model.id;
        request_data['name'] = $scope.current_edit_model.name;
        request_data['note'] = $scope.current_edit_model.note;

        categoryService.categoryAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Sửa danh mục thành công', 'warning');
            $('#myModalEdit').modal('hide');
            $scope.reset_edit_model()
            $scope.getCategory();
        });
    };

    $scope.removeCategory = function () {
        var request_data = getRequestObject('remove_category');
        request_data['id'] = $scope.current_remove_model.id;

        categoryService.categoryAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Xóa danh mục thành công', 'warning');
            $('#myModalRemove').modal('hide');
            $scope.getCategory();
        });
    };
    //</editor-fold>

    //<editor-fold defaultstate="collapsed" desc="Init: auto call function first time">
    $scope.getCategory();
    $scope.init_model();
    //</editor-fold>

});
