<?php 
  include_once 'auth.php';
  $page = "item";
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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.bootstrap5.css">

    <style>
        td:hover{
            cursor: pointer;
        }
    </style>
</head>
<body>
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
                                    <a class="nav-link" aria-current="page" href="add-item">Add New</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= (isset($_GET['v'])) ? 'active' : '' ?>" href="items?v=all">View All</a>
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
                            <table id="example" class="table table-striped" style="width:100%">
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
                                    <tr onmouseup="Option(<?= $rn->item_id; ?>)" data-bs-toggle="tooltip" title="Click to update">
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
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: true
            });
            swalWithBootstrapButtons.fire({
                title: "Are you sure you want to update this item?",
                icon: "info",
                showCancelButton: true,
                confirmButtonText: "Yes, edit it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = "update-item?id="+uuid
                } else{
                    result.dismiss === Swal.DismissReason.cancel
                }
            });
        }

    </script>
</body>
</html>