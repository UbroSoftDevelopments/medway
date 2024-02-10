<?php
header("Content-Type: application/xls");    
  header("Content-Disposition: attachment; filename=center.xls");  
  header("Pragma: no-cache"); 
  header("Expires: 0");
    include('config/dbconnection.php');
  $output = "";
  
  $output .="
          <table >
            <thead>
              <tr >                
                <td>Name</td>
                <td>Address</td>
                <td>District</td>
                <td>Pincode</td>
                <td>City</td>
                <td>State</td>
                <td>Capacity</td>
              </tr>
            </thead>
            <tbody>
            ";
    $result = $db->prepare("SELECT * FROM `center`");
      $result->execute();
      
      for($j=1;$row=$result->fetch();$j++){
        $output .="
        <tr>
            <td>".$row['name']."</td>
            <td>".$row['address']."</td>
            <td>".$row['district']."</td>
            <td>".$row['pincode']."</td>
            <td>".$row['city']."</td>
            <td>".$row['state']."</td>
            <td>".$row['capacity']."</td>
        </tr>";
      }
      $output .="
      </tbody>      
    </table>";  
  echo $output;
?>