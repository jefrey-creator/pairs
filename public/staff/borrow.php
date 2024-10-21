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
                                <a class="nav-link active" href="borrow">Borrow</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="borrowed-items">Borrowed</a>
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
                        <h3 class="card-title">Borrowing Site</h3>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div id="row-container">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label for="item_uuid">Item/Equipment</label>
                                        <select name="item_uuid[]" id="item_uuid" class="form-control form-select mb-3"></select>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="qty">Quantity</label>
                                        <input type="number" id="qty" name="qty[]" class="form-control mb-3" min="1">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="date_returned">Expected Date of Return</label>
                                        <input type="date" id="date_returned" name="date_returned[]" class="form-control mb-3">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="purpose">Purpose</label>
                                        <textarea id="purpose" name="purpose[]" class="form-control mb-3"></textarea>
                                    </div>
                                    <div class="col-sm-1 pt-3 mt-3">
                                        <button class="btn btn-success" type="button" id="AddNew">
                                            <i class="bi bi-plus-circle"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <button class="btn btn-primary float-end" type="submit" id="submitBorrowedItems">Submit</button>
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

    <!-- sweet alert  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            let rowCount = 1;

            document.getElementById('AddNew').addEventListener('click', function() {
                rowCount++;
                // Get the container where the rows are added
                const container = document.getElementById('row-container');
                
                // Create a new row
                const newRow = document.createElement('div');
                newRow.className = 'row mb-3';
                newRow.innerHTML = `
                    <div class="col-sm-3">
                        <label for="item_uuid">Item/Equipment</label>
                        <select name="item_uuid[]" id="item_uuid" class="form-control form-select mb-3 item_uuid${rowCount}"></select>
                    </div>
                    <div class="col-sm-2">
                        <label for="qty">Quantity</label>
                        <input type="number" name="qty[]" id="qty" class="form-control mb-3" min="1">
                    </div>
                    <div class="col-sm-3">
                        <label for="date_returned">Expected Date of Return</label>
                        <input type="date" class="form-control mb-3" name="date_returned[]" id="date_returned">
                    </div>
                    <div class="col-sm-3">
                        <label for="purpose">Purpose</label>
                        <textarea class="form-control mb-3" name="purpose[]" id="purpose"></textarea>
                    </div>
                    <div class="col-sm-1 mt-3 pt-3">
                        <button class="btn btn-danger remove-row">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </div>
                `;
                
                // Append the new row to the container
                container.appendChild(newRow);
                dropdownItem(rowCount);

                // Add event listener for the remove button
                newRow.querySelector('.remove-row').addEventListener('click', function() {
                    rowCount--;
                    container.removeChild(newRow);
                });
            });

            dropdownItem1();

            $('#submitBorrowedItems').on('click', (e)=>{
                e.preventDefault();
                var arr_item_uuid = [];
                var arr_item_qty = [];
                var arr_item_return_date = [];
                var arr_purpose = [];

                $('select[name="item_uuid[]"]').each(function() {
                    arr_item_uuid.push($(this).val());
                });

                $('input[name="qty[]"]').each(function() {
                    arr_item_qty.push($(this).val());
                });

                $('input[name="date_returned[]"]').each(function() {
                    arr_item_return_date.push($(this).val());
                });

                $('textarea[name="purpose[]"]').each(function() {
                    arr_purpose.push($(this).val());
                });

                $.ajax({
                    url: "borrow-items",
                    method: "POST",
                    data:{
                        arr_item_uuid: arr_item_uuid,
                        arr_item_qty: arr_item_qty,
                        arr_item_return_date: arr_item_return_date,
                        arr_purpose: arr_purpose
                    },
                    beforeSend:function(){
                        $('#submitBorrowedItems').html(`
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Sending request...</span>
                        `).prop('disabled', true);
                    },
                    success:function(data){

                        console.log(data);
                        $('#submitBorrowedItems').html(`Submit`).prop('disabled', false)
                        
                        // if(data.success === false){
                        //     Swal.fire({
                        //         title: "Oops!",
                        //         text: data.result,
                        //         icon: "error"
                        //     }).then( () => $('#submitBorrowedItems').html(`Submit`).prop('disabled', false));
                        //     return false;
                        // }   

                        // if(data.success === true){
                        //     Swal.fire({
                        //         title: "Success",
                        //         text: data.result,
                        //         icon: "success"
                        //     }).then( () => $('#submitBorrowedItems').html(`Submit`).prop('disabled', false))
                        //     .then( () => location.href = "borrowed-items" );
                        //     return false;
                        // }
                    }
                })
                
            });
        });

        const dropdownItem = (counter) => {

            $.ajax({
                url: "dropdown-item",
                method: "GET",
                dataType: "json",
                cache: false,
                
                success:function(data){

                    if(data.success === true){
                        
                        Array.isArray(data.result) ? 
                            data.result.map( (item, index)=> {
                                
                                
                                $('.item_uuid'+counter).append(`
                                    <option value="${item.item_uuid}">${item.item_name}</option>
                                `);
                            })
                            
                        : '';
                        
                    }
                }
            })
        }

        const dropdownItem1 = () =>{
            $.ajax({
                url: "dropdown-item",
                method: "GET",
                dataType: "json",
                cache: false,
                
                success:function(data){

                    if(data.success === true){
                        
                        Array.isArray(data.result) ? 
                            data.result.map( (item, index)=> {
                                
                                $('#item_uuid').append(`
                                    <option value="${item.item_uuid}">${item.item_name}</option>
                                `);

                                
                            })
                            
                        : '';
                    }
                }
            })
        }
    </script>
</body>
</html>