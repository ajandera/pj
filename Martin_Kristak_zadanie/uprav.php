global$pdo;
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
            <h1>V databaze ste upravili skladbu</h1>
            <div class="w3-left-align w3-padding-large">


<?php
require "conn.php";


$id = $_POST['id'];
$nazov = $_POST['nazov'];
$id_interpret = $_POST['id_interpret'];
$id_album = $_POST['id_album'];
$id_zaner = $_POST['id_zaner'];


echo "Udaje o upravenej skladbe: <br>";
echo "Nazov skladby: $nazov <br>";
echo "Meno interpreta: $id_interpret <br>";
echo "Album: $id_album <br>";
echo "Zaner: $id_zaner <br>";

if(!$nazov || !$id_interpret || !$id_album || !$id_zaner) {
    echo "Zoznam nebol pridany";
    exit();
}

try {
    $stmt = $pdo->prepare("UPDATE skladba SET nazov = ?, id_interpret = ?, id_album = ?, id_zaner = ? WHERE id = ?");
    $stmt->bindParam(1, $nazov);
    $stmt->bindParam(2, $id_interpret);
    $stmt->bindParam(3, $id_album);
    $stmt->bindParam(4, $id_zaner);
    $stmt->bindParam(5, $id);
    $stmt->execute();

    $last_id = $pdo->lastInsertId();
    echo "Uprava uspešne vykonaná.";
    echo "<br>";
} catch(PDOException $e) {
    echo $stmt . "<br>" . $e->getMessage();
}
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