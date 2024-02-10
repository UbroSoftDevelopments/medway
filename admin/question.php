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
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.js"></script>
<link rel="stylesheet" href="assets/css/exceltoimg.css">
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

  .txtarea {
    max-width: 100%;
    min-height: 200px;
    display: block;
    width: 100%;
  }

  .mydiv {
    padding: 10px;
    display: none;
  }

  .gen_btn {
    padding: 5px;
    background-color: #743ED9;
    color: white;
    font-family: arial;
    font-size: 13px;
    border: 2px solid black;
  }

  .gen_btn:hover {
    background-color: #9a64ff;
  }
</style>
<!-- Main Content -->
<div class="main-content" style="margin-top: -35px;"> 
<?php include('admin_status.php');?>
  <div class="modal bd-example-modal-sm" id="loadercss" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="display:none;opacity:1;background-color:#f3efefd1;">
    <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
      <div class="modal-content" style="width: 100%;">
        <div class="modal-body">
          <center><img src="assets/img/sloader.gif" class="img-fluid" /></center>
        </div>
      </div>
    </div>
  </div>
  <div class="modal bd-example-modal-sm" id="uploadloadercss" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="display:none;opacity:1;background-color:#f3efefd1;">
    <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
      <div class="modal-content" style="width: 100%;">
        <div class="modal-body">
          <center><img src="assets/img/newloader.gif" class="img-fluid" /></center>
        </div>
      </div>
    </div>
  </div>
  <!-- Vertically Center -->
  <div class="modal bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="display:none;opacity:1;background-color:#f3efefd1;">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="" style="border: solid;padding: 10px;width: 100%;">Choose Correct Option</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closemodal()">
            <span aria-hidden="true" style="color: red;opacity: 1;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="msgdata"></div>
          <div id="images_list" class="" style="border: solid;padding: 11px;height:500px; overflow-x: hidden;overflow-y: auto;">
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <!-- <button type="button" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        </div>
      </div>
    </div>
  </div>
  <div class="modal bd-example-modal-sm" id="confirmmodel" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="display:none;opacity:1;background-color:#f3efefd1;">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="" style="border: solid;padding: 10px;width: 100%;">Confirm Correct Option</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closemodal()">
            <span aria-hidden="true" style="color: red;opacity: 1;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <button type="button" class="btn btn-primary" onclick="confirmcorrectoption()">Confirm</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closemodalcop()">Cancel</button>
        </div>
        <div class="modal-footer bg-whitesmoke br">
        </div>
      </div>
    </div>
  </div>
  <div class="modal bd-example-modal-xl" id="viewuploadqpack" tabindex="-1" role="dialog" aria-labelledby="viewuploadqpackTitle" aria-hidden="true" style="display:none;opacity:1;background-color:#f3efefd1;">
    <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewuploadqpackTitle" style="border: solid;padding: 10px;width: 100%;">Uploaded Question</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closemodalqpack()">
            <span aria-hidden="true" style="color: red;opacity: 1;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="qpack_list" class="scrollqpack">
          </div>
        </div>
      </div>
    </div>
  </div>


  <section class="section">
    <div class="section-body">
      <div class="row" >
        <div class="col-12 col-md-9">
          <div class="card">
            <div class="card-header">
              <h4>Create Question</h4>
              <div class='mydiv'>
                <textarea id="txt" class='txtarea'></textarea>
                <button class='gen_btn'>Generate File</button>
              </div>
            </div>

            <?php //$userObj->createquestion()
            ?>
            <div class="card-body">
              <form enctype="multipart/form-data">

                <div class="form-group row">
                  <!-- <div class="col-sm-4">
                    <select class="custom-select" name="chooseexam" id="exid" onchange="getpaper(document.getElementById('exid').value)">
                      <option selected>Choose Exam</option>
                      <?php //$examdetail = $fetchrecordobj->examdropdown(); ?>
                    </select>
                  </div> -->
                  <div class="col-sm-4">
                    <select class="custom-select" name="chooseppr" id="chooseppr" onchange="shiftlistbypidprogress(document.getElementById('chooseppr').value)">
                      <option selected>Choose Paper</option>
                      <?php $examdetail = $fetchrecordobj->pprdropdown(); ?>
                    </select>
                    <input type="hidden" id="pid" name="pid"  />
                    <input type="hidden" id="exid" name="exid" value="<?php echo $_GET['ubexid']?>"/>
                  </div>
                  <div class="col-sm-4">
                    <select class="custom-select" name="chooseshift" id="chshift" onchange="getquestioncount(document.getElementById('chshift').value)">
                      <option selected>Choose Shift</option>
                    </select>
                  </div>
                <!-- </div>
                <div class="form-group row"> -->
                  <div class="col-sm-4 mt-1">
                    <select class="custom-select" name="choosesection" id="chsec">
                      <option selected>Choose Section</option>
                    </select>
                  </div>
                  <div class="col-sm-4 mt-1">
                    <select class="custom-select" name="chooselang" id="chlang">
                      <option selected>Choose Language</option>
                    </select>
                  </div>
                  <div class="col-sm-4">
                    <select class="custom-select" id="uploadtype" onchange="uploadmode(document.getElementById('uploadtype').value)">
                      <option value="blank">Choose Upload Type</option>
                      <option value="bulkupload">Bulk Upload</option>
                      <!-- <option value="imageupload">Image Upload</option> -->
                    </select>
                  </div>
                </div>

                <div id="bulkupload" style="display:none;">
                  <div class="form-group row">
                    <button class="col-sm-3 btn btn-warning" onclick="qpackexcel()">Download QPack Format</button>

                    <label class="col-sm-2 col-form-label">Choose QPack File</label>
                    <div class="col-sm-4">
                      <input id="upload" type=file name="files[]" class="form-control" required>
                    </div>
                    <div class="col-sm-2 btn btn-primary" onclick="uploadqpackexcel()">Submit</div>
                  </div>
                </div>
                <!-- <div id="imageupload"  style="display:none;">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Choose Question</label>
                        <div class="col-sm-6 ">
                          <div class="">
                            <input type="file" class="form-control" id="qimage" name="qimage" required>
                            <label class="custom-file-label" for="qimage">Choose file</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Choose Multiple Option</label>
                        <div class="col-sm-6 ">
                          <div class="">
                            <input type="file" class="form-control" name="image[]" id="image" multiple accept=".jpg, .png, .gif" required>
                            <label class="custom-file-label" for="opA">Choose file</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="mm" class="col-sm-3 col-form-label">Maximum Mark</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="mm" placeholder="Maximum Mark" name="mm" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="nm" class="col-sm-3 col-form-label">Negative Mark</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="nm" placeholder="Negative Mark" name="nm" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-5"></label>
                        <button type="submit" name="insert" id="insert" class="col-sm-2 btn btn-primary">Submit</button>
                        <label class="col-sm-3"></label>
                      </div>
                    </div> -->
              </form>
            </div>

            <div class="form-group row m-2">
              <div class="col-sm-12">
                <div class="small">
                  <canvas id="canv"></canvas>
                </div>
                <img id="image" class="img-fluid" />
                <div id="imgContainer" class="img-fluid" style="width: 100%;overflow: scroll;">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-3 ">
          <div class="card">
            <div class="card-header">
              <h4 id="papernm">Paper Name</h4>
            </div>
            <div class="card-body">
              <div id="progressdiv">
              </div>
              <span class=" btn btn-info" id="viewqpack" style="display: none;" onclick="getuploadedqpack()">View Question</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script src="assets/js/exceltoimg.js"></script>
