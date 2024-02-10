<?php   
   session_start();
    ob_start();
    $userid = $_SESSION['id']; 
    if(isset($userid) && $userid != "")
    {
        require_once('include/function/spl_autoload_register.php');
          $userObj = new user;
         $fetchrecordobj = new fetchrecord;
    } else {
        echo"ABC".$userid;
        // header('Location: index.php'); //redirect URL
    }
    ?>
<?php include "head.php"; ?>
<?php include "header.php"; ?>
<?php include "left-menu.php"; ?>
<!-- Main Content -->
<div class="main-content" >
        <section class="">
          <div class="">
            <div class="row" style="margin-top: -45px;">
              <div class="col-12">
                <div class="card" style="margin-bottom:5px">
                  <div class="card-header">
                    <h4>Assign Sets to Candidate</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group row" >
                      <div class="col-sm-2">
                      <select class="custom-select" name="chooseexam" id="exid" onchange="getpaper(document.getElementById('exid').value)">
                        <option selected>Choose Exam</option>
                        <?php $examdetail = $fetchrecordobj->examdropdown(); ?>
                      </select>
                      </div>
                      <div class="col-sm-3">
                      <select class="custom-select" name="chooseppr" id="chooseppr" onchange="shiftlist(document.getElementById('chooseppr').value)">
                        <option selected>Choose Paper</option>
                      </select>
                      <input type="hidden" id="pprid" name="pprid"/>
                      </div>
                      <div class="col-sm-2">
                      <select class="custom-select" name="chooseshift" id="chshift" onchange="getpapershift(document.getElementById('pprid').value)">
                        <option selected value="">Choose Shift</option>
                      </select>
                      </div>
                      <div class="col-sm-3">
                      <select class="custom-select" name="choosecenter" id="choosecenter">
                        <option selected value="">Choose Center</option>
                      </select>
                      </div>
                      <div class="col-sm-2">
                      <button onclick="assignset()" class="btn btn-primary" id="assignset" style="height: 40px;">Assign Set</button>
                      </div>
                    </div>
                    <div class="form-group row" id="setsdiv" style="margin-bottom: 0px;">
                    </div>
                  </div>
                </div>
              </div>
            
                <div class="col-12" style="color:white;display:none;" id="loaderdiv">
                      <img src="assets/img/rocketloader.gif" class="pull-right"  style="width:100%;height:400px;"/>
                </div>
            

              <div class="col-12">             
                  <div id="candidiv"></div>               
              </div>
           
            </div>
          </div>
        </section>
</div>
<?php include "footer.php"; ?>