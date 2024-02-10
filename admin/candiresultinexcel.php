<?php
header("Content-Type: application/xls");    
  header("Content-Disposition: attachment; filename=examcandidate.xls");  
  header("Pragma: no-cache"); 
  header("Expires: 0");
    include('config/dbconnection.php');
  $output = "";
  
  $output .="
          <table >
            <thead>
              <tr >                
                <td>CandidateId</td>
                <td>Candidate Name</td>
                <td>Enrollmentno</td>
                <td>Gender</td>
                <td>Date of Birth</td>
              </tr>
            </thead>
            <tbody>
            ";
    $exdetail = $db->prepare("SELECT name,logo FROM `exam` WHERE id=$eid"); 
  $exdetail->execute();
  $exrow=$exdetail->fetch();
  $pdetail = $db->prepare("SELECT id FROM `papershift` WHERE paperid=$pid"); 
  $pdetail->execute();
  for($q=1;$prow=$pdetail->fetch();$q++){
   $pshiftid = $prow['id'];
  $cdetail = $db->prepare("SELECT (SELECT name FROM candidate where id=ex.candidateid) cname,(SELECT dob FROM candidate where id=ex.candidateid) dob,(SELECT gender FROM candidate where id=ex.candidateid) gender,(SELECT photo FROM candidatephotomaster where candidateid='$enroll') photo FROM `examcandidate`ex WHERE papershiftid=$pprshiftid"); 
  $cdetail->execute();
  for($w=1;$crow=$cdetail->fetch();$w++){
  $result = $db->prepare("SELECT id,name,marks FROM `section` WHERE paperid=$pid"); 
  $result->execute();      
      for($j=1;$row=$result->fetch();$j++){
        $output .="
        <tr>
            <td>".$j."</td>
            <td>".$crow['cname']."</td>
            <td>".$enroll."</td>
            <td>".$crow['gender']."</td>
            <td>".$crow['dob']."</td>
        </tr>";
      }
    }
  }
      $output .="
      </tbody>      
    </table>";  
  echo $output;
?>