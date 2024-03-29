<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add</title>
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
    <h1 class="w3-margin w3-jumbo">ADD NEW PART</h1>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
    <div class="w3-content">
        <div class="w3-twothird">
<?php
require "conn.php";

//načítanie údajov z formulára pre zápis nového dielu
$nazov = $_POST['nazov'];
$popis = $_POST['popis'];
$cena = $_POST['cena'];
$dodavatel = $_POST['dodavatel'];
$urcenie = $_POST['urcenie'];
$min = $_POST['min'];
$status = $_POST['status'];

//vypísanie údajov, ktoré boli zapísané do formulára
echo "You add <br>";
echo "Name: $nazov <br>";
echo "Description: $popis <br>";
echo "Price: $cena <br>";
echo "Supplier: $dodavatel <br>";
echo "Type of use: $urcenie <br>";
echo "Minimal amount: $min <br>";
echo "Actual amount: $status <br>";

if(!$nazov || !$popis || !$cena || !$dodavatel || !$urcenie) {
    echo "Zoznam nebol pridany";
    exit();
}

try { //zapísanie údajov do tabuľky diel
    $stmt = $pdo->prepare("INSERT INTO diel (nazov, popis, id_dodavatel, cena, id_urcenie) VALUES(?,?,?,?,?)");
    $stmt->bindParam(1, $nazov);
    $stmt->bindParam(2, $popis);
    $stmt->bindParam(3, $dodavatel);
    $stmt->bindParam(4, $cena);
    $stmt->bindParam(5, $urcenie);
    $stmt->execute();

    $last_id = $pdo->lastInsertId();
    echo "New record created successfully. Last inserted ID is: " . $last_id ;
    echo "<br>";
} catch(PDOException $e) {
    echo $stmt . "<br>" . $e->getMessage();
}

try{ //zapísanie údajov do tabuľky stav
    $stmt = $pdo->prepare("INSERT INTO stav (id_diel, min, status) VALUES(?,?,?)");
    $stmt->bindParam(1, $last_id);
    $stmt->bindParam(2, $min);
    $stmt->bindParam(3, $status);
    $stmt->execute();
    echo "New record created successfully.";
}  catch(PDOException $e) {
    echo $stmt . "<br>" . $e->getMessage();
}
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
