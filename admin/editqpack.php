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
<style type="text/css">
  .opclass{
    padding: 0.10em;
    border-radius: 10%;
    border: solid;
    width: 110px;
    float: right;
    height: 80px;
}
  .qclass{
    padding: 0.10em;    
    width: 100%;
    height: auto;
}
  .ophover:hover{
    border:solid;
}
#qimg-preview {
  display: none; 
  width: 100%;   
  border: 2px dashed #333;  
  margin-bottom: 20px;
}
#qimg-preview img {  
  width: 100%;
  height: 10rem; 
  display: block;   
}

#opaimg-preview {
  display: none; 
  width: 100%;   
  border: 2px dashed #333;  
  margin-bottom: 20px;
}
#opaimg-preview img {  
  width: 100%;
  height: 8rem; 
  display: block;   
}

#opbimg-preview {
  display: none; 
  width: 100%;   
  border: 2px dashed #333;  
  margin-bottom: 20px;
}
#opbimg-preview img {  
  width: 100%;
  height: 8rem; 
  display: block;   
}
#opcimg-preview {
  display: none; 
  width: 100%;   
  border: 2px dashed #333;  
  margin-bottom: 20px;
}
#opcimg-preview img {  
  width: 100%;
  height: 8rem; 
  display: block;   
}
#opdimg-preview {
  display: none; 
  width: 100%;   
  border: 2px dashed #333;  
  margin-bottom: 20px;
}
#opdimg-preview img {  
  width: 100%;
  height: 8rem; 
  display: block;   
}
.lbl-hide{
  display: none;
}
</style>
<!-- Main Content -->
<div class="main-content">
        <!-- Vertically Center -->
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

        <div class="modal bd-example-modal-xl" id="uploadquestion" tabindex="-1" role="dialog"
          aria-labelledby="" aria-hidden="true" style="display:none;opacity:1;background-color:#f3efefd1;">
          <div class="modal-dialog modal-dialog-centered  modal-xl" role="document" >
            <div class="modal-content"style="height:93vh">
              <div class="modal-header">
                <h5 class="modal-title" id="" style="border: solid;padding: 10px;width: 100%;">Upload QPack</h5>
                <button type="button" class="close" onclick="closeqpackmodal()">
                  <span aria-hidden="true" style="color: red;opacity: 1;">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-3">
                    <label>Ques No.</label><label id="qid" class=""></label>
                    <input type="file" name="qimage" id ="qimage" class="form-control" />
                    <button class="btn btn-primary" onclick="editquestion()">Submit</button>
                  </div>
                  <div class="col-md-9">
                      <input type="hidden" id="qimg" name="qimg" required>
                      <div id="qimg-preview" name="qimageprev">
                         <img src="" name="qimages" id="qimages" alt = "img"/>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <label>Op A</label><label id="opaid" class=""></label>
                    <button class="btn btn-primary" onclick="editopA()">Submit</button>
                    <input type="file" name="opaimage" id ="opaimage" class="form-control" />
                    <input type="hidden" id="opaimg" name="opaimg" required>
                      <div id="opaimg-preview" name="opaimageprev">
                         <img src="" name="opaimages" id="opaimages" alt = "img"/>
                      </div>
                  </div>
                  <div class="col-md-3">
                    <label>Op B</label><label id="opbid" class=""></label>
                    <button class="btn btn-primary" onclick="editopB()">Submit</button>
                    <input type="file" name="opbimage" id ="opbimage" class="form-control" />
                    <input type="hidden" id="opbimg" name="opbimg" required>
                      <div id="opbimg-preview" name="opbimageprev">
                         <img src="" name="opbimages" id="opbimages" alt = "img"/>
                      </div>
                  </div>
                  <div class="col-md-3">
                    <label>Op C</label><label id="opcid" class=""></label>
                    <button class="btn btn-primary" onclick="editopB()">Submit</button>
                    <input type="file" name="opcimage" id ="opcimage" class="form-control" />
                    <input type="hidden" id="opcimg" name="opcimg" required>
                      <div id="opcimg-preview" name="opcimageprev">
                         <img src="" name="opcimages" id="opcimages" alt = "img"/>
                      </div>
                  </div>
                  <div class="col-md-3">
                    <label>Op D</label><label id="opdid" class=""></label>
                    <button class="btn btn-primary" onclick="editopB()">Submit</button>
                    <input type="file" name="opdimage" id ="opdimage" class="form-control" />
                    <input type="hidden" id="opdimg" name="opdimg" required>
                      <div id="opdimg-preview" name="opdimageprev">
                         <img src="" name="opdimages" id="opdimages" alt = "img"/>
                      </div>
                  </div>
                </div>
                <!-- <button class="btn btn-primary" onclick="uploadimgquestion()">Submit</button> -->
              </div>
            </div>
          </div>
        </div>
       
        <section class="section">
          <div class="section-body">
            <div class="row" style="margin-top: -45px;">
              <div class="col-12 col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Question Pack</h4>
                  </div>
                <!-- <form action="" id="upload_multiple_images" method="post" enctype="multipart/form-data"> -->
                  <?php //$userObj->createquestion()?>
                  <div class="card-body">
                    <div class="form-group row">
                      <div class="col-sm-2">
                      <select class="custom-select" name="chooseexam" id="exid" onchange="getpaper(document.getElementById('exid').value)">
                        <option selected>Choose Exam</option>
                        <?php $examdetail = $fetchrecordobj->examdropdown(); ?>
                      </select>
                      </div>
                      <div class="col-sm-3">
                      <select class="custom-select" name="chooseppr" id="chooseppr" onchange="shiftlistbypidprogress(document.getElementById('chooseppr').value)">
                        <option selected>Choose Paper</option>
                      </select>
                      </div>
                      <div class="col-sm-2">
                      <select class="custom-select" name="chooseshift" id="chshift" onchange="getquestioncount(document.getElementById('chshift').value)">
                        <option selected>Choose Shift</option>
                      </select>
                      </div>
                      <div class="col-sm-2">
                      <select class="custom-select" name="choosesection" id="chsec" >
                        <option selected>Choose Section</option>
                      </select>
                      </div>
                      <div class="col-sm-2">
                        <select class="custom-select" name="chooselang" id="chlang" >
                        <option selected>Choose Language</option>
                      </select>
                      </div>
                      <button class="col-sm-1 btn btn-primary" onclick="getqpack()">Submit</button>
                    </div>
                  </div>
                <!-- </form> -->
                </div>


                <div class="card" id="quesdiv" style="display:none">
                  <div class="card-body">
                    <div id="questionlist" class="scroll" style="text-align: left;">

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
</div>
<script type="text/javascript">
  function getqpack(){
      const sid = document.getElementById('chsec').value;
      const psid = document.getElementById('chshift').value;
      const langid = document.getElementById('chlang').value;
      if(!sid || !psid || !langid){
        alert("Some fields are not choosen");
      }else{
        $('#loadercss').css("display","block");
        $.ajax({
          type: "POST",
          data:{psid:psid,sid:sid,langid:langid},
          url:"ajax_pages/editqpack.php",
          success:function(data)
           {
            //alert(data);
            // document.getElementById('uploadquestion').style.display="block";
            //$('#qpack_list').html(data);
            $('#loadercss').css("display","none");
            document.getElementById('quesdiv').style.display="block";
            $('#questionlist').html(data);     
          }          
        });        
      }
  }

