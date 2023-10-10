<?php
session_start();

include"common.php";
include "spoj.php";
$cn = $_REQUEST["cn"];
$mail = $_REQUEST["mail"];
$locality = $_REQUEST["locality"];
$description = $_REQUEST["description"];
$number = $_REQUEST["number"];
if(!$cn && !$mail && !$locality && !$description && !$number)
 {
  if ($_SESSION[lan]=="sk") { DisplayErrMsg("Chyba: Aspoò jedno vyh¾adávacie kritérium musí by zadané"); ReturnToMain(); }
  else { DisplayErrMsg("Error: At least one of fields must be filled"); ReturnToMain(); }
  exit();
}

$searchStmt= "select * from ".$tableName." where ";

if ($cn) $searchStmt .= "meno like '%$cn%' and";
if ($mail) $searchStmt .= " email like '%$mail%' and";
if ($locality) $searchStmt .= " mesto like '%$locality%' and";
if ($description) $searchStmt .= " popis like '%$description%' and";
if ($number) $searchStmt .= " telefon like '%$number%' and";

$stmt=substr($searchStmt,0,strlen($searchStmt)-4);
 
if(!($result=mysql_query($stmt))){
  DisplayErrMsg("Chyba vo vykonani $stmt");
 exit();
}
?>
<h3 align="center"> <?php if ($_SESSION['lan']=="sk") generateHTMLheader("Výsledky vyh¾adávania",""); else generateHTMLheader("Results","");?></h3>

<table class="tab2">
<?php
if ($_SESSION['lan']=="sk")
   echo "<tr><td>Meno</td><td>E-mail</td><td>Mesto</td><td>Popis</td><td>Tel.cislo</td><td>zmenit/zmazat</td></tr>";
else    echo "<tr><td>Name</td><td>E-mail</td><td>City</td><td>Description</td><td>Phone number</td><td>modify/erase</td></tr>";
while ($row=mysql_fetch_object($result))
{
echo"<tr><td>".$row->MENO."</td><td>".$row->EMAIL."</td><td>".$row->MESTO."</td><td>".$row->POPIS;
echo "</td><td>".$row->TELEFON."</td><td><a href=\"uprav.php?rowid=".$row->ROWID."\">Uprav</a>/<a href=\"zmaz.php?rowid=".$row->ROWID."\">Zmaž</td>";
}
echo "</table>";
mysql_free_result($result);
ReturnToMain();
?>
