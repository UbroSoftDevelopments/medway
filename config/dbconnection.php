<?php
/* Database config */
$db_host = '89.117.188.1';
$db_database = 'u937865059_medway_cbt';
$db_user = 'u937865059_medway_cbt';
$db_pass = 'Medway_cbt@1';
// $db_database = 'u937865059_Healdiway';
// $db_user = 'u937865059_Healdiway';
// $db_pass = 'Healdiway@123';
/* End config */
$db = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
date_default_timezone_set('Asia/Kolkata');
?>

