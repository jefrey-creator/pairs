<?php 
  include_once 'auth.php';
  $page = "category";
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= TITLE ?> - Category</title>
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
                    <h3>Category</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered mb-3">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="category">
                            <div class="loader"></div>
                        </tbody>
                    </table>
                    <button class="btn btn-primary" type="button" id="loadMoreCategory">Load More</button>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="form_title">Add Category</h3>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" id="cat_id">
                        <label for="cat_name">Category Name</label>
                        <input type="text" id="cat_name" class="form-control mb-3">
                        <div class="btn-group gap-2 w-100">
                            <button class="btn btn-primary" type="submit" id="btnSaveCategory">Save category</button>
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
            loadCategory(page);

            $('#loadMoreCategory').on('click', ()=>{
                page++;
                loadCategory(page);
            });

            $('#btnCancel').on('click', ()=>{
                btnCancel();
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
                            }).then( () => {
                                $('#btnSaveCategory').html(`Save category`).removeAttr('disabled', 'disabled');
                            });

                            return false;
                        }

                        if(data.success === true){
                            Swal.fire({
                                title: "Success",
                                text: data.result,
                                icon: "success"
                            }).then( () => {
                                $('#btnSaveCategory').html(`Save category`).removeAttr('disabled', 'disabled');
                            }).then( () => {
                                $('#category').html('');
                                page = 1;
                                loadCategory(page);
                                btnCancel();
                            });

                            return false;
                        }
                    }
                })
            });

        });

        const loadCategory = (page)=>{
            $.ajax({
                url: "load-category",
                method: "GET",
                data: {page: page},
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
                        $('#loadMoreCategory').html(data.result).attr('disabled', 'disabled');
                        return false;
                    }

                    if(data.success === true){
                    
                        $('#loadMoreCategory').html('Load More').removeAttr('disabled', 'disabled');
                        Array.isArray(data.result) ? 
                            data.result.map( (item, index)=>{
                            $('#category').append(
                                `
                                <tr class="text-center">
                                    <td>${item.cat_name}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-link btn-lg dropdown-toggle dropdown-toggle-no-caret" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" title"Option Menu">
                                            <i class="bi bi-three-dots-vertical fs-2"></i>
                                            </button>
                                            <ul class="dropdown-menu">

                                                <a class="dropdown-item" href="#" onclick="updateCategory(${item.cat_id})">
                                                    <i class="bi bi-pencil"></i> Update
                                                </a>

                                                <a class="dropdown-item" href="#" onclick="deleteCategory(${item.cat_id})" id="delBtn${item.room_id}">
                                                    <i class="bi bi-trash"></i> Delete
                                                </a>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                `
                            );
                        }) : "";
                        return false;
                    }
                }
            })
        }

        const updateCategory = (cat_id) => {
            // $('#cat_id').val(cat_id);

            $.ajax({
                url: "select-category",
                method:"GET",
                data: {cat_id: cat_id},
                dataType: "json",
                cache: false,
                success:function(data){
                    $('#cat_id').val(data.result.cat_id);
                    $('#cat_name').val(data.result.cat_name);

                    if($('#cat_id').val() == ""){
                        $('.form_title').html('Add Category');
                        $('#btnSaveCategory').html('Save category');
                    }else{
                        $('.form_title').html('Update Category');
                        $('#btnSaveCategory').html('Save changes');
                    }
                }
            })
        }

        const btnCancel = () =>{
            $('#btnSaveCategory').html('Save category');
            $('#cat_id').val('');
            $('#cat_name').val('');
            $('.form_title').html('Add Category');
        }

        const deleteCategory = (cat_id) => {

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "delete-category",
                        method: "POST",
                        data: { cat_id: cat_id },
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
                                    title: "Success!",
                                    text: data.result,
                                    icon: "success"
                                }).then( ()=> {
                                    $('#category').html('');
                                    page = 1;
                                    loadCategory(page);
                                });

                                return false;
                            }
                        }
                    })

                   
                }
            });
        }
    </script>
</body>
</html>