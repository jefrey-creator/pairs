<?php 
  include_once 'auth.php';
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
 
</head>
<body>
    <div class="container-fluid">
        <div class="row mb-3">
            
            <div class="text-center mb-3 mt-2">
                <button class="btn btn-primary float-end" id="btnPrint">Print</button>
                <img src="../../assets/img/favicon.ico" alt="">
                <span class="h5">Republic of the Philippines</span><br />
                <span class="h4">CAGAYAN STATE UNIVERSITY - GONZAGA CAMPUS</span><br />
                <span class="text-sm">Arranz Street, Barangay Flourishing, Gonzaga Cagayan 3513</span><br />
                <span class="h4">SUPPLY OFFICE</span><br />
                <span class="text-sm">Email Us / Contact Us: csug.supplyoffice@gmail.com / +63918198816</span><br />
            </div>
        </div>
        <div class="row">
            <table class="table" style="width:100%">
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
                        $selected_filter = [];
                        $room = new Room();

                        $key = "";

                        if (isset($_GET['status']) != "") {
                            
                            $selected_filter = $room->select_item_by_condition($_GET['status']);
                        }else{
                            $selected_filter = $room->select_all_item();
                        }
                        
                        if(!$selected_filter){
                            echo "No data available.";
                        }else{
                            foreach($selected_filter as $rn){
                                ?>
                            <tr>
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
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        
        $(document).ready(function(){
            
            $('#btnPrint').on('click', ()=>{
                $('#btnPrint').css('display', 'none')
                window.print();
            })

            $('#btnPrint').css('display', 'block')

        })
    </script>
</body>
</html>
