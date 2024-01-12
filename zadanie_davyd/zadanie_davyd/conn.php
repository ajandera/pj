<?php
try {
    $pdo = new PDO("mysql:host=mysql;dbname=mydatabase", "myuser", "mypassword");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}
?>
