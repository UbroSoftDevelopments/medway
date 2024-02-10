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
<div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Add Shift</h4>
                  </div>
                <form action="" method="post">
                  <?php $userObj->centershift()?>
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="duration" class="col-sm-3 col-form-label">Choose Center</label>
                      <div class="col-sm-6">
                      <select class="custom-select" name="choosecenter">
                        <option selected>Choose Center</option>
                        <?php $examdetail = $fetchrecordobj->centerdropdown(); ?>
                      </select>
                     </div>
                    </div>
                    <div class="form-group row">
                      <label for="stime" class="col-sm-3 col-form-label">Start Time</label>
                      <div class="col-sm-6">
                        <input type="time" class="form-control" id="stime" placeholder="Start Timing" name="stime" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="duration" class="col-sm-3 col-form-label">Duration (in Minute)</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="duration" placeholder="Duration in Minute" name="duration" required>
                      </div>
                    </div>
                    <!-- <div class="form-group row">
                      <label for="etime" class="col-sm-3 col-form-label">End Time</label>
                      <div class="col-sm-6">
                        <input type="time" class="form-control" id="etime" placeholder="End Timing" name="etime" required>
                      </div>
                    </div> -->
                    <div class="form-group row">
                      <label for="password" class="col-sm-3 col-form-label">Shift Password</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="password" placeholder="Shift Password" name="password" required>
                      </div>  
                    </div>
                    <!-- <div class="form-group row">
                      <label for="papername" class="col-sm-3 col-form-label">Paper Name</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="papaername" placeholder="Paper Name" name="papername" required>
                      </div>  
                    </div> -->
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
        </div>
</div>
<?php include "footer.php"; ?>