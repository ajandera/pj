global$pdo; global$pdo; global$pdo;
<!DOCTYPE html>
<html>
<head>
    <title>W3.CSS Template</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body class="w3-content" style="max-width:1300px">

<!-- First Grid: Logo & About -->
<div class="w3-row">
    <div class="w3-half w3-black w3-container w3-center" style="height:700px">
        <div class="w3-padding-64">
            <h1>Menu</h1>
        </div>
        <div class="w3-padding-64">
            <a href="index.html" class="w3-button w3-black w3-block w3-hover-blue-grey w3-padding-16">Home</a>
            <a href="database.php" class="w3-button w3-black w3-block w3-hover-teal w3-padding-16">Tabulky</a>
            <a href="form.html" class="w3-button w3-black w3-block w3-hover-dark-grey w3-padding-16">Pridaj skladbu</a>
            <a href="select.php" class="w3-button w3-black w3-block w3-hover-brown w3-padding-16">Skladby</a>
        </div>
    </div>


<?php
 require "conn.php";

 try{
  $sql = "DROP TABLE IF EXISTS skladba, interpret, album, zaner";
  $pdo->exec($sql);

  $sql = "CREATE TABLE skladba(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nazov VARCHAR(50),
    id_interpret int,
    id_album int,
    id_zaner int)";
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
  $sql = "INSERT INTO skladba(id, nazov, id_interpret, id_album, id_zaner) VALUES
                                                                       (1,'Od tatier k Dunaju', 1, 1, 1),
                                                                       (2,'Čaba, neblázni', 1, 1, 1),
                                                                       (3,'Rock or Bust', 2 , 2, 1),
                                                                       (4,'Highway to Hell', 2 , 3, 1),
                                                                       (5,'Waiting For Love',3 , 4, 3)";
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
