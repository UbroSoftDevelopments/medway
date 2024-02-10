<?php 
  
   session_start();
    ob_start();
    $userid = $_SESSION['id']; 
    if(isset($userid) && $userid != "")
    {
        require_once('include/function/spl_autoload_register.php');
          $userObj = new user;
         $fetchrecordobj = new fetchrecord;
         $ubstatus = $fetchrecordobj->ubstatus();
       //  $centercnt = $fetchrecordobj->centercount();
        $pprcnt = $fetchrecordobj->papercount();
        //$shiftcnt = $fetchrecordobj->shiftcount();
        //$candidatecnt = $fetchrecordobj->candidatecount();

    } else {
        //echo"ABC".$userid;
         header('Location: index.php'); //redirect URL
    }
    ?>
<?php include 'head.php';?>
<?php include 'header.php';?>
<?php include 'left-menu.php';?>

<div class="main-content" style="margin-top: -35px;">
  <?php include('admin_status.php');?>
  
    <section class="section">
      <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card card-danger">
                  <div class="card-body">
                   <div class="form-group row">
                    <!-- <label for="chooseexam" class="col-sm-1 col-form-label">Filter</label> -->
                    <!-- <div class="col-sm-2">
                      <select class="custom-select" name="chooseexam" id="exid" onchange="getdashboardpaper(document.getElementById('exid').value)">
                        <option selected>Choose Exam</option>
                        <?php //$examdetail = $fetchrecordobj->examdropdown(); ?>
                      </select>
                    </div> -->
                    <div class="col-sm-3">                      
                      <select class="custom-select" name="chooseppr" id="chooseppr" onchange="getcenterdts(document.getElementById('chooseppr').value)">
                        <option selected>Choose Paper</option>
                        <?php $examdetail = $fetchrecordobj->pprdropdown(); ?>
                      </select>
                      <input type="hidden" id="pprid" name="pprid"/>
                    </div>
                    <div class="col-sm-3">
                      <select class="custom-select" name="choosepprtime" id="choosepprtime" onchange="getpapershift(document.getElementById('pprid').value)">
                        <option selected>Choose Shift</option>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <select class="custom-select" name="choosecity" id="choosecity" onchange="getcity(document.getElementById('choosecity').value)">
                        <option selected>Choose City</option>
                        <?php //echo $centercity=$fetchrecordobj->centercity();?>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <select class="custom-select" name="choosecenter" id="choosecenter" onchange="getcandidate(document.getElementById('choosecenter').value)">
                        <option selected>Choose Center</option>
                      </select>
                    </div>
                    <!-- <div class="col-sm-2">
                      <button class="btn btn-primary" onclick="getdatabyshift(document.getElementById('shiftdrop').value)">Submit</button>
                    </div> -->
                   </div>
                  </div>
                </div>
              </div>
              <!-- <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-primary">
                  <div class="card-body">
                    <div class="media">
                      <img class="mr-3" src="assets/icons/Total Exam.png" alt="Exam Image">
                      <div class="media-body">
                        <h5 class="mt-0">Examination</h5>
                        <code class="fntsize">Count:</code><label class="fntsize" id="excnt"><?php //echo $examcnt['cnt'];  ?></label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>               -->
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-danger">
                  <div class="card-body">
                    <div class="media">
                      <img class="mr-3" src="assets/icons/Total Shift.png" alt="Exam Image">
                      <div class="media-body">
                        <h5 class="mt-0">Paper</h5>
                        <code class="fntsize">Count:</code><label class="fntsize" id="pprcnt">0</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-danger">
                  <div class="card-body">
                    <div class="media">
                      <img class="mr-3" src="assets/icons/Schedule.png" alt="Exam Image">
                      <div class="media-body">
                        <h5 class="mt-0">Shift</h5>
                        <code class="fntsize">Count:</code><label class="fntsize" id="shiftcnt">0</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-secondary">                  
                  <div class="card-body">
                    <div class="media">
                      <img class="mr-3" src="assets/icons/Total Centre.png" alt="Center Image">
                      <div class="media-body">
                        <h5 class="mt-0">Center</h5>
                        <code class="fntsize">Count:</code><label class="fntsize" id="centercnt">0</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-warning">
                  <div class="card-body">
                    <div class="media">
                      <img class="mr-3" src="assets/icons/Total Candidate.png" alt="Exam Image">
                      <div class="media-body">
                        <h5 class="mt-0">Candidate</h5>
                        <code class="fntsize">Count:</code><label class="fntsize" id="candicnt">0</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>        
      </div> 
    </section>   
</div>



<?php  include 'footer.php';?>