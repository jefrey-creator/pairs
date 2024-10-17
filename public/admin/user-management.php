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
                                <a class="nav-link active" aria-current="page" href="<?= (isset($_GET['id'])) ? 'user-management?id='.$_GET['id'] : 'user-management'; ?>">
                                    <?= (isset($_GET['id'])) ? 'Update account' : 'Add new' ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="view-user">View Members</a>
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
                            <div id="msg"></div>
                            <input type="hidden" id="acct_id" value="<?php echo trim($_GET['id']); ?>">
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
                                <div class="col-sm-12 col-md-12 col-lg-4 username">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" class="form-control mb-3">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4 password">
                                    <label for="password">Password</label>
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
                            <div class="row mb-3">
                                <h5>Profile Information</h5>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label for="email">Email Address</label>
                                    <input type="email" id="email" class="form-control mb-3">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="member_type">
                                        Member Type
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
                                    <input type="text" id="m_name" class="form-control mb-3">
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
                                    <div class="input-group mb-3">
                                        <select id="department" class="form-control form-select">
                                            <option value="">--select--</option>
                                        </select>
                                        <div class="input-group-text" onclick="addDepartmentModal()">
                                            <i class="bi bi-plus-circle" style="cursor:pointer;"></i>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div class="btn-group gap-2 float-end">
                                <input type="reset" value="Reset form" class="btn btn-danger resetFormBtn">
                                <button class="btn btn-primary " type="submit" id="saveAccount">
                                    <?= (isset($_GET['id'])) ? 'Update account' : 'Save account'; ?>
                                </button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="addDepartmentModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <label for="dept_head">Head (Optional)</label>
                                <input type="text" class="form-control mb-3" id="department_head">
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <label for="dept_head">Department</label>
                                <input type="text" class="form-control mb-3" id="department_name">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveDepartment">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="../../assets/js/theme.js"></script>
    <script src="../../assets/js/logout.js"></script>

    <!-- sweet alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function(){

            dropdownDepartment();
            if($('#acct_id').val() != ""){
                onUpdate();
            }

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
            });

            $('#saveDepartment').on('click', (e)=>{
                e.preventDefault();
                var department_head = $('#department_head').val();
                var department_name = $('#department_name').val();

                $.ajax({
                    url: "add-department",
                    method: "POST",
                    data:{
                        dept_head: department_head,
                        dept_name: department_name,
                    },
                    dataType: "json",
                    cache: false,
                    beforeSend:function(){
                        $('#saveDepartment').html(`
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Saving...</span>
                        `).prop('disabled', true);
                    },
                    success:function(data){

                        if(data.success === false){

                            Swal.fire({
                                title: "Oops.",
                                text: data.result,
                                icon: "error",
                            }).then( () => $('#saveDepartment').html('Save').prop('disabled', false) );

                            return false;

                        }

                        if(data.success === true){

                            Swal.fire({
                                title: "Success",
                                text: data.result,
                                icon: "success",
                            }).then( () => $('#saveDepartment').html('Save').prop('disabled', false))
                            .then( () => {
                                $('#department').html('');
                                dropdownDepartment();
                                $('#addDepartmentModal').modal('hide')
                            });

                            return false;
                        }
                    }
                });
            });

            $('#saveAccount').on('click', (e)=>{

                e.preventDefault();
                var user_type = $('#user_type').val();
                var username = $('#username').val();
                var password = $('#password').val();
                var member_type = $('#member_type').val();
                var id_number = $('#id_number').val();
                var sex = $('#sex').val();
                var f_name = $('#f_name').val();
                var m_name = $('#m_name').val();
                var l_name = $('#l_name').val();
                var yr_level = $('#yr_level').val();
                var contact = $('#contact').val();
                var department = $('#department').val();
                var acct_id = $('#acct_id').val();
                var email = $('#email').val();

                $.ajax({
                    url: "add-account",
                    method: "POST",
                    data: {
                        user_type: user_type,
                        username: username,
                        password: password,
                        member_type: member_type,
                        id_number: id_number,
                        sex: sex,
                        f_name: f_name,
                        m_name: m_name,
                        l_name: l_name,
                        yr_level: yr_level,
                        contact: contact,
                        department: department,
                        acct_id: acct_id,
                        email: email
                    },
                    dataType: "json",
                    cache: false,
                    beforeSend:function(){
                        $('#saveAccount').html(`
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Saving...</span>
                        `).prop('disabled', true);
                    },
                    success:function(data){
                        console.log(data);
                        $('#saveAccount').html(`Save`).prop('disabled', false);
                        if(data.success === false){
                            Swal.fire({
                                title: "Oops!",
                                text: data.result,
                                icon: "error"
                            }).then( ()=> {
                                $('#saveAccount').html(`Save`).prop('disabled', false);
                            });

                            return false;
                        }

                        if(data.success === true){
                            Swal.fire({
                                title: "Success!",
                                text: data.result,
                                icon: "success"
                            }).then( ()=> {
                                $('#saveAccount').html(`Save`).prop('disabled', false);
                                location.href = "view-user"
                            });

                            return false;
                        }
                    }
                })
                
            });

            $('.resetFormBtn').on('click', ()=>{
            
                if($('#acct_id').val() != ""){
                    location.href = "user-management";
                    $('#msg').css('display', 'none');
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

        const addDepartmentModal = ()=>{
            $('#addDepartmentModal').modal('show');
        }

        const onUpdate = ()=>{
            var id = $('#acct_id').val();
            $.ajax({
                url: "select-member-by-id",
                method: "GET",
                data: {
                    id: id
                },
                dataType: "json",
                cache: false,
                success:function(data){
                    
                    if(data.success === false){
                        $('#msg').html(data.result).addClass('alert alert-info');
                        return false;
                    }

                    if(data.success === true){
                        $('#user_type option[value="'+data.result.user_type+'"]').prop('selected', true);
                        $('.username').css('display', 'none').fadeOut();
                        $('.password').css('display', 'none').fadeOut();
                        $('#member_type option[value="'+data.result.member_type+'"]').prop('selected', true);
                        $('#id_number').val(data.result.id_number);
                        $('#sex option[value="'+data.result.sex+'"]').prop('selected', true);
                        $('#f_name').val(data.result.f_name);
                        $('#m_name').val(data.result.m_name);
                        $('#l_name').val(data.result.l_name);
                        $('#yr_level').val(data.result.yr_level);
                        $('#contact').val(data.result.contact);
                        $('#email').val(data.result.email_address);
                        $('#department option[value="'+data.result.department_id+'"]').prop('selected', true);
                        $('.resetFormBtn').val('Cancel');
                        return false;
                    }
                }
            })
        }
    </script>
</body>
</html>