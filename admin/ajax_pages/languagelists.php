<?php 

$pid = $_POST['psid'];

 include('../config/dbconnection.php');
 $result = $db->prepare("SELECT * FROM languagemaster where pid=$pid ");
   $result->execute();
   for($j=1;$row=$result->fetch();$j++){
       ?>
       <tr>
       <th scope="row"><?php echo $j; ?></th>
       <td><?php echo $row['language']; ?></td>
       <!-- <td><button class="btn btn-primary" onclick="editlang(<?php //echo $row['id'] ?>)">Edit</button></td>
       <td><button class="btn btn-primary" onclick="deletelang(<?php //echo $row['id'] ?>)">Delete</button></td> -->
     </tr>
   <?php }

?>

    

   


