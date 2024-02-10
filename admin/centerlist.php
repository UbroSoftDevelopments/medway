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
<?php  include 'head.php';          ?>
<?php  include 'header.php';          ?>
<?php  include 'left-menu.php';          ?>




<div class="main-content">
    <section class="section">
      <div class="section-body">
        <div class="row" style="margin-top: -45px;">
            <div class="col-12">
                <div class="card card-danger">
                  <div class="card-body">
                   <div class="form-group row">
                    <!-- <label for="chooseexam" class="col-sm-1 col-form-label">Filter</label> -->
                    <div class="col-sm-4">
                      <select class="custom-select" name="chooseexam" id="exid" onchange="getdashboardppr(document.getElementById('exid').value)">
                        <option selected>Choose Exam</option>
                        <?php $examdetail = $fetchrecordobj->examdropdown(); ?>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <select class="custom-select" name="chooseppr" id="chooseppr" onchange="viewcenterlist(document.getElementById('chooseppr').value)">
                        <option selected>Choose Paper</option>
                      </select>
                    </div>
                    <!-- <div class="col-sm-4">
                      <select class="custom-select" name="choosepprtime" id="choosepprtime" onchange="viewcenterlist(document.getElementById('choosepprtime').value)">
                        <option selected>Choose Shift</option>
                      </select>
                    </div> -->
                    <!-- <div class="col-sm-2">
                      <select class="custom-select" name="choosecity" id="choosecity" onchange="getcity(document.getElementById('choosecity').value)">
                        <option selected>Choose City</option>
                        <?php // echo $centercity=$fetchrecordobj->centercity();?>
                      </select>
                    </div> -->
                    <!-- <div class="col-sm-3">
                      <select class="custom-select" name="choosecenter" id="choosecenter" onchange="viewcandidatelist(document.getElementById('choosecenter').value)">
                        <option selected>Choose Center</option>
                      </select>
                    </div> -->
                    <!-- <div class="col-sm-2">
                      <button class="btn btn-primary" onclick="getdatabyshift(document.getElementById('shiftdrop').value)">Submit</button>
                    </div> -->
                   </div>
                  </div>
                </div>
              </div>
              <div class="col-12" style="color:white;display:none;" id="loaderdiv">
                      <img src="assets/img/sloader.gif" class="pull-right"  style="width:100%;height:460px;"/>
                </div>
            <div class="col-12 scroll" id="centerdiv" style="display:none;">
                    <div class='card card-primary'>
                        <div class='card-body'>
                            <div class="table-responsive">
                                <table class='table table-bordered table-striped'>
                                    <thead style="background-color: black;">
                                    <tr>
                                      <th class="text-white">#</th>
                                      <th class="text-white">Name</th>
                                      <th class="text-white">Address</th>
                                      <th class="text-white">User Id</th>
                                      <th class="text-white">Password</th>
                                      <th class="text-white">Pincode</th>
                                      <th class="text-white">City</th>
                                      <th class="text-white">Capacity</th>
                                    </tr>
                                    </thead>
                                    <tbody id="centerlist">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
                
        </div> 
      </div>
    </section>   
</div>
<script>

function getcenterdta(pid) {
  const myArray = pid.split(",");
  const psid = myArray[0];
  $.ajax({
    type: "POST",
    url: "ajax_pages/getshiftdt.php",
    data: { psid: psid },
    success: function (msg) {
      $("#choosepprtime").empty();
      $("#choosepprtime").append(msg);
      //getdashboardshift(psid);
    }
  });
}

function getdashboardppr(eid) {
  $.ajax({
    type: "POST",
    url: "ajax_pages/getpaper.php",
    data: { eid: eid },
    success: function (msg) {
      //alert(msg);
      $("#chooseppr").empty();
      $("#chooseppr").append(msg);
     // getcnt(eid);
    }
  });
}

function viewcenterlist(dt) {
 // alert(psid)   
 const myArray = dt.split(",");
  const psid = myArray[0];
  $('#loaderdiv').css("display","block");
     
  $.ajax({
    type: "POST",
    url: "ajax_pages/viewcenterlist.php",
    data: {psid:psid},
    success: function (msg) {
      //alert(msg);
      //console.log(msg);
       ////console.log(JSON.parse(msg));
       setCenterJsonLists(msg);
    }
  });
}

function setCenterJsonLists(candidata) {
    $("#centerlist").empty();
   
 // alert(candidata);
  candidata.map((val, ind) => {
    const candirow = `<tr>
    <td>${ind+1}</td>
                <td>${val.name}</td>
                <td>${val.address}</td>
                <td>${val.userid}</td>
                <td>${val.password}</td>
                <td>${val.pincode}</td>
                <td>${val.city}</td>
                <td>${val.capacity}</td>
            </tr>
            `;
    var trok = document.createElement('tr');
    trok.innerHTML = candirow;
    $("#centerlist").append(trok);
  })
  $('#loaderdiv').css("display","none");
  $("#centerdiv").show();

}
</script>
<?php  include 'footer.php';      ?>