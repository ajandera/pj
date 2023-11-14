<!DOCTYPE html>
<html>
  <head>
    <title>Načtení XML souboru</title>
  </head>
  <body>
    <h1>Pridanie do XML souboru</h1>
    <form action="add.php" method="post">
      <label>Autor</label><br>
      <input type="text" name="author" required><br>
      <label>Titul</label><br>
      <input type="text" name="title" required><br>
      <label>Vydavatel</label><br>
      <input type="text" name="vydavatel" required><br>
      <label>Rok</label><br>
      <input type="number" name="year" required><br>
      <input type="submit" value="Pridat">
    </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Load the XML file
    $xml = simplexml_load_file('test.xml');

    // Create a new row (element) and add data
    $newRow = $xml->addChild('kniha');
    $newRow->addChild('titul', $_POST['title']);
    $newRow->addChild('autor', $_POST['author']);
    $newRow->addChild('vydavatel', $_POST['vydavatel']);
    $newRow->addChild('rok_vydani', $_POST['year']);

    // Save the changes back to the XML file
    $xml->asXML('test.xml');

    echo "<p>Raw xml:</p>";

    echo "<pre>" . htmlspecialchars($xml->asXML()) . "</pre>";
  }
  ?>
</body>
</html>