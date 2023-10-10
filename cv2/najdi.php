<?php
session_start();

require "common.php";

$cn = $_REQUEST["cn"];
$mail = $_REQUEST["mail"];
$locality = $_REQUEST["locality"];
$description = $_REQUEST["description"];
$number = $_REQUEST["number"];

if(!$cn && !$mail && !$locality && !$description && !$number) {
  if ($_SESSION[lan] == "sk") {
    displayErrMsg("Chyba: Aspon jedno vyhladavacie kriterium musi byt zadane"); returnToMain();
  } else {
    displayErrMsg("Error: At least one of fields must be filled"); returnToMain();
  }
  exit();
}

try {
  $sql = "select * from address WHERE ";
  if ($cn) {
    $sql .= "meno like :meno AND";
  }

  if ($mail) {
    $sql .= "email like :mail AND";
  }
  
  if ($locality) {
    $sql .= "mesto like :loc AND";
  }
  
  if ($description) {
    $sql .= "popis like :desc AND";
  }
  
  if ($number) {
    $sql .= "telefon like :number AND";
  }

  $stmt = $pdo->prepare(rtrim($sql, "AND"));

  if ($cn) {
    $s = '%'.$cn.'%';
    $stmt->bindParam(":meno", $s);
  }
  
  if ($mail) {
    $s = '%'.$mail.'%';
    $stmt->bindParam(":mail", $s);
  }
  
  if ($locality) {
    $s = '%'.$locality.'%';
    $stmt->bindParam(":loc", $s);
  }
  
  if ($description) {
    $s = '%'.$description.'%';
    $stmt->bindParam(":desc", $s);
  }
  
  if ($number) {
    $s = '%'.$number.'%';
    $stmt->bindParam(":number", $s);
  }
  
  $stmt->execute();
  $data = $stmt->fetchAll();
} catch (PDOException $e) {
  displayErrMsg("Error: " . $e->getMessage());
  exit();
}
?>
<h3 align="center"> <?php if ($_SESSION['lan']=="sk") { generateHTMLheader("Vysledky vyhladavania",""); } else { generateHTMLheader("Results",""); }?></h3>

<table class="tab2">
<?php
if ($_SESSION['lan']=="sk") {
   echo "<tr><td>Meno</td><td>E-mail</td><td>Mesto</td><td>Popis</td><td>Tel.cislo</td><td>zmenit/zmazat</td></tr>";
} else {
    echo "<tr><td>Name</td><td>E-mail</td><td>City</td><td>Description</td><td>Phone number</td><td>modify/erase</td></tr>";
}
foreach ($data as $row)
{
  echo"<tr><td>".$row['MENO']."</td><td>".$row['EMAIL']."</td><td>".$row['MESTO']."</td><td>".$row['POPIS'];
  echo "</td><td>".$row['TELEFON']."</td><td><a href=\"uprav.php?rowid=".$row['ROWID']."\">Uprav</a>/<a href=\"zmaz.php?rowid=".$row['ROWID']."\">Zmaz</td>";
}
echo "</table>";
returnToMain();
?>
