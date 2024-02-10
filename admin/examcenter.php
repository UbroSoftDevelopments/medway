<?php   
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
   session_start();
    ob_start();
    $userid = $_SESSION['id']; 
    if(isset($userid) && $userid != "")
    {
        require_once('include/function/spl_autoload_register.php');
          $userObj = new user;
         $fetchrecordobj = new fetchrecord;
         $ubstatus = $fetchrecordobj->ubstatus();
    } else {
        echo"ABC".$userid;
        // header('Location: index.php'); //redirect URL
    }
    ?>
<?php include "head.php"; ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.js"></script>
<?php include "header.php"; ?>
<?php include "left-menu.php"; ?>
<!-- Main Content -->
<style>
  .txtarea{
    max-width:100%;
    min-height:200px;    
    display:block;
    width:100%;
}

.mydiv{
    padding:10px;
    display: none;
}

.gen_btn{
    padding:5px;
    background-color:#743ED9;
    color:white;
    font-family:arial;
    font-size:13px;
    border:2px solid black;
}

.gen_btn:hover{
    background-color:#9a64ff;
}
  </style>
<div class="main-content" style="margin-top: -35px;">
<?php include('admin_status.php');?>


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
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Paper Center</h4>
                    <div class='mydiv'>    
                        <textarea id="txt" class='txtarea'></textarea>
                        <button class='gen_btn'>Generate File</button>
                    </div>
                  <a href="downloadcenterformat.php" class="col-sm-3">
                        <button type="submit" name="save" class=" btn btn-info">Download Center Format</button>
                  </a>
                 
                        <button name="save" class=" btn btn-info col-sm-3"  onclick="Downloadcandidateexcel()">Download Candidate Format</button>
                 
                  </div>
                  <div class="card-body">
                    <?php
                    //$msg=$_GET['msg'];
                    // if($msg!=""){
                    //   echo"<div style='text-align:center;' class='list-group-item list-group-item-success'>".$msg."</div>";
                    // }?>
                                
                    <!-- <div class="form-group row">
                      <label for="chooseexam" class="col-sm-3 col-form-label">Choose Exam</label>
                      <div class="col-sm-6">
                      <select class="custom-select" name="chooseexam" id="exid" onchange="getpaper(document.getElementById('exid').value)">
                        <option selected>Choose Exam</option>
                        <?php  //$examdetail = $fetchrecordobj->examdropdown(); ?>
                      </select>
                      </div>
                    </div> -->
                    <div class="form-group row">
                      <label for="chooseppr" class="col-sm-3 col-form-label">Choose Paper</label>
                      <div class="col-sm-6">
                      <select class="custom-select" name="chooseppr" id="chooseppr" onchange="getpapertime(document.getElementById('chooseppr').value)">
                        <option selected value="">Choose Paper</option>
                        <?php   $fetchrecordobj->pprdropdown(); ?>
                      </select>
                      <input type="hidden" id="pprid" name="pprid"/>
                      <input type="hidden" id="pprdate" name="pprdate"/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="" class="col-sm-3 col-form-label">Choose Shift Time</label>
                      <div class="col-sm-6">
                      <select class="custom-select" name="choosetime" id="choosetime" onchange="getshifttime(document.getElementById('choosetime').value)">
                        <option selected>Choose Shift Time</option>
                      </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Upload Center</label>
                      <div class="col-sm-4 ">
                          <input type="file" id="file_upload" class="form-control" />
                      </div>
                       <button class="col-sm-2 btn btn-primary"  onclick="uploadcenter()">Upload Center</button>                       
                    </div>                                      
                    <div class="form-group row">
                       <label class="col-sm-2 col-form-label">Upload Candidate</label>
                      <div class="col-sm-4 ">
                          <input type="file" class="form-control" id="file_upload_candidate">
                          <input type="hidden" id="pshifttime" name="pshifttime"/>
                      </div>
                      <button onclick="uploadcandidateexcel()" class="col-sm-2 btn btn-primary">Upload Candidate</button>                       
                    </div>                                  
                  </div>                
                </div>
              </div>
            </div>
          </div>
        </section>
      
</div>
<script>

function Downloadcandidateexcel(){
  var text = document.getElementById('chooseppr').value;
  const myArray = text.split(",");
  let pid = myArray[0];
  if(!text){
    alert("Choose Exam and Paper");
    return;
  }else{
    document.getElementById('loadercss').style.display = "block";
    $.ajax({
            type: "POST",
            data:{pid:pid},
            url:"ajax_pages/candiexcel.php",
            success:function(data){
            // console.log(data);
              $('#txt').val(data);
             DownloadCandiExcel()
            }
    });
  }
}

