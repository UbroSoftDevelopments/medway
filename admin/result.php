<?php
session_start();
ob_start();
$userid = $_SESSION['id'];
if (isset($userid) && $userid != "") {
  require_once('include/function/spl_autoload_register.php');
  $userObj = new user;
  $fetchrecordobj = new fetchrecord;
} else {
  echo "ABC" . $userid;
  // header('Location: index.php'); //redirect URL
}
?>
<?php include "head.php"; ?>


<?php include "header.php"; ?>
<?php include "left-menu.php"; ?>

<!-- Main Content -->
<div class="main-content">
      <div class="modal bd-example-modal-sm" id="loadercss" tabindex="-1" role="dialog"
          aria-labelledby="" aria-hidden="true" style="display:none;opacity:1;background-color:#f3efefd1;">
          <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
            <div class="modal-content" style="width: 100%;">
              <div class="modal-body">
                <center><img src="assets/img/sloader.gif" class="img-fluid" /></center>
              </div>              
            </div>
          </div>
        </div>
  <div class="modal bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display:none;">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Candidate Results</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closemodal()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body scrollresult" style="color:black;">
          <div id="resultmodal"></div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <!-- <button type="button" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        </div>
      </div>
    </div>
  </div>
  <section class="section">
    <div class="section-body">
      <div class="row" style="margin-top: -45px;">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Process Result</h4>
            </div>

            <div class="card-body">
              <div class="form-group row">
                <label for="sectionname" class="col-sm-2 col-form-label">Choose Exam</label>
                <div class="col-sm-4">
                  <select class="custom-select" name="chooseexam" id="exid" onchange="getpaper(document.getElementById('exid').value)">
                    <option selected>Choose Exam</option>
                    <?php $examdetail = $fetchrecordobj->examdropdown(); ?>
                  </select>
                </div>

                <label for="sectionname" class="col-sm-2 col-form-label">Choose Paper</label>
                <div class="col-sm-4">
                  <select class="custom-select" name="chooseppr" id="chooseppr" onchange="getlistbypaperidresult(document.getElementById('chooseppr').value)">
                    <option selected value="">Choose Paper</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-12" id="listforresult">

                </div>
              </div>
              <div class="row">
                <div class="col-12 pb-3" id="jsondatadiv">

                </div>
              </div>
              <div class="row" id="btnprocessdiv" style="display: none;">
                <div class="col-md-4">
                  <label class="">Click On Process button to process the result.</label>
                </div>
                <div class="col-md-4">
                  <div class="btn bg-success text-white w-75" onclick="processresult(document.getElementById('chooseppr').value)">
                    <label class="">Process</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div id="fetchresultbtn" style="display: none;" class="btn bg-primary text-white" onclick="fetchresult()">
                    <label class="">Fetch Result</label>
                  </div>
                </div>
              </div>



              <center>
                <div id="loader" style="display:none"><img src="assets/img/spinner.svg" /></div>
              </center>
              <div id="candilist" style="display:none;" class="scroll">
                <table class="table table-bordered table-striped" id="resultexcel">
                  <thead style="background-color: black;color:white">
                    <tr>
                      <th scope="col" class="text-white">Sr.</th>
                      <th scope="col" class="text-white">Enrollment No.</th>
                      <th scope="col" class="text-white">Name</th>
                      <th scope="col" class="text-white">Dob</th>
                      <th scope="col" class="text-white">Gender</th>
                      <th scope="col" class="text-white">Category</th>
                      <th scope="col" class="text-white">Marks</th>
                      <th scope="col" class="text-white">Percentage</th>
                      <th scope="col" class="text-white">Rank</th>
                      <th scope="col" class="text-white">Status</th>

                    </tr>
                  </thead>
                  <tbody id="tablelist">

                  </tbody>
                </table>
              </div>
            </div>
            <!-- </form> -->

          </div>
        </div>
      </div>
    </div>
  </section> 
</div>

<script>
  function getlistbypaperidresult(pid) {
    if (!pid) {
      alert("Some Field Not Choosen");
      return;
    }

    const myArray = pid.split(",");
    $('#btnprocessdiv').css('display', 'none');
    const psid = myArray[0];
    if (myArray[3] == "PROCESSED") {
      $('#fetchresultbtn').css('display', 'block');
    }

    $.ajax({
      type: "POST",
      url: "ajax_pages/getlistbypaperidresult.php",
      data: {
        psid: psid
      },
      success: function(msg) {
        $("#listforresult").empty();
        $("#listforresult").append(msg);
        $('#btnprocessdiv').css('display', 'flex');

      }
    });
  }



  function html_table_to_excel(type) {
    var data = document.getElementById('resultexcel');
    var file = XLSX.utils.table_to_book(data, {
      sheet: "sheet1"
    });
    XLSX.write(file, {
      bookType: type,
      bookSST: true,
      type: 'base64'
    });
    XLSX.writeFile(file, 'result.' + type);
  }
</script>
<?php include "footer.php"; ?>