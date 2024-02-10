  <!-- link from transacation -->
  <?php 
  $pid = $_POST['psid'];
  $enroll = $_POST['enroll'];
  $eid = $_POST['eid'];

  include('config/dbconnection.php');

  $gmarkobt = 0;
  $ttmmark = 0;

  $per = 0;

  $exdetail = $db->prepare("SELECT name,logo FROM `exam` WHERE id=$eid"); 
  $exdetail->execute();
  $exrow=$exdetail->fetch();
  $pdetail = $db->prepare("SELECT papername FROM `papermaster` WHERE id=$pid"); 
  $pdetail->execute();
  $prow=$pdetail->fetch();
  $cdetail = $db->prepare("SELECT (SELECT name FROM candidate where id=ex.candidateid) cname,
  (SELECT dob FROM candidate where id=ex.candidateid) dob,
  (SELECT gender FROM candidate where id=ex.candidateid) gender,
  (SELECT category FROM candidate where id=ex.candidateid) category,
  (SELECT photo FROM candidatephotomaster where candidateid='$enroll') photo FROM `examcandidate`ex WHERE enrollmentno='$enroll'"); 
  $cdetail->execute();
  $crow=$cdetail->fetch();
  $result = $db->prepare("SELECT id,name,marks FROM `section` WHERE paperid=$pid"); 
  $result->execute();?>
  <table style="width:100%" class="w3-center">
        <tr>
          <td style="width: 7%;"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($exrow['logo']); ?>" style="width: 100px;height: 100px;"/></td>
          <td style="width:85%;"><h2 style="font-weight: bold;"><?php echo $exrow['name']; ?></h2></td>
          <td style="width:8%"></td>
        </tr>
  </table>
  <table style="width:100%" class="w3-center">
    <tr>
      <td>        
        <b>
          <label style="margin-bottom: 0px;"><?php echo $prow['papername'] ?></label><br/>
          <label style="margin-bottom: 0px;">SCORE CARD</label><br/>
          <label style="margin-bottom: 0px;">(For admission to Undergraduate/Integrated Courses)</label>
        </b>
      </td>
    </tr>
  </table>
  <table style="width:100%;border:double;" class="w3-center">         
         <tr>
            <td style="border:double;"><b>Roll Number : </b></td>
            <td style="border:double;"><?php echo $enroll; ?></td>
            <td rowspan="5" style="border:double;"><img src="data:image/png;base64,<?php echo $crow['photo']; ?>" style="width: 80px;height: 120px;"/></td>
         </tr>
         <tr>
            <td style="border:double;"><b>Candidate's Name : </b></td>
            <td style="border:double;"><?php echo $crow['cname']; ?></td>
         </tr>
         <tr>
            <td style="border:double;"><b>Gender : </b></td>
            <td style="border:double;"><?php echo $crow['gender']; ?></td>
         </tr>
         <tr>
            <td style="border:double;"><b>Category : </b></td>
            <td style="border:double;"><?php echo $crow['category']; ?></td>
         </tr>
         <tr>
            <td style="border:double;"><b>Date of Birth : </b></td>
            <td style="border:double;"><?php echo date('d-m-Y', strtotime($crow['dob'])); ?></td>
         </tr>
  </table><br/>
  <table class="w3-center" style="width:100%;border: double;" border=1 >
                      <thead>
                        <tr>
                          <th style="border:double;"><b>Courses</b></th>
                          <th style="border:double;"><b>Maximum Marks</b></th>
                          <th style="border:double;"><b>Marks Obtained</b></th>
                        </tr>
                      </thead>
                      <tbody border=1>
  <?php
  for($j=1;$row=$result->fetch();$j++){
    $id=$row['id'];
    $name=$row['name'];
    $secmark=$row['marks'];
    
    $ttmmark = $ttmmark + $secmark;

      $result3 = $db->prepare("SELECT sum(marks) as mo from `response` where enrollment= '$enroll' and
       qid in (SELECT id FROM `question` where secid = $id)"); 
      $result3->execute();
      $row3=$result3->fetch();
      $mo=$row3['mo'];
      $gmarkobt = $gmarkobt + $mo;

      ?>
                        <tr>
                          <td style="border:double;"><?php echo $name ?></td>
                          <td style="border:double;"><?php echo $secmark ?></td>
                          <td style="border:double;"><?php echo $mo ?></td>
                        </tr>
<?php }
$per = $per + (($gmarkobt/$ttmmark)*100); ?>
</tbody>
</table><br/>
<table class="w3-center" style="width:100%;border: double;" border=1 >
                      <thead>
                        <tr>
                          <th style="border:double;"><b>Status</b></th>
                          <th style="border:double;"><b>General Rank</b></th>
                          <th style="border:double;"><b>Category Rank</b></th>
                        </tr>
                      </thead>
                      <tbody border=1>                        
                      <tr>
                          <td style="border:double;"><?php if($per < 33){
                            echo "Fail";
                          }else{
                            echo "Pass";
                          }  ?></td>
                          <td style="border:double;"><?php ?></td>
                          <td style="border:double;"><?php echo $gmarkobt; ?></td>
                        </tr>
                      </tbody>
</table>
<br/><br/>
<table style="width:100%;text-align: left;" class="">
  <tbody><tr><td><p><b>Note:</b><br/>
1. Particulars of candidates have been indicated in the Score Card as mentioned by him/her in the online application form. NTA disclaims any liability that may arise to a candidate due to incorrect information provided by him/her in his/her online application form.<br/>
2. If any candidate is found to have tampered with this Score Card at any stage, he/she will be considered as using Unfair Practice and further legal action will be taken as may be deemed fit.<br/>
3. The eligibility criteria, self-declaration and various documents/marks sheets/certificates required to be submitted by the eligible candidates will be verified with reference to the requirements specified by the participating Institutions, at subsequent stages of the admission process. Instances of incorrect information provided by the
candidates, if detected at any stage, would disqualify the candidates.<br/>
4. Candidates are advised to visit the website/s of the participating Universities/Institutions for information regarding the admission process.<br/>
5. Role of NTA is confined to registration of candidates, conduct of the Entrance Test, processing and declaration of results. NTA has no role in the admission process.</p>
</td></tr></tbody></table>
<br/>
<a href="getresultinpdf.php?file=results">Download PDF Now</a>
 

