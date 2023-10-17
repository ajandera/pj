# Prístupové práva
Na začiatok je veľmi dôležité vedieť, čo jednotlivé nastavenie prístupových práv znamená.

Rozlišujú tri typy prístupových práv k súboru:
1) užívateľ (vlastník - user) tvorca, pogramátor
2) skupina (group) napr. študenti jedného ročníka, riešitelia jedného projektu a pod.
3) ostatní užívatelia (others) užívatelia pristupujúci k aplikácii zvonku - internet,intranet

Prístupové práva určujú postupne právo čítať (r - 4), písať (w - 2) a spúšťať súbor (x - 1) - (rwx = 7 – hodnotu získame ako súčet nastavených čiastkových práv).

Názorný príklad nastavenia práv:
744 ==> rwx r-- r--
660 ==> rw- rw- ---
762 ==> rwx rw- -w-

- pre zobrazenie prístupových práv slúži skript zobraz.

- zmena práv je možná len pri objektoch (súbor, adresár), ktorých vlastníkom je "www-data" čiže boli vytvorené nejakým skriptom napríklad: vytvor.txt. Pre daný adresár, v ktorom sa vytvára test.txt musia byť povolené práva pre zápis v tvare (0777).

- pre vytvorenie nového adresára a nastavením jeho príslušných prístupových práv doplníme skript o funkciu adresár.php

- pre pridanie tretieho vstupu do skriptu dbman.php je potrebné pridať dblist


## Ziskanie informacii o subore

    if ( !isset($_GET['subor']) ) {
        exit ();
    }

    echo "<?xml version=\"1.0\" encoding=\"iso-8859-2\"?>";
    clearstatcache();
    $vlastnik = posix_getpwuid(fileowner($_GET['subor']));

## script - info o subore

    <script type="text/javascript">
        /* < ![CDATA[ */
        function otvorOdkaz(url)
        {
            self.document.location.href=url;
        }
        /* ]]> */
    </script>
    <form action='./zmen.php' method='get'>
        SÚBOR: " < ?php echo $_GET['subor']; ?>"
        VLASTNÍK: " < ?php echo $vlastnik['name']; ?>"
        PRÁVA: < input type='text' name='atribut' value='/>  '%o', fileperms($_GET['subor'])), -4); ?>' size='6' />
        <input type='submit' name='btnZmen' value='Zmen' />  
        <input type='hidden' name='subor' value=' < ?php echo $_GET['subor']; ?>' />
    </form>
    <button type='button' onclick="otvorOdkaz('main.php')">Spat </button>

## vytvor súbor

Pri vytváraní súboru test.txt treba dba na správne prisúdenie práv.
A pre daný adresár, v ktorom sa vytvára test.txt musia by povolené práva pre zápis v tvare (0777)
Pre takto vytvorený súbor test.txt je možné ¾ubovo¾ne meni prístupové práva.

    if (! file_exists('test.txt,'w'))
    {
        $subor= fopen('test.txt,'w');
        fwrite ($subor,'test');
        fclose ($subor);
        chmod ('test.txt',0777);
        echo "Subor uspesne vytvoreny";
    } else {
        echo "Subor uz je vytvoreny";
    }

## vytvor adresar

    if (!is_dir($_GET['meno']))
    {
        $adresar=mkdir("./".$_GET['meno']);
        chmod("./".$_GET['meno'], octdec($_GET['atribut']));
        if ($adresar)
        {
            echo "
            Adresár ".$_GET['meno']." bol úspeąne vytvorený. ";
            echo "Jeho práva sú: <strong>".substr(sprintf('%o', fileperms($_GET['meno'])), -4)."</strong>

            echo "Návrat na hlavnú stránku\n";
        } else {
            exit_smart('Chyba pri vytvorení adresára');
        }
    } else {
        echo "<p>Adresár ".$_GET['meno']." už existuje.</p>\n";
    }


