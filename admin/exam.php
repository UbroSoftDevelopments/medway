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
<?php //include('admin_status.php');?>
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-7 col-lg-7">
                <div class="card">
                  <div class="card-header">
                    <h4>Create Exam</h4>
                  </div>
                <form action="" method="post" enctype="multipart/form-data">
                  <?php $userObj->createexam()?>
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="examname" class="col-sm-3 col-form-label">Exam Name</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="examname" placeholder="Name" name="examname" required>
                        <input type="hidden" value="<?php echo $userid ;?>" class="form-control" name="userid">
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
                         <img src="" name="examimage" id="examimage" alt = "img"/>
                       </div>
                       </div>
                       <label class="col-sm-4"><div id="successmsg" style="display: none;"></div></label>
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
              <div class="col-12 col-md-5 col-lg-5">
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
                          <th scope="col">Action</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php  $examdetail = $fetchrecordobj->getexam(); ?>
                      </tbody>
                    </table>
                  </div>
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
  const chooseFile = document.getElementById("examlogo");
const imgPreview = document.getElementById("img-preview");
chooseFile.addEventListener("change", function () {
  getImgData();
});

function getImgData() {
  const files = chooseFile.files[0];
  if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      imgPreview.style.display = "block";
      document.getElementById('examimage').src = this.result ;
      document.getElementById('exlogo').value= this.result;

    });    
  }
}

function editexam(eid){
  $.ajax({
    type: "POST",
    url: "ajax_pages/getexam.php",
    data: {eid: eid },
    success: function (msg) {
      $('#successmsg').empty();
      $('#successmsg').append(msg);      
      document.getElementById('state').value = eid;
      document.getElementById('examname').value =  document.getElementById('nm').textContent;
      document.getElementById('exlogo').value =  document.getElementById('logo').textContent;
      document.getElementById('examimage').src =  document.getElementById('logo').textContent;
      imgPreview.style.display = "block";      
    }
  });
}
function deleteexam(eid){
  $.ajax({
    type: "POST",
    url: "ajax_pages/deleteexam.php",
    data: {eid:eid},
    success: function (msg) {
      alert(msg);
      window.location.href = "exam.php";
    }
  });
}

  </script>
<?php include "footer.php"; ?>