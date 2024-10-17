<?php include_once 'private/ini.php'; ?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <title>Login - <?= TITLE; ?></title>
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
                                <img src="./assets/img/login.svg" class="img-fluid login_img" draggable="false" alt="Person's image using a laptop trying to login">
                            </div>
                            <div class="col-lg-5 col-sm-12 col-md-12">
                                <div class="pt-3 mt-3">
                                    <img src="./assets/img/pairs-banner.png" class="img-fluid mt-3 pt-3">
                                </div>
                                <!-- <div class="separator"></div> -->
                                <div class="login_form">
                                    <div class="mb-3">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control-lg form-control" id="username">
                                    </div>
                                    <div class="mb-1">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control-lg form-control" id="password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="show_password" id="password_show">
                                            <input type="checkbox" id="show_password">
                                            Show Password
                                        </label>
                                    </div>
                                    <button class="btn btn-primary btn-lg w-100" type="submit" id="onLogin" name="btnLogin">Login</button>
                                    <a href="#" class="btn btn-link float-end mt-4 mb-4">Forgot Password?</a>
                                </div>
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
            $('#show_password').on('click', function(){
                // console.log('checked')
                if($('input[type="checkbox"]').is(':checked')){
                    // console.log('checked')
                    $('#password').attr('type', 'text');
                }else{
                    $('#password').attr('type', 'password');
                }
            });

            $('#onLogin').on('click', (e)=>{
                e.preventDefault();

                var username = $('#username').val();
                var password = $('#password').val();

                $.ajax({
                    url: "./login/login",
                    method: "POST",
                    data: { 
                        username: username,
                        password: password,
                    },
                    dataType: 'json',
                    cache: false,
                    beforeSend: function(){
                        $('#onLogin').html(`
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Loading...</span>`)
                        .attr('disabled', 'disabled');
                    },
                    success:function(data){
                        if(data.success === false){
                            Swal.fire({
                                title: "Error",
                                text: data.result,
                                icon: "error"
                            }).then(()=>{
                                $('#onLogin').html(`Login`)
                                .removeAttr('disabled', 'disabled');
                            });

                            return false;
                        }

                        if(data.success === true){
                            Swal.fire({
                                title: "Success",
                                text: data.result,
                                icon: "success"
                            }).then( () => location.href = 'verify-login');

                            return false;
                        }
                        
                    }
                })
            })
        });


    </script>
</body>
</html>