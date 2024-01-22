<!DOCTYPE html>
<html lang="en">
<head>
 <title>Database</title>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <style>
  body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
  .w3-bar,h1,button {font-family: "Montserrat", sans-serif}
  .fa-anchor,.fa-coffee {font-size:200px}
 </style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-red w3-card w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
  <a href="index.html" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
  <a href="database.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Database</a>
  <a href="form.html" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Form</a>
  <a href="select.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Update</a>
 </div>

 <!-- Navbar on small screens -->
 <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="database.php" class="w3-bar-item w3-button w3-padding-large">Database</a>
  <a href="form.html" class="w3-bar-item w3-button w3-padding-large">Form</a>
  <a href="select.php" class="w3-bar-item w3-button w3-padding-large">Update</a>
 </div>
</div>

<!-- Header -->
<header class="w3-container w3-red w3-center" style="padding:128px 16px">
 <h1 class="w3-margin w3-jumbo">Database first INSERT</h1>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
 <div class="w3-content">
  <div class="w3-twothird">
<?php
 require "conn.php";
//vytvorenie tabuliek a následné ich naplnenie pomocou sql príkazu INSERT
 try{
  $sql = "DROP TABLE IF EXISTS diel, stav, dodavatel, urcenie"; //zhodenie tabuľky ak existuje
  $pdo->exec($sql); //spustenie premennej $sql

  $sql = "CREATE TABLE diel(
            id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            nazov VARCHAR(25),
            popis VARCHAR(50),
            id_dodavatel int NOT NULL,
            cena int,
            id_urcenie int NOT NULL)";
            // vytvorenie tabuľky diel a definovanie typu udajov, ktore su v nej zapisane
  $pdo->exec($sql); //spustenie premennej $sql

  $sql= "CREATE TABLE stav(
            id_stav int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            id_diel int NOT NULL,
            min int,
            status int)";
            // vytvorenie tabuľky stav a definovanie typu udajov, ktore su v nej zapisane
  $pdo->exec($sql); //spustenie premennej $sql

  $sql= "CREATE TABLE dodavatel(
            id_dodavatel int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            dnazov VARCHAR(25))";
            // vytvorenie tabuľky dodavatel a definovanie typu udajov, ktore su v nej zapisane
  $pdo->exec($sql); //spustenie premennej $sql

  $sql= "CREATE TABLE urcenie(
            id_urcenie int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            unazov VARCHAR(25))";
            // vytvorenie tabuľky urcenie a definovanie typu udajov, ktore su v nej zapisane
  $pdo->exec($sql); //spustenie premennej $sql
  echo "Tables created successfully";
 }
  catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
  die();
 }
 echo "<br><br>";
 try{ //naplnenie tabuliek udajmi
  $sql = "INSERT INTO diel(id, nazov, popis, id_dodavatel, cena, id_urcenie) VALUES
                                                                       (1,'Mechanical belt', 'Mechanical belt, 2x30', 2, 7, 2),
                                                                       (2,'Inductive sensor', 'inductive sensor SIEH-M12B-PS-S-L', 1, 71, 1),
                                                                       (3,'Pneumatic cylinder', 'pneumatic cylinder DSBC DSBC-40-100-PPVA-N3', 1, 156, 3),
                                                                       (4,'PLC S7-1200', 'Siemens 6ES7211-1BE40-0XB0', 3, 243, 1),
                                                                       (5,'Photoelectric sensor', 'Omron E3FCRP112M', 4, 92, 1)";
  $pdo->exec($sql);
  $sql = "INSERT INTO stav(id_stav, id_diel, min, status) VALUES
                                               (1, 1, 2, 3), 
                                               (2, 2, 3, 2), 
                                               (3, 3, 1, 2), 
                                               (4, 4, 1, 1),
                                               (5, 5, 5, 8)";
  $pdo->exec($sql);
  $sql = "INSERT INTO dodavatel(id_dodavatel, dnazov) VALUES
                                              (1, 'Festo'),
                                              (2, 'MegaBelt'),
                                              (3, 'Siemens'),
                                              (4, 'Omron')";
  $pdo->exec($sql);
  $sql = "INSERT INTO urcenie(id_urcenie, unazov) VALUES
                                    (1, 'elektricke'),
                                    (2, 'mechanicke'),
                                    (3, 'pneumaticke'),
                                    (4, 'hydraulicke')";
  $pdo->exec($sql);
  echo "New records created successfully";
 }
 catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
  die();
 }
 $pdo = null;
?>
  </div>

  <div class="w3-third w3-center">
   <i class="fa fa-anchor w3-padding-64 w3-text-red"></i>
  </div>
 </div>
</div>

<!-- Second Grid -->

  <script>
   // Used to toggle the menu on small screens when clicking on the menu button
   function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
     x.className += " w3-show";
    } else {
     x.className = x.className.replace(" w3-show", "");
    }
   }
  </script>

</body>
</html>
