<?php
    include('../config/dbconnection.php');

    if(!empty($_FILES["qimage"]["name"])) { 
        $secid = $_POST['choosesection'];
        $result = $db->prepare("SELECT totalquestion,(SELECT count(*) from question where secid = $secid) as seccnt  FROM `section` WHERE id = $secid");
        $result->execute();
        $row = $result->fetch();
        
        if($row['seccnt'] < $row['totalquestion']){

        // Get file info 
        $fileName = basename($_FILES["qimage"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['qimage']['tmp_name']; 
            $data = file_get_contents($image); 
            $imgContent = base64_encode($data);
                    
       $sql = "INSERT INTO `question`(`type`, `question`, `secid`, `papershiftid`, `mm`, `nm`) VALUES (:type,:quess,:sid,:pprshiftid,:mm,:nm)";
              $r = $db->prepare($sql);
               $insertvisitor = $r->execute(array( ':type'=> 1, ':quess'=>$imgContent, ':sid'=>$_POST['choosesection'] , ':pprshiftid'=>$_POST['chooseshift'], ':mm'=> $_POST['mm'], ':nm'=>$_POST['nm']));             
            if($insertvisitor){ 
              $last_id = $db->lastInsertId();    
                if(count($_FILES["image"]["tmp_name"]) > 0)
                {
                 for($count = 0; $count < count($_FILES["image"]["tmp_name"]); $count++)
                 {
                  $opdata = file_get_contents($_FILES["image"]["tmp_name"][$count]);
                  $image_file = base64_encode($opdata);
                  $query = "INSERT INTO `options`(`qid`, `oPtion`, `iscorrect`) VALUES ($last_id, '$image_file',0)";
                  $statement = $db->prepare($query);
                  $statement->execute();
                 }
                }  
            $age = array("status"=>true, "message"=>"Question Successfully Uploaded", "data"=>$last_id);
            echo json_encode($age);
        }else{ 
            
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
            $age = array("status"=>false, "message"=>$statusMsg, "data"=>"");
            echo json_encode($age);
        } 
    }
    }else{
        $age = array("status"=>false, "message"=>"Reach Limit.", "data"=>"");
        echo json_encode($age);
    
    }
}



?>