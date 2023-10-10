<?php
session_start();

include "spoj.php";
include "common.php";

$cn = $_REQUEST["cn"];
$mail = $_REQUEST["mail"];
$locality = $_REQUEST["locality"];
$description = $_REQUEST["description"];
$number = $_REQUEST["number"];
$rowid = $_REQUEST["rowid"];
$updateStmt="update $tableName set meno='$cn', email='$mail', mesto='$locality', popis='$description', telefon='$number' where rowid=$rowid;";

if(!mysql_query($updateStmt))
{
  DisplayErrMsg("chyba vo vykonávani <b>$updateStmt</b>");
  exit();
}

if ($_SESSION['lan']=="sk") GenerateHTMLHeader("Úprava údajov","Záznam bol upravený úspešne");
else GenerateHTMLHeader("Entry modification","Entry was modificated successfuly");
ReturnToMain();
?>
