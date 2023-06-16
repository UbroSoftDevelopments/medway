<?php
//header('Content-Type: application/json');
include('../config/dbconnection.php');

$res = new stdClass();
$res->msg = "Nothing Happen!";
$res->status = false;
$res->type = 'info';

$REQ_METHOD = $_SERVER['REQUEST_METHOD'];

switch ($REQ_METHOD) {
  case 'GET':
    # code...
    // The request is using the PUT method

    // if (empty($_GET['pid'])) {
    //   http_response_code(201);
    //   $Res->msg = "Error: { pid: null }";
    // } else {
    //   $pid = $_GET['pid'];
    //   $res1 = $db->prepare("SELECT * FROM `order_detail`");
    //   $res1->execute();
    //   $OrderDetail = new stdClass();
    //   while ($row1 = $res1->fetch()) {
    //     $OrderDetail->id = $row1['id'];
    //     $OrderDetail->company_name = $row1['company_name'];
    //     $OrderDetail->full_address = $row1['full_address'];
    //     $OrderDetail->product_name = $row1['product_name'];
    //     $OrderDetail->order_quantity = $row1['order_quantity'];
    //     $OrderDetail->price = $row1['price'];
    //     $OrderDetail->gst = $row1['gst'];

    //   }
    //   $Res->msg = "Success";
    //   $Res->data = $OrderDetail;
    // }

    break;

  case 'POST':
    $data = (file_get_contents('php://input'));

    $fileName = $_FILES["logoimage"]["name"];
    $fileName_tempname = $_FILES["logoimage"]["tmp_name"];
    $targetFilePath = '../reg_candi/' . $fileName;
    $databaseTargetFilePath = '../reg_candi/' . $fileName;
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'png', 'jpeg');
    
    $timezone = "Asia/Calcutta";
    if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
    $todatetime = date('Y-m-d');
    
    $target_dir = "../reg_candi/";
    $target_file = $target_dir . basename($_FILES["logoimage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    // if(isset($_POST["submit"])) {
    //   $check = getimagesize($_FILES["logoimage"]["tmp_name"]);
    //   if($check !== false) {
    //     $res->msg = "File is an image - " . $check["mime"] . ".";
    //     $res->type = "danger";
    //     $uploadOk = 1;
    //   } else {
    //     $res->msg ="File is not an image.";
    //     $res->type = "danger";
    //     $uploadOk = 0;
    //   }
    // }
    
    // Check if file already exists
    if (file_exists($target_file)) {
      $res->msg = "Sorry, file already exists.";
      $res->type = "danger";
      $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["logoimage"]["size"] > 500000) {
      $res->msg = "Sorry, your file is too large.";
      $res->type = "danger";
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      $res->msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $res->type = "danger";
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      $res->msg = "Sorry, your file was not uploaded.";
      $res->type = "danger";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["logoimage"]["tmp_name"], $target_file)) {
    
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
                $insertpic = $newpic->execute(array(':pic' => $databaseTargetFilePath, ':stuid' => $last_id));
    
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
    
                $res->msg = "Registered Successfuly";
                $res->type = "success";
                $res->status = true;
                // echo "<div style='text-align:center;' class='list-group-item list-group-item-success'>Ingredient Added Successfull</div>";
                //header("Location: saved_agent.php");
              } else {
                $res->msg = "Something Went Wrong!";
                $res->type = "danger";
              }
            } else {
              $res->msg = "Not Created!";
              $res->type = "info";
            }
      } else {
        $res->msg = "Sorry, there was an error uploading your file.";
        $res->type = "danger";
        
      }
    
    
    }

    echo  json_encode($res);
    break;

  default:
    # code...
    http_response_code(201);
    $Res->msg = "Request Method Not Allowed";

    break;
}
// echo json_encode($Res,JSON_NUMERIC_CHECK);
