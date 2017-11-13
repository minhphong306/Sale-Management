app.controller('cartCtrl', function ($scope, categoryService, sessionService, productService) {
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

    $scope.cart_info = [];
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
        sessionService.sessionClientAction(request_obj).then(function (response) {
            $scope.products = response.data.data;
            console.log(response);
        });
    };
   
    
    $scope.removeCart = function(item){
        debugger;
        var request_obj = getRequestObject('remove_product');
        request_obj['id'] = item.id;
        
        sessionService.sessionClientAction(request_obj).then(function (response) {
            console.log(response);
        });
    };
    
    $scope.getCartTotal = function(){
        var length = $scope.products.length;
        var total = 0;
        for(var i =0 ; i < length; i++){
            total += products[i].price_out * products[i].quantity;
        }
        return total;
    };
    
    //<editor-fold defaultstate="collapsed" desc="Init function">
    $scope.get_category();
    $scope.get_product();
    //</editor-fold>


});
