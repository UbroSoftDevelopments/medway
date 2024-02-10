<?php 


// Excel file name for download 
$fileName = "Center Excel_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('Center Code', 'User id', 'Password', 'State', 'City', 'Name of the Test Centre', 'Address of the Test Centre', 'PIN Code', 'Scheduling'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 

// Render excel data 
echo $excelData; 
 
exit;

?>