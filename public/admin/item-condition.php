<?php 
  include_once 'auth.php';
  $page = "item-condition";
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
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
  <link rel="stylesheet" href="../../assets/css/item.css">
  <link rel="shortcut icon" href="../../<?= FAV_ICO; ?>" type="image/x-icon">

</head>
<body>
    <?php include_once 'nav.php'; ?>
    <div class="container">
        <div class="row mt-4">
            <div class="col-7">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Item Condition</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="ItemCondition"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Add Condition</h3>
                        <small>This condition will appear in the adding of items.</small>
                        <hr>
                        <form method="POST">
                            <div class="col-12">
                                <label for="item_condition">Item condition</label>
                                <input type="text" class="form-control form-control-lg mb-3" id="item_condition">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg w-100" id="onSaveCondition">Save condition</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalUpdate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="POST">
                        <h3 class="modal-title fs-5 text-primary">
                            Update Condition
                        </h3>
                        <hr>
                        <input type="hidden" id="condition_id">
                        <input type="text" id="condition" class="form-control form-control-lg">
                        <div class="float-end mt-4">
                            <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="OnEditCOndition">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   
    <script src="../../assets/js/theme.js"></script>
    <script src="../../assets/js/logout.js"></script>

    <script>
        $(document).ready(function(){

            var page = 1;
            get_item_conditon(page);


            $('#onSaveCondition').on('click', function(e){
                e.preventDefault();
                
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
                                $('#ItemCondition').html(``);
                                page = 1;
                                get_item_conditon(page);
                                $('#item_condition').val('');
                            });

                            return false;
                        }
                    }
                })
            });

            $('#OnEditCOndition').on('click', function(e){
                e.preventDefault();

                var condition_id = $('#condition_id').val();
                var condition = $('#condition').val();

                $.ajax({
                    url: "update-condition",
                    method: "POST",
                    data: {
                        condition_id: condition_id,
                        condition: condition
                    },
                    dataType: 'json',
                    cache: false,
                    beforeSend:function(){
                        $('#OnEditCOndition').html(`
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Updating...</span>
                        `)
                        .attr('disabled', 'disabled')
                    },
                    success:function(data){

                        if(data.success === false){

                            Swal.fire({
                                title: "Error",
                                html: data.result,
                                icon: "error"
                            }).then( () => {
                                $('#OnEditCOndition').html(`
                                    Save changes
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
                                $('#OnEditCOndition').html(`
                                    Save changes
                                `).removeAttr('disabled', 'disabled')
                            }).then(() => {
                                $('#ItemCondition').html(``);
                                page = 1;
                                get_item_conditon(page);
                                $('#modalUpdate').modal('hide');    
                            });

                            return false;
                        }
                    }
                })
            })
        });

        const get_item_conditon = (page)=>{

            $.ajax({
                url: 'get-item-condition',
                method: "GET",
                data: { page: page},
                dataType:'json',
                cache: false,
                beforeSend:function(){
                    $('#ItemCondition').html(`
                        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    `)
                },
                success:function(data){
                    if(data.success === false){
                        $('#ItemCondition').html(data.result);
                        return false;
                    }


                    if(data.success === true){
                        $('#ItemCondition').html(``);
                        data.result.map( (item, index) => {
                            $('#ItemCondition').append(`
                                <tr>
                                    <td>${item.condition}</td>
                                    <td>
                                        <button class="btn btn-success" onclick="onUpdateCondition(${item.condition_id})">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </td>
                                </tr>
                            `)
                        });
                        return false;
                    }
                }
            })
        }

        const onUpdateCondition = (condition_id) =>{
            get_condition_by_id(condition_id)
            $('#modalUpdate').modal('show');            
        }

        const get_condition_by_id = (id) => {
            $.ajax({
                url: "get-condition-by-id",
                method: 'GET',
                data: {id: id},
                dataType: "json",
                cache: false,
                success:function(data){
                    if(data.success === false){
                        Swal.fire({
                            title: "Error",
                            html: data.result,
                            icon: "error"
                        });

                        return false;
                    }

                    if(data.success === true){
                        // console.log(data);
                        $('#condition_id').val(data.result.condition_id);
                        $('#condition').val(data.result.condition)
                    }
                }
            })
        }

       
    </script>
</body>
</html>