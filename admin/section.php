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
       // echo"ABC".$userid;
         header('Location: index.php'); //redirect URL
    }
    ?>
<?php include "head.php"; ?>
<?php include "header.php"; ?>
<?php include "left-menu.php"; ?>
<!-- Main Content -->
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
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Create Section</h4>
                  </div>
                  <form action="" method="post" id="myForm">
                  <?php $userObj->createsection()?>
                  <div class="card-body">
                    <div class="form-group row">
                      <!-- <label for="sectionname" class="col-sm-2 col-form-label">Choose Exam</label>
                      <div class="col-sm-4">
                      <select class="custom-select" required="true" name="chooseexam" id="exid" onchange="getpaper(document.getElementById('exid').value)">
                        <option selected>Choose Exam</option>
                        <?php //$examdetail = $fetchrecordobj->examdropdown(); ?>
                      </select>
                      </div> -->
                      <label for="sectionname" class="col-sm-2 col-form-label">Choose Paper</label>
                      <div class="col-sm-4">
                      <select class="custom-select" required="true" name="chooseppr" id="chooseppr" onchange="setpid(document.getElementById('chooseppr').value)">
                        <option selected value="choose">Choose Paper</option>
                        <?php $examdetail = $fetchrecordobj->pprdropdown(); ?>
                      </select>
                      </div>
                    </div>
                    <div class="abc">
                    <div class='element form-group row' id='div_1'>
                      <label for="sectionname" class="col-sm-2 col-form-label" id="lblsection_1">Section Details</label>
                      <div class="col-sm-2" id="sectext_1">
                        <input type="text" class="form-control" id="sectionname_1" placeholder="Section Name" name="sectioname[]" required><br/>
                      </div>
                      <div class="col-sm-2" id="ttlquestext_1">
                        <input type="text" class="form-control" id="ttlques_1" placeholder="Total Question" name="ttlques[]" required><br/>
                      </div>
                      <div class="col-sm-2" id="marktext_1">
                        <input type="text" class="form-control" id="marks_1" placeholder="Marks" name="marks[]" required>
                        <input type="text" class="form-control" style="display: none;" id="pid" placeholder="Pid" name="pid">
                        <br/>
                      </div>
                      <label for="check_1" class="col-form-label col-sm-2" id="issub_1" style="text-align:center">Subjective</label>
                      <div class="col-sm-1" id="checktext_1">
                        <input type="checkbox" class="" id="check_1" onclick="myFunction(1)" value="0" style="width:100%;height:4vh">
                        <input type="hidden" id="ischeck_1" name="chk[]" style="display:block" value="0"/>
                      </div>
                      <div class="col-sm-1">
                        <button id="Add" type="button" style="font-size:2rem" class="btn btn-primary add">+</button>                        
                      </div>
                    </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-5"></label>
                       <button type="submit" name="save" class="col-sm-1 btn btn-primary">Submit</button>
                       <label class="col-sm-4"></label>
                    </div>
                  </div>
                </form>
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

function myFunction(num) {
  document.getElementById("ischeck_"+num+"").value = "1"; 
}

$(document).ready(function(){
// Add new element
$(".add").click(function(){
  let chpid = document.getElementById('chooseppr').value;
  if(chpid == "choose"){
    alert("Please Choose Paper");
  }
  else{
 // Finding total number of elements added
 var total_element = $(".element").length;
 // last <div> with element class id
 var lastid = $(".element:last").attr("id");
 var split_id = lastid.split("_");
 var nextindex = Number(split_id[1]) + 1;
 var max = 10;
 // Check total number elements
 if(total_element < max ){
  // Adding new div container after last occurance of element class
  $(".element:last").after("<div class='element form-group row' id='div_"+ nextindex +"'></div>");
  // Adding element to <div>  
  $("#div_" + nextindex).append('<label for="sectionname" class="col-sm-2 col-form-label" id="lblsection_'+ nextindex +'">Section Details</label>'+
  '<div class="col-sm-2" id="sectext_'+ nextindex +'"><input type="text" class="form-control" id="sectionname_'+ nextindex +'" placeholder="Section Name" name="sectioname[]" required><br/></div>'+
  '<div class="col-sm-2" id="ttlquestext_'+ nextindex +'"><input type="text" class="form-control" id="ttlques_'+ nextindex +'" placeholder="Total Question" name="ttlques[]" required><br/></div>'+
  '<div class="col-sm-2" id="marktext_'+ nextindex +'"><input type="text" class="form-control" id="marks_'+ nextindex +'" placeholder="Marks" name="marks[]" required><br/></div>'+
  '<label for="check_'+ nextindex +'" class="col-form-label col-sm-2" id="issub_'+ nextindex +'" style="text-align:center">Subjective</label>'+
  '<div class="col-sm-1" id="checktext_'+ nextindex +'"><input type="checkbox" class="form-control" id="check_'+ nextindex +'" onclick="myFunction('+nextindex+')" style="width:100%;height:4vh"><input type="hidden" id="ischeck_'+ nextindex +'" name="chk[]" value="0" /></div>'+
  '<div class="col-sm-1"><button id="remove_'+ nextindex +'" style="font-size:2rem;" class="btn btn-danger remove">-</button></div>');
 }
}
});

// Remove element
$('.abc').on('click','.remove',function(){
 var id = this.id;
 var split_id = id.split("_");
 var deleteindex = split_id[1];
 // Remove <div> with id
 $("#div_" + deleteindex).remove();
}); 
});
</script>

<?php include "footer.php"; ?>