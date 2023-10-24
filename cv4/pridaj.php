<?php
session_start();

require "common.php";
 
$cn = $_REQUEST["cn"];
$mail = $_REQUEST["mail"];
$locality = $_REQUEST["locality"];
$description = $_REQUEST["description"];
$number = $_REQUEST["number"];

// check if values are filles
if(!$cn || !$mail || !$locality || !$description || !$number) {
  if ($_SESSION['lan']=="sk") { 
    displayErrMsg("Error: Vsetky polia musia byt vyplnene!");
  } else {
    displayErrMsg("Error: All fields must be filled!");
  }
  returnToMain();
  exit();
}

// check email format
$pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
if (!preg_match($pattern, $mail)) {
    displayErrMsg("Ypur inserted email is not in valid format.");
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
