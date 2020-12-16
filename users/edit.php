<?php

include("../model/db.php"); 
include("../model/korisnik.class.php");

if (!Korisnik::jePrijavljen()) header("Location: login.php");
$prijavljeni_korisnik = Korisnik::$prijavljeniKorisnik;

if ($prijavljeni_korisnik["uloga"] == "administrator"){
    Korisnik::spasi($_POST);
    echo(json_encode(["message" => "Uspješno ste uredili podatke", "status" => 200]));
} else {
    echo json_encode(["message" => "Nemate pristup podacima", "status" => 400]);
}