<!DOCTYPE html>
<html>
  <head>
    <title>Načtení XML souboru</title>
  </head>
  <body>
    <h1>Načtení XML souboru</h1>
    <form action="parser.php" method="post" enctype="multipart/form-data">
      Vyberte XML soubor: <input type="file" name="xml_file" accept=".xml"><br>
      <input type="submit" value="Odeslat">
    </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["xml_file"])) {
    $file = $_FILES["xml_file"];
    $file_name = $file["name"];
    $file_tmp_name = $file["tmp_name"];

    if (empty($file_name)) {
      echo "Není vybrán žádný soubor.";
    } else {
      if (move_uploaded_file($file_tmp_name, $file_name)) {
        echo "Soubor byl úspěšně nahrán: " . $file_name;
        // Zde můžete provést načtení a zobrazení obsahu XML souboru
        $xml = simplexml_load_file($file_name);

        // show simple element
        foreach ($xml as $book) {
            echo "<br>" .  $book->vydavatel . "<br>";
        }

        echo "<pre>" . htmlspecialchars($xml->asXML()) . "</pre>";
      } else {
        echo "Nahrání souboru selhalo.";
      }
    }
  }
  ?>
</body>
</html>