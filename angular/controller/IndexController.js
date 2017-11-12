app.controller('indexCtrl', function ($scope, categoryService, sessionService, productService) {
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

    $scope.reset_prepare_model = function () {
        // init add model
        $scope.prepare_item = {};
    };
    

    $scope.load_edit_index = function (index) {
        $scope.current_edit_model['id'] = index.id;
        $scope.current_edit_model['name'] = index.name;
        $scope.current_edit_model['note'] = index.note;
    };

    $scope.load_remove_index = function (index) {
        $scope.current_remove_model['id'] = index.id;
        $scope.current_remove_model['name'] = index.name;
    };
    //</editor-fold>

    $scope.prepare_item = {};
    $scope.parent_categories = [];
    $scope.products = [];
    $scope.product_quantity = 1;

    $scope.get_category = function () {
        var request_obj = getRequestObject('get_parent_category');
        categoryService.getCategory(request_obj).then(function (response) {
            $scope.parent_categories = response.data.data;
        });
    };

    $scope.get_product = function () {
        var request_obj = getRequestObject('get_product');
        productService.getProduct(request_obj).then(function (response) {
            $scope.products = response.data.data;
        });
    };
    
    $scope.preprareAddToCart = function(item){
        $scope.prepare_item = item;
    };
    
    $scope.addToCart = function(){
        var request_obj = getRequestObject('add_product');
        request_obj['id'] = $scope.prepare_item.id;
        request_obj['name'] = $scope.prepare_item.name;
        request_obj['description'] = $scope.prepare_item.description;
        request_obj['price'] = $scope.prepare_item.price;
        request_obj['image'] = $scope.prepare_item.image;
        request_obj['promotion_name'] = $scope.prepare_item.promotion_name;
        request_obj['promotion_type'] = $scope.prepare_item.promotion_type;
        request_obj['promotion_value'] = $scope.prepare_item.promotion_value;
        request_obj['quantity'] = $scope.product_quantity;
        
        sessionService.sessionClientAction(request_obj).then(function (response) {
            $scope.reset_prepare_model();
            
        });
        
    };
    
    //<editor-fold defaultstate="collapsed" desc="Init function">
    $scope.get_category();
    $scope.get_product();
    //</editor-fold>


});
