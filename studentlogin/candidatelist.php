<?php   
   session_start();
    ob_start();
    $userid = $_SESSION['id']; 
    if(isset($userid) && $userid != "")
    {
        require_once('include/function/spl_autoload_register.php');
         // $userObj = new user;
         $fetchrecordobj = new fetchrecord;
        // $examcnt = $fetchrecordobj->examcount();
         //$centercnt = $fetchrecordobj->centercount();
         //$pprcnt = $fetchrecordobj->papercount();
         //$shiftcnt = $fetchrecordobj->shiftcount();
         //$candidatecnt = $fetchrecordobj->candidatecount();

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
        <div class="row">
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
                      <select class="custom-select" name="chooseppr" id="chooseppr" onchange="getlang(document.getElementById('chooseppr').value)">
                        <option selected value="">Choose Paper</option>
                      </select>
                    </div>                    
                    <div class="col-sm-3">
                      <select class="custom-select" name="chooselang" id="chooselang">
                        <option selected value="">Choose Language</option>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <select class="custom-select" name="chooseshift" id="chooseshift" onchange="viewcandidatelist(document.getElementById('chooseshift').value)">
                        <option selected value="">Choose Shift</option>
                      </select>
                    </div>
                    <!-- <div class="col-sm-2">
                      <button class="btn btn-primary" >Submit</button>
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
                                        <th class="text-white">Email Id</th>
                                        <th class="text-white">Mobile No.</th>
                                        <th class="text-white">University Name</th>
                                        <th class="text-white">Dob</th>
                                        <th class="text-white">Gender</th>
                                        <th class="text-white">Photo</th>
                                        <th class="text-white">Action</th>
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

function getlang(pid){
  
  $.ajax({
    type: "POST",
    url: "ajax_pages/getlang.php",
    data: { pid: pid },
    success: function (msg) {
      $("#chooselang").empty();
      $("#chooselang").append(msg);
      getshift(pid);
    }
  });
}

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

function getshift(pid) {
  $.ajax({
    type: "POST",
    url: "ajax_pages/getshift.php",
    data: { pid: pid },
    success: function (msg) {
      $("#chooseshift").empty();
      $("#chooseshift").append(msg);
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


function viewcandidatelist(psid) {
     
     //$("#candilist").empty();
       // var langid = document.getElementById('chooselang').value;
        //var shiftid = document.getElementById('chooseshift').value;
        
        if(!psid){
          alert("Some Field is not choosen");
          return
        }else{
          $('#loaderdiv').css("display","block");
  $.ajax({
    type: "POST",
    url: "ajax_pages/viewcandidatelist.php",
    data: {psid:psid},
    success: function (msg) {
      //alert(msg);
   //   console.log(msg);
      // console.log(JSON.parse(msg));
      setCandidateJsonLists(msg);
    }
  });
}
}


function setCandidateJsonLists(candidata) {
    $("#candilist").empty();
      var langid = document.getElementById('chooselang').value;
      var pid = document.getElementById('chooseppr').value;
      var psid = document.getElementById('chooseshift').value;
   
  candidata.map((val, ind) => {
    const candirow = `<tr>
    <td>${ind+1}</td>
                <td>${val.name}</td>
                <td>${val.reg_no}</td>
                <td>${val.email}</td>
                <td>${val.mobile}</td>
                <td>${val.academicname}</td>
                <td>${val.dob}</td>
                <td>${val.gender}</td>
                <td><img alt="photo" id='photo${val.reg_no}' src='${val.photo}' style='width:80px;height:80px;padding:5px;'/></td>
                <td><a target="_blank" href="answerkey.php?setno=${val.setno}&&regno=${val.reg_no}&&langid=`+langid+`&&pid=`+pid+`&&psid=`+psid+`"><button class="btn btn-primary">Answer Key</button/></a>
               
                
            </tr>
            `;
           
    var trok = document.createElement('tr');
    trok.innerHTML = candirow;

    $("#candilist").append(trok);
   
  })
  
  $('#myTable').DataTable({pagingType: 'full_numbers'} );
    
  
            //   $('#myTable').DataTable( {
            //     dom: 'Bfrtip',
            //     buttons: [
            //       'copy',  'print',
            //       {
            //         extend: 'csv',
            //         title: 'Candidtae Data'
            //       },
            //       {
            //         extend: 'excel',
            //         title: 'Camdidate Data'
            //       }    
            //     ]
            // } );
  $('#loaderdiv').css("display","none");
  $("#candidiv").show();

}

</script>
<?php  include 'footer.php';      ?>