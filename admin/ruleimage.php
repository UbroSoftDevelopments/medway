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

<!-- Main Content -->
<style>
  #img-preview {
    display: none;
    width: 100%;
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
  <?php include('admin_status.php'); ?>
  <div class="modal bd-example-modal-sm" id="uploadloadercss" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="display:none;opacity:1;background-color:#f3efefd1;">
    <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
      <div class="modal-content" style="width: 100%;">
        <div class="modal-body">
          <center><img src="assets/img/newloader.gif" class="img-fluid" /></center>
        </div>
      </div>
    </div>
  </div>
  <section class="">
    <div class="">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Add Rule</h4>
            </div>
            <div class="card-body">
              <div class="form-group row">
                <!-- <div class="col-sm-3">
                  <select class="custom-select" required="true" name="chooseexam" id="exid" onchange="getpaper(document.getElementById('exid').value)">
                    <option selected>Choose Exam</option>
                    <?php //$examdetail = $fetchrecordobj->examdropdown(); ?>
                  </select>
                </div> -->
                <div class="col-sm-3">
                  <select class="custom-select" required="true" name="chooseppr" id="chooseppr" onchange="getruleimage(document.getElementById('chooseppr').value)">
                    <option selected value="">Choose Paper</option>
                    <?php $examdetail = $fetchrecordobj->pprdropdown(); ?>
                  </select>

                </div>
                <div class="col-sm-3">
                  <input type="file" class="form-control" id="rulelogo" name="image" accept=".jpg, .png">
                  <!-- <label class="" for="examlogo">Choose file</label> -->
                  <input type="hidden" class="form-control" id="imgrule" name="imgrule">
                </div>
                <div class="col-sm-3">
                  <button class="btn btn-primary" onclick="updateruleimage(document.getElementById('chooseppr').value)">Submit</button>
                </div>
              </div>
              <div class="form-group row" id="imgdiv" style="display: none;">
                <div class="col-sm-12">
                  <div id="img-preview" name="imageprev">
                    <img src="" name="ruleimage" id="ruleimage" alt="img" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</section>
</div>
<script>
  const chooseFile = document.getElementById("rulelogo");
  const imgPreview = document.getElementById("img-preview");
  const imgdiv = document.getElementById("imgdiv");
  chooseFile.addEventListener("change", function() {
    getImgData();
  });

  function getImgData() {
    const files = chooseFile.files[0];
    if (files) {
      const fileReader = new FileReader();
      fileReader.readAsDataURL(files);
      fileReader.addEventListener("load", function() {
        imgPreview.style.display = "block";
        imgdiv.style.display = "block";
        document.getElementById('ruleimage').src = this.result;
        document.getElementById('imgrule').value = this.result;

      });
    }
  }

  function getruleimage(id) {
    if (!id) {
      imgdiv.style.display = "none";
      alert("Choose Paper");
      return;
    }

    const myArray = id.split(",");
    const pid = myArray[0];
    $('#uploadloadercss').css('display', 'block');
    $.ajax({
      type: "POST",
      data: {
        pid: pid
      },
      url: "ajax_pages/getruleimage.php",
      success: function(data) {
        //console.log(data);
        imgPreview.style.display = "block";
        imgdiv.style.display = "block";
        document.getElementById('ruleimage').src = data;
        document.getElementById('imgrule').value = data;
        $('#uploadloadercss').css('display', 'none');

      }
    });
  }

  function updateruleimage(id) {
    if (!id) {
      alert("Choose Exam and Paper First");
      return;
    }
    const myArray = id.split(",");
    const pid = myArray[0];
    const exid = <?php echo $_GET['ubexid']?>;
    $('#uploadloadercss').css('display', 'block');
    var imgrule = document.getElementById('imgrule').value;
    //console.log(imgrule);
    $.ajax({
      type: "POST",
      data: {
        exid: exid,
        pid: pid,
        imgrule: imgrule
      },
      url: "ajax_pages/updateruleimage.php",
      success: function(data) {
        $('#uploadloadercss').css('display', 'none');
        swal("Congratulation", "Registered Successfully", "success", {
            button: "Done",
          }).then(function(isConfirm) {
            if (isConfirm) {
              window.location.href = "ruleimage.php?ubexid=" + exid;
            }
          });
      }
    });
  }
</script>
<?php include "footer.php"; ?>