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
  <a href="delete.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Delete</a>
 </div>

 <!-- Navbar on small screens -->
 <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="database.php" class="w3-bar-item w3-button w3-padding-large">Database</a>
  <a href="form.html" class="w3-bar-item w3-button w3-padding-large">Form</a>
  <a href="select.php" class="w3-bar-item w3-button w3-padding-large">Update</a>
  <a href="delete.php" class="w3-bar-item w3-button w3-padding-large">Delete</a>
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

 try{
  $sql = "DROP TABLE skladba, interpret, album, zaner";
  $pdo->exec($sql);

  $sql = "CREATE TABLE skladba(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nazov VARCHAR(50),
    interpret VARCHAR(50),
    id_album int,
    id_zaner int,)";
  $pdo->exec($sql);

  $sql= "CREATE TABLE interpret(
    id_interpret int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    meno_interpreta VARCHAR(50))";
  $pdo->exec($sql);

  $sql= "CREATE TABLE album(
    id_album int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nazov_album VARCHAR(50))";
  $pdo->exec($sql);

  $sql= "CREATE TABLE zaner(
    id_zaner int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nazov_zaner VARCHAR(50))";
  $pdo->exec($sql);
  echo "Tables created successfully";
 }
  catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
  die();
 }
 echo "<br><br>";
 try{
  $sql = "INSERT INTO skladba(id, nazov, interpret, id_album, id_zaner) VALUES
                                                                       (1,'Od tatier k Dunaju', 'Elán', 1, 1),
                                                                       (2,'Čaba, neblázni', 'Elán', 1, 1),
                                                                       (3,'Rock or Bust', 'AC/DC', 2, 1),
                                                                       (4,'Highway to Hell', 'AC/DC', 3, 1),
                                                                       (5,'Waiting For Love', 'Avicii', 4, 3)";
  $pdo->exec($sql);
  $sql = "INSERT INTO interpret(id_interpret, meno_interpreta) VALUES
                                               (1,'Elán'), 
                                               (2, 'AC/DC'), 
                                               (3, 'Avicii')";
  $pdo->exec($sql);
  $sql = "INSERT INTO album(id_album, nazov_album) VALUES
                                              (1, 'Rabaka'),
                                              (2, 'Rock or Bust'),
                                              (3, 'Highway to Hell'),
                                              (4, 'Stories')";
  $pdo->exec($sql);
  $sql = "INSERT INTO zaner(id_zaner, nazov_zaner) VALUES
                                    (1, 'Rock'),
                                    (2, 'Pop'),
                                    (3, 'Elektronicka hudba')";
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
