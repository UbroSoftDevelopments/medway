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
    } else {
        echo"ABC".$userid;
        // header('Location: index.php'); //redirect URL
    }
?>
<?php include "head.php"; ?>
<?php include "header.php"; ?>
<?php include "left-menu.php"; ?>

<!-- Main Content -->
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
  </style>
<div class="main-content" style="margin-top: -35px;">
<?php include('admin_status.php');?>
        <div class="modal bd-example-modal-sm" id="uploadloadercss" tabindex="-1" role="dialog"
          aria-labelledby="" aria-hidden="true" style="display:none;opacity:1;background-color:#f3efefd1;">
          <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
            <div class="modal-content" style="width: 100%;">
              <div class="modal-body">
                <center><img src="assets/img/newloader.gif" class="img-fluid" /></center>
              </div>              
            </div>
          </div>
        </div>
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-9 col-lg-9">
                <div class="card">
                  <div class="card-header">
                    <h4>Add Language</h4>
                  </div>
                <form action="" method="post" enctype="multipart/form-data" id="myForm">
                  <?php $userObj->createlanguage()?>
                  <div class="card-body">
                  <div class="form-group row">
                      <!-- <label for="sectionname" class="col-sm-2 col-form-label">Choose Exam</label>
                      <div class="col-sm-4">
                      <select class="custom-select" required="true" name="chooseexam" id="exid" onchange="getpaper(document.getElementById('exid').value)">
                        <option selected>Choose Exam</option>
                        <?php //$examdetail = $fetchrecordobj->examdropdown(); ?>
                      </select>
                      </div> -->                      
                      <div class="col-sm-5">
                      <select class="custom-select" required="true" name="chooseppr" id="chooseppr" onchange="choosepprf(document.getElementById('chooseppr').value)">
                        <option selected value="choose">Choose Paper</option>
                        <?php $examdetail = $fetchrecordobj->pprdropdown(); ?>
                      </select>
                      <input type="hidden" class="form-control" id="pid" name="pid" value="">
                      </div>                      
                      <div class="col-sm-5">
                        <input type="text" class="form-control" id="language" placeholder="Enter Language Name" name="language" required>
                        <input type="hidden" class="form-control" name="lanid" id="lanid">
                      </div>
                      <div class="col-sm-2">
                        <button type="submit" name="save" class=" btn btn-primary">Submit</button>
                      </div>
                    </div>
                  </div>
                </form>
                </div>
              </div>
              <div class="col-12 col-md-3 col-lg-3">
                <div class="card">
                  <div class="card-header">
                    <h4>Language List</h4>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <!-- <th scope="col">Action</th>
                          <th scope="col">Action</th> -->
                        </tr>
                      </thead>
                      <tbody id="languagelist">
                        <?php  //$examdetail = $fetchrecordobj->getlanguage(); ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

</div>
<script>
 $(function(){
  $('#myForm').submit(function() {
    $('#uploadloadercss').show(); 
    return true;
  });
});

function editlang(eid){
  $.ajax({
    type: "POST",
    url: "ajax_pages/getlanguage.php",
    data: {eid: eid },
    success: function (msg) {
      //alert(msg)
      const myArray = msg.split(",");
      // $('#successmsg').empty();
      // $('#successmsg').append(msg);      
      document.getElementById('lanid').value = myArray[0];
      document.getElementById('language').value=myArray[1];
    }
  });
}
function deletelang(eid){
  $.ajax({
    type: "POST",
    url: "ajax_pages/deletelanguage.php",
    data: {eid:eid},
    success: function (msg) {
      alert(msg);
      window.location.href = "language.php";
    }
  });
}

  </script>
<?php include "footer.php"; ?>