const chooseFile = document.getElementById("qimage");
const qimgPreview = document.getElementById("qimg-preview");
chooseFile.addEventListener("change", function () {
  QgetImgData();
});

function QgetImgData() {
  const files = chooseFile.files[0];
  if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      qimgPreview.style.display = "block";
      document.getElementById('qimages').src = this.result ;
      document.getElementById('qimg').value= this.result;

    });    
  }
}

const OpAFile = document.getElementById("opaimage");
const OpAPreview = document.getElementById("opaimg-preview");
OpAFile.addEventListener("change", function () {
  OpAgetImgData();
});

function OpAgetImgData() {
  const files = OpAFile.files[0];
  if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      OpAPreview.style.display = "block";
      document.getElementById('opaimages').src = this.result ;
      document.getElementById('opaimg').value= this.result;

    });    
  }
}

const OpBFile = document.getElementById("opbimage");
const OpBPreview = document.getElementById("opbimg-preview");
OpBFile.addEventListener("change", function () {
  OpBgetImgData();
});

function OpBgetImgData() {
  const files = OpBFile.files[0];
  if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      OpBPreview.style.display = "block";
      document.getElementById('opbimages').src = this.result ;
      document.getElementById('opbimg').value= this.result;

    });    
  }
}

const OpCFile = document.getElementById("opcimage");
const OpCPreview = document.getElementById("opcimg-preview");
OpCFile.addEventListener("change", function () {
  OpCgetImgData();
});

function OpCgetImgData() {
  const files = OpCFile.files[0];
  if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      OpCPreview.style.display = "block";
      document.getElementById('opcimages').src = this.result ;
      document.getElementById('opcimg').value= this.result;

    });    
  }
}

const OpDFile = document.getElementById("opdimage");
const OpDPreview = document.getElementById("opdimg-preview");
OpDFile.addEventListener("change", function () {
  OpDgetImgData();
});

