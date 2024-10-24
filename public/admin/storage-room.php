<?php 
  include_once 'auth.php';
  $page = "storage";
  
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <title><?= TITLE ?> - Storage</title>
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
        <div class="col-lg-7 col-sm-12 col-md-12 mt-3">
          <div class="card">
            <div class="card-header bg-primary">
              <h3>Storage Room</h3>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr class="text-center">
                    <th>Room #</th>
                    <th>Room Label</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="rooms">
                  <div class="loader"></div>
                </tbody>
              </table>
              <button class="btn btn-primary mt-3" id="loadMoreRoom">Load More</button>
            </div>
            
          </div>
        </div>
        <div class="col-lg-5 col-sm-12 col-md-12 mt-3">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 id="form_title">Add Room</h3>
            </div>
            <div class="card-body">
              <form method="post">
                <input type="hidden" id="room_id">
                <label for="room_name">Room Label</label>
                <input type="text" class="form-control mb-3" id="room_name">

                <label for="room_name">Room Number</label>
                <input type="number" class="form-control mb-3" id="room_num">

                <div class="btn-group gap-2 w-100">
                  <button type="submit" class="btn btn-primary" id="saveRoom">Save room</button>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="../../assets/js/theme.js"></script>
    <script src="../../assets/js/logout.js"></script>

    <script>
      $(document).ready(function(){
        var page = 1;

        loadRooms(page);

        $('#loadMoreRoom').on('click', ()=>{
          page++;
          loadRooms(page);
        });

        $('#saveRoom').on('click', (e) => {

          e.preventDefault();
          var room_name = $('#room_name').val();
          var room_num = $('#room_num').val();
          var room_id = $('#room_id').val();

          $.ajax({
            url: "add-room",
            method: "POST",
            data: { 
              room_name: room_name,
              room_num: room_num,
              room_id: room_id,
            },
            dataType: "json",
            cache: false,
            beforeSend:function(){
              $('#saveRoom').html(`
                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                <span role="status">Saving...</span>
              `).attr('disabled', 'disabled');
            },
            success:function(data){

              // console.log(data);

              if(data.success === false){
                Swal.fire({
                  title: "Oops!",
                  text: data.result,
                  icon: "error"
                }).then( () => {
                  $('#saveRoom').html(`Save room`).removeAttr('disabled', 'disabled');
                });

                return false;
              }

              if(data.success === true){
                Swal.fire({
                  title: "Success",
                  text: data.result,
                  icon: "success"
                }).then( () => {
                  $('#saveRoom').html(`Save room`).removeAttr('disabled', 'disabled');
                }).then( () => {
                  $('#rooms').html('');
                  page = 1;
                  loadRooms(page);
                  btnCancel();
                });

                return false;
              }
            }
          })

        });

        $('#btnCancel').on('click', () => {
          btnCancel();
        })

      })

      const loadRooms = (page)=>{
        $.ajax({
          url: "load-room",
          method: "GET",
          data: {page:page},
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
              $('#loadMoreRoom').html(data.result).attr('disabled', 'disabled');
              return false;
            }

            if(data.success === true){
              // $('#loadMoreRoom').css('display', 'block');
              $('#loadMoreRoom').html('Load More').removeAttr('disabled', 'disabled');
              Array.isArray(data.result) ? 
                data.result.map( (item, index)=>{
                  $('#rooms').append(
                    `
                      <tr class="text-center">
                        <td>${item.room_num}</td>
                        <td>${item.room_name}</td>
                        <td>
                          <div class="btn-group">
                            <button class="btn btn-link btn-lg dropdown-toggle dropdown-toggle-no-caret" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" title"Option Menu">
                              <i class="bi bi-three-dots-vertical fs-2"></i>
                            </button>
                            <ul class="dropdown-menu">
                              <a class="dropdown-item" href="#" onclick="updateRoom(${item.room_id})">
                                <i class="bi bi-pencil"></i> Update
                              </a>

                              <a class="dropdown-item" href="#" onclick="deleteRoom(${item.room_id})" id="delBtn${item.room_id}">
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

      const deleteRoom = (room_id) => {
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
              url: "delete-room",
              method: "POST",
              data: {room_id: room_id},
              dataType: "json",
              cache: false,
              beforeSend:function(){
                $('#delBtn'+room_id).html(`
                  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                  <span role="status">Deleting...</span>
                `).attr('disabled', 'disabled');
              },
              success:function(data){

                if(data.success === false){
                  Swal.fire({
                    title: "Oops!",
                    text: data.result,
                    icon: "error"
                  }).then( ()=>{
                    $('#delBtn'+room_id).html(`
                      <i class="bi bi-trash"></i> Delete
                    `).removeAttr('disabled', 'disabled');

                  } );

                  return false;
                }

                if(data.success === true){
                  Swal.fire({
                    title: "Deleted!",
                    text: data.result,
                    icon: "success"
                  }).then( ()=>{
                    $('#rooms').html('');
                    page = 1;
                    loadRooms(page);
                    btnCancel();
                  });

                  return false;
                }

              }
            })

            
          }
        });
      }

      const updateRoom = (room_id) => {
        
        $.ajax({
          url: "select-room",
          method: "GET",
          data: { room_id: room_id },
          dataType: "json",
          cache: false,
          success:function(data){
            $('#room_name').val(data.result.room_name);
            $('#room_num').val(data.result.room_num);
            $('#room_id').val(data.result.room_id);

            if($('#room_id').val() === ''){
              $('#saveRoom').html('Save room')
              $('#form_title').html('Add Room')
            }else{
              $('#saveRoom').html('Save changes')
              $('#form_title').html('Update Room')
            }
          }
        })
      }

      const btnCancel = () => {
        $('#room_id').val('');
        $('#room_name').val('');
        $('#room_num').val('');
        $('#saveRoom').html('Save room')
        $('#form_title').html('Add Room')
      }
    </script>
</body>
</html>