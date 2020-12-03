<?php
session_start();

require("db.php");

if (isset($_POST["emailKorisnika"])){
    if ($_POST["emailKorisnika"] == "" || $_POST["lozinkaKorisnika"] == ""){
        $greska = "Molimo unesite Vašu email adresu i lozinku.";
    } else {
        $SQL = "SELECT ID FROM korisnik WHERE";
        $SQL .= " email='" . $_POST["emailKorisnika"] . "' AND ";
        $SQL .= " lozinka='". md5($_POST["lozinkaKorisnika"]) . "'";
        $rezultat = mysqli_query($konekcija, $SQL);
        
        if (mysqli_num_rows($rezultat) == 0) {
            $greska = "Vaši korisnički podaci nisu ispravni molimo pokušajte ponovo.";
        } else {
            $korisnik = mysqli_fetch_assoc($rezultat);
            $_SESSION["token"] = $korisnik["ID"];
            header("Location: index.php");
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Prijava na sustav e-dnevnik!</title>
    <style>
        html, body {
            height:100% !important;
        }
    </style>
  </head>
  <body>
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <div class="col shadow p-5">
                <h5>Prijava na sustav e-dnevnik</h5>
                <?php if (isset($greska)): ?>
                <div class="alert alert-danger"><?php echo($greska) ?></div>
                <?php endif ?>
                <form method="POST" action="login.php">
                    <div class="form-group">
                        <label>E-mail adresa:</label>
                        <input type="email" class="form-control" name="emailKorisnika" placeholder="Unesite Vašu email adresu" />
                    </div>

                    <div class="form-group">
                        <label>Vaša lozinka:</label>
                        <input type="password" class="form-control" name="lozinkaKorisnika" placeholder="Unesite Vašu lozinku" />
                    </div>
                    <p>Nemate račun? Napravite ga <a  href="register.php">ovdje</a>.</p>
                    <button type="submit" class="btn btn-primary">Pošalji obrazac</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>