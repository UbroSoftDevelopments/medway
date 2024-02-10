<?php
header("Content-Type: application/xls");    
  header("Content-Disposition: attachment; filename=center.xls");  
  header("Pragma: no-cache"); 
  header("Expires: 0");
    include('../config/dbconnection.php');
    $pid=$_POST['pid'];
    $sid=$_POST['sid'];
  $output = "";
  
  $output .="
          <table >
            <thead>
              <tr >                
                <td>Center Id</td>
                <td>Center Name</td>
                <td>Paper Id</td>
                <td>Paper Name</td>
                <td>Shift Id</td>
                <td>Shift Time</td>
                <td>Activation Key</td>
                <td>Username</td>
                <td>Password</td>
              </tr>
            </thead>
            <tbody>
            ";
    $result = $db->prepare("SELECT id,name,(SELECT papername FROM papermaster where id = $pid) pname,(SELECT starttime FROM shiftmaster where id=$sid) stime FROM `center`");
      $result->execute();
      
      for($j=1;$row=$result->fetch();$j++){
        $output .="
        <tr>
            <td>".$row['id']."</td>
            <td>".$row['name']."</td>
            <td>".$pid."</td>
            <td>".$row['pname']."</td>
            <td>".$sid."</td>
            <td>".$row['stime']."</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>";
      }
      $output .="
      </tbody>      
    </table>";  
  echo $output;
?>