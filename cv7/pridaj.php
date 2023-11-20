<?php

require "common.php";
 
$cn = $_REQUEST["cn"];
$mail = $_REQUEST["mail"];
$locality = $_REQUEST["locality"];
$description = $_REQUEST["description"];
$number = $_REQUEST["number"];
if(!$cn || !$mail || !$locality || !$description || !$number) {
  if ($_SESSION['lan']=="sk") {
    echo json_encode(["success" => false, "message" => "Zoznam nebol pridany"]);
  } else {
    echo json_encode(["success" => false, "message" => "The entry was not added"]);
  }
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
  echo json_encode(["success" => true, "message" => "Zaznam bol pridany"]);
} catch (PDOException $e) {
  echo json_encode(["success" => false, "message" => $e->getMessage()]);
  exit();
}

?>
