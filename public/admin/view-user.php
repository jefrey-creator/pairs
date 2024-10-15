<?php 
  include_once 'auth.php';
  $page = "user";
  
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <title><?= TITLE ?> - User Accounts</title>
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
            <div class="col-lg-12 col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title">
                            <h3>User Management - Menu</h3>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <ul class="nav nav-underline nav-fill">
                            <li class="nav-item">
                                <a class="nav-link" href="user-management">Add New</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="import-user">Import</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="view-user">View</a>
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
                        <div class="card-title">
                            <h4>User List</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            
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

    <script>
        $(document).ready(function(){
            $('#toggle-password').on('click', function(){

                const passwordInput = document.getElementById('password');
                const icon = this;

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.textContent = '🙈'; // Change icon to "hide"
                } else {
                    passwordInput.type = 'password';
                    icon.textContent = '👁️'; // Change icon to "show"
                }
            });
        });

        const passwGen = () =>{
            $('#password').val(generatePassword(10));
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