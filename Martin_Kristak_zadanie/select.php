global$pdo; global$pdo;
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
    <div class="w3-half w3-blue-grey w3-container" style="height:700px">
        <div class="w3-padding-64 w3-center">
            <h1>Vypis skladieb</h1>
            <div class="w3-left-align w3-padding-large">




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