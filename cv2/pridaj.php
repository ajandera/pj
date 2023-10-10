<?php
session_start();

require "common.php";
 
$cn = $_REQUEST["cn"];
$mail = $_REQUEST["mail"];
$locality = $_REQUEST["locality"];
$description = $_REQUEST["description"];
$number = $_REQUEST["number"];
if(!$cn || !$mail || !$locality || !$description || !$number) {
  if ($_SESSION['lan']=="sk") {
    GenerateHTMLHeader("Pridavanie zaznamu","Zoznam nebol pridany");
  } else {
    GenerateHTMLHeader("Adding entry","The entry was not added");
  }
  if ($_SESSION['lan']=="sk") { 
    displayErrMsg("Error: Vsetky polia musia byt vyplnene!");
  } else {
    displayErrMsg("Error: All fields must be filled!");
  }
  returnToMain();
  exit();
}

try {
  $stmt = $pdo->prepare("INSERT INTO address (MENO, EMAIL, MESTO, POPIS, TELEFON) VALUES(?,?,?,?,?)");
  $stmt->bindParam(1, $cn);
  $stmt->bindParam(2, $mail);
  $stmt->bindParam(3, $locality);
  $stmt->bindParam(4, $description);
  $stmt->bindParam(5, $number);
  $stmt->execute();
} catch (PDOException $e) {
  displayErrMsg("Error: " . $e->getMessage());
  exit();
}

if ($_SESSION['lan']=="sk") {
  generateHTMLHeader("Pridavanie zoznamu","Zoznam bol pridany uspesne");
  returnToMain();
} else {
  generateHTMLHeader("Adding entry","Entry was added successfuly");
  returnToMain();
}

?>
