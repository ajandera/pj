<?php
session_start();

include"common.php";
include "spoj.php";

$rowid = $_REQUEST["rowid"];
$selectStmt ="select * from $tableName where rowid=$rowid";

if(!($result=mysql_query($selectStmt)))
 {
  DisplayErrMsg("chyba vo vykon�van� $selectStmt stmt");
  exit();
}

if ($_SESSION['lan']=="sk") GenerateHTMLHeader("Zmena �dajov","Pros�m modifikujte polia");
else GenerateHTMLHeader("Entry modification","Please modify fields");
if(!($row=mysql_fetch_object($result))){
  if ($_SESSION['lan']=="sk") DisplayErrMsg("Intern� chyba : z�znam neexistuje");
  else DisplayErrMsg("Internal error : entry not found");
  exit();
}
$resultEntry["id"]=$row->ROWID;
$resultEntry["cn"]=$row->MENO;
$resultEntry["mail"]=$row->EMAIL;
$resultEntry["locality"]=$row->MESTO;
$resultEntry["description"]=$row->POPIS;
$resultEntry["number"]=$row->TELEFON;


if ($_SESSION['lan']=="sk") GenerateHtmlForm($resultEntry,"update.php?rowid=$rowid","ZMEN");
else GenerateHtmlForm($resultEntry,"update.php?rowid=$rowid","MODIFY");
mysql_free_result($result);
?>
