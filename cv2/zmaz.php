<?php
session_start();

require "common.php";

$rowid = $_REQUEST["rowid"];

try {
  $stmt = $pdo->prepare("DELETE FROM ? WHERE rowid = ?");
  $stmt->bindParam(1, $tableName);
  $stmt->bindParam(2, $rowid);
  $stmt->execute();
} catch (PDOException $e) {
  displayErrMsg("Error: " . $e->getMessage());
  exit();
}

if ($_SESSION['lan'] == "sk") {
  generateHTMLHeader("Zmazanie zaznamu","Zoznam bol uspesne zmazana");
} else {
  generateHTMLHeader("Deleting entry","Entry was deleted successfuly");
}
returnToMain(); 
?>
