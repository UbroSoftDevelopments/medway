<?php
include('../config/dbconnection.php');
$exid = $_POST['exid'];
$pid = $_POST['pid'];
$pdt = $_POST['pdt'];
$status = 1;
$jsondt = $_POST['jsondt'];
$msg="";
// Extracting row by row
foreach($jsondt as $row) {
  $code = $row['Center Code'];
  $userid = $row['User id'];
  $password = $row['Password'];
  // $query = $db->query("SELECT * FROM `center` where userid='$userid' and `password` = '$password' and paperid = $pid and paperdate = '$pdt' and examid = $exid");
  $query = $db->query("SELECT * FROM `center` where userid='$userid'");
if($query->rowCount() > 0){ 
  $msg ="Not";
}else{
      // if( $city!=''){
      $sql = "INSERT INTO `center`(`name`, `address`, `userid`, `password`, `pincode`, 
            `city`, `state`, `code`, `capacity`, `examid`, `paperid`, `paperdate`, `status`) VALUES
            (:cname,:adr,:userid,:pass,:pin,:city,:states,:code,:cap,:exid,:pid,:pdt,:sts)";
        $r = $db->prepare($sql);
        $insertvisitor = $r->execute(array(':cname'=>$row['Name of the Test Centre'], ':adr'=>$row['Address of the Test Centre'],
         ':userid'=>$row['User id'], ':pass'=> $row['Password'], ':pin'=>$row['PIN Code'], ':city'=>$row['City'], ':states'=>$row['State'],
          ':code'=>$row['Center Code'], ':cap'=>$row['Scheduling'], ':exid'=>$exid, ':pid'=>$pid, ':pdt'=>$pdt, ':sts'=>$status));       
        if($insertvisitor){  
          $msg = "Center Inserted";
          $update = $db->query("UPDATE `ub_status` SET `center`= 1 WHERE examid = $exid");
          $update->execute();
          }else{ 
          $msg = "Center Not Inserted"; 
      }          
    }
}
echo $msg;
   
?>