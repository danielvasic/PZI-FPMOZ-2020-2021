<?php
include("../model/db.php"); 
include("../model/korisnik.class.php");

if (!Korisnik::jePrijavljen()) header("Location: login.php");
$prijavljeni_korisnik = Korisnik::$prijavljeniKorisnik;

if ($prijavljeni_korisnik["uloga"] == "administrator")
    Korisnik::pobrisi($_GET["id"]);

header("Location: ../index.php");
?>