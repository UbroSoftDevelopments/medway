<?php

    include('../config/dbconnection.php');

    
    $list = $_POST['imageList'];


    for($i=0;$i<count($list);$i++){

    $en = $list[$i]['enroll'];
    $photo = $list[$i]['sign'];

            $insert = $db->query("UPDATE `candidatephotomaster` SET `signature`='$photo' WHERE candidateid='$en'"); 
                if(!$insert){             
                    echo "Data not  Inserted";
                }
 
            }
            echo "Sign Uploaded Successfully";

?>