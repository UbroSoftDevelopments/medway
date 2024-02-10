<?php

//fetch_qpack.php

include('../config/dbconnection.php');

$psid = $_POST['psid'];
$result = $db->prepare("SELECT COUNT(id) FROM `question` WHERE papershiftid  = $psid");
      $result->execute();
      $row=$result->fetch();
      echo $row['count'] .' / '. $row['ttl'];
?>
