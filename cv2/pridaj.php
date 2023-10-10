<?php
session_start();

 include"common.php";
 include "spoj.php";
$cn = $_REQUEST["cn"];
$mail = $_REQUEST["mail"];
$locality = $_REQUEST["locality"];
$description = $_REQUEST["description"];
$number = $_REQUEST["number"];
 $addStmt = "insert into $tableName(MENO, EMAIL, MESTO, POPIS,
TELEFON) values('$cn','$mail','$locality','$description','$number');";

 if(!$cn || !$mail || !$locality || !$description || !$number) {
  if ($_SESSION['lan']=="sk") GenerateHTMLHeader("Pridávanie záznamu","Záznam nebol pridaný");
  else GenerateHTMLHeader("Adding entry","The entry was not added");
  if ($_SESSION['lan']=="sk") DisplayErrMsg("Error: Všetky polia musia by vyplnené!");
  else DisplayErrMsg("Error: All fields must be filled!");
  ReturnToMain();
  exit();
 }


if(!mysql_query($addStmt))
 {
  DisplayErrMsg("chyba vo vykonávani <b>$addStmt</b>");
  exit();
}

 if ($_SESSION['lan']=="sk") GenerateHTMLHeader("Pridávanie záznamu","Záznam bol pridaný úspešne");
 else GenerateHTMLHeader("Adding entry","Entry was added successfuly");
 ReturnToMain();

?>
