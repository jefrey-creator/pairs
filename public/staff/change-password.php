<?php 
    include_once 'auth.php';
    $page = "account";
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <title><?= TITLE ?> - Borrower's Account</title>
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
      <div class="row mt-3 pt-3">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <h1 class="text-left">
            Change Password
          </h1>
          <hr class="shadow p-1">
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-md-12">
                    <label for="currentPass">Current Password</label>
                    <input type="password" class="form-control mb-3" id="current_password">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-md-12">
                    <label for="currentPass">New Password</label>
                    <div class="input-group">
                        <input type="password" id="new_password" class="form-control">
                        <div class="input-group-text" style="cursor: pointer;">
                            <span id="toggle-password" class="icon">👁️</span>
                        </div>
                    </div>
                    <a href="#" onclick="passwGen()" class="float-end  mb-3">Generate Password</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-md-12">
                    <label for="currentPass">Confirm New Password</label>
                    <input type="password" class="form-control mb-3" id="password_confirmation">
                </div>
            </div>
            <hr>
            <button class="btn btn-primary mb-3" type="button" id="btnChangePass">Change password</button>
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

            $('#toggle-password').on('click', function(){

                const passwordInput = document.getElementById('new_password');
                const icon = this;

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.textContent = '🙈'; // Change icon to "hide"
                } else {
                    passwordInput.type = 'password';
                    icon.textContent = '👁️'; // Change icon to "show"
                }
            });


            $('#btnChangePass').on('click', ()=>{

                var current_password = $('#current_password').val();
                var new_password = $('#new_password').val();
                var password_confirmation = $('#password_confirmation').val();

                $.ajax({
                    url: "update-password",
                    method: "POST",
                    data:{
                        current_password: current_password,
                        new_password: new_password,
                        password_confirmation: password_confirmation,
                    },
                    dataType: "JSON",
                    cache: false,
                    beforeSend:function(){
                        $('#btnChangePass').html(`
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Updating...</span>
                        `).prop('disabled', true);
                    },
                    success:function(data){
                        if(data.success === false){
                            Swal.fire({
                                title: "Error",
                                text: data.result,
                                icon: "info"
                            }).then(()=>{
                                $('#btnChangePass').html(`Change password`).prop('disabled', false);
                            });

                            return false;
                        }

                        if(data.success === true){

                            Swal.fire({
                                title: "Success",
                                text: data.result,
                                icon: "success"
                            }).then(()=>{
                                $('#btnChangePass').html(`Change password`).prop('disabled', false);
                            }).then(()=> location.href = "index");

                            return false;
                        }
                    }
                })

            });
        });

        const passwGen = () =>{
            $('#new_password').val(generatePassword(10));
            $('#password_confirmation').val($('#new_password').val());
            return false;
        }
        
        function generatePassword(length) {
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()";
            let password = "";

            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * charset.length);
                password += charset[randomIndex];
            }

            return password;
        }

    </script>
</body>
</html>