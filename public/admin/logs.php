<?php 
  include_once 'auth.php';
  $page = "log";
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <title><?= TITLE ?> - Activity Logs</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <link rel="shortcut icon" href="../../<?= FAV_ICO; ?>" type="image/x-icon">
</head>
<body>
    <?php include_once 'nav.php'; ?>
    <div class="container">
      <div class="row mb-3">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <h3 class="text-bold">
            Activity Logs
          </h3>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="row">
            <div class="col-lg-4 col-sm-12 col-md-12">
              <div class="input-group mb-3">
                <input type="date" class="form-control form-control-lg" id="filterInput">
                <div class="input-group-text">
                  <button class="btn btn-link text-decoration-none" type="button" id="btnFilter">
                    <i class="bi bi-filter"></i>
                    Filter
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div id="logs"></div>
        </div>
      </div>
      <hr>
      <button class="btn btn-primary float-end" type="button" id="btnLoadMore">Load More</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="../../assets/js/theme.js"></script>
    <script src="../../assets/js/logout.js"></script>

    <script>
      $(document).ready(function(){
        var page = 1;
        activityLogs(page);

        $('#btnLoadMore').on('click', ()=>{
          page++
          activityLogs(page);
        });

        $('#btnFilter').on('click', ()=>{

          var filterInput = $('#filterInput').val();

          if(filterInput == ""){

            $('#logs').html('')
            page = 1;
            activityLogs(page);

            return false;
          }

          $.ajax({
            url: "filter-logs",
            method: "GET",
            data: {filterInput: filterInput},
            dataType: "json",
            cache: false,
            beforeSend:function(){
              $('#btnFilter').html(`
                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
              `).prop('disabled', true);
            },
            success:function(data){

              $('#logs').html('');
              
              $('#btnFilter').html(`
                <i class="bi bi-filter"></i> Filter
              `).prop('disabled', false);

              if(data.success === false){
                $('#btnLoadMore').html(data.result).prop('disabled', true);
                return false;
              }

              if(data.success === true){

                $('#btnLoadMore').html('All data loaded successfully').prop('disabled', true);
                Array.isArray(data.result) ? 
                  data.result.map((item, index)=>{
                    $('#logs').append(`
                      <div class="card mb-3">
                        <div class="card-body">
                          <div class="mb-3">
                            <span class="mb-2">${item.user_id}</span> | 
                            <span class="float-end">${item.time_stamp}</span>
                            <span>${item.ip_address}</span>
                          </div>
                          <div>
                            <span>${item.action}</span>
                          </div>
                          <h6>
                            ${item.details}
                          </h6>
                        </div>
                      </div>
                    `)
                  })
                : '';

                return false;
                
              }
            }
          });
        });
      });
      
      const activityLogs = (page)=>{
        $.ajax({
          url: "list-logs",
          method: "GET",
          data: {page: page},
          dataType: "json",
          cache: false,
          beforeSend:function(){
            $('#btnLoadMore').html(`
              <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
              <span role="status">Loading...</span>
            `).prop('disabled', true);
          },
          success:function(data){
            
            if(data.success === false){
              $('#btnLoadMore').html(data.result).prop('disabled', true);
              return false;
            }

            if(data.success === true){

              $('#btnLoadMore').html('Load More').prop('disabled', false);

              Array.isArray(data.result) ? 
                data.result.map((item, index)=>{
                  $('#logs').append(`
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="mb-3">
                          <span class="mb-2">${item.user_id}</span> | 
                          <span class="float-end">${item.time_stamp}</span>
                          <span>${item.ip_address}</span>
                        </div>
                        <div>
                          <span>${item.action}</span>
                        </div>
                        <h6>
                          ${item.details}
                        </h6>
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
    </script>
</body>
</html>