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
            Profile Information
          </h1>
          <hr class="shadow p-1">
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12">
            <div class="row mb-3">
                <div class="col-lg-6 col-sm-12 col-md-12">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" class="form-control mb-3" readonly>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-12">
                    <label for="email">Username</label>
                    <input type="text" id="username" class="form-control mb-3" readonly>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <label for="member_type">
                        Member Type
                    </label>
                    <input type="text" id="member_type" class="form-control mb-3" readonly>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <label for="id_number">ID Number</label>
                    <input type="text" id="id_number" class="form-control mb-3" readonly>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <label for="member_type">
                        Sex
                    </label>
                    <input type="text" id="sex" class="form-control mb-3" readonly>
                </div>
                <!-- name info  -->
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <label for="f_name">First Name</label>
                    <input type="text" id="f_name" class="form-control mb-3" readonly>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <label for="l_name">Middle Name</label>
                    <input type="text" id="m_name" class="form-control mb-3" readonly>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <label for="l_name">Last Name</label>
                    <input type="text" id="l_name" class="form-control mb-3" readonly>
                </div>
                

                <div class="col-sm-12 col-md-12 col-lg-4 yr_level">
                    <label for="yr_level">Year Level (For student only)</label>
                    <input type="number" id="yr_level" class="form-control mb-3" min="1" max="4" readonly>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <label for="id_number">Contact Number</label>
                    <input type="text" id="contact" class="form-control mb-3" readonly>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <label for="member_type">
                        Department / Office / College
                    </label>
                    <input type="text" id="department" class="form-control mb-3" readonly>
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
            profileInfo();
        });

        const profileInfo = ()=>{
            var id = $('#acct_id').val();
            $.ajax({
                url: "get-profile-info",
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

                        let member_type = (data.result.member_type == 1) ? "Student" : "Employee"
                        let sex = (data.result.sex == 1) ? 'Male' : 'Female'
                        
                        $('#username').val(data.result.username)
                        $('#member_type').val(member_type)
                        $('#id_number').val(data.result.id_number);

                        $('#sex').val(sex)
                        $('#f_name').val(data.result.f_name);
                        $('#m_name').val(data.result.m_name);
                        $('#l_name').val(data.result.l_name);
                        $('#contact').val(data.result.contact);
                        $('#email').val(data.result.email_address);

                        $('#department').val(data.result.department);
               
                        (data.result.member_type == 2) ? $('.yr_level').css('display', 'none') : $('#yr_level').val(data.result.yr_level)
                        return false;
                    }
                }
            })
        }
    </script>
</body>
</html>