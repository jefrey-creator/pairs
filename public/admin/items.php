<?php 
  include_once 'auth.php';
  $page = "item";

  $uri = explode("/", $_SERVER['REQUEST_URI']);
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title><?= TITLE ?> - Item</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="shortcut icon" href="../../<?= FAV_ICO; ?>" type="image/x-icon">
    
    <!-- dataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.bootstrap5.css">

    <style>
        td:hover{
            cursor: pointer;
        }

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
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card mt-2">
                    <div class="card-header">
                        <h3 class="card-title fw-bold">
                            Menu
                        </h3>
                    </div>
                    <div class="card-body">
                        <form method="GET">
                            <ul class="nav nav-underline nav-fill">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle <?= (isset($_GET['rn'])) ? 'active' : '' ?>" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                        Room Number
                                    </a>
                                    <ul class="dropdown-menu">
                                        <div id="room_number"></div>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle <?= (isset($_GET['sc'])) ? 'active' : '' ?>" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                        Condition / Status
                                    </a>
                                    <ul class="dropdown-menu">
                                        <div id="status_condition"></div>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= (isset($_GET['v'])) ? 'active' : '' ?>" href="items?v=all">View All</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="add-item">Add New</a>
                                </li>
                               
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Inventory</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Description</th>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Category</th>
                                        <th>Handler</th>
                                        <th>Date Acquired</th>
                                        <th>Item Price</th>
                                        <th>Room Number</th>
                                        <th>Quantity</th>
                                        <th>Condition</th>
                                    </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $selected_filter = "";
                                $room = new Room();

                                $key = "";

                                if(isset($_GET['rn'])){
                                    $key = $_GET['rn'];
                                    $selected_filter = $room->select_item_by_room($key);
                                }elseif (isset($_GET['sc'])) {
                                    $key = $_GET['sc'];
                                    $selected_filter = $room->select_item_by_condition($key);
                                }elseif(isset($_GET['v'])){
                                    $selected_filter = $room->select_all_item();
                                }else{
                                    echo "No data available.";
                                }
                                
                                foreach($selected_filter as $rn){
                                ?>
                                    <tr oncontextmenu="Option(<?= $rn->item_id; ?>)" data-bs-toggle="tooltip" title="Click to update">
                                        <td><?=$rn->item_name; ?></td>
                                        <td><?=$rn->item_desc; ?></td>
                                        <td><?=$rn->item_brand; ?></td>
                                        <td><?=$rn->item_model; ?></td>
                                        <td><?=$rn->cat_name; ?></td>
                                        <td><?=$rn->handler_name; ?></td>
                                        <td><?=$rn->date_acquired; ?></td>
                                        <td><?=$rn->item_price; ?></td>
                                        <td><?=$rn->room_num; ?></td>
                                        <td><?=$rn->item_qty; ?></td>
                                        <td><?=$rn->condition; ?></td>
                                    </tr>
                                <?php
                                }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Description</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Category</th>
                                    <th>Handler</th>
                                    <th>Date Acquired</th>
                                    <th>Item Price</th>
                                    <th>Room Number</th>
                                    <th>Quantity</th>
                                    <th>Condition</th>
                                </tr>
                            </tfoot>
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
                        <input type="hidden" id="item_id">
                        <input type="hidden" id="request_uri" value="<?= $uri[4]; ?>">
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
                                <a href="#" id="deleteOption" class="fs-6 text-decoration-none text-danger">
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
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="../../assets/js/theme.js"></script>
    <script src="../../assets/js/logout.js"></script>

    <!-- dataTables  -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.bootstrap5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.colVis.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(()=>{
            room_dropdown();
            status_dropdown();

            $('#deleteOption').on('click', ()=>{
                var item_id = $('#item_id').val();
                var request_uri = $('#request_uri').val();

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
                            url: "delete-item",
                            method: "post",
                            data:{
                                item_id: item_id,
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

                                // console.log(""); 

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
                                    }).then(()=> location.href = request_uri);

                                    return false;
                                }
                            }
                        })
                    }
                });
            })
        });

        const room_dropdown = () =>{
            $.ajax({
                url: "dropdown-room",
                method: "GET",
                dataType: "json",
                cache: false,
                success:function(data){

                    if(data.success === true){
                        Array.isArray(data.result) ? 
                            data.result.map((item, index) => {
                                $('#room_number').append(`
                                    <li onchange='this.form.submit()'>
                                        <a class="dropdown-item" href="items?rn=${item.room_id}&r=${item.room_num}">${item.room_name} - ${item.room_num}</a>
                                    </li>
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
                    
                    if(data.success === true){
                        Array.isArray(data.result) ? 
                            data.result.map((item, index) => {
                                $('#status_condition').append(`
                                    <li onchange='this.form.submit()'>
                                        <a class="dropdown-item" href="items?sc=${item.condition_id}&cond=${item.condition}">${item.condition}</a>
                                    </li>
                                `);

                            })

                        : "";

                        return false;
                    }
                }
            })
        }

        new DataTable('#example', {
            responsive: true,
            layout: {
                topStart: {
                    buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
                }
            }
        });

        const Option = (uuid)=>{
            $('#optionModal').modal('show');
            const updateLink = document.getElementById('updateOption');
            updateLink.href = "update-item?id="+uuid
            $('#item_id').val(uuid);
        }

        

    </script>
</body>
</html>
