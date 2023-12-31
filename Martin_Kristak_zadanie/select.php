global$pdo; global$pdo; <!DOCTYPE html>
<html lang="en">
<head>
    <title>form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
        .w3-bar,h1,button {font-family: "Montserrat", sans-serif}
        <i class="fa fa-headphones" style="font-size:400px;color:red;"></i>
    </style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-red w3-card w3-left-align w3-large">
        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
        <a href="index.html" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
        <a href="database.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Tabulky</a>
        <a href="form.html" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Pridaj skladbu</a>
        <a href="select.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Skladby</a>
        <a href="update.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Uprav</a>
    </div>

    <!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
        <a href="database.php" class="w3-bar-item w3-button w3-padding-large">Tabulky</a>
        <a href="form.html" class="w3-bar-item w3-button w3-padding-large">Pridaj skladbu</a>
        <a href="select.php" class="w3-bar-item w3-button w3-padding-large">Skladby</a>
        <a href="delete.php" class="w3-bar-item w3-button w3-padding-large">Delete</a>
    </div>
</div>

<!-- Header -->
<header class="w3-container w3-red w3-center" style="padding:128px 16px">
    <h1 class="w3-margin w3-jumbo">Výpis skladieb</h1>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
    <div class="w3-content">
        <div class="w3-twothird">
<?php
require "conn.php";
try {
    $stmt = $pdo->prepare("SELECT skladba.id, skladba.nazov, interpret.meno_interpreta, album.nazov_album, zaner.nazov_zaner FROM skladba, interpret, album, zaner WHERE skladba.id_interpret = interpret.id_interpret AND skladba.id_album = album.id_album AND skladba.id_zaner = zaner.id_zaner");
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

        echo "<tr><td>ID skladby</td><td>Nazov skladby</td><td>Nazov interpreta</td><td>Album</td><td>Zaner</td></td><td>Upraviť/Vymazať</td></tr>";


    foreach ($data as $row) {
            echo"<tr><td>".$row['id']."</td><td>".$row['nazov']."</td><td>".$row['meno_interpreta']."</td><td>".$row['nazov_album']."</td><td>".$row['nazov_zaner']."</td><td><a href=\"update.php?id=".$row['id']."\">Change</a><a href=\"delete.php?id=".$row['id']."\">/Delete</td>";

    }
    echo "</table>";

?>
    </div>

    <div class="w3-third w3-center">
        <i class="fa fa-headphones" style="font-size:400px;color:red;"></i>
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