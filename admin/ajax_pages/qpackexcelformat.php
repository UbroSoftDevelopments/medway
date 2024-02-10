<?php 
// Load the database configuration file 

$list = $_POST['dt'];
//include('../config/dbconnection.php');
 
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "Qpack_" . date('Y-m-d') . ".xlsx"; 
 
// Column names 
$fields = array('QID', 'TYPE', 'MM', 'NM', 'Question', 'Option_A', 'Option_B', 'Option_C', 'Option_D', 'Op_Id_1', 'Op_Id_2', 'Op_Id_3', 'Op_Id_4'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
    
    // Output each row of the data 
    // print_r($data);
    // return;
    for($i=0;$i<count($list);$i++){
        //  echo $row;
        $lineData = array($list[$i]['ID'], 
                          $list[$i]['TYPE'],
                          $list[$i]['MM'],
                          $list[$i]['NM'], 
                          '','','','','','',
                          $list[$i]['Op_Id_1'],
                          $list[$i]['Op_Id_2'],
                          $list[$i]['Op_Id_3'],
                          $list[$i]['Op_Id_4']
                        ); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
      }
 
      // $fileName = "QPack_" . date('Y-m-d') . ".xls"; 
 

//Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;