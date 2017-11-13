app.controller('promotionCtrl', function ($scope, promotionService) {
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

    $scope.load_edit_promotion = function (promotion) {
        $scope.current_edit_model['id'] = promotion.id;
        $scope.current_edit_model['name'] = promotion.name;
        $scope.current_edit_model['note'] = promotion.note;
    };

    $scope.load_remove_promotion = function (promotion) {
        $scope.current_remove_model['id'] = promotion.id;
        $scope.current_remove_model['name'] = promotion.name;
    };
    //</editor-fold>

    $scope.promotions = [];

    //<editor-fold defaultstate="collapsed" desc="Service function: get, add, edit, remove">
    $scope.getPromotion = function () {
        var request_data = getRequestObject('get_promotion');

        promotionService.promotionAction(request_data).then(function (response) {
            $scope.promotions = response.data.data;
        });
    };

    $scope.addPromotion = function () {
        var request_data = getRequestObject('add_promotion');
        request_data['name'] = $scope.current_add_model.name;
        request_data['note'] = $scope.current_add_model.note;

        promotionService.promotionAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Thêm mới khuyến mại thành công', 'success');
            $('#myModalAdd').modal('hide');
            $scope.reset_add_model()
            $scope.getPromotion();
        });
    };

    $scope.editPromotion = function () {
        var request_data = getRequestObject('edit_promotion');
        request_data['id'] = $scope.current_edit_model.id;
        request_data['name'] = $scope.current_edit_model.name;
        request_data['note'] = $scope.current_edit_model.note;

        promotionService.promotionAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Sửa khuyến mại thành công', 'warning');
            $('#myModalEdit').modal('hide');
            $scope.reset_edit_model()
            $scope.getPromotion();
        });
    };

    $scope.removePromotion = function () {
        var request_data = getRequestObject('remove_promotion');
        request_data['id'] = $scope.current_remove_model.id;

        promotionService.promotionAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Xóa khuyến mại thành công', 'warning');
            $('#myModalRemove').modal('hide');
            $scope.getPromotion();
        });
    };
    //</editor-fold>

    //<editor-fold defaultstate="collapsed" desc="Init: auto call function first time">
    $scope.getPromotion();
    $scope.init_model();
    //</editor-fold>

});


app.controller('addPromotionCtrl', function ($scope, promotionService, productService, categoryService) {
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


    $scope.init_model = function () {
        // init add model
        $scope.current_add_model.cat_id = '';
        $scope.current_add_model.unit_id = '';
        $scope.current_add_model.name = '';
        $scope.current_add_model.promotion = {};
        $scope.current_add_model.description = '';
        $scope.current_add_model.promotion_value = '';
        $scope.current_add_model.price = '';

    };
    //</editor-fold>

    $scope.products = [];
    $scope.category_service = [];


    //<editor-fold defaultstate="collapsed" desc="External function: getProduct">

    $scope.getProduct = function () {
        var request_data = getRequestObject('get_product');

        productService.productAction(request_data).then(function (response) {
            $scope.products = response.data.data;
        });
    };

    $scope.getCategory = function () {
        var request_data = getRequestObject('get_category');

        categoryService.productAction(request_data).then(function (response) {
            $scope.category_service = response.data.data;
        });
    };
    //</editor-fold>

    //<editor-fold defaultstate="collapsed" desc="Service function: add">
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

    //</editor-fold>

    //<editor-fold defaultstate="collapsed" desc="Init: auto call function first time">
    $scope.getProduct();
    $scope.init_model();

    $('#start_time').datetimepicker({
        locale: 'vi'
    });
    $('#end_time').datetimepicker();
    //</editor-fold>






});
