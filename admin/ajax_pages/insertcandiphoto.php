<?php
    include('../config/dbconnection.php');

    
    $list = $_POST['imageList'];


    for($i=0;$i<count($list);$i++){

    $en = $list[$i]['enroll'];
    $photo = $list[$i]['photo'];

    $insert = $db->query("UPDATE `candidatephotomaster` SET `photo`='$photo' WHERE candidateid='$en'"); 
                if(!$insert){             
                    echo "Data not  Inserted";
                }
 
            }
            echo "Photo Uploaded Succssfully";

?>