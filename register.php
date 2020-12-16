<?php
require ("model/db.php");
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
        $SQL.= md5($_POST["lozinkaKorisnika"]) . "', 'učenik');";
        $rezultat = mysqli_query($konekcija, $SQL);
    }
}
$naslov = "Registracija na sustav";
include("static/header.php");
?>
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
                <p>Imate račun? Prijavite se <a  href="login.php">ovdje</a>.</p>
                
                <button type="submit" class="btn btn-primary">Pošalji obrazac</button>
            </form>
        </div>
    </div>
</div>
<?php
include("static/footer.php");
?>