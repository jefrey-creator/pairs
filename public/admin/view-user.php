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

  <!-- dataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
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
                                <a class="nav-link active" href="view-user">View Members</a>
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
                        <div class="table-responsive">
                            <table class="table table-bordered" id="membersDT">
                                <thead>
                                    <tr>
                                        <th>ID Number</th>
                                        <th>Name</th>
                                        <th>Member Type</th>
                                        <th>Sex</th>
                                        <th>Department</th>
                                        <th>Contact</th>
                                        <th>Year Level</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-start">
                                <?php
                                    $account = new Account();

                                    $members = $account->select_all_user();
                                    foreach($members as $member){
                                        $name = $member->l_name . ", " . $member->f_name . " " . $member->m_name;
                                    ?>
                                    <tr class="<?= ($member->acct_status == 1) ? 'table-danger' : ''; ?>">
                                        <td class="text-start"><?= $member->id_number; ?></td>
                                        <td class="text-start"><?= $name; ?></td>
                                        <td class="text-start"><?= ($member->member_type == 1) ? 'Student' : 'Employee'; ?></td>
                                        <td class="text-start"><?= ($member->sex == 1) ? 'Male' : 'Female'; ?></td>
                                        <td class="text-start"><?= $member->department; ?></td>
                                        <td class="text-start" ><?= $member->contact; ?></td>
                                        <td class="text-start"><?= $member->yr_level; ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-link btn-lg dropdown-toggle dropdown-toggle-no-caret" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip">
                                            <i class="bi bi-three-dots-vertical fs-2"></i>
                                            </button>
                                            <ul class="dropdown-menu">

                                                <a class="dropdown-item" href="#" onclick="resetPasswordModal(<?=$member->acct_id?>)">
                                                    <i class="bi bi-key"></i>
                                                    Reset password
                                                </a>

                                                <a href="user-management?id=<?= $member->acct_uuid; ?>" class="dropdown-item">
                                                    <i class="bi bi-pencil"></i>
                                                    Edit
                                                </a>

                                                <a class="dropdown-item" href="#" onclick="blockMember(<?=$member->acct_id?>)">
                                                    <?= ($member->acct_status == 0) ? '<i class="bi bi-ban"></i>  Block' : '<i class="bi bi-check-circle"></i> Unblock';  ?>
                                                </a>
                                            </ul>
                                            <input type="hidden" id="acct_status<?=$member->acct_id?>" value="<?=$member->acct_status?>">
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- reset password modal  -->
    <div class="modal" id="resetPasswordModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reset user password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <form method="post">
                        <input type="hidden" id="acct_id">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="password">Enter or Generate a new password</label>
                                <div class="input-group">
                                    <input type="password" id="password" class="form-control">
                                    <div class="input-group-text" style="cursor: pointer;">
                                        <span id="toggle-password" class="icon">👁️</span>
                                    </div>
                                </div>
                                <a href="#" onclick="passwGen()" class="float-end  mb-3">Generate Password</a>
                            </div>
                        </div>
                        <hr>
                        <div class="float-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="resetUserPassword">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="../../assets/js/theme.js"></script>
    <script src="../../assets/js/logout.js"></script>

    <!-- dataTables  -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

    <!-- sweet alert  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

            $('#membersDT').DataTable();

            $('#resetUserPassword').on('click', function(e){
                e.preventDefault();
                var acct_id = $('#acct_id').val();
                var password = $('#password').val();

                $.ajax({
                    url: "user-reset-password",
                    method: "POST",
                    data: {
                        acct_id: acct_id,
                        password: password,
                    },
                    dataType: "json",
                    cache: false,
                    success:function(data){
                        if(data.success === false){
                            Swal.fire({
                                title: "Error",
                                text: data.result,
                                icon: "error"
                            });

                            return false;
                        }

                        if(data.success === true){
                            Swal.fire({
                                title: "Success",
                                text: data.result,
                                icon: "success"
                            }).then(()=> location.href = "view-user" );

                            return false;
                        }
                    }
                });
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
        
        const blockMember = (acct_id)=>{
            var acct_status = $('#acct_status'+acct_id).val();
            
            $.ajax({
                url: "block-user",
                method: "POST",
                data: {
                    acct_id: acct_id,
                    acct_status: acct_status
                },
                dataType: "json",
                cache: false,
                success:function(data){
                    if(data.success === false){
                        Swal.fire({
                            title: "Error",
                            text: data.result,
                            icon: "error"
                        });

                        return false;
                    }

                    if(data.success === true){
                        Swal.fire({
                            title: "Success",
                            text: data.result,
                            icon: "success"
                        }).then(()=> location.href = "view-user" );

                        return false;
                    }
                }
            })
        }

        const resetPasswordModal = (acct_id) =>{
            $('#resetPasswordModal').modal('show');
            $('#acct_id').val(acct_id);
        }
    </script>
</body>
</html>