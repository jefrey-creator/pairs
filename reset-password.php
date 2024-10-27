<?php 

    include_once 'vendor/autoload.php';
    include_once 'private/ini.php';

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    try {

        $key = API_KEY;
        $decoded = JWT::decode($_GET['token'], new Key($key, 'HS256'));
    
    } catch (\Throwable $th) {
        header("location: redirect/401?invalid=Link expired");
        error_log($th->getMessage(), 0);
    }

   
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <title>Reset Password - <?= TITLE; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="shortcut icon" href="<?= FAV_ICO; ?>" type="image/x-icon">
    
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-7 col-sm-12 col-md-12 text-center">
                                <img src="./assets/img/reset-password.svg" class="img-fluid login_img" draggable="false" alt="Person's image using a laptop trying to login">
                            </div>
                            <div class="col-lg-5 col-sm-12 col-md-12">
                                <div class="pt-3 mt-3">
                                    <img src="./assets/img/pairs-banner.png" class="img-fluid mt-3 pt-3">
                                </div>
                                <div class="alert alert-success mt-3">
                                    <h6>
                                        Awesome! You're all set—now go ahead and create your new password!
                                    </h6>
                                </div>
                                <form method="POST">
                                    <input type="hidden" class="form-control-lg form-control" id="token" value="<?= htmlspecialchars($_GET['token']) ?>">
                                    <div class="mb-3">
                                        <label for="new_password">New Password</label>
                                        <div class="input-group">
                                            <input type="password" id="new_password" class="form-control form-control-lg">
                                            <div class="input-group-text" style="cursor: pointer;">
                                                <span id="toggle-password" class="icon">👁️</span>
                                            </div>
                                        </div>
                                        <a href="#" onclick="passwGen()" class="float-end  mb-3">Generate Password</a>
                                    </div>

                                    <div class="mb-3">
                                        <label for="new_password">Confirm New Password</label>
                                        <input type="password" class="form-control-lg form-control" id="confirm_new_password">
                                    </div>
                                    <button class="btn btn-primary btn-lg w-100" type="submit" id="onSavePassword" name="btnLogin">
                                        Create New Password
                                    </button>
                                    <a href="index" class="btn btn-outline-secondary w-100 mt-3">Login</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        $(document).ready(function(){

            $('#toggle-password').on('click', function(){

                const passwordInput = document.getElementById('new_password');
                const confirmPass = document.getElementById('confirm_new_password');
                const icon = this;

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    confirmPass.type = 'text';
                    icon.textContent = '🙈'; // Change icon to "hide"
                } else {
                    passwordInput.type = 'password';
                    confirmPass.type = 'password';
                    icon.textContent = '👁️'; // Change icon to "show"
                }
            });

            

            $('#onSavePassword').on('click', (e)=>{
                e.preventDefault();

                var new_password = $('#new_password').val();
                var confirm_new_password = $('#confirm_new_password').val();
                var token = $('#token').val();
                
                $.ajax({
                    url: "create-new-password",
                    method: "POST",
                    data: { 
                        new_password: new_password,
                        confirm_new_password: confirm_new_password,
                        token: token
                    },
                    dataType: "JSON",
                    cache: false,
                    beforeSend:function(){
                        $('#onSavePassword').html(`
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Updating...</span>
                        `).prop('disabled', true);
                    },
                    success:function(data){
                        if(data.success === false){
                            Swal.fire({
                                title: "Error",
                                text: data.result,
                                icon: "error"
                            }).then(()=> {
                                $('#onSavePassword').html(`Create New Password`).prop('disabled', false);
                            });

                            return false;
                        }

                        if(data.success === true){
                            Swal.fire({
                                title: "Success",
                                text: data.result,
                                icon: "success"
                            }).then(()=> {
                                $('#onSavePassword').html(`Create New Password`).prop('disabled', false);
                            }).then(()=> location.href="index");

                            return false;
                        }
                    }
                })
            })
        });

        const passwGen = () =>{
            $('#new_password').val(generatePassword(10));
            $('#confirm_new_password').val($('#new_password').val());
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