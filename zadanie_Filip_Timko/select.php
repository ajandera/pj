<!DOCTYPE html>
<html lang="en">
<head>
    <title>werehouse</title>
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
        table, th, td {
            border: 2px solid black;
            padding: 10px;
        }
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
    <h1 class="w3-margin w3-jumbo">SELECT</h1>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
    <div class="w3-content">
        <div class="w3-twothird">
<?php
require "conn.php";
try { //načítanie údajov z daných tabuliek pomocou príkazu SELECT
    $stmt = $pdo->prepare("SELECT diel.id, diel.nazov, diel.popis, dodavatel.dnazov, diel.cena, urcenie.unazov FROM diel , dodavatel , urcenie  WHERE diel.id_dodavatel = dodavatel.id_dodavatel AND diel.id_urcenie = urcenie.id_urcenie");
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
    echo "<table>"; //vytvorenie tabuľky na webstránke
        echo "<tr><td>Name</td><td>Descripton</td><td>Supplier</td><td>Price</td><td>Use</td><td>Modify/Erase</td></tr>";

    //naplnenie údajov do tabuľky aby sa vypísali na webstránke
    foreach ($data as $row) {
            echo"<tr><td>".$row['nazov']."</td><td>".$row['popis']."</td><td>".$row['dnazov']."</td><td>".$row['cena']."</td><td>".$row['unazov']."</td><td><a href=\"update.php?id=".$row['id']."\">Change</a><a href=\"delete.php?id=".$row['id']."\">Delete</td></tr>";

    }
    echo "</table>";

    try { //načítanie údajov z daných tabuliek pomocou príkazu SELECT
        $stmt = $pdo->prepare("SELECT diel.nazov, stav.min, stav.status FROM stav , diel  WHERE stav.id_diel = diel.id");
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
        echo "<table>"; //vytvorenie tabuľky na webstránke
        echo "<tr><td>Name</td><td>Minimal amount</td><td>Current</td></tr>";

        //naplnenie údajov do tabuľky aby sa vypísali na webstránke
        foreach ($data as $row) {
            echo"<tr><td>".$row['nazov']."</td><td>".$row['min']."</td><td>".$row['status']."</td></tr>";

        }
        echo "</table>";

        ?>
    </div>

    <div class="w3-third w3-center">
        <i class="fa fa-anchor w3-padding-64 w3-text-red"></i>
    </div>
    </div>
    </div>

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