<?php 
  include_once 'auth.php';
  $page = "notif";
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <title><?= TITLE ?> - Borrower Notification</title>
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
            <div class="col-lg-12 col-sm-12-col-md-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-underline nav-fill">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="notification">
                                    Processing
                                    <span class="badge text-bg-secondary">
                                        <span id="processing">0</span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="for-pickup">
                                    For Pickup 
                                    <span class="badge text-bg-secondary">
                                        <span id="for_pickup">0</span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="delivered">
                                    Acquired / Delivered
                                    <span class="badge text-bg-secondary">
                                        <span id="delivered">0</span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="returned-item">Returned</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="declined-request">Declined</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-4 col-sm-12 col-md-12">
                <div class="input-group">
                    <div class="input-group-text">
                        <i class="bi bi-search"></i>
                    </div>
                    <div class="form-floating">
                        <input type="number" class="form-control" id="reference_number" placeholder="reference number">
                        <label for="reference_number">Reference Number</label>
                    </div>
                </div>
                <span class="badge bg-primary text-wrap float-end" id="loader">Press enter to search</span>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-12 col-sm-12 col-md-12">
                <div id="pendingOrder"></div>
                    <hr>
                    <button class="btn btn-primary float-end" type="button" id="loadMore">Load More</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="../../assets/js/theme.js"></script>
    <script src="../../assets/js/logout.js"></script>

    <script>
        $(document).ready(function(){
            var page = 1;
            
            getPendingOderNumber(page);

            $('#loadMore').on('click', ()=>{
                page++
                getPendingOderNumber(page);
            });

            $('#reference_number').on('keydown', function(event){
                if(event.key === 'Enter'){
                    event.preventDefault();
                    var reference_number = $('#reference_number').val();

                    if(reference_number == ''){
                        $('#pendingOrder').html('')
                        page = 1;
                        getPendingOderNumber(page);
                        return false;
                    }

                    $.ajax({
                        url: "search-order-number",
                        method: "GET",
                        data: {
                            reference_number: reference_number,
                            status: 2
                        },
                        dataType: "json",
                        cache: false,
                        beforeSend:function(){
                            $('#loader').html(`
                                <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                                </div>
                            `);
                        },
                        success:function(data){

                            if(data.success === false){

                                $('#loader').html(`Press enter to search`);

                                $('#pendingOrder').html(data.result);

                                return false;
                            }

                            if(data.success === true){

                                $('#loader').html(`Press enter to search`);

                                $('#pendingOrder').html('');
                                Array.isArray(data.result) ? 
                                    data.result.map((item, index)=>{
                                        $('#pendingOrder').append(`
                                        <div class="accordion mb-3 " id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne${item.order_num}" aria-expanded="true" aria-controls="collapseOne" onclick="getItem(${item.order_num})">
                                                    <div class="badge bg-secondary">
                                                        Order Number:&nbsp;${item.order_num} <br /><br /> Number of Item:&nbsp;${item.total_borrows}
                                                    </div>
                                                    </button>
                                                </h2>
                                                <div id="collapseOne${item.order_num}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                    <h3 class="text-bold" id="borrower_name${item.order_num}"></h3>
                                                    <small id="date_borrowed${item.order_num}">Date Borrowed</small>
                                                    <hr>
                                                    <div class="table-responsive">
                                                        <h4>Select item to approve</h4>
                                                        <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Item</th>
                                                                <th>Expected Date of Return</th>
                                                                <th>Purpose</th>
                                                                <th>Requested Qty</th>
                                                                <th>Approved Qty</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="item_details${item.order_num}"></tbody>
                                                        </table>
                                                    </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        `)
                                    })
                                : '';
                                
                                return false;
                            }
                        }
                    })
                }
            });
        });

        const getPendingOderNumber = (page) =>{
            $.ajax({
                url: "get-approved-order",
                method: "GET",
                data:{page: page},
                dataType: "json",
                cache: false,
                beforeSend:function(){
                    $('#loadMore').html(`
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status">Loading...</span>
                    `).prop('disabled', true)
                },
                success:function(data){
                    
                    
                    if(data.success === false){

                        $('#loadMore').html(data.result).prop('disabled', true)
                        return false;

                    }

                    if(data.success === true){

                        $('#loadMore').html('Load More').prop('disabled', false);

                        Array.isArray(data.result) ? 
                            data.result.map((item, index)=>{
                                $('#pendingOrder').append(`
                                    <div class="accordion mb-3 " id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne${item.order_num}" aria-expanded="true" aria-controls="collapseOne" onclick="getItem(${item.order_num})">
                                                    <div class="badge bg-secondary">
                                                        Reference Number:&nbsp;${item.order_num} <br /><br />Number of Item:&nbsp;${item.total_borrows}
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapseOne${item.order_num}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                <h3 class="text-bold" id="borrower_name${item.order_num}"></h3>
                                                <small id="date_borrowed${item.order_num}">Date Borrowed</small>
                                                <hr>
                                                <div class="table-responsive">
                                                    <h4>For Pick up</h4>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Item</th>
                                                                <th>Expected Date of Return</th>
                                                                <th>Purpose</th>
                                                                <th>Requested Qty</th>
                                                                <th>Approved Qty</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="item_details${item.order_num}"></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `)
                            })
                            
                            : '';

                        return false;
                    }
                }
            });
        }

        const getItem = (order_num) =>{

            $.ajax({
                url: "list-item-approved",
                method: "GET",
                data: { order_num: order_num },
                dataType: "json",
                cache: false,
                beforeSend:function(){
                $('#pendingOrder'+order_num).html(`
                    <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                    </div>
                `)
                },
                success:function(data){

                    if(data.success === false){
                        $('#item_details'+order_num).html(data.result);
                        return false;
                    }

                    if(data.success === true){
                        
                        $('#item_details'+order_num).html('');
                        Array.isArray( data.result ) ? 

                        data.result.map( (item, index)=>{
                            $('#date_borrowed'+order_num).html(`<i class="bi bi-calendar-check"></i> Date Requested: `+item.date_borrowed);
                            $('#borrower_name'+order_num).html(`<i class="bi bi-person"></i>`+item.borrower_name.toUpperCase());

                            $('#item_details'+order_num).append(`
                                <tr>
                                    <td>
                                        ${item.item_name}
                                    </td>
                                    <td>${item.date_returned}</td>
                                    <td>${item.purpose}</td>
                                    
                                    <td>${item.borrowed_qty}</td>
                                    <td>
                                        ${item.approved_qty}
                                    </td>
                                </tr>
                            `)
                        })
                        : '';
                        return false;
                    }
                }
            })
        }
    </script>
</body>
</html>