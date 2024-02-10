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
        <section class="section">
          <div class="section-body">
            <div class="row" style="margin-top: -45px;">
              <div class="col-12">
                <div class="card" style="margin-bottom:5px">
                  <div class="card-header">
                    <h4>Paper List</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group row" style="margin-bottom: 10px;">
                      <label for="sectionname" class="col-sm-2 col-form-label">Choose Exam</label>
                      <div class="col-sm-6">
                      <select class="custom-select" name="chooseexam" id="exid" >
                        <option selected value="">Choose Exam</option>
                        <?php $examdetail = $fetchrecordobj->examdropdown(); ?>
                      </select>
                      </div>
                      <div class="col-md-2">
                        <button class="btn btn-primary" onclick="getpaperlist()">Submit</button>
                      </div>
                    </div>
                    <div class="form-group row" id="setsdiv" style="margin-bottom: 0px;">
                    </div>
                  </div>
                </div>
                <div class="col-12" style="color:white;display:none;" id="loaderdiv">
                      <img src="assets/img/rocketloader.gif" class="pull-right"  style="width:100%;height:420px;"/>
                </div>
           
                <div class="row">             
                  <div class="col-12" id="sectionData"></div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- <div class="settingSidebar">
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
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
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
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Mini Sidebar</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="sticky_header_setting">
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
        </div> -->
</div>
<script>
function getpaperlist() {
  const eid = document.getElementById('exid').value;
  if(!eid){
    alert("Choose Exam First");
    return;
  }
  
  $('#loaderdiv').show();
  $.ajax({
    type: "POST",
    url: "ajax_pages/getpaperlist.php",
    data: { eid: eid },
    success: function (msg) {
      document.getElementById('sectionData').innerHTML = msg.data;
      $('#mainTable').DataTable();
      $('#loaderdiv').hide();
      
    }
  });
}

function editpaper(pid) {
  // $.ajax({
  //   type: "POST",
  //   url: "getpaperlist.php",
  //   data: { eid: eid },
  //   success: function (msg) {
  //     $("#sectionData").empty();
  //     $("#sectionData").append(msg);
  //     $('#loaderdiv').hide();
  //   }
  // });
}

function deletepaper(pid) {
  
  $.ajax({
    type: "POST",
    url: "ajax_pages/deletepaper.php",
    data: { pid: pid },
    success: function (msg) {
      swal ( "Done" ,  "Successfully Deleted!" ,  "success" );
      getpaperlist(document.getElementById('exid').value);
    }
  });
}


  </script>
<?php include "footer.php"; ?>