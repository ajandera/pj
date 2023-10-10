<?php
session_start();

require "common.php";

$cn = $_REQUEST["cn"];
$mail = $_REQUEST["mail"];
$locality = $_REQUEST["locality"];
$description = $_REQUEST["description"];
$number = $_REQUEST["number"];
$rowid = $_REQUEST["rowid"];

$updateStmt="update $tableName set meno='$cn', email='$mail', mesto='$locality', popis='$description', telefon='$number' where rowid=$rowid;";

try {
  $stmt = $pdo->prepare("UPDATE ? SET meno = ?, emnail = ?, mesto = ?, popis = ?, telefon = ? where rowid = ?");
  $stmt->bindParam(1, $tableName);
  $stmt->bindParam(2, $cn);
  $stmt->bindParam(3, $mail);
  $stmt->bindParam(4, $locality);
  $stmt->bindParam(5, $description);
  $stmt->bindParam(6, $number);
  $stmt->bindParam(7, $rowid);
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
