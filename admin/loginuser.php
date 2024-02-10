<?php
session_start();
if (isset($_POST['logged'])) {
 
 define('DB_SERVER', 'localhost');   
 // define('DB_USERNAME', 'u937865059_medway');
 // define('DB_PASSWORD', 'Medway_cbt@12');
 // define('DB_DATABASE', 'u937865059_medexam');

   // define('DB_USERNAME', 'u937865059_Go_Medway');
   // define('DB_PASSWORD', 'Ub_Medwaydb_2!@7');
   // define('DB_DATABASE', 'u937865059_medway_db');

   // define('DB_SERVER', 'localhost');   
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'u937865059_medexam');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);


//    $host = "bitsensedbmysql.mysql.database.azure.com";
//    $dbname = "u937865059_medwayexam";
//    $username = "bitsensedbadmin";
//    $password = "@Azure_Database@2023";
   

// //Establishes the connection
// $db = mysqli_init();
// mysqli_ssl_set($db,NULL,NULL, "DigiCertGlobalRootCA.crt.pem", NULL, NULL);
// mysqli_real_connect($db, $host, $username, $password, $dbname, 3306);
// if (mysqli_connect_errno()) {
// die('Failed to connect to MySQL: '.mysqli_connect_error());
// }else{
//    echo "connect";
// }
   
   $myusername = mysqli_real_escape_string($db,$_POST['username']);
   $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
   
   $sql = "SELECT * FROM siteuser WHERE email = '$myusername' AND password='$mypassword'";
   $result = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   //$active = $row['active'];
   
   $count = mysqli_num_rows($result);
   
   // If result matched $myusername and $mypassword, table row must be 1 row
     
   if($count == 1) {
    //   session_register("myusername");
      $_SESSION['id']  = $row['id'];
      $_SESSION['useremail'] = $myusername;
      $_SESSION['username'] = $row['username'];
      header("Location: ubexam.php");
   }else {
      $error = "Your Login Name or Password is invalid";
      header("Location: index.php");
   }
    
}

?>