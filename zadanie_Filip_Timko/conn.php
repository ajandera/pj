	<?php
    try { //pripojenie sa do databazy pomocou PDO
        $pdo = new PDO("mysql:host=mysql;dbname=mydatabase", "myuser", "mypassword");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
    ?>
