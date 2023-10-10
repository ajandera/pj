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
    displayErrMsg("Chyba: Aspon jedno vyhyadlvacie kriterium musi byt zadane"); returnToMain();
  } else {
    displayErrMsg("Error: At least one of fields must be filled"); returnToMain();
  }
  exit();
}

try {
  $stmt = $pdo->prepare("select * from ?");
  $stmt->bindParam(1, $tableName);

  if ($cn) {
    $stmt->where("meno like :meno");
    $stmt->bindParam(":meno", '%'.$cn.'%');
  }
  
  if ($mail) {
    $stmt->where("email like :mail");
    $stmt->bindParam(":mail", '%'.$mail.'%');
  }
  
  if ($locality) {
    $stmt->where("mesto like :loc");
    $stmt->bindParam(":loc", '%'.$mail.'%');
  }
  
  if ($description) {
    $stmt->where("popis like :desc");
    $stmt->bindParam(":desc", '%'.$description.'%');
  }
  
  if ($number) {
    $stmt->where("telefon like :number");
    $stmt->bindParam(":number", '%'.$number.'%');
  }
  
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  displayErrMsg("Error: " . $e->getMessage());
  exit();
}
?>
<h3 align="center"> <?php if ($_SESSION['lan']=="sk") { generateHTMLheader("V�sledky vyh�ad�vania",""); } else { generateHTMLheader("Results",""); }?></h3>

<table class="tab2">
<?php
if ($_SESSION['lan']=="sk") {
   echo "<tr><td>Meno</td><td>E-mail</td><td>Mesto</td><td>Popis</td><td>Tel.cislo</td><td>zmenit/zmazat</td></tr>";
} else {
    echo "<tr><td>Name</td><td>E-mail</td><td>City</td><td>Description</td><td>Phone number</td><td>modify/erase</td></tr>";
}
foreach ($data as $row)
{
  echo"<tr><td>".$row->MENO."</td><td>".$row->EMAIL."</td><td>".$row->MESTO."</td><td>".$row->POPIS;
  echo "</td><td>".$row->TELEFON."</td><td><a href=\"uprav.php?rowid=".$row->ROWID."\">Uprav</a>/<a href=\"zmaz.php?rowid=".$row->ROWID."\">Zma�</td>";
}
echo "</table>";
returnToMain();
?>
