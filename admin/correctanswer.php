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
<style type="text/css">
  .opclass {
    padding: 0.10em;
    border-radius: 10%;
    border: solid;
    width: 110px;
    float: right;
    height: 80px;
  }

  .qclass {
    padding: 0.10em;
    width: 100%;
    height: auto;
  }

  .ophover:hover {
    border: solid;
  }
</style>
<!-- Main Content -->
<div class="main-content" style="margin-top: -35px;">
  <?php include('admin_status.php'); ?>
  <!-- Vertically Center -->
  <div class="modal bd-example-modal-sm" id="loadercss" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="display:none;opacity:1;background-color:#f3efefd1;">
    <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
      <div class="modal-content" style="width: 100%;">
        <div class="modal-body">
          <center><img src="assets/img/sloader.gif" class="img-fluid" /></center>
        </div>
      </div>
    </div>
  </div>

  <div class="modal bd-example-modal-sm" id="confirmmodel" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="display:none;opacity:1;background-color:#f3efefd1;">
    <div class="modal-dialog modal-dialog-centered  modal-sm" role="document">
      <div class="modal-content" style="border: solid;padding: 10px;width: 100%;">
        <div class="modal-header">
          <h5 class="modal-title" id="">Confirm Correct Option</h5>
        </div>
        <div class="modal-body">
          <button type="button" class="btn btn-primary" onclick="confirmcorrectoption()">Confirm</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closemodalcop()">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <section class="">
    <div class="">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="col-6">
                <h4>Choose Correct Option</h4>
              </div>
              <div class="col-6">
                <span style="font-size: 1rem;color:black"><b>Correct Count: </b></span>
                <span id="ttlcorrectoption" style="font-size: 1rem;color:black;font-weight:bold"></span>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group row">
                <!-- <div class="col-sm-3">
                  <select class="custom-select" name="chooseexam" id="exid" onchange="getpaper(document.getElementById('exid').value)">
                    <option selected>Choose Exam</option>
                    <?php //$examdetail = $fetchrecordobj->examdropdown(); ?>
                  </select>
                </div> -->
                <div class="col-sm-3">
                  <select class="custom-select" name="chooseppr" id="chooseppr" onchange="shiftlistbypidprogress(document.getElementById('chooseppr').value)">
                    <option selected>Choose Paper</option>
                    <?php $examdetail = $fetchrecordobj->pprdropdown();?>
                  </select>
                  <input type="hidden" id="exid" name="exid" value="<?php echo $_GET['ubexid']?>"/>
                </div>
                <div class="col-sm-3">
                  <select class="custom-select" name="chooselang" id="chlang">
                    <option selected value="">Choose Language</option>
                  </select>
                </div>
                <div class="col-sm-3">
                  <select class="custom-select" name="chooseshift" id="chshift">
                    <option selected value="">Choose Shift</option>
                  </select>
                </div>
                <div class="col-sm-3">
                  <button class="btn btn-primary" onclick="getqpack(document.getElementById('chshift').value)">Submit</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 scroll" id="qpackkdiv" style="display:none;text-align:left;">
          <div class='card'>
            <div class='card-body'>
              <div id="viewquestion"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
  function getqpack(psid) {
    let langid = $('#chlang').val();
    if (!psid || !langid) {
      alert("Some fields are not choosen");
    } else {
      $('#loadercss').css('display', 'block');
      $.ajax({
        type: "POST",
        data: {
          psid: psid,
          langid: langid
        },
        url: "ajax_pages/fetch_qpackforcorrect.php",
        success: function(data) {
          //console.log(data)
          $('#qpackkdiv').css('display', 'block');
          $('#viewquestion').empty();
          $('#viewquestion').append(data);
          $('#loadercss').css('display', 'none');
        }
      });
    }
          
    correctoptioncount();
  }

  var copid = "";

  function opid(a, b) {
    document.getElementById('confirmmodel').style.display = "block";
    copid = a + "," + b;
  }

  function confirmcorrectoption() {
    //alert(copid);
   
    const myArray = copid.split(",");
    const opid = myArray[0];
    const qid = myArray[1];
    $.ajax({
      url: "ajax_pages/correctoption.php",
      method: "POST",
      data: {
        a: opid,
        b: qid,
        psid:psid,
        exid:exid
      },
      success: function(data) {
        data = JSON.parse(data)
        console.log(data);
        if (!data.status) {
          swal("Not Allowed", data.message, "warning", {
            button: "Done",
          });
        } else {
          copid = "";
          document.getElementById('correctoption' + opid).checked = true;
          document.getElementById('confirmmodel').style.display = "none";
          correctoptioncount();
          swal("Congratulation", data.message, "success", {
            button: "Done",
          });
        }
      }
    });
  }

  function correctoptioncount(){
    var psid = document.getElementById('chshift').value;
    const exid = document.getElementById('exid').value;
    if (!psid) {
      alert("Choose Paper and Shift");
      return;
    }
    $.ajax({
      url: "ajax_pages/correctoptioncount.php",
      method: "POST",
      data: {
        exid: exid,
        psid: psid
      },
      success: function(data) {
          document.getElementById('ttlcorrectoption').textContent = data;
          
      }
    });
  }

  function closemodalcop() {
    document.getElementById('confirmmodel').style.display = "none";
  }

  function closemodalqpack() {
    document.getElementById('viewuploadqpack').style.display = "none";
  }
</script>
<?php include "footer.php"; ?>