<?php
session_start();

require "common.php";

$cn = $_REQUEST["cn"];
$mail = $_REQUEST["mail"];
$locality = $_REQUEST["locality"];
$description = $_REQUEST["description"];
$number = $_REQUEST["number"];
$rowid = $_REQUEST["rowid"];



try {
  $stmt = $pdo->prepare("UPDATE address SET meno = ?, email = ?, mesto = ?, popis = ?, telefon = ? where rowid = ?");
  $stmt->bindParam(1, $cn);
  $stmt->bindParam(2, $mail);
  $stmt->bindParam(3, $locality);
  $stmt->bindParam(4, $description);
  $stmt->bindParam(5, $number);
  $stmt->bindParam(6, $rowid);
  $stmt->execute();
} catch (PDOException $e) {
  displayErrMsg("Error: " . $e->getMessage());
  exit();
}

if ($_SESSION['lan'] == "sk") {
  generateHTMLHeader("Uprava udajov","Zoznam bol upravene uspesne");
} else {
  generateHTMLHeader("Entry modification","Entry was modificated successfuly");
}
returnToMain();
