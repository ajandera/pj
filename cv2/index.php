<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);

require "common.php";

$l = $_REQUEST["l"];
$choice = $_REQUEST["choice"];
if($choice=="uns") {
  unset($choice);
}

if (empty ($_SESSION['lan'])) {
  $_SESSION['lan'] = "sk";
}

if ($l == "sk") {
  $_SESSION['lan'] = "sk";
}

if ($l == "en") {
  $_SESSION['lan'] = "en";
}

if (!isset($choice)) {
  if ($_SESSION['lan'] == "sk") {
    generateHTMLHeader("Adresár","Kliknite dole na vstup do adresára");
  } else {
    generateHTMLHeader("Directory","Click below to enter the directory");
  }
  generateFrontPage("uvod");
} else if($choice == "Nájdi adresu" || $choice=="Search Address") {
  if ($_SESSION['lan']=="sk") {
    generateHTMLHeader("Adresár","Vyhladávajte pomocou nasledujúcich kritérií");
  } else {
    generateHTMLHeader("Directory","Search by followings criteria");
  }
  if ($_SESSION['lan']=="sk") {
    generateHtmlForm(0,"najdi.php", "vyhľadaj");
  } else {
    generateHtmlForm(0,"najdi.php", "search");
  }
} else if($choice=="Pridaj záznam" || $choice=="Add A New Entry") {
  if ($_SESSION['lan'] == "sk") {
    generateHTMLHeader("Adresár","Vyplňte následovná polia");
  } else {
    generateHTMLHeader("Directory","Complete followings fields");
  }
  if ($_SESSION['lan'] == "sk") {
    generateHtmlForm(0,"pridaj.php", "pridaj záznam");
  }
  else GenerateHtmlForm(0,"pridaj.php", "add entry");
} else if($choice == "Zoznam všetkých adries" || $choice=="Adress List"){
  if ($_SESSION['lan'] == "sk") {
    generateHTMLHeader("Adresár","Zoznam všetkých adries");
  } else {
    generateHTMLHeader("Directory","List of addresses");
  }
  generateHTMLZoznam($pdo);
}
