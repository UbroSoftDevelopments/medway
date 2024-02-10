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
</style>
<!-- Main Content -->
<div class="main-content" >
        <div class="modal bd-example-modal-sm" id="loadercss" tabindex="-1" role="dialog"
          aria-labelledby="" aria-hidden="true" style="display:none;opacity:1;background-color:#f3efefd1;">
          <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
            <div class="modal-content" style="width: 100%;">
              <div class="modal-body">
                <center><img src="assets/img/newloader.gif" class="img-fluid" /></center>
              </div>              
            </div>
          </div>
        </div>

  <section class="section">
    <div class="section-body">
      <div class="row" style="margin-top: -45px;">
        <div class="col-12">
          <div class="card" style="margin-bottom:5px">
            <div class="card-header">
              <h4>Upload Candidate Image</h4>
            </div>
            <!-- <form action="" id="upload_candi_images" method="post" enctype="multipart/form-data"> -->
            <div class="card-body">
              <div class="form-group row">
                <label for="chooseexam" class="col-sm-1 col-form-label">Choose</label>
                <div class="col-sm-3">
                  <select class="custom-select" name="chooseexam" id="exid" onchange="getpaper(document.getElementById('exid').value)">
                    <option selected>Choose Exam</option>
                    <?php $examdetail = $fetchrecordobj->examdropdown(); ?>
                  </select>
                </div>
                <div class="col-sm-5">
                  <select class="custom-select" name="chooseppr" id="chooseppr" onchange="getpapertime(document.getElementById('chooseppr').value)">
                    <option selected>Choose Paper</option>
                  </select>
                  <input type="hidden" id="pprid" name="pprid"/>
                  <input type="hidden" id="pprdate" name="pprdate" />
                </div>
                <div class="col-sm-3">
                  <select class="custom-select" name="choosetime" id="choosetime" onchange="getcandidatelist(document.getElementById('choosetime').value)">
                    <option selected>Choose Shift Time</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-6 row">
                  <label class="col-4 col-form-label">Candidates Image<label><b>(Only in .jpg/.jpeg/.png)</b></label></label>
                  <div class="col-8">
                    <input type="file" class="form-control" name="photoimage[]" id="photoimage" multiple accept=".jpg, .png" required>
                    <div class="m-2" style="text-align:right">
                      <button name="insert" id="previewphoto" type="button" class=" btn btn-primary" onclick="covertImageInBlob(true)">Upload</button>
                    </div>
                  </div>
                </div>
                <div class="col-6 row">
                  <label class="col-4 col-form-label">Candidates Signature<label><b>(Only in .jpg/.jpeg/.png)</b></label></label>
                  <div class="col-8">
                    <input type="file" class="form-control" name="sigimage[]" id="sigimage" multiple accept=".jpg, .png">
                    <div class="m-2" style="text-align: right;">
                      <button type="submit" name="insert" id="insert" class=" btn btn-primary" onclick="covertImageInBlob(false)">Upload</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- </form> -->
          </div>
        </div>
        <div class="col-12" style="color:white;display:none;" id="loaderdiv">
              <img src="assets/img/rocketloader.gif" class="pull-right"  style="width:100%;height:250px;"/>
        </div>
        <div class="col-12 scroll" id="candidiv" style="display:none;">
          <div class='card'>
            <div class='card-body'>
              <table class='table table-bordered table-striped'>
                <thead>
                  <tr>
                    <td></td>
                    <td>Name</td>
                    <td>Enrollmentno</td>
                    <td>Photo</td>
                    <td>Signature</td>
                  </tr>
                </thead>
                <tbody id="candilist">
                </tbody>
              </table>
            </div>
          </div> 
        </div>
        </div>
  </section>
</div>

