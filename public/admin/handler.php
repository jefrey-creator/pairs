<?php 
  include_once 'auth.php';
  $page = "handler";
  
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <title><?= TITLE ?> - Handler</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="../../assets/css/main.css">
  <!-- <link rel="stylesheet" href="../../assets/css/dashboard.css"> -->
  <link rel="shortcut icon" href="../../<?= FAV_ICO; ?>" type="image/x-icon">
</head>
<body>
    <?php include_once 'nav.php'; ?>
    <div class="container">
      <div class="row">
        <div class="col-lg-7 col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3>Handler List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Handler Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="handler">
                            <div class="loader"></div>
                        </tbody>
                    </table>
                    <button class="btn btn-primary" id="loadMoreHandler" type="button">Load More</button>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="form_title">Add Handler</h3>
                </div>
                <div class="card-body">
                    <form method="post">
                        <input type="hidden" id="handler_id">
                        <label for="handler_name">Handler Name</label>
                        <input type="text" class="form-control mb-3" id="handler_name">

                        <div class="btn-group gap-2 w-100">
                            <button type="submit" class="btn btn-primary" id="addHandler">Save</button>
                            <button class="btn btn-danger" type="button" id="btnCancel">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="../../assets/js/theme.js"></script>
    <script src="../../assets/js/logout.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(()=>{

            var page = 1;

            loadHandler(page);

            $('#loadMoreHandler').on('click', ()=>{
                page++
                loadHandler(page);
            })

            
            $('#addHandler').on('click', function(){
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
                        $('#addHandler').html(`
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
                            }).then( ()=> $('#loadMoreHandler').html(data.result).attr('disabled', 'disabled') );
                            
                            return false;
                        }

                        if(data.success === true){

                            Swal.fire({
                                title: "Success",
                                text: data.result,
                                icon: "success"
                            }).then( ()=> {
                                $('#handler').html('');
                                page = 1;
                                loadHandler(page);
                                $('#loadMoreHandler').html('Load More').removeAttr('disabled', 'disabled');
                                $('#addHandler').html('Save ').removeAttr('disabled', 'disabled');
                                btnCancel();
                            });
                            
                            return false;

                        }
                    }
                });
            });

        });

        const loadHandler = (page) => {
            $.ajax({
                url: "load-handler",
                method: "GET",
                data: { page: page },
                dataType: "json",
                cache: false,
                beforeSend:function(){
                    $('.loader').html(`
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    `);
                },
                success:function(data){

                    $('.loader').css('display', 'none');

                    if(data.success === false){
                        $('#loadMoreHandler').html(data.result).attr('disabled', 'disabled');
                        return false;
                    }

                    if(data.success === true){
                        $('#loadMoreHandler').html('Load More').removeAttr('disabled', 'disabled');

                        Array.isArray(data.result) ? 
                        data.result.map((item, index)=>{
                            $('#handler').append(`
                                <tr>
                                    <td>${item.handler_name}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-link btn-lg dropdown-toggle dropdown-toggle-no-caret" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" title"Option Menu">
                                            <i class="bi bi-three-dots-vertical fs-2"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <a class="dropdown-item" href="#" onclick="updateHandler(${item.handler_id})">
                                                    <i class="bi bi-pencil"></i> Update
                                                </a>

                                                <a class="dropdown-item" href="#" onclick="deleteHandler(${item.handler_id})">
                                                    <i class="bi bi-trash"></i> Delete
                                                </a>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            `);
                        }) 
                        : "";

                        return false;
                    }
                }
            })
        }

        const updateHandler = (handler_id) => {
            
            $.ajax({
                url: "select-handler",
                method: "GET",
                data: { handler_id: handler_id },
                dataType: "json",
                cache: false,
                success:function(data){
                    $('#handler_name').val(data.result.handler_name);
                    $('#handler_id').val(data.result.handler_id);

                    if($('#handler_id').val() == ""){
                        $('.form_title').html('Add Handler');
                        $('#addHandler').html('Save');
                    }else{
                        $('.form_title').html('Update Handler');
                        $('#addHandler').html('Save changes');
                    }
                }
            })
        }

        const deleteHandler = (handler_id) => {

            Swal.fire({

                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",

            }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({
                        url: "delete-handler",
                        method: "POST",
                        data: { handler_id: handler_id },
                        dataType: "json",
                        cache: false,
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
                                    title: "Deleted!",
                                    text: data.result,
                                    icon: "success"
                                }).then( () => {
                                    $('#handler').html('');
                                    page = 1;
                                    loadHandler(page);
                                    btnCancel();
                                });
                                return false;
                            }
                        }
                    })
                }
            });
        }

        const btnCancel = () =>{
            $('.form_title').html('Add Handler');
            $('#addHandler').html('Save');
            $('#handler_name').val('');
            $('#handler_id').val('');
        }

    </script>
</body>
</html>