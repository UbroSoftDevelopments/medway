<?php
//require_once('include/membersite_config.php');
//    if(isset($_POST['logged'])){
//        $user = $_POST['username'];
//        if($fgmembersite->Login()){
//            echo $_SESSION['username'];
//            if($_SESSION['useremail'] == "$user"){
//            $fgmembersite->RedirectToURL("dashboard.php");
//        }
//        else{
//            echo"ftg";
//        }
//    }
//    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="">

    <title>Login Page</title>
    <link href="assets/css/lstyle.css" rel="stylesheet" />
    <link href="assets/css/cdncss.css" rel="stylesheet" />
    </head>
       <style>
  .center {
text-align:center; 

padding-bottom:10px; 

background-color: white; 

margin-left: auto;
   }

    </style>
<body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page">
<div class="c-app flex-row align-items-center">
    <div class="container">
            <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card mx-4">
                <div class="card-body p-4">
                    <div class="center">
                        <img src="assets/medway-lg.png" width="80%" height="" class="text-center">
                        
                </div>
                    <p class="text-muted">Login</p>

                    
                  <form method="POST" action="loginuser.php">
                       <!--<input type="hidden" name="logged" value="1" />-->
                        <div class="input-group mb-3">
                            <input id="email" name="username" type="text" class="form-control" required autofocus placeholder="Enter Enrollment Number." value="">

                                                    </div>

                        <!-- <div class="input-group mb-3">
                            <input id="password" name="password" type="password" class="form-control" required placeholder="Password">

                                                    </div> -->

                        <div class="input-group mb-4">
                            <div class="form-check checkbox">
                             
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" name="logged" class="btn btn-primary px-4">Login</button>
                                <!--<input type="submit" class="btn btn-primary px-4" name="logged" value='Login' />-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</body>

</html>

