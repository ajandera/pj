<?php
session_start();

require "common.php";

$rowid = $_REQUEST["rowid"];

try {
  $stmt = $pdo->prepare("SELECT * from address where ROWID = ?");
  $stmt->bindParam(1, $rowid);
  $stmt->execute();
  $row = $stmt->fetch();
} catch (PDOException $e) {
  displayErrMsg("Error: " . $e->getMessage());
  exit();
}

if ($_SESSION['lan'] == "sk") {
  generateHTMLHeader("Zmena udajov","Prosim modifikujte polia");
} else {
  generateHTMLHeader("Entry modification","Please modify fields");
}

$resultEntry["id"]=$row['ROWID'];
$resultEntry["cn"]=$row['MENO'];
$resultEntry["mail"]=$row['EMAIL'];
$resultEntry["locality"]=$row['MESTO'];
$resultEntry["description"]=$row['POPIS'];
$resultEntry["number"]=$row['TELEFON'];


if ($_SESSION['lan']=="sk") {
  generateHtmlForm($resultEntry,"update.php?rowid=$rowid","ZMEN");
} else {
  generateHtmlForm($resultEntry,"update.php?rowid=$rowid","MODIFY");
}
?>
