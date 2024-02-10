<?php
session_start();
ob_start();
$userid = $_SESSION['id'];
if (isset($userid) && $userid != "") {
    require_once('include/function/spl_autoload_register.php');
    $userObj = new user;
    $fetchrecordobj = new fetchrecord;
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>ADMIN</title>
    <script src="assets/js/page/sweetalert.js"></script>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel='shortcut icon' type='image/x-icon' href='' />
    <style>
        #img-preview {
            display: none;
            width: 155px;
            border: 2px dashed #333;
            margin-bottom: 20px;
        }

        #img-preview img {
            width: 100%;
            height: auto;
            display: block;
        }
        .navbar{
            left: 0 !important;
        }
    </style>
</head>
<body>
    <!-- Main Content -->
    <div class="loader">
    </div>
    <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar sticky">
            <div class="form-inline mr-auto">
                <ul class="navbar-nav">
                    <li>
                         <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"> 
                            <img src="assets/Title_UB.png" class="img-fluid" alt="ublogo" style="width: 20px;height:20px;"/>
                         </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link nav-link-lg fullscreen-btn">
                            <i data-feather="maximize"></i>
                        </a>
                    </li>
                    <!-- <li>
                        <form class="form-inline mr-auto">
                            <div class="search-element">
                                <input class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search......" title="Type in a name" aria-label="Search" data-width="200">
                                <button class="btn" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </li> -->
                    <li>
                        <h5 class="mt-2 ml-2">Welcome <?php echo  $_SESSION['username'];?></h5>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown dropdown-list-toggle">
                    <a href="#" class="nav-link nav-link-lg message-toggle">
                        <i data-feather="edit" onclick="getnote(<?php echo $userid; ?>)"></i>
                    </a>
                    <div id="notebox" class="dropdown-menu dropdown-list dropdown-menu-right pullDown ">
                        <div class="dropdown-header">
                            Notes<label id="notestatus" class="text-success pull-right"></label>
                        </div>
                        <div class="dropdown-list-content  p-2">
                            <textarea cols=31 rows=8 id="notetextarea"></textarea>
                        </div>
                        <div class="dropdown-footer text-center">
                            <label class="btn btn-danger text-left" onclick="hidenote()">Cancel</label>
                            <label class="btn btn-success text-right" onclick="savenote(<?php echo $userid; ?>)">Save</label>
                        </div>
                    </div>
                </li>
                <script>
                    function hidenote() {
                        $('#notestatus').empty();
                        $('#notebox').removeClass('show');
                    }
                </script>
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="assets/logo/download.png" class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
                    <div class="dropdown-menu dropdown-menu-right pullDown">
                        <div class="dropdown-title"><?php echo  $_SESSION['username'];?></div>
                        <a href="#" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="logout.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
    <div class="container-fluid" style="margin-top:6rem">
        <div class="row">
            <div class="col-12 col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Exam</h4>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php $userObj->createexam() ?>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="examname" class="col-sm-3 col-form-label">Exam Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="examname" placeholder="Name" name="examname" required>
                                    <input type="hidden" value="<?php echo $userid; ?>" class="form-control" name="userid">
                                    <input type="hidden" class="form-control" name="state" id="state">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Choose Logo</label>
                                <div class="col-sm-6 ">
                                    <div class="">
                                        <input type="file" class="form-control" id="examlogo" name="image" accept=".jpg, .png">
                                        <!-- <label class="" for="examlogo">Choose file</label> -->
                                        <input type="hidden" class="form-control" id="exlogo" name="exlogo" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4"></label>
                                <div class="col-sm-4">
                                    <div id="img-preview" name="imageprev">
                                        <img src="" name="examimage" id="examimage" alt="img" />
                                    </div>
                                </div>
                                <label class="col-sm-4">
                                    <div id="successmsg" style="display: none;"></div>
                                </label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4"></label>
                                <button type="submit" name="save" class="col-sm-3 btn btn-primary">Submit</button>
                                <label class="col-sm-5"></label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h4>Exam List</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $examdetail = $fetchrecordobj->getexam(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        function configureexam(id){
            document.cookie = "myJavascriptVar = " + id;
            window.open("dashboard.php", "_blank");
        }
            
        const chooseFile = document.getElementById("examlogo");
        const imgPreview = document.getElementById("img-preview");
        chooseFile.addEventListener("change", function() {
            getImgData();
        });

        function getImgData() {
            const files = chooseFile.files[0];
            if (files) {
                const fileReader = new FileReader();
                fileReader.readAsDataURL(files);
                fileReader.addEventListener("load", function() {
                    imgPreview.style.display = "block";
                    document.getElementById('examimage').src = this.result;
                    document.getElementById('exlogo').value = this.result;

                });
            }
        }

        function editexam(eid) {
            $.ajax({
                type: "POST",
                url: "ajax_pages/getexam.php",
                data: {
                    eid: eid
                },
                success: function(msg) {
                    $('#successmsg').empty();
                    $('#successmsg').append(msg);
                    document.getElementById('state').value = eid;
                    document.getElementById('examname').value = document.getElementById('nm').textContent;
                    document.getElementById('exlogo').value = document.getElementById('logo').textContent;
                    document.getElementById('examimage').src = document.getElementById('logo').textContent;
                    imgPreview.style.display = "block";
                }
            });
        }

        function deleteexam(eid) {
            $.ajax({
                type: "POST",
                url: "ajax_pages/deleteexam.php",
                data: {
                    eid: eid
                },
                success: function(msg) {
                    alert(msg);
                    window.location.href = "ubexam.php";
                }
            });
        }
    </script>
    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
</body>
</html>
<?php } else {
    // echo "ABC" . $userid;
    header('Location: index.php'); //redirect URL
}
?>