<?php
require ("db.php");
if (isset($_POST["imeKorisnika"])) {
    if ($_POST["imeKorisnika"] == ""  || $_POST["prezimeKorisnika"] == "" || $_POST["jmbgKorisnika"] == "" || $_POST["emailKorisnika"] == "" ||  $_POST["lozinkaKorisnika"] == "" || $_POST["pLozinkaKorisnika"] == "")
        $greska = "Nastala je greška niste unijeli sva polja.";
    else if ($_POST["lozinkaKorisnika"] != $_POST["pLozinkaKorisnika"])
        $greska = "Nastala je greška lozinke se ne podudaraju!";
    else {
        $SQL = "INSERT INTO korisnik VALUES (null, '";
        $SQL.= $_POST["imeKorisnika"] . "', '";
        $SQL.= $_POST["prezimeKorisnika"] . "', '";
        $SQL.= $_POST["jmbgKorisnika"] . "', '";
        $SQL.= $_POST["emailKorisnika"] . "', '";
        $SQL.= $_POST["lozinkaKorisnika"] . "', 'učenik');";
        $rezultat = mysqli_query($konekcija, $SQL);
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

    <title>Registracija na sustav e-dnevnik!</title>
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
                <h5>Registracija na sustav e-dnevnik</h5>
                <?php if (isset($greska)): ?>
                <div class="alert alert-danger"><?php echo($greska) ?></div>
                <?php endif ?>
                <form method="POST" action="register.php">
                    <div class="form-group">
                        <label>Ime:</label>
                        <input type="text" class="form-control" name="imeKorisnika" placeholder="Unesite Vaše ime" />
                    </div>

                    <div class="form-group">
                        <label>Prezime:</label>
                        <input type="text" class="form-control" name="prezimeKorisnika" placeholder="Unesite Vaše prezime" />
                    </div>

                    <div class="form-group">
                        <label>Jedinstveni matični broj:</label>
                        <input type="text" class="form-control" name="jmbgKorisnika" placeholder="Unesite Vaš JMBG" />
                    </div>

                    <div class="form-group">
                        <label>E-mail adresa:</label>
                        <input type="email" class="form-control" name="emailKorisnika" placeholder="Unesite Vašu email adresu" />
                    </div>

                    <div class="form-group">
                        <label>Vaša lozinka:</label>
                        <input type="password" class="form-control" name="lozinkaKorisnika" placeholder="Unesite Vašu lozinku" />
                    </div>

                    <div class="form-group">
                        <label>Ponovite Vašu lozinku:</label>
                        <input type="password" class="form-control" name="pLozinkaKorisnika" placeholder="Ponovite Vašu lozinku" />
                    </div>
                    <button type="submit" class="btn btn-primary">Pošalji obrazac</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>