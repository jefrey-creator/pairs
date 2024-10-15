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
                                <a class="nav-link active" aria-current="page" href="user-management">Add New</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="import-user">Import</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="view-user">View</a>
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
                            <h4>Add new user</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="row mb-3">
                                <h5>Account Details</h5>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="user_type">User Type</label>
                                    <select id="user_type" class="form-control form-select mb-3">
                                        <option value="">--select--</option>
                                        <option value="2">Admin</option>
                                        <option value="1">Borrower</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" class="form-control mb-3">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="password">Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" id="password" class="form-control">
                                        <div class="input-group-text" style="cursor: pointer;">
                                            <span id="toggle-password" class="icon">👁️</span>
                                        </div>
                                    </div>
                                    <a href="#" onclick="passwGen()" class="float-end">Generate Password</a>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <h5>Profile</h5>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="member_type">
                                        Borrower Type
                                    </label>
                                    <select id="member_type" class="form-control form-select mb-3">
                                        <option value="">--select--</option>
                                        <option value="1">Student</option>
                                        <option value="2">Employee</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="id_number">ID Number</label>
                                    <input type="text" id="id_number" class="form-control mb-3">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="member_type">
                                        Sex
                                    </label>
                                    <select id="sex" class="form-control form-select mb-3">
                                        <option value="">--select--</option>
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
                                    </select>
                                </div>
                                <!-- name info  -->
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="f_name">First Name</label>
                                    <input type="text" id="f_name" class="form-control mb-3">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="l_name">Middle Name (Optional)</label>
                                    <input type="text" id="l_name" class="form-control mb-3">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="l_name">Last Name</label>
                                    <input type="text" id="l_name" class="form-control mb-3">
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-4 yr_level">
                                    <label for="yr_level">Year Level (For student only)</label>
                                    <input type="number" id="yr_level" class="form-control mb-3" min="1" max="4">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="id_number">Contact Number</label>
                                    <input type="text" id="contact" class="form-control mb-3">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="member_type">
                                        Department / Office / College
                                    </label>
                                    <select id="department" class="form-control form-select mb-3">
                                        <option value="">--select--</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary float-end" type="submit" id="saveAccount">
                                Save account
                            </button>
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

            dropdownDepartment();

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

            $('#member_type').on('change', ()=>{
                let member_type = $('#member_type').val();

                if(member_type == 2){
                    $('.yr_level').css('display', 'none').fadeOut();
                }else{
                    $('.yr_level').css('display', 'block').fadeIn();
                }
            })
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

        const dropdownDepartment = ()=>{

            $.ajax({
                url: "load-department",
                method: "GET",
                dataType: "json",
                cache: false,
                success:function(data){
                   
                    Array.isArray(data) ? 
                        data.map( (item, index) => {
                            $('#department').append(`
                                <option value="${item.department_id}">${item.department}</option>
                            `)
                        })

                    : '';

                }
            })
        }

    </script>
</body>
</html>