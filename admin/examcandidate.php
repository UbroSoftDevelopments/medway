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
<?php include "left-menu.php";

 ?>

<!-- Main Content -->
<div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Exam Candidate</h4>
                  </div>
                
                  <div class="card-body">
                    <form action="uploadcandiexcel.php" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                      
                      <label class="col-sm-3 col-form-label">Choose File</label>
                      <div class="col-sm-4 custom-file">
                        <div class="custom-file">
                           <input type="file" class="custom-file-input" id="exlfile" name="exlfile" required>
                           <label class="custom-file-label" for="exlfile">Choose file</label>
                        </div>
                      </div>
                       <button type="submit" name="save" class="col-sm-1 btn btn-primary">Submit</button>
                      
                      <label class="col-sm-2"></label>
                      <a class="btn btn-info" href="candidateexcel.php" class="col-sm-2">Download Format</a>
                    </div>
                    </form>
                    <table style="width:100%;border:solid;" border=1>
                      <thead>
                        <tr>
                          <td>S.No</td>
                          <td>CandidateId</td>
                          <td>ShiftId</td>
                          <td>Enrollmentno</td>
                          <td>Password</td>
                          <td>Alloted Time</td>
                        </tr>
                      </thead>
                      <tbody><?php $fetchrecordobj->examcandidate(); ?></tbody>
                    </table>              
                  </div>
                <!-- </form> -->
                
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
      <script>
      $(function() {
        $(".exportToExcel").click(function(e){
          var table = $(this).prev('.table2excel');
          if(table && table.length){
            var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
            $(table).table2excel({
              exclude: ".noExl",
              name: "Excel Document Name",
              filename: "myFileName" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
              fileext: ".xls",
              exclude_img: true,
              exclude_links: true,
              exclude_inputs: true,
              preserveColors: preserveColors
            });
          }
        });
        
      });
    </script>
<?php include "footer.php"; ?>