<?php
include('../config/dbconnection.php');

$stime = $_POST['psid'];
$center = $_POST['center'];

$result = $db->prepare("SELECT (SELECT `ttlset` from `papermaster` where id=ps.paperid) ttlset FROM `papershift` ps WHERE id=$stime");
$result->execute();
$row = $result->fetch();
$tset = $row['ttlset'];

$results = $db->prepare("SELECT id FROM `examcandidate` WHERE papershiftid=$stime and centercode = '$center'");
$results->execute();
for ($i = 1; $rows = $results->fetch(); $i++) {
  $id = $rows['id'];
  $update = $db->query("UPDATE `examcandidate` set `setno` = $tset WHERE id=$id");
  if ($update) {
    echo "<div style='color:#990000' class='alert alert-success' role='alert'>Shift Created</div>";
  }
  $tset--;
  if ($tset == 0) {
    $tset = $row['ttlset'];
  }
}
