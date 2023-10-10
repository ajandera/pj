<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
 $l = $_REQUEST["l"];
 $choice = $_REQUEST["choice"];
 if($choice=="uns")unset($choice);
 if (empty ($_SESSION['lan'])) $_SESSION['lan'] = "sk";
 if ($l=="sk") $_SESSION['lan'] = "sk";
 if ($l=="en") $_SESSION['lan'] = "en";


include"common.php";




if (!isset($choice)) {
  if ($_SESSION['lan']=="sk") GenerateHTMLHeader("Adresár","Kliknite dole na vstup do adresára");
  else GenerateHTMLHeader("Directory","Click below to enter the directory");
  GenerateFrontPage("uvod");
}
else if($choice=="Najdi adresu" || $choice=="Search Address"){
  if ($_SESSION['lan']=="sk") GenerateHTMLHeader("Adresár","Vyhladávajte pomocou nasledujúcich kritérií");
  else GenerateHTMLHeader("Directory","Search by followings criteria");
  if ($_SESSION['lan']=="sk") GenerateHtmlForm(0,"najdi.php", "vyhľadaj");
  else GenerateHtmlForm(0,"najdi.php", "search");
}

else if($choice=="Pridaj záznam" || $choice=="Add A New Entry"){
  if ($_SESSION['lan']=="sk") GenerateHTMLHeader("Adresár","Vyplňte následovná polia");
  else GenerateHTMLHeader("Directory","Complete followings fields");
  if ($_SESSION['lan']=="sk") GenerateHtmlForm(0,"pridaj.php", "pridaj záznam");
  else GenerateHtmlForm(0,"pridaj.php", "add entry");
}

else if($choice=="Zoznam všetkých adries" || $choice=="Adress List"){
  if ($_SESSION['lan']=="sk") GenerateHTMLHeader("Adresár","Zoznam všetkých adries");
  else GenerateHTMLHeader("Directory","List of addresses");
  GenerateHTMLZoznam();
}
//include 'http://ccdec.tuke.sk/wdb/rok.php';
//$prewd = getcwd(); // get the current working directory
//chdir(realpath(dirname('../../../rok.php'))); // change working directory to the location of this file
//chdir(realpath(dirname(__FILE__))); // change working directory to the location of this file
//__FILE
//echo "act dir=".getcwd()."<BR>";
//include(getcwd().'/rok.php'); // include relative to this file
//chdir($prewd); // change back to previous working dir
//echo "rok=".$rok."<BR>";
$rok='0';
printf("<br><br>Spat na <a href=\"../../../cvicenia_pj".$rok.".htm\">cvičenia</a>.");
?>