<script type="text/javascript">
  function qpackexcel() {
    document.getElementById('loadercss').style.display = "block";
    const pshiftid = document.getElementById('chshift').value;
    const secid = document.getElementById('chsec').value;
    $.ajax({
      type: "POST",
      data: {
        pshiftid: pshiftid,
        secid: secid
      },
      url: "ajax_pages/qpackexcel.php",
      success: function(data) {
        //console.log(data);
        //
        // alert();            
        $('#txt').val(data);
        //document.getElementById('exampleModalCenter').style.display="block";
        DownloadQPackExcel()
      }
    });
  }

  function DownloadQPackExcel() {
    var data = $('#txt').val();
    if (data == '')
      return;
    JSONToCSVConvertor(data, "QPack", true);
  }

  function JSONToCSVConvertor(JSONData, ReportTitle, ShowLabel) {
    //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
    var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;

    var CSV = '';
    //Set Report title in first row or line

    // CSV += ReportTitle + '\r\n\n';

    //This condition will generate the Label/Header
    if (ShowLabel) {
      var row = "";

      //This loop will extract the label from 1st index of on array
      for (var index in arrData[0]) {

        //Now convert each value to string and comma-seprated
        row += index + ',';
      }

      row = row.slice(0, -1);

      //append Label row with line break
      CSV += row + '\r\n';
    }

    //1st loop is to extract each row
    for (var i = 0; i < arrData.length; i++) {
      var row = "";

      //2nd loop will extract each column and convert it in string comma-seprated
      for (var index in arrData[i]) {
        row += '"' + arrData[i][index] + '",';
      }

      row.slice(0, row.length - 1);

      //add a line break after each row
      CSV += row + '\r\n';
    }

    if (CSV == '') {
      alert("Invalid data");
      return;
    }

    //Generate a file name
    var fileName = "UBROSOFT_";
    //this will remove the blank-spaces from the title and replace it with an underscore
    fileName += ReportTitle.replace(/ /g, "_");

    //Initialize file format you want csv or xls
    var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);

    // Now the little tricky part.
    // you can use either>> window.open(uri);
    // but this will not work in some browsers
    // or you will not get the correct file extension    

    //this trick will generate a temp <a /> tag
    var link = document.createElement("a");
    link.href = uri;

    //set the visibility hidden so it will not effect on your web-layout
    link.style = "visibility:hidden";
    link.download = fileName + ".csv";

    //this part will append the anchor tag and remove it after automatic click
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    document.getElementById('loadercss').style.display = "none";
  }

  function qpackexcelformat(data) {
    var dt = JSON.parse(data);
    //window.location.href = "ajax_pages/qpackexcelformat.php?dt="+dt;
    // $.ajax({
    //         type: "POST",
    //         data:{dt:dt},
    //         url:"ajax_pages/qpackexcelformat.php",
    //         success:function(msg){
    //           //console.log("msg"+msg);
    //           // alert("msg"+msg);
    //           //$('#images_list').html(data);
    //           //document.getElementById('exampleModalCenter').style.display="block";
    //         }
    // });
  }

  function uploadmode(mode) {
    var lang = document.getElementById('chlang').value;
    if (lang == "Choose Language") {
      alert("First Choose Language");
    } else {
      if (mode == "blank") {
        document.getElementById('bulkupload').style.display = "none";
        //document.getElementById('imageupload').style.display = "none";
      }
      if (mode == "bulkupload") {
        //document.getElementById('imageupload').style.display = "none";
        document.getElementById('bulkupload').style.display = "block";
      }
    }
    // if(mode== "imageupload"){
    //   document.getElementById('bulkupload').style.display = "none";
    //   document.getElementById('imageupload').style.display = "block";
    // }
  }

  function getuploadedqpack() {
    var psid = document.getElementById('chshift').value;
    var langid = document.getElementById('chlang').value;
    var secid = document.getElementById('chsec').value;
    if (!langid || !psid || !secid) {
      alert("Something is not Choosen");
    } else {
      $.ajax({
        type: "POST",
        data: {
          psid: psid,
          langid: langid,
          secid: secid
        },
        url: "ajax_pages/fetchuploadqpack.php",
        success: function(data) {
          //alert(data);
          document.getElementById('viewuploadqpack').style.display = "block";
          $('#qpack_list').html(data);
        }
      });
    }
  }

  $(document).ready(function() {

    // load_images(52); 

    function load_images(qid) {
      var psid = document.getElementById('chshift').value;
      getquestioncount(psid);
      $.ajax({
        type: "POST",
        data: {
          qid: qid
        },
        url: "ajax_pages/fetch_images.php",
        success: function(data) {
          alert(data);
          $('#images_list').html(data);
          document.getElementById('exampleModalCenter').style.display = "block";
        }
      });
    }

    $('#upload_multiple_images').on('submit', function(event) {
      event.preventDefault();
      var qimage = $('#qimage').val();
      var image_name = $('#image').val();
      var mm = $('#mm').val();
      var nm = $('#nm').val();
      if (image_name == '' || qimage == '') {
        alert("Please Select Image");
        return false;
      } else {
        $.ajax({
          url: "ajax_pages/insertques.php",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {
            data = JSON.parse(data)
            //console.log("json data"+data);
            if (!data.status) {
              swal("Not Allowed", data.message, "warning", {
                button: "Done",
              });
            } else {
              $('#image').val('');
              $('#qimage').val('');
              //document.getElementById('exampleModalCenter').style.display="block";
              var psid = document.getElementById('chshift').value;
              getquestioncount(psid);
              //load_images(data.data);
              swal("Congratulation", data.message, "success", {
                button: "Done",
              });
            }
          }
        });
      }
    });

  });
  var copid = "";

  function opid(a) {
    document.getElementById('confirmmodel').style.display = "block";
    copid = a;
  }

  function confirmcorrectoption() {
    $.ajax({
      url: "ajax_pages/correctoption.php",
      method: "POST",
      data: {
        a: copid
      },
      success: function(data) {
        //swal("Good job!", "You clicked the button!", "success")
        $('#msgdata').empty();
        $('#msgdata').append(data);
        $('#images_list').empty();
        copid = "";
        document.getElementById('confirmmodel').style.display = "none";
        document.getElementById('images_list').style.display = "none";
        //document.getElementById('exampleModalCenter').style.display="none";

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