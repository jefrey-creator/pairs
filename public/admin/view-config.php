<?php 
  include_once 'auth.php';
  $page = "email";
  
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title><?= TITLE ?> - Email Configuration</title>
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

    <style>
        #contextMenu {
            display: none;
            position: absolute;
            z-index: 1000;
        }

        .menuContainer a {
            display: block; /* Make the link a block element */
            width: 100%; /* Take full width of the container */
            text-align: left; /* Center text (optional) */
            padding: 10px; /* Add some padding */
            text-decoration: none; /* Remove underline */
            color: black; /* Default text color */
        }

        .menuContainer a:hover {
            background-color: rgba(255, 255, 255, 0.2); 
            border-radius: 5px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); /* Soft shadow */
            backdrop-filter: blur(10px); /* Blurs the background behind the element */
            color: #ffffff; /* Text color for better readability */
        }
    </style>
</head>
<body oncontextmenu="return false;">
    <?php include_once 'nav.php'; ?>
    <div class="container">
        <div class="row mb-3">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3>Email Configuration</h3>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-underline nav-fill">
                            <li class="nav-item">
                                <a class="nav-link" href="email-config">Add New</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="view-config">View</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>List of available email configurations</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="emailDT">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Tag</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $config = new Config();
                                    $lists = $config->view_config();
                                    
                                    foreach($lists as $list){
                                    ?>
                                    <tr oncontextmenu="configMenu(<?= $list->config_id; ?>);">
                                        <td><?= $list->subject; ?></td>
                                        <td><?= $list->message; ?></td>
                                        <td><?= $list->tag; ?></td>
                                    </tr>
                                    <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- menu option  -->
    <div class="modal" id="optionModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="menuContainer">
                        <input type="hidden" id="config_id">
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="#" id="updateOption" class="fs-6 text-decoration-none text-primary">
                                    <i class="bi bi-pencil"></i>
                                    Update 
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="javascript:void(0)" id="deleteOption" class="fs-6 text-decoration-none text-danger">
                                    <i class="bi bi-trash"></i>
                                    Delete 
                                </a>
                            </div>
                        </div>
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
            $('#emailDT').DataTable();

            $('#deleteOption').on('click', ()=>{
                var config_id = $('#config_id').val();
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
                            url: "delete-config",
                            method:"POST",
                            data: {
                                config_id: config_id,
                            },
                            dataType: "json",
                            cache: false,
                            beforeSend:function(){
                                $('#deleteOption').html(`
                                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                    <span role="status">Deleting...</span>
                                `).prop('disabled', true);
                            },
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
                                        title: "Success",
                                        text: data.result,
                                        icon: "success"
                                    }).then(()=> location.href = "view-config");

                                    return false;
                                }
                            }
                        })
                    }
                });
                
            })
        });

        const configMenu = (config_id) => {
            $('#optionModal').modal('show');
            const updateLink = document.getElementById('updateOption');
            updateLink.href = "email-config?id="+config_id;
            $('#config_id').val(config_id);
        }

    
    </script>
</body>
</html>