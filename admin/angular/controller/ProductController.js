app.controller('productCtrl', function ($scope, productService, NgTableParams) {
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

    $scope.load_edit_product = function (product) {
        $scope.current_edit_model['id'] = product.id;
        $scope.current_edit_model['name'] = product.name;
        $scope.current_edit_model['note'] = product.note;
    };

    $scope.load_remove_product = function (product) {
        $scope.current_remove_model['id'] = product.id;
        $scope.current_remove_model['name'] = product.name;
    };
    //</editor-fold>

    $scope.data = [];
    $scope.display_mode = 'grid';
    
    //<editor-fold defaultstate="collapsed" desc="External function: changeDisplayMode">
    $scope.change_display_mode = function(mode){
        $scope.display_mode = mode
    }
    //</editor-fold>

    //<editor-fold defaultstate="collapsed" desc="Service function: get, add, edit, remove">
    $scope.getProduct = function () {
        var request_data = getRequestObject('get_product');

        productService.productAction(request_data).then(function (response) {
            $scope.data = response.data.data;
        });
    };

    $scope.addProduct = function () {
        var request_data = getRequestObject('add_product');
        request_data['name'] = $scope.current_add_model.name;
        request_data['note'] = $scope.current_add_model.note;

        productService.productAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Thêm mới sản phẩm thành công', 'success');
            $('#myModalAdd').modal('hide');
            $scope.reset_add_model()
            $scope.getproduct();
        });
    };

    $scope.editProduct = function () {
        var request_data = getRequestObject('edit_product');
        request_data['id'] = $scope.current_edit_model.id;
        request_data['name'] = $scope.current_edit_model.name;
        request_data['note'] = $scope.current_edit_model.note;

        productService.productAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Sửa sản phẩm thành công', 'warning');
            $('#myModalEdit').modal('hide');
            $scope.reset_edit_model()
            $scope.getproduct();
        });
    };

    $scope.removeProduct = function () {
        var request_data = getRequestObject('remove_product');
        request_data['id'] = $scope.current_remove_model.id;

        productService.productAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Xóa sản phẩm thành công', 'warning');
            $('#myModalRemove').modal('hide');
            $scope.getproduct();
        });
    };
    //</editor-fold>

    //<editor-fold defaultstate="collapsed" desc="Init: auto call function first time">
    $scope.getProduct();
    $scope.init_model();
    //</editor-fold>

});
