<?php
session_start();
ob_start();
$userid = $_SESSION['id'];
if (isset($userid) && $userid != "") {
    require_once('include/function/spl_autoload_register.php');
  $userObj = new user;
  $fetchrecordobj = new fetchrecord;
  $ubstatus = $fetchrecordobj->ubstatus();
} else {
  echo "ABC" . $userid;
  // header('Location: index.php'); //redirect URL
}


?>
<?php include "head.php"; ?>
<?php include "header.php"; ?>
<?php include "left-menu.php"; ?>
<script>
var PaperData;

</script>
<!-- Main Content -->
<div class="main-content">
<?php include('admin_status.php');
?>
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
              <h4>Create Paper</h4>
              <div id="ajaxdata" style="display:none"></div>
            </div>
            <form action="" method="post" id="myForm">
              <?php $userObj->createpaper() ?>
              <div class="card-body">
                <!-- <div class="form-group row">
                  <label for="exid" class="col-sm-2 col-form-label">Choose Exam</label>
                  <div class="col-sm-4">
                    <select class="custom-select" name="exid">
                      <option selected>Choose Exam</option>
                      <?php //$examdetail = $fetchrecordobj->examdropdown(); ?>
                    </select>
                  </div>
                </div> -->
                <div class="form-group row">
                  <label for="pprname" class="col-sm-2 col-form-label">Paper Name</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="pprname" placeholder="Name" name="pprname" required>
                    <input type="hidden" value="<?php echo $userid; ?>" class="form-control" name="userid">
                  </div>
                  <label for="pprcode" class="col-sm-2 col-form-label">Paper Code</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="pprcode" placeholder="Paper Code" name="pprcode" required>
                  </div>
                </div>
                <div class="form-group row ">
                  <label for="examduration" class="col-sm-2 col-form-label">Duration (In Minutes)</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="examduration" placeholder="Duration In Minutes" name="examduration" required>
                  </div>
                  <label for="examdate" class="col-sm-2 col-form-label">Exam Date</label>
                  <div class="col-sm-4">
                    <input type="date" class="form-control" id="examdate" placeholder="Date" name="examdate" required>
                  </div>
                </div>
                <div class="abc">
                  <div class='element form-group row' id='div_1'>
                    <label for="examtime" class="col-sm-2 col-form-label" id="examlbl_1">Exam Time</label>
                    <div class="col-sm-4" id="textboxDiv_1">
                      <input type="time" class="form-control" id="examtime_1" placeholder="Time" name="examtime[]" required /><br />
                    </div>
                    <label for="password" class="col-sm-2 col-form-label" id="passlbl_1">Password</label>
                    <div class="col-sm-3" id="passtextbox_1">
                      <input type="text" class="form-control" id="password_1" placeholder="Password" name="password[]" required><br />
                    </div>    
                    <div class="col-sm-1" style="display: grid;">
                    <button id="Add" style="line-height: 15px; height: fit-content;" class="btn btn-primary add">Add Shift</button>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="ttlques" class="col-sm-2 col-form-label">Total Question</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="ttlques" placeholder="Total Question" name="ttlques" required>
                  </div>
                  <label for="ttlmark" class="col-sm-2 col-form-label">Total Marks</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="ttlmark" placeholder="Total Marks" name="ttlmark" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="examset" class="col-sm-2 col-form-label">No.of Set</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="examset" placeholder="Number of Set" name="examset" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-5 "></label>
                  <button type="submit" name="save" class="col-sm-1 btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Exam List</h4>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Logo</th>
                          <th scope="col">Code</th>
                          <th scope="col">Duration</th>
                          <th scope="col">Set</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php //$examdetail = $fetchrecordobj->getexam(); ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div> -->
      </div>
    </div>
  </section>
  <div class="settingSidebar">
    <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
    </a>
    <div class="settingSidebar-body ps-container ps-theme-default">
      <div class=" fade show active">
        <div class="setting-panel-header">Setting Panel
        </div>
        <div class="p-15 border-bottom">
          <h6 class="font-medium m-b-10">Select Layout</h6>
          <div class="selectgroup layout-color w-50">
            <label class="selectgroup-item">
              <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
              <span class="selectgroup-button">Light</span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
              <span class="selectgroup-button">Dark</span>
            </label>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <h6 class="font-medium m-b-10">Sidebar Color</h6>
          <div class="selectgroup selectgroup-pills sidebar-color">
            <label class="selectgroup-item">
              <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
              <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
              <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
            </label>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <h6 class="font-medium m-b-10">Color Theme</h6>
          <div class="theme-setting-options">
            <ul class="choose-theme list-unstyled mb-0">
              <li title="white" class="active">
                <div class="white"></div>
              </li>
              <li title="cyan">
                <div class="cyan"></div>
              </li>
              <li title="black">
                <div class="black"></div>
              </li>
              <li title="purple">
                <div class="purple"></div>
              </li>
              <li title="orange">
                <div class="orange"></div>
              </li>
              <li title="green">
                <div class="green"></div>
              </li>
              <li title="red">
                <div class="red"></div>
              </li>
            </ul>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <div class="theme-setting-options">
            <label class="m-b-0">
              <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="mini_sidebar_setting">
              <span class="custom-switch-indicator"></span>
              <span class="control-label p-l-10">Mini Sidebar</span>
            </label>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <div class="theme-setting-options">
            <label class="m-b-0">
              <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="sticky_header_setting">
              <span class="custom-switch-indicator"></span>
              <span class="control-label p-l-10">Sticky Header</span>
            </label>
          </div>
        </div>
        <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
          <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
            <i class="fas fa-undo"></i> Restore Default
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(function(){
  $('#myForm').submit(function() {
    $('#uploadloadercss').show(); 
    return true;
  });
});

  function setpaperdetail(pid) {
   
    $.ajax({
      type: "GET",
      url: "apiV1/Paper.php?pid="+pid,
      success: function(res,m, status) {
        if(status.status != 200){
          swal('Message',res.msg,"error");
          return;
        }
        //console.log(res)
        PaperData = res.data;

        $('#pprname').val(PaperData.papername);
        $('#pprcode').val(PaperData.papercode);
        $('#examduration').val(PaperData.duration);
        $('#examdate').val(PaperData.examdate);
        $('#ttlmark').val(PaperData.ttlmarks);
        $('#ttlques').val(PaperData.ttlquestions);
        $('#examset').val(PaperData.ttlset);
        
      }
    });
  }
  
