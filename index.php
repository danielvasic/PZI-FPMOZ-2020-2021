<?php
session_start();
if (!isset($_SESSION["token"])) header("Location: login.php");
include("model/db.php"); 
include("model/korisnik.class.php");

if (isset($_GET["akcija"]) && $_GET["akcija"] == "pobrisi") {
  Korisnik::pobrisi($_GET["id"]);
}

$id = $_SESSION["token"];
$upit = "SELECT * FROM korisnik WHERE ID=".$id;

$rezultat = mysqli_query($konekcija, $upit);
$prijavljeni_korisnik = mysqli_fetch_assoc($rezultat);
$naslov = "Dobrodošli na sustav " . $prijavljeni_korisnik["ime"]. " " .$prijavljeni_korisnik["prezime"];
include("static/header.php");
?>
<div class="container h-100">
    <div class="row shadow p-5">
        <div class="col-12 mb-5">
            <h3 class="float-left">Administracija korisnika</h3>
            <a title="Odjavite se sa sustava" data-toggle="tooltip" data-placement="top"  class="btn btn-light float-right mt-1" href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
        </div>
        <div class="col-12">
          <table class="table table-striped table-hover">
            <tr>
              <th>#ID</th>
              <th>Ime</th>
              <th>Prezime</th>
              <th>Email</th>
              <th>JMBG</th>
              <th>Akcije</th>
            </tr>
            <?php
              foreach(Korisnik::dajSve() as $korisnik):
            ?>
            <tr>
              <td><?= $korisnik["ID"] ?></td>
              <td><?= $korisnik["ime"] ?></td>
              <td><?= $korisnik["prezime"] ?></td>
              <td><?= $korisnik["email"] ?></td>
              <td><?= $korisnik["JMBG"] ?></td>
              <td>
                <a class="btn btn-danger" href="index.php?akcija=pobrisi&id=<?= $korisnik["ID"] ?>"><i class="fas fa-trash"></i></a>
              </td>
            </tr>
            <?php endforeach ?>
          </table>
        </div>
    </div>

</div>
<?php
include("static/header.php");
?>