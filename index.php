<?php

include("db.php"); 

$upit = "SELECT * FROM korisnik";

$rezultat = mysqli_query($konekcija, $upit);
// print(mysqli_error($konekcija));

$redak = mysqli_fetch_assoc($rezultat);
var_dump($redak);

?>