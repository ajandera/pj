<?php
session_start();

include "common.php";
include "spoj.php";

$rowid = $_REQUEST["rowid"];
$deleteStmt="delete from $tableName where rowid=$rowid";

if(!mysql_query($deleteStmt)){
  DisplayErrMsg("chyba vo vykon�van� $deleteStmt stmt");
  exit();
}
if ($_SESSION['lan']=="sk") GenerateHTMLHeader("Zmazanie z�znamu","Z�znam bol �spe�ne zmazan�");
else GenerateHTMLHeader("Deleting entry","Entry was deleted successfuly");
ReturnToMain(); 
?>
