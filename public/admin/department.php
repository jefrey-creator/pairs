<?php 
  include_once 'auth.php';
  $page = "department";
  
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title><?= TITLE ?> - Department</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../../assets/css/main.css">
    <!-- <link rel="stylesheet" href="../../assets/css/dashboard.css"> -->
    <link rel="shortcut icon" href="../../<?= FAV_ICO; ?>" type="image/x-icon">


    <!-- dataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.bootstrap5.css">
</head>
<body>
    <?php include_once 'nav.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-8 col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3>Office / Department / College</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="deptDT">
                                <thead>
                                    <tr>
                                        <th>Department</th>
                                        <th>Department Head</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="form_title">Add Department</h3>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <input type="hidden" id="dept_id">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label for="dept_head">Head (Optional)</label>
                                    <input type="text" class="form-control mb-3" id="dept_head">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label for="dept">Department / College / Office</label>
                                    <input type="text" class="form-control mb-3" id="dept_name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="btn-group gap-2 w-100">
                                    <button type="submit" class="btn btn-primary" id="addDepartment">Save</button>
                                    <button class="btn btn-danger" type="button" onclick="btnCancel()">Cancel</button>
                                </div>
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

    <!-- sweet alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- dataTables  -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

    <script>
        $(document).ready(function() {
         
            loadDepartment()

            $('#addDepartment').on('click', (e)=>{
                e.preventDefault();

                var dept_id = $('#dept_id').val();
                var dept_head = $('#dept_head').val();
                var dept_name = $('#dept_name').val();

                $.ajax({
                    url: "add-department",
                    method: "POST",
                    data: {
                        dept_id: dept_id,
                        dept_head: dept_head,
                        dept_name: dept_name,
                    },
                    dataType: "json",
                    cache: false,
                    beforeSend:function(){
                        $('#addDepartment').html(`
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Saving...</span>
                        `).prop('disabled', true);
                    },
                    success:function(data){

                        if(data.success === false){
                            Swal.fire({
                                title: "Oops.",
                                text: data.result,
                                icon: "error",
                            }).then( () => $('#addDepartment').html('Save').prop('disabled', false) );

                            return false;
                        }

                        if(data.success === true){
                            Swal.fire({
                                title: "Success",
                                text: data.result,
                                icon: "success",
                            }).then( () => $('#addDepartment').html('Save').prop('disabled', false))
                            .then( () => location.href="department" );

                            return false;
                        }
                    }
                })
            })

        });

        const loadDepartment = () =>{
    
            $.ajax({
                'url': "load-department",
                'method': "GET",
                'contentType': 'application/json'
            }).done( function(data) {
              
                $('#deptDT').dataTable({
                    "aaData": data,
                    "columns": [
                        { "data": "department" },
                        { "data": "department_head" },
                        {
                            "mData": null,
                            "bSortable": false,
                            "mRender": function (o) {
                                return `
                                    
                                    <button class="btn btn-link btn-lg dropdown-toggle dropdown-toggle-no-caret" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" title"Option Menu">
                                        <i class="bi bi-three-dots-vertical fs-2"></i>
                                    </button>
                                    <ul class="dropdown-menu">

                                        <a class="dropdown-item" href="#" onclick="updateCategory(${o.department_id})">
                                            <i class="bi bi-pencil"></i> Update
                                        </a>

                                        <a class="dropdown-item" href="#" onclick="deleteCategory(${o.department_id})">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </ul>
                                `; 
                            }
                        }
                    ],
                    
                })
            });
        }

        const updateCategory = (dept_id) => {
            // var dept_id = $('#dept_id').val(dept_id);

            $.ajax({
                url: "select-department",
                method: "GET",
                data: { dept_id: dept_id },
                dataType: 'json',
                cache:false,
                success:function(data){

                    $('#dept_head').val(data.result.department_head);
                    $('#dept_name').val(data.result.department);
                    $('#dept_id').val(data.result.department_id);

                    if($('#dept_id').val() != ""){
                        $('.form_title').html("Update Department");
                        $('#addDepartment').html('Save changes');
                    }else{
                        btnCancel();
                    }

                    return false;

                    
                }
            })
        }

        const btnCancel = () =>{
            $('.form_title').html("Add Department");
            $('#addDepartment').html('Save');
            $('#dept_id').val('');
            $('#dept_head').val('');
            $('#dept_name').val('');
        }

        const deleteCategory = (dept_id)=>{
            Swal.fire({

                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"

            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "delete-department",
                        method: "POST",
                        data: { dept_id: dept_id },
                        dataType: "json",
                        cache: false,
                        success:function(data){
                            
                            if(data.success === false){
                                Swal.fire({
                                    title: "Error",
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
                                }) .then( () => location.href="department" );

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