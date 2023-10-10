<?php
require "conn.php";

function generatehtmlheader($topic,$message) {
?>
<head>
  <title>Adresar na webe</title>
  <link rel="stylesheet" href="./style.css" type="text/css">
  </head>
  <body>
    <h1><?php  echo $topic; ?></h1>
    <h3 align='center'><?php echo $message?></h3>
   <br><br>
<?php
}

function generateFrontPage(){?>

<form method="post" action="index.php">
<table >
<tr><td>
<input type="submit" name="choice" value="<?php if ($_SESSION['lan']=="sk") echo"Nájdi adresu"; else echo"Search Address";?>">
<input type="submit" name="choice" value="<?php if ($_SESSION['lan']=="sk") echo"Pridaj záznam"; else echo"Add A New Entry";?>">
<input type="submit" name="choice" value="<?php if ($_SESSION['lan']=="sk") echo"Zoznam všetkých adries"; else echo"Adress List";?>">
</td></tr>
</table>
<br><br>
<ul>

<?php if ($_SESSION['lan']=="sk") echo"Slovencina"; else echo"English";?>

<li><?php if ($_SESSION['lan']=="sk") echo"Pridajte adresu kliknutím na <i> Pridaj záznam</i>"; else echo"Add Adress By Clicking  <i> Add A New Entry</i>";?>
<li><?php if ($_SESSION['lan']=="sk") echo"Vyhladajte adresu kliknutím na <i> Nájdi adresu</i>"; else echo"Search Address by clicking <i> Search Address</i>";?>
<li><?php if ($_SESSION['lan']=="sk") echo"Všetky adresy klik na <i> Zoznam všetkých adries</</i>"; else echo"Display all Addresses by clicking <i> Display all Addresses</i>";?>
<li><?php if ($_SESSION['lan']=="sk") echo"Zmeňte existujúci záznam kliknutím na <i> Zoznam všetkých adries</i></li> a potom zvoľte modifikovanie záznamu"; else echo"Modify an existing entry by clicking <i>Display all Addresses</i></li> first and then choosing the entry to Modify</i> ";?>
<li><?php if ($_SESSION['lan']=="sk") echo"Vymažte existujúci záznam kliknutím na <i>Zoznam všetkých adries</i></li> a potom zvoľte vymazanie záznamu "; else echo"Delete an existing entry by clicking <i> Display all Addresses</i> first and then choosing the entry to Delete </i>";?>
</ul>
</form>
<p>Jazyk/Language:<br>
<a href="index.php?l=sk">Slovak</a>
<a href="index.php?l=en">English</a>
</p>
<?php }

function displayErrMsg($message) {
echo "<div class=\"errmsg\">$message</div>";
}

function generateHtmlForm($formValues, $actionScript, $submitLabel)

{ ?>
<form method="post" action="<?php echo $actionScript?>">
<table>
 <tr>
  <td><?php if ($_SESSION['lan']=="sk") echo "meno:"; else echo "name:";?></td>
  <td><input type="text" size="35" name="cn" value="<?php echo $formValues["cn"]?>" required ></td>
</tr>
<tr>
 <td>email:</td>
 <td><input type="email" size="35" name="mail" value="<?php echo $formValues["mail"]?>" required></td>
</tr>
<tr>
 <td><?php if ($_SESSION['lan']=="sk") echo "mesto:"; else echo "city:";?></td>
 <td><input type="text" size="35" name="locality" value="<?php echo $formValues["locality"]?>" ></td>
</tr>
<tr>
 <td><?php if ($_SESSION['lan']=="sk") echo "popis:"; else echo "description:";?></td>
 <td><input type="text" size="35" name="description" value="<?php echo $formValues["description"]?>" ></td>
</tr>
<tr>
 <td><?php if ($_SESSION['lan']=="sk") echo "telefon:"; else echo "telephone:";?></td>
 <td><input type="text" size="35" name="number" value="<?php echo $formValues["number"]?>" ></td>
</tr>
<tr>
 <td></td>
 <td>
<input type="submit" value="<?php echo $submitLabel?>" >
 </td>
 </tr>
 </table>
</form>

<?php }

function returnToMain()
{?>
<br><form action="index.php?l=<?php echo $_SESSION['lan'];?>&choice=uns" method="post">
<input type="submit" value="<?php if ($_SESSION['lan']=="sk") { echo "Navrat na hlavnu stranku"; } else { echo "Return to main page"; } ?>">
<?php }

function generateHTMLZoznam($pdo) {
  try {
    $stmt = $pdo->prepare("SELECT * FROM address");
    $stmt->bindParam(1, $tableName);
    $stmt->execute();
    $data = $stmt->fetchAll();
  } catch (PDOException $e) {
    displayErrMsg("Error: " . $e->getMessage());
    exit();
  }
  ?>
<table class="tab2">
<?php 
if ($_SESSION['lan'] == "sk") {
   echo "<tr><td>Meno</td><td>E-mail</td><td>Mesto</td><td>Popis</td><td>Tel.cislo</td><td>zmenit/zmazat</td></tr>";
} else {
    echo "<tr><td>Name</td><td>E-mail</td><td>City</td><td>Description</td><td>Phone number</td><td>modify/erase</td></tr>";
}

foreach ($data as $row) {
  if ($_SESSION['lan']=="sk") {
    echo"<tr><td>".$row['MENO']."</td><td>".$row['EMAIL']."</td><td>".$row['MESTO']."</td><td>".$row['POPIS']."</td><td>".$row['TELEFON']."</td><td><a href=\"uprav.php?rowid=".$row['ROWID']."\">Uprav</a>/<a href=\"zmaz.php?rowid=".$row['ROWID']."\">Zmaz</td>";
  } else {
    echo"<tr><td>".$row['MENO']."</td><td>".$row['EMAIL']."</td><td>".$row['MESTO']."</td><td>".$row['POPIS']."</td><td>".$row['TELEFON']."</td><td><a href=\"uprav.php?rowid=".$row['ROWID']."\">Modify</a>  <a href=\"zmaz.php?rowid=".$row['ROWID']."\">Delete</td>";
  }
}
echo "</table>";
returnToMain();
}
