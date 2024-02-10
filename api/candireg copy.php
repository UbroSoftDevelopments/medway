<?php

include('../config/dbconnection.php');

$timezone = "Asia/Calcutta";
if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
$todatetime = date('Y-m-d');

$i_profile = "../reg_candi/" . $_FILES["logoimage"]["name"];
$target_dirs = "../reg_candi/";
$target_files = $target_dirs . basename($_FILES["logoimage"]["name"]);
$uploadOks = 1;
$imageFileTypes = strtolower(pathinfo($target_files, PATHINFO_EXTENSION));


// $check = getimagesize($_FILES["logoimage"]["tmp_name"]);
// if ($check !== false) {
//   echo "File is an image - " . $check["mime"] . ".";
//   $uploadOk = 1;
// } else {
//   echo "File is not an image.";
//   $uploadOk = 0;
// }

if ($_FILES["logoimage"]["size"] > 2000000) {
  echo "Sorry, your file is too large, Upload less than 2 MB.";
  $uploadOk = 0;
}

if ($imageFileTypes != "jpg" && $imageFileTypes != "png" && $imageFileTypes != "jpeg") {
  echo "Sorry, only JPG, JPEG & PNG files are allowed.";
  $uploadOks = 0;
}
if ($uploadOks == 0) {
   echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["logoimage"]["tmp_name"], $target_files)) {
    // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    // echo  "The file ". basename( $_FILES["logoimage"]["name"]). " has been uploaded.";


    try {

      $sql = "INSERT INTO `candidate`(`pprid`, `name`, `dob`, `gender`, `category`, `father_name`, `mother_name`,`created_at`) VALUES
              (:pid,:s_name,:dob, :gender, :reserve, :f_name, :m_name,:crdt)";
      $r = $db->prepare($sql);
      $insertvisitor = $r->execute(array(
        ':pid' => $_POST['course'], ':s_name' => $_POST['fname'] . " " . $_POST['lname'], ':dob' => $_POST['dob'], ':gender' => $_POST['gender'], ':reserve' => $_POST['reserve'], ':f_name' => $_POST['f_name'], ':m_name' => $_POST['m_name'],
        ':crdt' => $todatetime
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

          $sqlphoto = "INSERT INTO `candidatephotomaster`(`photo`, `candidateid`) VALUES (:pic, :stuid)";
          $newpic = $db->prepare($sqlphoto);
          $insertpic = $newpic->execute(array(':pic' => $i_profile, ':stuid' => $reg_no));

          for ($i = 0; $i < 5; $i++) {

            $c_type = $_POST['contact_type'][$i];
            $c_value = $_POST['contact_value'][$i];
            $sqls = "INSERT INTO `contacts`(`contact_type`, `candidateid`, `contact_value`) VALUES (:ctype, :studentid, :cval)";
            $user = $db->prepare($sqls);
            $insert = $user->execute(array(':ctype' => $c_type, ':studentid' => $last_id, ':cval' => $c_value));
            // if($insert) {
            //   echo "<div class='list-group-item list-group-item-danger'>Contact !!</div>";  
            // }
          }

          for ($j = 0; $j < 2; $j++) {

            $add_type = $_POST['add_type'][$j];
            $add_value = $_POST['address'][$j];
            $city = $_POST['city'];
            $pin = $_POST['pincode'];
            $state = $_POST['state'];
            $country = $_POST['country_nm'];
            $sqls = "INSERT INTO `address`(`addtype`, `address`, `district`, `pincode`, `city`, `state`, `country`, `candidateiid`)
                        VALUES (:atype, :addres, :dist, :pin, :city, :stat, :country, :stuid )";
            $user = $db->prepare($sqls);
            $insert = $user->execute(array(
              ':atype' => $add_type, ':addres' => $add_value, ':dist' => $city,
              ':pin' => $pin, ':city' => $city, ':stat' => $state, ':country' => $country, ':stuid' => $last_id
            ));
            // if($insert) {
            //   echo "<div class='list-group-item list-group-item-danger'>Address!!</div>";  
            // }
          }
        } else {
          echo "Something Went Wrong!";
        }
         echo $last_id;
        //header("Location: preview.php?reg_id=".$last_id);
      //  echo "<div style='text-align:center;' class='list-group-item list-group-item-success'>Added Successfull</div>";
      } else {
        echo "Not Registered Successfuly";
      }
      $db = null;
    } catch (PDOException $e) {
      echo "Sorry, there was an error uploading your file.";
    }
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>