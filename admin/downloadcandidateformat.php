<?php

// Excel file name for download 
$fileName = "Candidate Excel_" . date('Y-m-d') . ".xls"; 
$excelData = "";

// Column names 
$fields = array('Candidate Name', 'Roll Number', 'Dob', 'Category', 'Gender', 'Photo', 'Signature', 'Center Code'); 
 
// Display column names as first row 
$excelData .= implode("\t", array_values($fields)) . "\n"; 

$sql = $db->prepare("SELECT * FROM `question` WHERE pprid = $pid");
$sql->execute();
for($i=0;$row=$sql->fetch();$i++){

}
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 

// Render excel data 
echo $excelData; 
 
exit;

?>