function DownloadCandiExcel(){
  var data = $('#txt').val();
        if(data == '')
            return;
        JSONToCSVConvertor(data, "Candidate_Excel", true);
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
    fileName += ReportTitle.replace(/ /g,"_");   
    
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



    // Method to upload a valid excel file
    function uploadcenter() {
      document.getElementById('loadercss').style.display = "block";
        var files = document.getElementById('file_upload').files;
        if(files.length==0){
          alert("Please choose any file...");
          return;
        }
        var filename = files[0].name;
        var extension = filename.substring(filename.lastIndexOf(".")).toUpperCase();
        if (extension == '.XLS' || extension == '.XLSX') {
            //Here calling another method to read excel file into json
            excelFileToJSON(files[0]);
        }else{
            alert("Please select a valid excel file.");
        }
    }

    //Method to read excel file and convert it into JSON 
    function excelFileToJSON(file){
          try {
            var reader = new FileReader();
            reader.readAsBinaryString(file);
            reader.onload = function(e) {
 
                var data = e.target.result;
                var workbook = XLSX.read(data, {
                    type : 'binary'
                });
                var result = {};
                var firstSheetName = workbook.SheetNames[0];
                //reading only first sheet data
                var jsonData = XLSX.utils.sheet_to_json(workbook.Sheets[firstSheetName]);
                //displaying the json result into HTML table
                displayJsonToHtmlTable(jsonData);
                }
            }catch(e){
                console.error(e);
            }
    }
       
    //Method to display the data in HTML Table
    function displayJsonToHtmlTable(jsonData){
        var exid = <?php echo $_GET['ubexid'];?>;
        var pdt = document.getElementById("pprdate").value;
        var pid = document.getElementById("pprid").value;
        ////console.log("exid"+exid+"pid"+pid+"pshiftid"+pshift);
        if(jsonData.length>0){
            var htmlData;
            for(var i=0;i<jsonData.length;i++){
                var row=jsonData[i];
            }
            //console.log(jsonData)
            $.ajax({
              type: "POST",
              url: "ajax_pages/uploadcenterexcel.php",
              data: {exid:exid,pdt:pdt,pid:pid, jsondt: jsonData },
              success: function (msg) {
                //alert(msg);
                //console.log(msg);
                document.getElementById('loadercss').style.display = "none";
                document.getElementById("file_upload").value = "";
                if(msg.trim()=="Not"){
                  swal("Warning!", "Center User Id Already Exist!!! Please Change User Id", "warning");
                }else{
                swal("Good job!", msg, "success");
                }
              }
            });
        }else{
          swal("Failed!", "There is no data in Excel", "warning");
        }
    }

    // Method to upload a valid excel file
    function uploadcandidateexcel() {
      document.getElementById('loadercss').style.display = "block";
        var files = document.getElementById('file_upload_candidate').files;
        if(files.length==0){
          alert("Please choose any file...");
          return;
        }
        var filename = files[0].name;
        var extension = filename.substring(filename.lastIndexOf(".")).toUpperCase();
        if (extension == '.XLS' || extension == '.XLSX') {
            //Here calling another method to read excel file into json
            excelFileToJSONcandidate(files[0]);
        }else{
            alert("Please select a valid excel file.");
        }
    }
    
    //Method to read excel file and convert it into JSON 
    function excelFileToJSONcandidate(file){
          try {
            var reader = new FileReader();
            reader.readAsBinaryString(file);
            reader.onload = function(e) {
 
                var data = e.target.result;
                var workbook = XLSX.read(data, {
                    type : 'binary'
                });
                var result = {};
                var firstSheetName = workbook.SheetNames[0];
                //reading only first sheet data
                var jsonData = XLSX.utils.sheet_to_json(workbook.Sheets[firstSheetName]);
                //displaying the json result into HTML table
                displayJsonToHtmlTablecandidate(jsonData);
                }
            }catch(e){
                console.error(e);
            }
    }
       
      //Method to display the data in HTML Table
    function displayJsonToHtmlTablecandidate(jsonData){
        var pshifttime = document.getElementById("pshifttime").value;
        
        if(jsonData.length>0){
            var htmlData;
            for(var i=0;i<jsonData.length;i++){
                var row=jsonData[i];
            }
            console.log(jsonData)
            $.ajax({
              type: "POST",
              url: "ajax_pages/uploadcandiexcel.php",
              data: {pshifttime:pshifttime,jsondt: jsonData },
              success: function (msg) {
                //alert(msg);
                 //console.log("msg"+msg);
                document.getElementById('loadercss').style.display = "none";
               document.getElementById("file_upload_candidate").value = "";
               if(msg=="Not"){
                swal("Warning!", "Duplicate Entry", "warning");
               }else{
               swal("Good job!", msg, "success");
              }
            }
            });
        }else{
          swal("Failed!", "There is no data in Excel", "warning");
        }
    }

    
</script>
<?php include "footer.php"; ?>