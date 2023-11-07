# Praca s XML

Zostavte XML súbor pokus.xml, ktorý je tvorený položkami predmet, skúšajúci a cvičiaci pre niekoľko predmetov (v tomto semestri) (podľa test.xml). 

Podľa príkladu test.php (z prednášky) zostavte skript pokus.php, pomocou ktorého preverte a zobrazte vstupný súbor pokus.xml. Súbor pokus.xml pripravte najprv v správnom tvare a potom vyskúšajte chyby na rôznych miestach v otváracích i zatváracích elementoch. 

### riesenie

Samozřejmě, zde je PHP skript "pokus.php", který zkontroluje a zobrazí obsah vstupního XML souboru "pokus.xml". Nejprve předpokládejme, že váš XML soubor je ve stejném adresáři jako "pokus.php":

```php
<?php
// Zkontrolujeme, zda byl soubor odeslán jako parametr
if (isset($_GET['file'])) {
    $filename = $_GET['file'];
    
    // Zkontrolujeme, zda soubor existuje
    if (file_exists($filename)) {
        // Načteme obsah souboru
        $xml = file_get_contents($filename);
        
        // Zkusíme načíst XML a zobrazit jej
        $dom = new DOMDocument();
        
        // Ignorujeme bílé znaky a zobrazujeme chyby XML
        $dom->loadXML($xml);
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        
        echo "<pre>";
        echo htmlspecialchars($dom->saveXML());
        echo "</pre>";
    } else {
        echo "Soubor neexistuje.";
    }
} else {
    echo "Není zadaný žádný soubor k zobrazení.";
}
?>
```

Tento skript načte XML soubor z URL parametru "file", zkontroluje, zda soubor existuje, načte jeho obsah a zobrazí ho formátovaný pomocí DOMDocument.

Pokud chcete vyzkoušet chyby v otváracích nebo zavíracích elementech v XML, tak vám například následující XML soubor s chybami může posloužit:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<univerzita>
  <predmet>
    <nazev>Informatika</nazev>
    <skusajici>
      <jmeno>Jan Novák</jmeno>
      <jmeno>Petr Sýkora</jmeno>
    </skusajici>
    <cviciaci>
      <jmeno>Eva Dvořáková</jmeno>
    </cviciaci>
  </predmet>
  <predmet>
    <nazev>Matematika</nazev>
    <skusajici>
      <jmeno>Karel Hájek</jmeno>
      <jmeno>Marta Kralová</jmeno>
    </skusajici>
    <cviciaci>
      <jmeno>Pavel Novotný</jmeno>
    </cviciaci>
  </predmet>
  <predmet>
    <nazev>Angličtina</nazev>
    <skusajici>
      <jmeno>Anna Svobodová</jmeno>
      <jmeno>David Kovařík</jmeno>
    </skusajici>
    <cviciaci>
      <jmeno>Martin Procházka<jmeno>
    </cviciaci>
  </predmet>
</univerzita>
```

V tomto XML souboru jsem uměle způsobil chybu uzávěru elementu `<jmeno>` učitele "Martin Procházka", abyste mohli vidět, jak skript reaguje na chyby.

---
Zostavte XML súbor pokus1.xml, ktorý je tvorený položkami titul, autor (môže ich byť aj viac), recenzent (môže ich byť aj viac), vydavateľ, rok vydania, ISBN a počet strán pre niekoľko rôznych kníh. 

## riuesenie

Zde je příklad XML souboru "pokus1.xml", který obsahuje informace o různých knihách včetně titulu, autorů, recenzentů, vydavatele, roku vydání, ISBN a počtu stránek:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<kniha>
  <titul>Principia Mathematica</titul>
  <autori>
    <autor>Isaac Newton</autor>
  </autori>
  <recenzenti>
    <recenzent>John Smith</recenzent>
    <recenzent>Mary Johnson</recenzent>
  </recenzenti>
  <vydavatel>Cambridge University Press</vydavatel>
  <rok_vydani>1687</rok_vydani>
  <ISBN>978-0521869597</ISBN>
  <pocet_stran>992</pocet_stran>
</kniha>

<kniha>
  <titul>1984</titul>
  <autori>
    <autor>George Orwell</autor>
  </autori>
  <recenzenti>
    <recenzent>David Brown</recenzent>
  </recenzenti>
  <vydavatel>Penguin Books</vydavatel>
  <rok_vydani>1949</rok_vydani>
  <ISBN>978-0141036144</ISBN>
  <pocet_stran>328</pocet_stran>
</kniha>

<kniha>
  <titul>Válka světů</titul>
  <autori>
    <autor>H.G. Wells</autor>
  </autori>
  <recenzenti>
    <recenzent>Lisa Green</recenzent>
    <recenzent>Michael White</recenzent>
  </recenzenti>
  <vydavatel>William Heinemann</vydavatel>
  <rok_vydani>1898</rok_vydani>
  <ISBN>978-1948138051</ISBN>
  <pocet_stran>221</pocet_stran>
</kniha>
</kniha>
```

Tento XML soubor obsahuje tři různé knihy, každá s informacemi o titulu, autorech, recenzentech, vydavateli, roku vydání, ISBN a počtu stránek. Tyto informace jsou zabaleny do elementu `<kniha>`, přičemž některé elementy mohou obsahovat více hodnot (např. více autorů nebo recenzentů).

---

Zostavte XML súbor pokus2.xml, ktorý je tvorený aspoň 5 položkami položkami podľa vlastného výberu tak, že sú tam položky jednoduché, viacnásobné aj položky s atribútmi (podľa vzoru súboru books.xml s atribútom currency="USD" v riešenom príklade main.html prevzatom z [1]. 

Upravte skript pokus.php na skript pokus1.php tak, aby bol názov vstupného súboru načítaný do php skriptu pomocou formulára. Otestujte správnosť vstupného súboru. 

### riesenie 

<!DOCTYPE html>
<html>
<head>
  <title>Načtení XML souboru</title>
</head>
<body>
  <h1>Načtení XML souboru</h1>
  <form action="pokus1.php" method="post" enctype="multipart/form-data">
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
        echo "<pre>" . htmlspecialchars($xml->asXML()) . "</pre>";
      } else {
        echo "Nahrání souboru selhalo.";
      }
    }
  }
  ?>
</body>
</html>
