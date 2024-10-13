<?php 
  include_once 'auth.php';
  $page = "item";
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= TITLE ?> - Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="../../assets/css/main.css">
  <!-- <link rel="stylesheet" href="../../assets/css/dashboard.css"> -->
  <link rel="shortcut icon" href="../../<?= FAV_ICO; ?>" type="image/x-icon">

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
  
</head>
<body>
    <?php include_once 'nav.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12">
                <a href="items" class="btn btn-link">
                    <i class="bi bi-arrow-left-short"></i>
                    Go Back
                </a>
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3>Update Item/Equipment</h3>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <input type="hidden" id="item_uuid">
                            <div class="row">
                                <div class="col-sm-12 col-lg-12 col-md-12">
                                    <label for="i_name">Item Name</label>
                                    <input type="text" class="form-control mb-3" id="i_name">
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-lg-6 col-md-12">
                                    <label for="i_brand">Brand</label>
                                    <input type="text" class="form-control mb-3" id="i_brand">
                                </div>
                                <div class="col-sm-12 col-lg-6 col-md-12">
                                    <label for="i_model">Model</label>
                                    <input type="text" class="form-control mb-3" id="i_model">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-lg-6 col-md-12">
                                    <label for="i_price">Unit Price</label>
                                    <input type="text" class="form-control mb-3" id="i_price" data-type="currency" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$">
                                </div>
                                <div class="col-sm-12 col-lg-6 col-md-12">
                                    <label for="i_handler">MR / Handler</label>
                                    <div class="input-group mb-3">
                                        <select id="i_handler" class="form-control form-select">
                                            <option value="">---</option>
                                        </select>
                                        <div class="input-group-text">
                                            <a href="#" data-bs-toggle="tooltip" title="Add Handler" onclick="handlerModal()">
                                                <i class="bi bi-plus-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-lg-6 col-md-12">
                                    <label for="i_status">Item Status</label>
                                    <div class="input-group mb-3">
                                        <select id="i_status" class="form-control form-select">
                                            <option value="">---</option>
                                        </select>
                                        <div class="input-group-text">
                                            <a href="#" data-bs-toggle="tooltip" title="Add Status" onclick="conditionModal()">
                                                <i class="bi bi-plus-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                
                                </div>
                                <div class="col-sm-12 col-lg-6 col-md-12">
                                    <label for="i_date_acquired">Date Acquired</label>
                                    <input type="date" class="form-control mb-3" id="i_date_acquired">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-lg-6 col-md-12">
                                    <label for="i_assign_room">Assign Room</label>
                                    <div class="input-group mb-3">
                                        <select id="i_assign_room" class="form-control form-select">
                                            <option value="">---</option>
                                        </select>
                                        <div class="input-group-text">
                                            <a href="#" data-bs-toggle="tooltip" title="Add Room" onclick="roomAssignModal()">
                                                <i class="bi bi-plus-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                
                                </div>
                                <div class="col-sm-12 col-lg-6 col-md-12">
                                    <label for="i_category">Category</label>
                                    <div class="input-group mb-3">
                                        <select id="i_category" class="form-control form-select">
                                            <option value="">---</option>
                                        </select>
                                        <div class="input-group-text">
                                            <a href="#" data-bs-toggle="tooltip" title="Add Category" onclick="categoryModal()">
                                                <i class="bi bi-plus-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-lg-6 col-md-12">
                                    <label for="i_type">Type</label>
                                    <select id="i_type" class="form-control form-select mb-3">
                                        <option value="">--select--</option>
                                        <option value="1">Consumable</option>
                                        <option value="2">Non-Consumable</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-6 col-md-12">
                                    <label for="i_name">Quantity</label>
                                    <input type="number" class="form-control mb-3" id="i_qty">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-lg-12 col-md-12">
                                    <label for="i_desc">Description</label>
                                    <textarea id="i_desc" class="form-control mb-3" rows="4" cols="5"></textarea>
                                </div>
                            </div>

                            <button class="btn btn-primary mt-3 float-end" type="submit" id="saveItem">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- category modal  -->
    <div class="modal" id="categoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="cat_name">Category Name</label>
                <input type="text" class="form-control" id="cat_name">
                <input type="hidden" id="cat_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSaveCategory">Save</button>
            </div>
            </div>
        </div>
    </div>
    <!-- handler modal  -->
    <div class="modal" id="handlerModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Handler</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="handler_name">Handler Name</label>
                <input type="text" class="form-control" id="handler_name">
                <input type="hidden" id="handler_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSaveHandler">Save</button>
            </div>
            </div>
        </div>
    </div>

    <!-- room assign modal  -->
    <div class="modal" id="roomAssignModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="handler_name">Room Name</label>
                <input type="text" class="form-control mb-3" id="room_name">

                <label for="handler_name">Room Number</label>
                <input type="number" class="form-control mb-3" id="room_num">

                <input type="hidden" id="room_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveRoom">Save</button>
            </div>
            </div>
        </div>
    </div>

    <!-- handler modal  -->
    <div class="modal" id="conditionModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Condition</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="handler_name">Condition Name</label>
                <input type="text" class="form-control" id="item_condition">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="onSaveCondition">Save</button>
            </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="../../assets/js/theme.js"></script>
    <script src="../../assets/js/logout.js"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        $(document).ready(function(){

            category_dropdown();
            handler_dropdown();
            room_dropdown();
            status_dropdown();
            updateItem();

            
            $('#saveItem').on('click', function(e){
                e.preventDefault();
                var i_desc = $('#i_desc').val();
                var i_qty = $('#i_qty').val();
                var i_category = $('#i_category').val();
                var i_assign_room = $('#i_assign_room').val();
                var i_date_acquired = $('#i_date_acquired').val();
                var i_status = $('#i_status').val();
                var i_handler = $('#i_handler').val();
                var i_price = $('#i_price').val();
                var i_model = $('#i_model').val();
                var i_brand = $('#i_brand').val();
                var i_name = $('#i_name').val();
                var i_type = $('#i_type').val();
                var item_uuid = $('#item_uuid').val();

                if(i_desc == ""){

                    Swal.fire({
                        title: "Error",
                        text: "Description must not be empty.",
                        icon: "error"
                    }).then( () => $('#saveItem').html(`Save changes`).removeAttr('disabled', 'disabled') );
                    return false;
                }

                $.ajax({
                    url: "save-item",
                    method: "POST",
                    data: {
                        i_desc: i_desc,
                        i_qty: i_qty,
                        i_category: i_category,
                        i_assign_room: i_assign_room,
                        i_date_acquired: i_date_acquired,
                        i_status: i_status,
                        i_handler: i_handler,
                        i_price: i_price,
                        i_model: i_model,
                        i_brand: i_brand,
                        i_name: i_name,
                        i_type: i_type,
                        item_uuid: item_uuid
                    },
                    dataType: "json",
                    cache: false,
                    beforeSend:function(){
                        $('#saveItem').html(`
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Updating...</span>
                        `).attr('disabled', 'disabled');
                    },
                    success:function(data){
                        
                        $('#saveItem').html(`Save item`).removeAttr('disabled', 'disabled')
                        if(data.success === false){
                            Swal.fire({
                                title: "Error",
                                text: data.result,
                                icon: "error"
                            }).then( () => $('#saveItem').html(`Save changes`).removeAttr('disabled', 'disabled') );

                            return false;
                        }

                        if(data.success === true){

                            Swal.fire({
                                title: "Success",
                                text: data.result,
                                icon: "success"
                            }).then( () => $('#saveItem').html(`Save changes`).removeAttr('disabled', 'disabled') )
                            .then( () => location.href="items");
                            return false;
                        }
                    }
                })

            });

            $('#btnSaveCategory').on('click', ()=>{
                var cat_name = $('#cat_name').val();
                var cat_id = $('#cat_id').val();

                $.ajax({
                    url: "add-category",
                    method: "POST",
                    data: { cat_name: cat_name, cat_id: cat_id },
                    dataType: "json",
                    cache: false,
                    beforeSend:function(){
                        $('#btnSaveCategory').html(`
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Saving...</span>
                        `).attr('disabled', 'disabled');
                    },
                    success:function(data){

                        if(data.success === false){
                            Swal.fire({
                                title: "Oops!",
                                text: data.result,
                                icon: "error"
                            });

                            return false;
                        }

                        if(data.success === true){
                            Swal.fire({
                                title: "Success",
                                text: data.result,
                                icon: "success"
                            }).then( () => {
                                category_dropdown();
                                $('#categoryModal').modal('hide');
                                $('#btnSaveCategory').html(`Save`).removeAttr('disabled', 'disabled');
                            });

                            return false;
                        }
                    }
                })
            });

            $('#btnSaveHandler').on('click', function(){
                var handler_name = $('#handler_name').val();
                var handler_id = $('#handler_id').val();

                $.ajax({
                    url: "add-handler",
                    method: "POST",
                    data: { 
                        handler_name: handler_name,
                        handler_id: handler_id
                    },
                    dataType: "json",
                    cache: false,
                    beforeSend:function(){
                        $('#btnSaveHandler').html(`
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Saving...</span>
                        `).attr('disabled', 'disabled');
                    },
                    success:function(data){

                        if(data.success === false){

                            Swal.fire({
                                title: "Oops!",
                                text: data.result,
                                icon: "error"
                            }).then( () => {
                                $('#btnSaveHandler').html(`Save `).removeAttr('disabled', 'disabled');
                            });
                            
                            return false;
                        }

                        if(data.success === true){

                            Swal.fire({
                                title: "Success",
                                text: data.result,
                                icon: "success"
                            }).then( ()=> {
                                $('#i_handler').html('');
                                $('#handlerModal').modal('hide');
                                handler_dropdown();
                            }).then(()=>{
                                $('#btnSaveHandler').html(`Save`).removeAttr('disabled', 'disabled');
                            });
                            
                            return false;

                        }
                    }
                });
            });

            $('#saveRoom').on('click', () => {

                var room_name = $('#room_name').val();
                var room_num = $('#room_num').val();
                var room_id = $('#room_id').val();

                $.ajax({
                    url: "add-room",
                    method: "POST",
                    data: { 
                        room_name: room_name,
                        room_num: room_num,
                        room_id: room_id,
                    },
                    dataType: "json",
                    cache: false,
                    beforeSend:function(){
                        $('#saveRoom').html(`
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status">Saving...</span>
                        `).attr('disabled', 'disabled');
                    },
                    success:function(data){

                        // console.log(data);

                        if(data.success === false){
                            Swal.fire({
                                title: "Oops!",
                                text: data.result,
                                icon: "error"
                            }).then( () => {
                                $('#saveRoom').html(`Save room`).removeAttr('disabled', 'disabled');
                            });

                            return false;
                        }

                        if(data.success === true){
                            Swal.fire({
                                title: "Success",
                                text: data.result,
                                icon: "success"
                            }).then( () => {
                                $('#saveRoom').html(`Save room`).removeAttr('disabled', 'disabled');
                            }).then( () => {
                                $('#i_assign_room').html('');
                                $('#roomAssignModal').modal('hide');
                                room_dropdown();
                            });

                            return false;
                        }
                    }
                })

            });


            $('#onSaveCondition').on('click', function(){
               
                var item_condition = $('#item_condition').val();

                $.ajax({
                    url: 'add-item-condition',
                    method: "POST",
                    data:{
                        item_condition: item_condition,
                    },
                    dataType: 'json',
                    cache: false,
                    beforeSend:function(){
                        $('#onSaveCondition').html(`
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Saving...</span>
                        `).attr('disabled', 'disabled')
                    },
                    success:function(data){

                        // console.log(data);
                        
                        if(data.success === false){

                            Swal.fire({
                                title: "Error",
                                html: data.result,
                                icon: "error"
                            }).then( () => {
                                $('#onSaveCondition').html(`
                                    Save condition
                                `).removeAttr('disabled', 'disabled')
                            });

                            return false;
                        }

                        if(data.success === true){
                            
                            Swal.fire({
                                title: "Success",
                                html: data.result,
                                icon: "success"
                            }).then( () => {
                                $('#onSaveCondition').html(`
                                    Save condition
                                `).removeAttr('disabled', 'disabled')
                            }).then(() => {
                                $('#i_status').html('');
                                $('#conditionModal').modal('hide');
                                status_dropdown();

                            });

                            return false;
                        }
                    }
                })
            });

            $("input[data-type='currency']").on({
                keyup: function() {
                    formatCurrency($(this));
                },
                blur: function() { 
                    formatCurrency($(this), "blur");
                }
            });

            $('#i_desc').summernote({
                    height: 280,
                    toolbar: [
                        // ['style', ['style']],
                        ['color', ['color']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert',[ 'picture']],
                        ['view', ['fullscreen', 'help']]
                    ],
            });

        });

        const categoryModal = ()=>{ $('#categoryModal').modal('show')}

        const handlerModal = () => { $('#handlerModal').modal('show') }

        const roomAssignModal = () => { $('#roomAssignModal').modal('show') }

        const conditionModal = () => { $('#conditionModal').modal('show') }

        const category_dropdown = () => {
            $.ajax({
                url: "category-dropdown",
                method: "GET",
                dataType: "json",
                success:function(data){
                    
                    if(data.success === false){
                        $('#i_category').append(`
                            <option value="">${data.result}</option>
                        `);

                        return false;
                    }

                    if(data.success === true){
                        $('#i_category').html('');
                        $('#i_category').append(`
                            <option value="">--select--</option>
                        `);
                        Array.isArray(data.result) ? 
                            data.result.map((item, index) => {
                                $('#i_category').append(`
                                    <option value="${item.cat_id}">${item.cat_name}</option>
                                `);

                            })
                        : ""

                        return false;
                    }
                }
            })
        }

        const handler_dropdown = ()=>{
            $.ajax({
                url: "dropdown-handler",
                method: "GET",
                dataType: "json",
                cache: false,
                success:function(data){

                    if(data.success === false){
                        $('#i_handler').append(`
                            <option value="">${data.result}</option>
                        `);

                        return false;
                    }

                    if(data.success === true){
                        $('#i_handler').html('');
                        $('#i_handler').append(`
                            <option value="">--select--</option>
                        `);
                        Array.isArray(data.result) ? 
                            data.result.map((item, index) => {
                                $('#i_handler').append(`
                                    <option value="${item.handler_id}">${item.handler_name}</option>
                                `);

                            })
                        : ""

                        return false;
                    }
                }
            })
        }

        const room_dropdown = () =>{
            $.ajax({
                url: "dropdown-room",
                method: "GET",
                dataType: "json",
                cache: false,
                success:function(data){

                    if(data.success === false){
                        $('#i_assign_room').append(`
                            <option value="">${data.result}</option>
                        `);

                        return false;
                    }

                    if(data.success === true){
                        $('#i_assign_room').html('');
                        $('#i_assign_room').append(`
                            <option value="">--select--</option>
                        `);
                        Array.isArray(data.result) ? 
                            data.result.map((item, index) => {
                                $('#i_assign_room').append(`
                                    <option value="${item.room_id}">${item.room_name} - ${item.room_num}</option>
                                `);

                            })

                        : "";

                        return false;
                    }
                }
            });
        }

        const status_dropdown =() => {
            $.ajax({
                url: 'dropdown-condition',
                method: "GET",
                dataType:'json',
                cache: false,
                
                success:function(data){
                    if(data.success === false){
                        $('#i_status').append(`
                            <option value="">${data.result}</option>
                        `);

                        return false;
                    }

                    if(data.success === true){
                        $('#i_status').html('');
                        $('#i_status').append(`
                            <option value="">--select--</option>
                        `);
                        Array.isArray(data.result) ? 
                            data.result.map((item, index) => {
                                $('#i_status').append(`
                                    <option value="${item.condition_id}">${item.condition}</option>
                                `);

                            })

                        : "";

                        return false;
                    }
                }
            })
        }

        function formatNumber(n) {
            // format number 1000000 to 1,234,567
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }


        function formatCurrency(input, blur) {
            // appends $ to value, validates decimal side
            // and puts cursor back in right position.
            
            // get input value
            var input_val = input.val();
            
            // don't validate empty input
            if (input_val === "") { return; }
            
            // original length
            var original_len = input_val.length;

            // initial caret position 
            var caret_pos = input.prop("selectionStart");
                
            // check for decimal
            if (input_val.indexOf(".") >= 0) {

                // get position of first decimal
                // this prevents multiple decimals from
                // being entered
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);
                
                // On blur make sure 2 numbers after decimal
                if (blur === "blur") {
                right_side += "00";
                }
                
                // Limit decimal to only 2 digits
                right_side = right_side.substring(0, 2);

                // join number by .
                input_val = "PHP " + left_side + "." + right_side;

            } else {
                // no decimal entered
                // add commas to number
                // remove all non-digits
                input_val = formatNumber(input_val);
                input_val = "PHP " + input_val;
                
                // final formatting
                if (blur === "blur") {
                input_val += ".00";
                }
            }
            
            // send updated string to input
            input.val(input_val);

            // put caret back in the right position
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }

        const updateItem = () => {
            var id = $('#item_id').val();
            $.ajax({
                url: "select-item",
                method: "GET",
                data: {
                    id: <?= $_GET['id'] ?>
                },
                dataType: "json",
                cache: false,
                success:function(data){
                    // console.log(data);
                    var item_name = data.result.item_name;
                    var brand = data.result.item_brand;
                    var model = data.result.item_model;
                    var price = data.result.item_price;
                    var handler = data.result.handler_id;
                    var item_status = data.result.condition_id;
                    var date_acquired = data.result.date_acquired;
                    var category = data.result.item_category;
                    var item_type = data.result.item_type;
                    var qty = data.result.item_qty;
                    var room = data.result.room_id;
                    var item_desc = data.result.item_desc;

                    $('#i_name').val(item_name);
                    $('#i_brand').val(brand);
                    $('#i_model').val(model);
                    $('#i_price').val(price);
                    $('#i_handler option[value="'+handler+'"]').prop('selected', true);
                    $('#i_status option[value="'+item_status+'"]').prop('selected', true);
                    $('#i_date_acquired').val(date_acquired);
                    $('#i_category option[value="'+category+'"]').prop('selected', true);
                    $('#i_type option[value="'+item_type+'"]').prop('selected', true);
                    $('#i_assign_room option[value="'+room+'"]').prop('selected', true);
                    $('#i_qty').val(qty);
                    $('#item_uuid').val(data.result.item_uuid);
                    $('#i_desc').summernote('code', item_desc);
                }
            });
        }
        
    </script>

</body>
</html>