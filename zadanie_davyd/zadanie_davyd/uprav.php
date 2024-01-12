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

$id = $_POST['id'];
$nazov = $_POST['nazov'];
$autor = $_POST['autor'];
$vydavatelstvo = $_POST['vydavatelstvo'];
$zaner = $_POST['zaner'];
$pocet_stran = $_POST['pocet_stran'];


echo "Názov knihy: $nazov <br>";
echo "Autor: $autor <br>";
echo "Vydavateľstvo: $vydavatelstvo <br>";
echo "Žáner: $zaner <br>";
echo "Počet strán: $pocet_stran <br>";

if(!$nazov || !$autor || !$vydavatelstvo || !$zaner || !$pocet_stran) {
    echo "Zaznam nebol pridany";
    exit();
}

try {
    $stmt = $pdo->prepare("UPDATE kniha SET nazov = ?, id_autor = ?, id_vydavatelstvo = ?, id_zaner = ?, pocet_stran = ? where id = ?");
    $stmt->bindParam(1, $nazov);
    $stmt->bindParam(2, $autor);
    $stmt->bindParam(3, $vydavatelstvo);
    $stmt->bindParam(4, $zaner);
    $stmt->bindParam(5, $pocet_stran);
    $stmt->bindParam(6, $id);
    $stmt->execute();

    $last_id = $pdo->lastInsertId();
    echo "Zaznam bol pridany. Pre knihu s id " .$id;
    echo "<br>";
}
catch(PDOException $e) {
    echo $stmt . "<br>" . $e->getMessage();
}

?>

</div>


</div>
</div>
<footer class="container-fluid">
    <p>Footer Text</p>
</footer>

</body>
</html>
