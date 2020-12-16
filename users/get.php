<?php
include("../model/db.php"); 
include("../model/korisnik.class.php");

if (!Korisnik::jePrijavljen()) header("Location: login.php");

if (Korisnik::$prijavljeniKorisnik["uloga"] == "administrator"){
    header('Content-type: application/json');
    $korisnik = Korisnik::daj($_GET["id"]);
    echo (json_encode($korisnik));
}
    