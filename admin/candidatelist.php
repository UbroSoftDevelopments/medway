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
        <div class="row"  style="margin-top: -45px;">
            <div class="col-12">
                <div class="card card-danger">
                  <div class="card-body">
                   <div class="form-group row">
                    <!-- <label for="chooseexam" class="col-sm-1 col-form-label">Filter</label> -->
                    <div class="col-sm-3">
                      <select class="custom-select" name="chooseexam" id="exid" onchange="getdashboardppr(document.getElementById('exid').value)">
                        <option selected>Choose Exam</option>
                        <?php $examdetail = $fetchrecordobj->examdropdown(); ?>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <select class="custom-select" name="chooseppr" id="chooseppr" onchange="getcenterdta(document.getElementById('chooseppr').value)">
                        <option selected>Choose Paper</option>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <select class="custom-select" name="choosepprtime" id="choosepprtime" onchange="getpapershiftss(document.getElementById('choosepprtime').value)">
                        <option selected>Choose Shift</option>
                      </select>
                    </div>
                    <!-- <div class="col-sm-2">
                      <select class="custom-select" name="choosecity" id="choosecity" onchange="getcity(document.getElementById('choosecity').value)">
                        <option selected>Choose City</option>
                        <?php // echo $centercity=$fetchrecordobj->centercity();?>
                      </select>
                    </div> -->
                    <div class="col-sm-3">
                      <select class="custom-select" name="choosecenter" id="choosecenter" onchange="viewcandidatelist(document.getElementById('choosecenter').value)">
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
              <div class="col-12" style="color:white;display:none;" id="loaderdiv">
                      <img src="assets/img/sloader.gif" class="pull-right"  style="width:100%;height:460px;"/>
              </div>
            <div class="col-12 scroll" id="candidiv" style="display:none;">
                    <div class='card card-primary'>
                        <div class='card-body'>
                            <div class="table-responsive">
                                <table class='table table-bordered table-striped' id="myTable">
                                    <thead style="background-color: black;color:white">
                                        <tr>                
                                        <th class="text-white">#</th>
                                        <th class="text-white">Name</th>
                                        <th class="text-white">Enrollment No.</th>
                                        <th class="text-white">Dob</th>
                                        <th class="text-white">Gender</th>
                                        <th class="text-white">Photo</th>
                                        <th class="text-white">Signature</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody id="candilist">
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
function getpapershiftss(pid) {
  $.ajax({
    type: "POST",
    url: "ajax_pages/getcenterdt.php",
    data: { pid: pid },
    success: function (msg) {
      $("#choosecenter").empty();
      $("#choosecenter").append(msg);
     // getdashboardcenter(pid);
    }
  });
}

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


function viewcandidatelist(ccode) {
     $('#loaderdiv').css("display","block");
     //$("#candilist").empty();
        var psid = document.getElementById('choosepprtime').value;
  //alert(psid);
  $.ajax({
    type: "POST",
    url: "ajax_pages/viewcandidatelist.php",
    data: {ccode:ccode,psid:psid},
    success: function (msg) {
      //alert(msg);
      //console.log(msg);
       ////console.log(JSON.parse(msg));
      setCandidateJsonLists(msg);
  //    $("#candilist").append(msg);
  //    $('#loaderdiv').css("display","none");
  // $("#candidiv").show();
    }
  });
}

function setCandidateJsonLists(candidata) {
    $("#candilist").empty();
   
 // alert(candidata);
  candidata.map((val, ind) => {
    const candirow = `<tr>
    <td>${ind+1}</td>
                <td>${val.cname}</td>
                <td>${val.enrollmentno}</td>
                <td>${val.dob}</td>
                <td>${val.gender}</td>
                <td><img alt="photo" id='photo${val.enrollmentno}' src='${val.photo}' style='width:80px;height:80px;padding:5px;'/></td>
                <td><img alt="photo" id='photo${val.enrollmentno}' src='${val.sig}' style='width:80px;height:80px;padding:5px;'/></td>
            </tr>
            `;
    var trok = document.createElement('tr');
    trok.innerHTML = candirow;
    $("#candilist").append(trok);
   
  })
  $('#myTable').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                  'copy',  'print',
                  {
                    extend: 'csv',
                    title: 'Candidate Data'
                  },
                  {
                    extend: 'excel',
                    title: 'Candidate Data'
                  }    
                ]
            } );

  $('#loaderdiv').css("display","none");
  $("#candidiv").show();

}
</script>
<?php  include 'footer.php';      ?>