<script language="javascript" type="text/javascript">
  $(function() {
    $("#photoimage").change(function() {
      if (typeof(FileReader) != "undefined") {
        var dvPreview = $("#dvPreview");
        dvPreview.html("");
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.png)$/;
        var counter = 0;

        var listphoto = [];
        $($(this)[0].files).each(function() {
          var file = $(this);
          if (regex.test(file[0].name)) {
            var reader = new FileReader();
            reader.onload = function(e) {
              counter++;
             //  var img = $("<img />");
              // img.attr("style", "height:80px;width: 80px");
              //img.attr("src", e.target.result); 
              var filename1 = file[0].name;
              filename1 = filename1.split('.').slice(0, -1).join('.');
              //console.log("filename: ",filename1) 
             // //console.log("target: ",e.target.result)             
              $("#photo" + filename1).attr({
                "src": e.target.result,
                "name": "photoblob"
              });

              listphoto.push({
                "src": e.target.result,
                "name": filename1
              })

            }

            reader.readAsDataURL(file[0]);
          } else {
            alert(file[0].name + " is not a valid image file.");
            dvPreview.html("");
            return false;
          }

        });
        console.log(listphoto)

      } else {
        alert("This browser does not support HTML5 FileReader.");
      }

    });
  });

  $(function() {
    $("#sigimage").change(function() {
      if (typeof(FileReader) != "undefined") {
        var dvPreview = $("#dvPreview");
        dvPreview.html("");
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.png)$/;
        var counter = 0;
        $($(this)[0].files).each(function() {
          var file = $(this);
          if (regex.test(file[0].name.toLowerCase())) {
            var reader = new FileReader();
            reader.onload = function(e) {
              counter++;
              // var img = $("<img />");
              // img.attr("style", "height:80px;width: 80px");
              // img.attr("src", e.target.result);    
              var filename1 = file[0].name;
              filename1 = filename1.split('.').slice(0, -1).join('.');
              //  $("#sig"+counter).attr("src", e.target.result);  
              $("#sig" + filename1).attr({
                "src": e.target.result,
                "name": "sigblob"
              });
            }
            reader.readAsDataURL(file[0]);
          } else {
            alert(file[0].name + " is not a valid image file.");
            dvPreview.html("");
            return false;
          }
        });
        console.log("Counter: ", counter);
      } else {
        alert("This browser does not support HTML5 FileReader.");
      }
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#upload_candi_images').on('submit', function(event) {
      event.preventDefault();
      var image_name = $('#photoimage').val();
      if (image_name == '') {
        alert("Please Select Image");
        return false;
      } else {
        $.ajax({
          url: "ajax_pages/insertcandiphoto.php",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {
            alert(data);
          }
        });
      }
    });

    $('#upload_candi_signature').on('submit', function(event) {
      event.preventDefault();
      var image_name = $('#sigimage').val();
      if (image_name == '') {
        alert("Please Select Image");
        return false;
      } else {
        $.ajax({
          url: "ajax_pages/insertcandisignature.php",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {
            alert(data);
          }
        });
      }
    });

  });

  function covertImageInBlob(isPhoto) {
    let imageList = [];
    const psid= document.getElementById('choosetime').value;
    var url_images ="";
    var pic = [];
    document.getElementById('loadercss').style.display = "block";
    if (isPhoto) {
      images = document.getElementsByName("photoblob");
      url_images = "ajax_pages/insertcandiphoto.php";
       ////console.log("length"+images.length);
      for (var i = images.length - 1; i >= 0; i--) {
        // var blobtoinsert =  $(images[i].id).imageBlob().blob();
        //photo: images[i].src.slice(23)
        pic = images[i].src;
        
        imageList.push({
          enroll: images[i].id.replace('photo', ''),
          photo:pic
        });
       
      }
      // //console.log("Pic: "+pic)
      // //console.log("imagelist5:"+imageList);
    } else {
      images = document.getElementsByName("sigblob");
      url_images ="ajax_pages/insertcandisignature.php";
      for (var i = images.length - 1; i >= 0; i--) {
        // var blobtoinsert =  $(images[i].id).imageBlob().blob();
        pic = images[i].src;
        imageList.push({
          enroll: images[i].id.replace('sig', ''),
          sign: pic
        });
      }
    }

    ////console.log("imageList:", imageList);
    
    $.ajax({
    type: "POST",
    url: url_images,
    data:{psid:psid,imageList:imageList},
    success: function(msg){
      document.getElementById('loadercss').style.display = "none";
       // alert(msg);
        swal("Congratulation", msg, "success", {
				button: "Done",
			  });
       }
    });




  }

</script>
<?php include "footer.php"; ?>