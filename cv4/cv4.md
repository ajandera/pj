# Cv 4

Copy cv2 content without md and sq1l files.

Add server side validation to the pridaj.php:

Email: add regular expression to check if email has correct format.
Phone: Check if number is in international type and has all numbers.

Meno - všetky medzery v mene nahradíme podčiarknikom.
Email - login musí byť najmenej 4 znaky, len pre doménu sk, @.
Telefon - len pre Košice a Prešov pevná linka plus Orange čísla.

Zostavíme skript vystup.php, ktorý vykoná opis všetkých zadaných vstupných hodnôt na obrazovku.

Zostavíme formulár prenos.html, ktorý vykoná vstup mena a priezviska (v jednom vstupnom prvku) a vstup názvu súboru.
Vytvorime odkaz na skript prenos.php s prenosom oboch parametrov.

Zabezpečíme, aby v predchádzajúcom príklade nebolo možné cez vstup zadať HTML elementy < B> a < I> a žiadny PHP príkaz.