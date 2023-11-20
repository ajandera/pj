<!DOCTYPE html>
<html>
  <head>
    <title>Načtení XML souboru</title>
  </head>
  <body>
    <h1>Pridanie do XML souboru</h1>
    <form action="remove.php" method="post">
      <label>Titul</label><br>
      <input type="text" name="title" required><br>
      <input type="submit" value="Zmazat">
    </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Load the XML file
    $dom = new DOMDocument; 
    $dom->load('test.xml');   
    // Vytvorte objekt DOMXPath 
    $xpath = new DOMXPath($dom); 

    // Nájdite druhú osobu 
    $targetRow = $xpath->query('//knihy/kniha/titul[. = "' . $_POST['title'] .'"]/parent::*')->item(0);

    $targetRow->parentNode->removeChild($targetRow); 

    // Uložte zmeny späť do XML súboru 

    $dom->formatOutput = true; 

    $dom->save('test.xml'); 
  }
    $xml = simplexml_load_file('test.xml');
    echo "<p>Raw xml:</p>";

    echo "<pre>" . htmlspecialchars($xml->asXML()) . "</pre>";
  
  ?>
</body>
</html>