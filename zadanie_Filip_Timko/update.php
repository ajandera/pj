<!DOCTYPE html>
<html lang="en">
<head>
    <title>update</title>
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
    <h1 class="w3-margin w3-jumbo">UPDATE</h1>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
    <div class="w3-content">
        <div class="w3-twothird">
<?php
require "conn.php";

$id = $_REQUEST["id"];
echo "For ID of the part use this number: $id";
?>
<form action="uprav.php" method="post">
    <label for="id">Part ID:</label>
    <input type="number" id="id" name="id" min="1" required><br>

    <label for="nazov">Part name:</label>
    <input type="text" id="nazov" name="nazov" required><br>

    <label for="popis">Description:</label>
    <input type="text" id="popis" name="popis" required><br>

    <label for="cena">Price:</label>
    <input type="number" id="cena" name="cena" min="1" max="10000" required><br>

    <p>Supplier:</p>
    <input type="radio" id="festo" name="dodavatel" value=1 required>
    <label for="festo">Festo</label><br>
    <input type="radio" id="megabelt" name="dodavatel" value=2>
    <label for="megabelt">MegaBelt</label><br>
    <input type="radio" id="siemens" name="dodavatel" value=3>
    <label for="siemens">Siemens</label><br>
    <input type="radio" id="omron" name="dodavatel" value=4>
    <label for="omron">Omron</label><br>

    <p>Type of use:</p>
    <input type="radio" id="elektricke" name="urcenie" value=1 required>
    <label for="elektricke">Electrical</label><br>
    <input type="radio" id="mechanicke" name="urcenie" value=2>
    <label for="mechanicke">Mechanical</label><br>
    <input type="radio" id="pneumaticke" name="urcenie" value=3>
    <label for="pneumaticke">Pneumatic</label><br>
    <input type="radio" id="hydraulicke" name="urcenie" value=4>
    <label for="hydraulicke">Hydraulic</label><br>


    <input type="submit">



</form>
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