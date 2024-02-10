<?php

include('../config/dbconnection.php');
$todatetime = date('Y-m-d');
$mobile = trim($_POST['contact_value'][0]);
$pprid = trim($_POST['course']);
$query = $db->query("SELECT * FROM candidate inner join contacts on candidate.id = contacts.candidateid
where contacts.contact_value = '$mobile' and candidate.pprid = $pprid ");
if ($query->rowCount() > 0) {
  // $prow = $query->fetch();
  // $pid = $prow['pprid'];
  // //echo "d".$pid;
  // if($pid == $pprid ){
  echo "404";
  //} 

} 
else {
  $sql = "INSERT INTO `candidate`(`pprid`, `name`, `dob`, `gender`, `created_at`) VALUES
              (:pid, :s_name, :dob, :gender, :crdt)";
  $r = $db->prepare($sql);
  $insertvisitor = $r->execute(array(
    ':pid' => $_POST['course'], ':s_name' => $_POST['fname'] . " " . $_POST['lname'], ':dob' => $_POST['dob'], ':gender' => $_POST['gender'], ':crdt' => $todatetime
  ));
  if ($insertvisitor) {
    // echo "<div style='text-align:center;' class='list-group-item list-group-item-success'>Added Successfull</div>";
    $last_id = $db->lastInsertId();
    $reg_no = date('Y') . str_pad($last_id, 4, '0', STR_PAD_LEFT);
    $updatesql = $db->query("UPDATE `candidate` SET `reg_no` = '$reg_no' WHERE id = $last_id");
    $updatesql->execute();
    // echo "<div style='text-align:center;' class='list-group-item list-group-item-success'>Product Added Successfull</div>".$last_id;

    $sqling = "INSERT INTO `academicmaster`(`candidateid`, `academicname`, `passingyear`) VALUES (:stuid, :acd_nm, :passyear)";
    $newing = $db->prepare($sqling);
    $inserting = $newing->execute(array(':stuid' => $last_id, ':acd_nm' => $_POST['college'], ':passyear' => $_POST['y_o_p']));
    if ($inserting) {

      $sqlphoto = "INSERT INTO `candidatephotomaster`(`photo`, `signature`, `candidateid`) VALUES (:pic, :sig, :stuid)";
      $newpic = $db->prepare($sqlphoto);
      $insertpic = $newpic->execute(array(':pic' => $_POST['exlogo'], ':sig' => $_POST['exlogo'], ':stuid' => $reg_no));

      for ($i = 0; $i < 2; $i++) {

        $c_type = $_POST['contact_type'][$i];
        $c_value = $_POST['contact_value'][$i];
        $sqls = "INSERT INTO `contacts`(`contact_type`, `candidateid`, `contact_value`) VALUES (:ctype, :studentid, :cval)";
        $user = $db->prepare($sqls);
        $insert = $user->execute(array(':ctype' => $c_type, ':studentid' => $last_id, ':cval' => $c_value));
        // if($insert) {
        //   echo "<div class='list-group-item list-group-item-danger'>Contact !!</div>";  
        // }
      }

      // for ($j = 0; $j < 1; $j++) {

      //   $add_type = $_POST['add_type'][$j];
      //   $add_value = $_POST['address'][$j];
      //   $city = $_POST['city'];
      //   $pin = $_POST['pincode'];
      //   $state = $_POST['state'];
      //   $country = $_POST['country_nm'];
      //   $sqls = "INSERT INTO `address`(`addtype`, `address`, `district`, `pincode`, `city`, `state`, `country`, `candidateiid`)
      //               VALUES (:atype, :addres, :dist, :pin, :city, :stat, :country, :stuid )";
      //   $user = $db->prepare($sqls);
      //   $insert = $user->execute(array(
      //     ':atype' => $add_type, ':addres' => $add_value, ':dist' => $city,
      //     ':pin' => $pin, ':city' => $city, ':stat' => $state, ':country' => $country, ':stuid' => $last_id
      //   ));
      //   // if($insert) {
      //   //   echo "<div class='list-group-item list-group-item-danger'>Address!!</div>";  
      //   // }
      // }
    } else {
      echo "Something Went Wrong!";
    }
    echo $last_id;
    //header("Location: preview.php?reg_id=".$last_id);
    //  echo "<div style='text-align:center;' class='list-group-item list-group-item-success'>Added Successfull</div>";
  } else {
    echo "Not Registered Successfuly";
  //}
}
}
$db = null;
