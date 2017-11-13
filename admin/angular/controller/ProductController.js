app.controller('productCtrl', function ($scope, productService, categoryService, unitService) {
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

    $scope.products = [];
    $scope.display_mode = 'table';
    $scope.categories = [];
    $scope.units = [];

    $scope.selected_category = '';

    //<editor-fold defaultstate="collapsed" desc="External function: changeDisplayMode, getCategory, getUnit">
    $scope.change_display_mode = function (mode) {
        $scope.display_mode = mode
    }

    $scope.getCategory = function () {
        var request_data = getRequestObject('get_category');

        categoryService.categoryAction(request_data).then(function (response) {
            $scope.categories = response.data.data;
        });
    }

    $scope.getUnit = function () {
        var request_data = getRequestObject('get_unit');

        unitService.unitAction(request_data).then(function (response) {
            $scope.units = response.data.data;
        });
    };
    //</editor-fold>

    //<editor-fold defaultstate="collapsed" desc="Service function: get, add, edit, remove">
    $scope.getProduct = function () {
        var request_data = getRequestObject('get_product');

        productService.productAction(request_data).then(function (response) {
            $scope.products = response.data.data;
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
    $scope.getUnit();
    $scope.getCategory();
    $scope.getProduct();
    $scope.init_model();
    //</editor-fold>

});

app.controller('addProductCtrl', function ($scope, productService, categoryService, unitService, promotionService, galleryService, fileUpload) {
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

    $scope.image_upload = {};
    $scope.parent_categories = [];
    $scope.child_categories = [];
    $scope.units = [];
    $scope.promotions = [];
    $scope.galleries = [];

    $scope.selected_image = {};
    $scope.selected_promotion = {};
    $scope.selected_unit = {};
    $scope.selected_category = {};
    $scope.selected_parent_category = {};

    $scope.preview_image = 'default.jpg';


    $scope.promotion_value = '';

    //<editor-fold defaultstate="collapsed" desc="External function: getCategory, getUnit, getPromotion, getGallery, readImageURL">

    $scope.getCategory = function () {
        var request_data = getRequestObject('get_parent_category');

        categoryService.categoryAction(request_data).then(function (response) {
            $scope.parent_categories = response.data.data;
        });
    };

    $scope.getChildCategory = function () {
        var request_data = getRequestObject('get_child_category');
        request_data['parent_id'] = $scope.selected_parent_category.id;

        categoryService.categoryAction(request_data).then(function (response) {
            $scope.child_categories = response.data.data;
        });
    };

    $scope.getUnit = function () {
        var request_data = getRequestObject('get_unit');

        unitService.unitAction(request_data).then(function (response) {
            $scope.units = response.data.data;
        });
    };

    $scope.getActivePromotion = function () {
        var request_data = getRequestObject('get_active_promotion');

        promotionService.promotionAction(request_data).then(function (response) {
            $scope.promotions = response.data.data;
        });
    };

    $scope.loadGallery = function () {
        galleryService.galleryAction('test').then(function (response) {
            console.log(response.data);
            $scope.galleries = response.data;
        });
    };
    //</editor-fold>

    //<editor-fold defaultstate="collapsed" desc="Init: auto call function first time">
    $scope.getUnit();
    $scope.getCategory();
    $scope.getActivePromotion();
    $scope.init_model();
    //</editor-fold>



    $scope.addProduct = function () {

        console.log($scope.current_add_model);
        console.log($scope.selected_unit);
        console.log($scope.selected_category);
        // upload image
        var file = $scope.myFile;
        console.log(file);
        if (file) {
            fileUpload.uploadFileToUrl(file).then(function (response) {
                console.info('UPLOAD RESPONSE', response);
//                 addProduct($cat_id, $unit_id, $name, $description, $price, $image);
                var request_data = getRequestObject('add_product');

                request_data['cat_id'] = $scope.selected_category.id;
                request_data['unit_id'] = $scope.selected_unit.id;
                request_data['name'] = $scope.current_add_model.name;
                request_data['description'] = $scope.current_add_model.description;
                request_data['price'] = $scope.current_add_model.price;
                request_data['image'] = response.data.file_name;
                productService.productAction(request_data).then(function (response) {
                    show_notify('Thông báo', 'Thêm mới sản phẩm thành công', 'success');
                    $('#myModalAdd').modal('hide');
                    $scope.reset_add_model()
                    $scope.getCategory();
                });
            });
        } else {
            var request_data = getRequestObject('add_product');

            request_data['cat_id'] = $scope.selected_category.id;
            request_data['unit_id'] = $scope.selected_unit.id;
            request_data['name'] = $scope.current_add_model.name;
            request_data['description'] = $scope.current_add_model.description;
            request_data['price'] = $scope.current_add_model.price;
            request_data['image'] = $scope.preview_image;
            productService.productAction(request_data).then(function (response) {
                show_notify('Thông báo', 'Thêm mới sản phẩm thành công', 'success');
                $('#myModalAdd').modal('hide');
                $scope.reset_add_model()
                $scope.getCategory();
            });
        }

    };

    $scope.promotionChange = function (promotion) {
        debugger;
        $scope.current_add_model.promotion = $scope.selected_promotion;
        console.log($scope.current_add_model);
    };

    $scope.chooseImage = function (promotion) {
        $scope.preview_image = $scope.selected_image == '' ? 'default.jpg' : $scope.selected_image;
        $('#myModalGallery').modal('hide');
    };

    $scope.imageChange = function (item) {
        $scope.selected_image = item;
        var length = $scope.galleries.length;
        for (var i = 0; i < length; i++) {
            if (item == $scope.galleries[i]) {
                $scope.galleries[i].status = true;
                $scope.selected_image = $scope.galleries[i].file_name;
            } else {
                $scope.galleries[i].status = false;
            }
        }
    }

});

function readURL(input) {
    console.log(input.files);
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img_thumbnail')
                    .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}