function OpDgetImgData() {
  const files = OpDFile.files[0];
  if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      OpDPreview.style.display = "block";
      document.getElementById('opdimages').src = this.result ;
      document.getElementById('opdimg').value= this.result;
    });    
  }
}
 
  function editopenqpack(qid){
    const langid = document.getElementById('chlang').value;
    document.getElementById('uploadquestion').style.display="block";
    $.ajax({
          type: "POST",
          data:{qid:qid,langid:langid},
          url:"ajax_pages/getoptionidbyqid.php",
          success:function(data)
           {
            console.log(data)
            $('#qid').html(qid);
            const obj = JSON.parse(data);
            
            $('#qimg').val(obj.data[0]);
            $("#qimages").attr("src", obj.data[0]);
            $('#qimg-preview').css('display','block');
            $('#opaid').html(obj.data[1]);
            $('#opaimg').val(obj.data[2]);
            $("#opaimages").attr("src", obj.data[2]);
            $('#opaimg-preview').css('display','block');
            $('#opbid').html(obj.data[3]);
            $('#opbimg').val(obj.data[4]);
            $("#opbimages").attr("src", obj.data[4]);
            $('#opbimg-preview').css('display','block');
            $('#opcid').html(obj.data[5]);
            $('#opcimg').val(obj.data[6]);
            $("#opcimages").attr("src", obj.data[6]);
            $('#opcimg-preview').css('display','block');
            $('#opdid').html(obj.data[7]);            
            $('#opdimg').val(obj.data[8]);
            $("#opdimages").attr("src", obj.data[8]);
            $('#opdimg-preview').css('display','block');
          }          
        });
  }

  function uploadimgquestion(){
    const langid = document.getElementById('chlang').value;
    //let qid = $('#qid').text();
    let opaid = $('#opaid').text();
    let opbid = $('#opbid').text();
    let opcid = $('#opcid').text();
    let opdid = $('#opdid').text();
    //let Qimgdata = $('#qimg').val();
    let OpAimgdata = $('#opaimg').val();
    let OpBimgdata = $('#opbimg').val();
    let OpCimgdata = $('#opcimg').val();
    let OpDimgdata = $('#opdimg').val();
    // if( !$('#opaimg').val() || !$('#opbimg').val() || !$('#opcimg').val() || !$('#opdimg').val()){
    //   alert("Choose Question and Options First!!!");
    // }else{
      
      $.ajax({
          type: "POST",
          // data:{qid:qid,opaid:opaid,opbid:opbid,opcid:opcid,opdid:opdid,
          //   Qimgdata:Qimgdata,OpAimgdata:OpAimgdata,OpBimgdata:OpBimgdata,OpCimgdata:OpCimgdata,OpDimgdata:OpDimgdata
          //   ,langid:langid},
          url:"ajax_pages/uploadimgquestion.php",
          success:function(data)
           {
            swal("Congratulation", "Question Added Successfully", "success", {
                    button: "Done",
                  });
            document.getElementById('uploadquestion').style.display="none";
                  
          }          
        });
     //}
  }

  function editquestion(){
    $('#loadercss').css("display","block");
    const langid = document.getElementById('chlang').value;
    let qid = $('#qid').text();
    let Qimgdata = $('#qimg').val();
    if( !$('#qimg').val() || !$('#qid').text()){
      alert("Choose Question and Options First!!!");
    }else{
      $.ajax({
          type: "POST",
          data:{qid:qid,Qimgdata:Qimgdata,langid:langid},
          url:"ajax_pages/uploadimgquestion.php",
          success:function(data){
            swal("Congratulation",data, "success", {
                    button: "Done",
            });
          }          
        });
     }
  }


$(document).ready(function(){

   // load_images(52); 

    function load_images(qid)
    {
      var psid = document.getElementById('chshift').value;
      getquestioncount(psid);
        $.ajax({
          type: "POST",
          data:{qid:qid},
          url:"fetch_images.php",
          success:function(data){
            alert(data);            
            $('#images_list').html(data);
            document.getElementById('exampleModalCenter').style.display="block";
          }
        });       
    }
 
    $('#upload_multiple_images').on('submit', function(event){
        event.preventDefault();
        var qimage = $('#qimage').val();
        var image_name = $('#image').val();
        var mm = $('#mm').val();
        var nm = $('#nm').val();
        if(image_name == '' || qimage == '')        {
            alert("Please Select Image");
            return false;
        } else {
            $.ajax({
                url:"insertques.php",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                success:function(data){
                  data =JSON.parse(data)
                  //console.log("json data"+data);
                  if(!data.status){
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
var copid ="";
function opid(a){
  document.getElementById('confirmmodel').style.display="block";
   copid = a;
}

function confirmcorrectoption(){
  $.ajax({
        url:"correctoption.php",
        method:"POST",
        data:{a:copid},
        success:function(data)
        {
          //swal("Good job!", "You clicked the button!", "success")
          $('#msgdata').empty();
          $('#msgdata').append(data);
          $('#images_list').empty();
          copid="";
          document.getElementById('confirmmodel').style.display="none";
          document.getElementById('images_list').style.display="none";
          //document.getElementById('exampleModalCenter').style.display="none";
          
        }
    });
}

function closeqpackmodal(){
  document.getElementById('uploadquestion').style.display="none";
}

function closemodalqpack(){
  document.getElementById('viewuploadqpack').style.display="none";
}

</script>
<?php include "footer.php"; ?>