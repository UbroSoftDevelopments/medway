<?php
/* Database config */

//  $db_host = 'localhost';
//  $db_database = 'u937865059_medexam';
//  $db_user = 'root';
//  $db_pass = '';

   $db_host = '89.117.188.1';
//  $db_host = 'localhost';
//  $db_database = 'u937865059_medexam';
//  $db_user = 'u937865059_medway';
//  $db_pass = 'Medway_cbt@12';
$db_database = 'u937865059_medway_db';
$db_user = 'u937865059_Go_Medway';
$db_pass = 'Ub_Medwaydb_2!@7';

// /* End config */

$db = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

date_default_timezone_set('Asia/Kolkata');
?>

