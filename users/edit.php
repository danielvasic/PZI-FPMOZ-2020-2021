<?php
session_start();
if (!isset($_SESSION["token"])) header("Location: login.php");

include("../model/db.php"); 
include("../model/korisnik.class.php");

$id = $_SESSION["token"];
$upit = "SELECT * FROM korisnik WHERE ID=".$id;

$rezultat = mysqli_query($konekcija, $upit);
$prijavljeni_korisnik = mysqli_fetch_assoc($rezultat);

if (!$prijavljeni_korisnik) header("Location: login.php");
if ($prijavljeni_korisnik["uloga"] == "administrator"){
    Korisnik::spasi($_POST);
    echo(json_encode(["message" => "Uspješno ste uredili podatke", "status" => 200]));
} else {
    echo json_encode(["message" => "Nemate pristup podacima", "status" => 400]);
}