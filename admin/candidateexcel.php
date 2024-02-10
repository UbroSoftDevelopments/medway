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
                <td>ShiftId</td>
                <td>Enrollmentno</td>
                <td>Password</td>
                <td>Alloted Time</td>
              </tr>
            </thead>
            <tbody>
            ";
    $result = $db->prepare("SELECT * FROM `examcandidate`");
      $result->execute();
      
      for($j=1;$row=$result->fetch();$j++){
        $output .="
        <tr>
            <td>".$row['candidateid']."</td>
            <td>".$row['shiftid']."</td>
            <td>".$row['enrollmentno']."</td>
            <td>".$row['password']."</td>
            <td>".$row['allotedtime']."</td>
        </tr>";
      }
      $output .="
      </tbody>      
    </table>";  
  echo $output;
?>