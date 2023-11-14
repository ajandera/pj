# Spracovanie XML – rozhrania 

  

Úlohy: 

 - Zostavte štruktúru XML súboru určenú pre cenník výrobkov - napríklad zoznamvyrobkov -> vyrobok -> nazov, vyrobca, cena. Zostavte pre vytvorenú štruktúru aj DTD a uložte do súboru cennik.xml. 

 - S využitím rozhrania DOM zostavte skript na pridanie nového výrobku pridaj.php. Pomocou uvedeného skriptu vytvorte zoznam aspoň 7 výrobkov.  

 - S využitím rozhrania DOM zostavte skript na zrušenie výrobku zrus.php. Pomocou uvedeného skriptu zrušte 2 výrobky.  

 - S využitím rozhrania DOM (prípadne SimpleXML) zostavte skript na výber výrobku vyber.php. Preskúšajte uvedený skript pre rôzne výrobky.   

 ## riesenie

Add row

    // Load the XML file
    $xml = simplexml_load_file('your_xml_file.xml');

    // Create a new row (element) and add data
    $newRow = $xml->addChild('row');
    $newRow->addChild('column1', 'value1');
    $newRow->addChild('column2', 'value2');
    // Add more columns as needed

    // Save the changes back to the XML file
    $xml->asXML('your_xml_file.xml');

Remove row

    // Load the XML file
    $xml = simplexml_load_file('your_xml_file.xml');

    // Find and delete a specific row based on a condition
    $targetRow = $xml->xpath('//row[column1="value1" and column2="value2"]')[0];

    if ($targetRow !== false) {
        // Unset the found row
        unset($targetRow[0]);
        
        // Save the changes back to the XML file
        $xml->asXML('your_xml_file.xml');
        echo 'Row deleted successfully.';
    } else {
        echo 'Row not found.';
    }




 # What is DTD for xml

A DTD defines the structure and the legal elements and attributes of an XML document.

    <!DOCTYPE note
    [
    <!ELEMENT note (to,from,heading,body)>
    <!ELEMENT to (#PCDATA)>
    <!ELEMENT from (#PCDATA)>
    <!ELEMENT heading (#PCDATA)>
    <!ELEMENT body (#PCDATA)>
    ]>

## When to Use a DTD?
- With a DTD, independent groups of people can agree to use a standard DTD for interchanging data.
- With a DTD, you can verify that the data you receive from the outside world is valid.
- You can also use a DTD to verify your own data.
- If you want to study DTD, please read our DTD Tutorial.

## When NOT to Use a DTD?
- XML does not require a DTD.
- When you are experimenting with XML, or when you are working with small XML files, creating DTDs may be a waste of time.
- If you develop applications, wait until the specification is stable before you add a DTD. Otherwise, your software might stop working because of validation errors.