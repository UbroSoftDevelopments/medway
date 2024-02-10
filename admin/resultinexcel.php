<?php 
// Load the database configuration file 
$pid = $_GET['psid'];
//$cat = $_POST['cat'];
include('config/dbconnection.php');
 
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "Candidate_Result_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('ID', 'ENROLLMENT NO', 'NAME', 'GENDER', 'CATEGORY', 'MARKS', 'PERCENTAGE'. 'STATUS'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
    $querys = $db->query("SELECT id, (SELECT sum(marks) FROM section where paperid = $pid) as ttlmark FROM `papershift` ps where paperid = $pid"); 
    $rows = $querys->fetch();
    $psid = $rows['id'];
      $query = $db->query("SELECT *, (SELECT name from candidate where id=pr.candidateid) cname,
                          (SELECT dob from candidate where id=pr.candidateid) dob,
                          (SELECT gender from candidate where id=pr.candidateid) gender
                          FROM `processedresult` pr where papershiftid = $psid ORDER BY percentage DESC");
      if($query->rowCount() > 0){ 
  

    // Output each row of the data 
    for($i=1;$row = $query->fetch();$i++){ 
        //$status = ($row['status'] == 1)?'Active':'Inactive'; 
        $lineData = array($i, $row['enrollment'],
                              $row['cname'],
                            //   $row['dob'],
                              $row['gender'], 
                              $row['category'], 
                              $row['markobtained'] . ' / ' . $rows['ttlmark'],
                              $row['percentage'].'%',
                              $row['status']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;