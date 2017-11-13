app.controller('receiptCtrl', function ($scope, receiptService, productService, providerService) {
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
    $scope.reset_data = function () {
        $scope.bill_note = '';
         $scope.carts = [];
    };

    $scope.load_edit_receipt = function (receipt) {
        $scope.current_edit_model['id'] = receipt.id;
        $scope.current_edit_model['name'] = receipt.name;
        $scope.current_edit_model['note'] = receipt.note;
        $scope.is_error = false;
        $scope.error_message = "";
    };

    $scope.load_remove_receipt = function (receipt) {
        $scope.current_remove_model['id'] = receipt.id;
        $scope.current_remove_model['name'] = receipt.name;
        $scope.is_error = false;
        $scope.error_message = "";
    };
    //</editor-fold>

    $scope.is_error = false;
    $scope.error_message = "haha";

    $scope.receiptSortType = '';
    $scope.receiptSortReverse = '';
    $scope.receiptSortSearchQuery = '';

    $scope.receipts = [];
    $scope.products = [];
    $scope.carts = [];
    $scope.providers = [];
    $scope.selected_provider = {};
    $scope.bill_note = '';

    //<editor-fold defaultstate="collapsed" desc="Service function: get, add, edit, remove">
    $scope.getReceipt = function () {
        var request_data = getRequestObject('get_receipt');

        receiptService.receiptAction(request_data).then(function (response) {
            $scope.receipts = response.data.data;
        });
    };

    $scope.addReceipt = function () {
        var request_data = getRequestObject('add_receipt');
        request_data['name'] = $scope.current_add_model.name;
        request_data['note'] = $scope.current_add_model.note;

        // Check error 
        if (!$scope.current_add_model.name) {
            $scope.is_error = true;
            $scope.error_message = "Vui lòng nhập vào tên danh mục";
            return;
        }

        receiptService.receiptAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Thêm mới đơn vị thành công', 'success');
            $('#myModalAdd').modal('hide');
            $scope.reset_add_model();
            $scope.getReceipt();
        });
    };

    $scope.editReceipt = function () {
        var request_data = getRequestObject('edit_receipt');
        request_data['id'] = $scope.current_edit_model.id;
        request_data['name'] = $scope.current_edit_model.name;
        request_data['note'] = $scope.current_edit_model.note;


// Check error 
        if (!$scope.current_edit_model.name) {
            $scope.is_error = true;
            $scope.error_message = "Vui lòng nhập vào tên danh mục";
            return;
        }
        receiptService.receiptAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Sửa đơn vị thành công', 'warning');
            $('#myModalEdit').modal('hide');
            $scope.reset_edit_model()
            $scope.getReceipt();
        });
    };

    $scope.removeReceipt = function () {
        var request_data = getRequestObject('remove_receipt');
        request_data['id'] = $scope.current_remove_model.id;

        receiptService.receiptAction(request_data).then(function (response) {
            show_notify('Thông báo', 'Xóa đơn vị thành công', 'warning');
            $('#myModalRemove').modal('hide');
            $scope.getReceipt();
        });
    };
    //</editor-fold>

    //<editor-fold defaultstate="collapsed" desc="External function">
    $scope.getProduct = function () {
        var request_data = getRequestObject('get_product');

        productService.productAction(request_data).then(function (response) {
            $scope.products = response.data.data;
        });
    };
    
    $scope.getProvider = function () {
        var request_data = getRequestObject('get_provider');

        providerService.providerAction(request_data).then(function (response) {
            $scope.providers = response.data.data;
        });
    };
    
    
    //</editor-fold>


    //<editor-fold defaultstate="collapsed" desc="Init: auto call function first time">
    $scope.getProduct();
    $scope.getProvider();
    $scope.reset_data();
    //</editor-fold>


    $scope.addToCart = function (item) {
        // Check if item already exist
        for(var i = 0; i< $scope.carts.length; i++){
            if($scope.carts[i].id == item.id){
                $scope.carts[i].quantity++;
                return;
            }
        }
        
        var obj = angular.copy(item);
        obj['quantity'] = 1;
        $scope.carts.push(obj);
    };

    $scope.removeFromCart = function (item) {
        $scope.carts.splice($scope.carts.indexOf(item), 1);
    };

    $scope.getCartTotal = function (item) {
        var length = $scope.carts.length;
        var total = 0;
        for (var i = 0; i < length; i++) {
            total += $scope.carts[i].price_in * $scope.carts[i].quantity;
        }
        return total;
    };

    $scope.getCartQuantity = function (item) {
        var length = $scope.carts.length;
        var total = 0;
        for (var i = 0; i < length; i++) {
            total += $scope.carts[i].quantity;
        }
        return total;
    };
    
    $scope.checkOut = function(){
        var obj = getRequestObject('checkout_order_in');
        obj['provider_id'] = $scope.selected_provider.id;
        obj['note'] = $scope.bill_note;
        obj['data'] = $scope.carts;
        obj['total'] = $scope.getCartTotal();
        receiptService.receiptAction(obj).then(function(response){
            $scope.reset_data();
            show_notify('Thông báo', 'Thanh toán hóa đơn thành công', 'success');
        });
    };
});
