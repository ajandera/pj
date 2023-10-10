	<?php
  try {
    $pdo = new PDO("mysql:host=data;dbname=mydatabase", "myuser", "mypassword");
    $tableName = "address";
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }