<?php
session_start();
ob_start();
$userid = $_SESSION['id'];
if (isset($userid) && $userid != "") {
    require_once('include/function/spl_autoload_register.php');
    // $userObj = new user;
    $fetchrecordobj = new fetchrecord;
    $examimg = $fetchrecordobj->examimg();
    $candidata = $fetchrecordobj->candidata();
    $candimarks = $fetchrecordobj->candimarks();
    //$pprcnt = $fetchrecordobj->papercount();
    //$shiftcnt = $fetchrecordobj->shiftcount();
    //$candidatecnt = $fetchrecordobj->candidatecount();

} else {
    echo "ABC" . $userid;
    // header('Location: index.php'); //redirect URL
}
?>
<?php include 'head.php'; ?>
<style>
    .correctans{
        margin-left: 24px;
    color: green;
    font-weight: bold;
    padding: 8px;
    border: solid;
    }
    .respans{
        margin-left: 24px;
    color: purple;
    font-weight: bold;
    padding: 8px;
    border: solid;
    }
    fieldset{
        margin-top: 20px;
    }
    @media print { #printPageButton { display: none; } }
</style>
<div class="container">

    <div class="row">
        <div class="col-12 p-4">
         <!-- <button id="printPageButton" class="btn btn-primary" onClick="window.print();">Download</button> -->
            <center><img src="<?php echo $examimg['logo']; ?>" alt="image" /></center>
            <div class="table-responsive mt-2">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Enrollment No.</td>
                            <td><?php echo $_SESSION['rollno']; ?></td>
                        </tr>
                        <tr>
                            <td>Candidate Name</td>
                            <td><?php echo $candidata['name']; ?></td>
                        </tr>
                        <tr>
                            <td>Paper Name</td>
                            <td><?php echo $candidata['papername']; ?></td>
                        </tr>
                        <tr>
                            <td>Marks </td>
                            <td><?php echo $candimarks['marks'].' / 150'; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12" style="color:white;display:block;" id="loaderdiv">
                      <img src="../admin/assets/img/sloader.gif" class="pull-right"  style="width:100%;height:460px;"/>
              </div>
            <div id="sectionData" class="modal-content" style="overflow-y:AUTO;padding: 10px">
            </div>
        </div>
    </div>
    </body>
    <script>
        window.onload = function getanswerkey() {
            const pid = <?php echo $_GET['pid'];?>;
            const psid = <?php echo $_GET['psid'];?>;
            const set = <?php echo $_SESSION['setno'] ?>;
            const regno = <?php echo $_SESSION['rollno'] ?>;
           
            $.ajax({
                type: "POST",
                url: "ajax_pages/answerkey_data.php",
                data: {
                    pid: pid,
                    set: set,
                    psid: psid,
                    regno: regno
                },
                success: function(msg) {
                    //console.log(msg);
                    // alert(msg);
                    if(msg == "1"){
                        alert("Result Not Declared!! Please Wait");
                    }else{
                    displayQuestion(msg);
                    }

                }
            });
        }

        function displayQuestion(setv1) {
            $('#loaderdiv').css("display","block");
            var secv1 = setv1.Sections;
            var sectionDataDiv = document.getElementById('sectionData');
            $("#sectionData").empty();

            secv1.map(function(val, ind) {
                var sectionDiv = document.createElement('div');
                var sectionName = document.createElement('h4');
                sectionName.innerText = val.SectionName;
                sectionDiv.appendChild(sectionName);

                var AllQuestionSec = val.AllSetQuestion;
                AllQuestionSec.map(function(qval, qind) {

                    var questionDiv = document.createElement('fieldset');
                    var questionNO = document.createElement('legend');
                    questionNO.innerText = "Q.No " + (qind + 1);
                    questionDiv.appendChild(questionNO);
                    var qtype = qval.Type;

                    var qname = document.createElement('img');
                    qname.src = qval.Question;

                    questionDiv.appendChild(qname);
                    questionDiv.appendChild(
                        document.createElement('hr')
                    );

                    var AllOptions = qval.optionModels;
                    AllOptions.map(function(oval, oind) {
                        var optionname = document.createElement('img');
                        optionname.src = oval.Option;
                        var optonDiv = document.createElement('fieldset');
                        var optNO = document.createElement('legend');
                    
                        optNO.innerText = String.fromCharCode(oind + 65);

                        if(oval.Iscorrect == 1){
                            var spancorr = document.createElement('span');
                        spancorr.classList.add("correctans");
                        spancorr.innerText = "Correct";
                        optNO.appendChild(spancorr);
                        }
                      
                        if(oval.ID == qval.response){
                            var spanresp = document.createElement('span');
                        spanresp.classList.add("respans");
                        spanresp.innerText = "Choosed Option";
                        optNO.appendChild(spanresp);
                        }

                        optonDiv.appendChild(optNO);
                        optonDiv.appendChild(optionname);
                        questionDiv.appendChild(optonDiv);
                    });

                    ExplainDiv = document.createElement('fieldset');
                    var Exolatintle = document.createElement('legend');
                    Exolatintle.innerText = "Explanation";
                    ExplainDiv.appendChild(Exolatintle);
                    var explainimg = document.createElement('img');
                    explainimg.src = qval.Explain;
                    ExplainDiv.appendChild(explainimg);
                    questionDiv.appendChild(ExplainDiv);
                    // questionDiv.appendChild(
                    //     document.createElement('hr')
                    // );

                    sectionDiv.appendChild(questionDiv);
                    sectionDiv.appendChild(
                        document.createElement('br')
                    );
                    sectionDiv.appendChild(
                        document.createElement('hr')
                    );
                });
                sectionDataDiv.appendChild(sectionDiv);
            });
            $('#loaderdiv').css("display","none");
        }
    </script>

    </html>