// $(document).ready(function () {
//   $("#Add").on("click", function () {
//     $('#Remove').css("display","block");
//     $("#textboxDiv").append("<input type='time' name='examtime[]' class='form-control'/><br/>");
//     $("#passtextbox").append("<input type='text' placeholder='Password' name='password[]' class='form-control'/><br/>");
//   });
//    $("#Remove").on("click", function() {  
//        $("#textboxDiv").children().last().remove();  
//        $("#textboxDiv").children().last().remove();  
//          $("#passtextbox").children().last().remove();  
//          $("#passtextbox").children().last().remove();   
//    });  
// });

$(document).ready(function(){
// Add new element
$(".add").click(function(){
  // Finding total number of elements added
  var total_element = $(".element").length;
  // last <div> with element class id
  var lastid = $(".element:last").attr("id");
  var split_id = lastid.split("_");
  var nextindex = Number(split_id[1]) + 1;
  var max = 8;
  // Check total number elements
  if(total_element < max ){
    // Adding new div container after last occurance of element class
    $(".element:last").after("<div class='element form-group row' id='div_"+ nextindex +"'></div>");
    // Adding element to <div>  
    $("#div_" + nextindex).append('<label for="examtime" class="col-sm-2 col-form-label" id="examlbl_'+ nextindex +'">Exam Time</label><div class="col-sm-4" id="textboxDiv_'+ nextindex +'"><input type="time" class="form-control" id="examtime_'+ nextindex +'" placeholder="Time" name="examtime[]" required /><br /></div><label for="password" class="col-sm-2 col-form-label" id="passlbl_'+ nextindex +'">Password</label><div class="col-sm-3" id="passtextbox_'+ nextindex +'"><input type="text" class="form-control" id="password_'+ nextindex +'" placeholder="Password" name="password[]" required><br /></div><div class="col-sm-1" style="display: grid;"><button id="remove_'+ nextindex +'" style="line-height: 15px; height: fit-content;" class="btn btn-danger remove">Remove</button></div>');   
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
<?php if (isset($_POST["paperid"])) {
  echo '<script> setpaperdetail(' . $_POST["paperid"] . ')</script>';
}
?>
<?php include "footer.php"; ?>