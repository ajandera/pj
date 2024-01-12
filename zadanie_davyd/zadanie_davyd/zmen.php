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

$rowid = $_REQUEST["id"];
echo "Chceš zmeniť knihu s id: $rowid";
?>

<form action="uprav.php" method="post">
    <label for="id">Zadaj Id knihy, ktorú chceš zmeniť:</label>
    <input type="number" id="id" name="id" min="1" max="10000" required><br>

    <label for="nazov">Zadaj názov knihy:</label>
    <input type="text" id="nazov" name="nazov" required><br>

    <p>Autor:</p>
    <input type="radio" id="autor1" name="autor" value=1 required>
    <label for="autor1">Anna Todd</label><br>
    <input type="radio" id="autor2" name="autor" value=2>
    <label for="autor2">Vaclav Hrabe</label><br>
    <input type="radio" id="autor3" name="autor" value=3>
    <label for="autor3">Charles Dickens</label><br>
    <input type="radio" id="autor4" name="autor" value=4>
    <label for="autor4">Stephen King</label><br>

    <p>Vydavateľstvo:</p>
    <input type="radio" id="vydavatelstvo1" name="vydavatelstvo" value=1 required>
    <label for="vydavatelstvo1">Gallery Books</label><br>
    <input type="radio" id="vydavatelstvo2" name="vydavatelstvo" value=2>
    <label for="vydavatelstvo2">Labyrint</label><br>
    <input type="radio" id="vydavatelstvo3" name="vydavatelstvo" value=3>
    <label for="vydavatelstvo3">Tatran</label><br>
    <input type="radio" id="vydavatelstvo4" name="vydavatelstvo" value=4>
    <label for="vydavatelstvo4">Fairy Tale</label><br>

    <p>Žáner:</p>
    <input type="radio" id="zaner1" name="zaner" value=1 required>
    <label for="zaner1">fantasy</label><br>
    <input type="radio" id="zaner2" name="zaner" value=2>
    <label for="zaner2">poézia</label><br>
    <input type="radio" id="zaner3" name="zaner" value=3>
    <label for="zaner3">román</label><br>
    <input type="radio" id="zaner4" name="zaner" value=4>
    <label for="zaner4">dobrodružný</label><br>

    <label for="pocet_stran">Počet strán knihy:</label>
    <input type="number" id="pocet_stran" name="pocet_stran" min="1" max="10000" required><br>

    <input type="submit">



</form>
</div>


</div>
</div>
<footer class="container-fluid">
    <p>Footer Text</p>
</footer>

</body>
</html>
