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
        table, th, td {
            border: 1px solid black;
            padding: 15px;
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
try {
    $stmt = $pdo->prepare("SELECT k.id, k.nazov, a.meno, v.nazov_vydavatelstvo, z.nazov_zaner, k.pocet_stran FROM kniha AS k, autor AS a, vydavatelstvo AS v, zaner AS z WHERE k.id_autor=a.id_autor AND k.id_vydavatelstvo=v.id_vydavatelstvo AND k.id_zaner=z.id_zaner");
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
echo"<br><br>";
echo "<tr><td>Názov </td><td>Autor </td><td>Vydavateľstvo </td><td>Žáner </td><td>Počet strán </td><td>Zmeň </td><td>Vymaž</td></tr>";


foreach ($data as $row) {
    echo "<tr><td>" . $row['nazov'] . "</td><td>" . $row['meno'] . "</td><td>" . $row['nazov_vydavatelstvo'] . "</td><td>" . $row['nazov_zaner'] . "</td><td>" . $row['pocet_stran'] . "</td><td><a href=\"zmen.php?id=".$row['id']."\">Zmeniť</a></td><td><a href=\"vymaz.php?id=".$row['id']."\">Vymazať</td></tr>";
}
echo "</table>";
?>
        </div>


    </div>
</div>
<footer class="container-fluid">
    <p>Footer Text</p>
</footer>

</body>
</html>
