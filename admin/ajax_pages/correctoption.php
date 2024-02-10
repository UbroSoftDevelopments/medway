<?php

//fetch_images.php

include('../config/dbconnection.php');

$id = $_POST['a'];
$qid = $_POST['b'];
$inserts = $db->query("UPDATE `options` set `iscorrect` = 0 WHERE qid = $qid"); 
if($inserts){ 
        $insert = $db->query("UPDATE `options` set `iscorrect` = 1 WHERE id = $id"); 
        // $status = 'success'; 
        if($insert){            
         $age = array("status"=>true, "message"=>"Successfully Done");
         echo json_encode($age);
        }else{ 
         $age = array("status"=>false, "message"=>"Failed");
         echo json_encode($age);
        }       
       }else{ 
        $age = array("status"=>false, "message"=>"Failedsssss");
        echo json_encode($age);
       }

?>
