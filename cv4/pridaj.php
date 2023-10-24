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
    displayErrMsg("Your inserted email is not in valid format.");
    returnToMain();
    exit();
}

// validate phone number

// simple validation
//if (strlen($number) !== 13 && substr($number, 0,3) !== "+421") {
//  displayErrMsg("Your inserted phone is not in valid format. Begin with +421 ...");
//  returnToMain();
//  exit();
//}


// better validation
$patternNumber = '/^(\+421|00421|0)(\s?\d{3}\s?\d{3}\s?\d{3}|\d{2}\s?\d{2}\s?\d{2}\s?\d{2})$/';

if (preg_match($patternNumber, $number)) {
    displayErrMsg("Your inserted phone is not in valid format. Begin with +421 ...");
    returnToMain();
    exit();
}


// divide name to name and surname
$preName = preg_split('/\s+/', $cn);
$name = $preName[0];
$surnname = $preName[1];

// other option
// $preName = explode(' ', $cn);
// $name = $preName[0];
// $surnname = $preName[1];

try {
  $stmt = $pdo->prepare("INSERT INTO address (MENO, PRIEZVISKO, EMAIL, MESTO, POPIS, TELEFON) VALUES(?,?,?,?,?,?)");
  $stmt->bindParam(1, $name);
  $stmt->bindParam(2, $surname);
  $stmt->bindParam(3, $mail);
  $stmt->bindParam(4, $locality);
  $stmt->bindParam(5, $description);
  $stmt->bindParam(6, $number);
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
