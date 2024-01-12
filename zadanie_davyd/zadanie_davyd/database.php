<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kniznica</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
        .row.content {height: 1500px}

        /* Set gray background color and 100% height */
        .sidenav {
            background-color: #f1f1f1;
            height: 100%;
        }

        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }
            .row.content {height: auto;}
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav">
            <h4>Knižnica</h4>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="index.html">Domov</a></li>
                <li><a href="ukaz.php">Prehľad kníh</a></li>
                <li><a href="formular.html">Pridaj knihu</a></li>
                <li><a href="database.php">Reset databázy</a></li>
            </ul><br>

        </div>

        <div class="col-sm-9">
<?php
 require "conn.php";

 try{
  $sql = "DROP TABLE kniha, zaner, vydavatelstvo, autor";
  $pdo->exec($sql);

  $sql = "CREATE TABLE kniha(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nazov VARCHAR(50),
    id_autor int NOT NULL,
    id_vydavatelstvo int NOT NULL,
    id_zaner int NOT NULL,
    pocet_stran int)";
  $pdo->exec($sql);

  $sql= "CREATE TABLE zaner(
    id_zaner int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nazov_zaner VARCHAR(15))";
  $pdo->exec($sql);

  $sql= "CREATE TABLE vydavatelstvo(
    id_vydavatelstvo int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nazov_vydavatelstvo VARCHAR(25))";
  $pdo->exec($sql);

  $sql= "CREATE TABLE autor(
    id_autor int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    meno VARCHAR(25))";
  $pdo->exec($sql);
  echo "Tables created successfully";
 }
  catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
  die();
 }
 echo "<br><br>";
 try{
  $sql = "INSERT INTO kniha(id, nazov, id_autor, id_vydavatelstvo, id_zaner, pocet_stran) VALUES
                 (1,'After', 1, 1, 3, 608),
                 (2,'After 2', 1, 1, 3, 656),
                 (3,'Blues', 2, 2, 2, 176),
                 (4,'Vianocna koleda', 3, 3, 4, 144),
                 (5,'Rozprávka', 4, 4, 1, 656)";
  $pdo->exec($sql);
  $sql = "INSERT INTO zaner(id_zaner, nazov_zaner) VALUES
                                      (1, 'Fantasy'), 
                                      (2, 'Poezia'), 
                                      (3, 'Roman'), 
                                      (4, 'Dobrodruzny')";
  $pdo->exec($sql);
  $sql = "INSERT INTO vydavatelstvo(id_vydavatelstvo, nazov_vydavatelstvo) VALUES
                                      (1, 'Gallery Books'),
                                      (2, 'Labyrint'),
                                      (3, 'Tatran'),
                                      (4, 'Fairy Tale')";
  $pdo->exec($sql);
  $sql = "INSERT INTO autor(id_autor, meno) VALUES
                                    (1, 'Anna Todd'),
                                    (2, 'Vaclav Hrabe'),
                                    (3, 'Charles Dickens'),
                                    (4, 'Stephen King')";
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


    </div>
</div>
<footer class="container-fluid">
    <p>Footer Text</p>
</footer>

</body>
</html>
