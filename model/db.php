<?php
define("RACUNALO", "localhost");
define("KORISNIK", "root");
define("LOZINKA", "");
define("BAZA", "ednevnik");

$konekcija = mysqli_connect(RACUNALO, KORISNIK, LOZINKA, BAZA);

if (!$konekcija) {
    die("Nismo se spojili na bazu iz nekog razloga, možda znate o čemu se radi, evo greška: " . mysqli_connect_error());
}
?>