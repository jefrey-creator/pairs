<?php 
    include_once 'auth.php';
    $page = "borrow";
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
  <!-- <link rel="stylesheet" href="../../assets/css/dashboard.css"> -->
  <link rel="shortcut icon" href="../../<?= FAV_ICO; ?>" type="image/x-icon">
</head>
<body>
    <?php include_once 'nav.php'; ?>
    <div class="container">
        <div class="row mb-3">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">
                            Menu
                        </h3>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-underline nav-fill">
                            <li class="nav-item">
                                <a class="nav-link " href="borrow">Borrow Item(s)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="borrowed-items">Requested Item(s)</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12 col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Select Item Filter</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-12 col-sm-12 col-md-12 mb-3">
                                <form method="get">
                                    <label for="status">Item Status</label>
                                    <select id="status" class="form-control form-control form-select mb-3">
                                        <option value="">--select status--</option>
                                        <option value="3">Acquired</option>
                                        <option value="2">Approved</option>
                                        <option value="5">Declined</option>
                                        <option value="1">Pending</option>
                                        <option value="4">Returned</option>
                                    </select>
                                </form>
                            </div>
                        </div>

                        <div class="row mb-3 result" style="display: none">
                            <div class="col-lg-12 col-sm-12 col-md-12 mb-3">
                                <h6>Click order number to show item(s) borrowed</h6>
                                <div id="order_number"></div>
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

    <!-- sweet alert  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function(){
            

            $('#status').on('change', ()=>{

                let status_req = $('#status').val();

                $.ajax({
                    url: "filter-request",
                    method: "GET",
                    data: {
                        status_req: status_req
                    },
                    dataType: "json",
                    cache: false,
                    beforeSend:function(){
                        $('label').html(`
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        `)
                    },
                    success:function(data){

                        if(data.success === false){
                            $('#order_number').html('')
                            $('.result').css('display', 'none');
                            $('label').html(data.result+" <a href='borrow' class='btn btn-primary mb-3'>Add New</a>");
                            return false;
                        }

                        if(data.success === true){

                            $('label').html('Item Status');
                            $('.result').css('display', 'block');

                            Array.isArray(data.result) ? data.result.map((item, index)=>{
                                $('#order_number').append(`
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne${item.order_num}" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    ${item.order_num} (${item.total_borrows})
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne${item.order_num}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Item</th>
                                                                <th>Qty</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `);
                            })
                            : '';
                            
                            return false;
                        }
                        
                    }
                })
            })
        })
    </script>
</body>
</html>