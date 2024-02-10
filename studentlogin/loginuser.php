<?php
session_start();
if (isset($_POST['logged'])) {

    define('DB_SERVER', '89.117.188.1');   
   // define('DB_USERNAME', 'u937865059_medway');
   // define('DB_PASSWORD', 'Medway_cbt@12');
   // define('DB_DATABASE', 'u937865059_medexam');
  
     define('DB_USERNAME', 'u937865059_Go_Medway');
     define('DB_PASSWORD', 'Ub_Medwaydb_2!@7');
     define('DB_DATABASE', 'u937865059_medway_db');
  
   //   define('DB_SERVER', 'localhost');   
   //   define('DB_USERNAME', 'root');
   //   define('DB_PASSWORD', '');
   //   define('DB_DATABASE', 'u937865059_medexam');
 
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);


   $myusername = mysqli_real_escape_string($db,$_POST['username']);
   //$mypassword = mysqli_real_escape_string($db,$_POST['password']); 
   
   $sql = "SELECT * FROM examcandidate where enrollmentno = '$myusername'";
   $result = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   //$active = $row['active'];
   
   $count = mysqli_num_rows($result); 
   // If result matched $myusername and $mypassword, table row must be 1 row
     
   if($count >= 1) {
    //   session_register("myusername");
      $_SESSION['id']  = $row['candidateid'];
      $_SESSION['rollno'] = $myusername;
      $_SESSION['setno'] = $row['setno'];
      header("Location: dashboard.php");
   }else {
      echo "Your Enrollment Number is invalid";
      header("Location: index.php");
   }
    
}

?>