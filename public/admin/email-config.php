<?php 
    include_once 'auth.php';
    $page = "email";
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title><?= TITLE ?> - Email Configuration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../../assets/css/main.css">
    <!-- <link rel="stylesheet" href="../../assets/css/dashboard.css"> -->
    <link rel="shortcut icon" href="../../<?= FAV_ICO; ?>" type="image/x-icon">

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once 'nav.php'; ?>
    <div class="container">
        <div class="row mb-3">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3>Email Configuration</h3>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-underline nav-fill">
                            <li class="nav-item">
                                <a class="nav-link active" href="email-config">Add New</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="view-config">View</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            <?= (isset($_GET['id'])) ? 'Update configuration' : 'Add new configuration' ?>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <input type="hidden" id="config_id" value="<?= isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 col-md-12">
                                    <label for="subject">Subject</label>
                                    <input type="text" class="form-control mb-3" id="subject">
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-12">
                                    <label for="tag">Tag</label>
                                    <input type="text" class="form-control mb-3" id="tag">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label for="message">Message</label>
                                    <textarea id="message" class="form-control mb-3"></textarea>
                                </div>
                            </div>
                            <div class="float-end mt-3">
                                
                                <?php 
                                    if(isset($_GET['id'])){
                                    ?>
                                    <a href="view-config" class="btn btn-danger">Cancel</a>
                                    <?php
                                    }
                                ?>
                                <button type="submit" class="btn btn-primary" id="saveConfigBtn">
                                    <?= (isset($_GET['id'])) ? 'Update config' : 'Save config' ?>
                                </button>
                            </div>
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

    <!-- sweet alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- dataTables  -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

    <script>
        
        $(document).ready(function(){
            $('#message').summernote({
                tabsize: 2,
                height: 280,
                toolbar: [
                    ['style', ['style']],
                    ['color', ['color']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert',['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
            });

            $('#saveConfigBtn').on('click', (e)=>{
                e.preventDefault();
                var message = $('#message').val();
                var subject = $('#subject').val();
                var tag = $('#tag').val();
                var config_id = $('#config_id').val();

                $.ajax({
                    url: "add-config",
                    method: "POST",
                    data: {
                        subject: subject,
                        tag: tag,
                        message: message,
                        config_id: config_id
                    },
                    beforeSend:function(){
                        $('#saveConfigBtn').html(`
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Saving...</span>
                        `).prop('disabled', true);
                    },
                    success:function(data){

                        if(data.success === false){
                                Swal.fire({
                                    title: "Oops!",
                                    text: data.result,
                                    icon: "error"
                                }).then( ()=> {
                                    $('#saveConfigBtn').html(`Save config`).prop('disabled', false);
                                });

                                return false;
                            }

                            if(data.success === true){
                                Swal.fire({
                                    title: "Success!",
                                    text: data.result,
                                    icon: "success"
                                }).then( ()=> {
                                    $('#saveConfigBtn').html(`Save config`).prop('disabled', false);
                                }).then(()=>{
                                    Swal.fire({
                                        title: "Would you like to add another?",
                                        icon: "question",
                                        showCancelButton: true,
                                        confirmButtonColor: "blue",
                                        cancelButtonColor: "#d33",
                                        confirmButtonText: "Yes",
                                        cancelButtonText: "No",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.href = "email-config";
                                        }else{
                                            location.href = "view-config";
                                        }
                                    });
                                });

                                return false;
                            }
                    }
                })
            });

            selectConfig();
        });

        const selectConfig = () => {
            var config_id = $('#config_id').val();
            $.ajax({
                url: "select-config",
                method: "GET",
                data: {
                    config_id: config_id,
                },
                dataType: "json",
                cache: false,
                success:function(data){
                    $('#subject').val(data.result.subject);
                    $('#tag').val(data.result.tag);
                    // $('#message').val(data.result.message);
                    $('#message').summernote('code', data.result.message);
                }
            });
        }
    </script>
</body>
</html>