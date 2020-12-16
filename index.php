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
        <div class="col-8">
          <div class="alert alert-success d-none" id="info"></div>
          <div class="alert alert-danger d-none" id="error"></div>
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
            <tr id="korisnik_<?= $korisnik["ID"] ?>">
              <td class="id"><?= $korisnik["ID"] ?></td>
              <td class="ime"><?= $korisnik["ime"] ?></td>
              <td class="prezime"><?= $korisnik["prezime"] ?></td>
              <td class="email"><?= $korisnik["email"] ?></td>
              <td class="jmbg"><?= $korisnik["JMBG"] ?></td>
              <td>
              
              <div class="btn-group" role="group" aria-label="Basic example">
                <a title="Uredite korisnika" data-toggle="tooltip" data-placement="top"  type="button" class="btn btn-sm btn-info" ref="<?= $korisnik["ID"] ?>" href="users/edit.php" onclick="dohvati_korisnika(event);"><i class="fas fa-edit"></i></a>
                <a title="Pobrišite korisnika" data-toggle="tooltip" data-placement="top"  type="button"  class="btn btn-sm btn-danger delete-user" href="index.php?akcija=pobrisi&id=<?= $korisnik["ID"] ?>"><i class="fas fa-trash"></i></a>
              </div>
              </td>
            </tr>
            <?php endforeach ?>
          </table>
        </div>

        <div class="col-4">
          <form method="POST" action="users/add.php" id="addUserForm">
                <div class="form-group">
                    <label>Ime korisnika:</label>
                    <!-- Dodavanje polja za pohranu ID korisnika -->
                    <input type="hidden" name="idKorisnika" />
                    <!-- Dodavanje polja za pohranu ID korisnika -->
                    <input type="text" required class="form-control" name="imeKorisnika" placeholder="Unesite Vaše ime" />
                </div>

                <div class="form-group">
                    <label>Prezime korisnika:</label>
                    <input type="text" required class="form-control" name="prezimeKorisnika" placeholder="Unesite Vaše prezime" />
                </div>

                <div class="form-group">
                    <label>Jedinstveni matični broj korisnika:</label>
                    <input type="text" required class="form-control" name="jmbgKorisnika" placeholder="Unesite Vaš JMBG" />
                </div>

                <div class="form-group">
                    <label>E-mail adresa korisnika:</label>
                    <input type="email" required class="form-control" name="emailKorisnika" placeholder="Unesite Vašu email adresu" />
                </div>

                <div class="form-group">
                    <label>Lozinka korisnika:</label>
                    <input type="password" class="form-control" name="lozinkaKorisnika" placeholder="Unesite Vašu lozinku" />
                </div>

                <div class="form-group">
                    <label>Uloga korisnika:</label>
                    <select required class="form-control" name="ulogaKorisnika">
                      <option value="nastavnik">Nastavnik</option>
                      <option value="učenik">Učenik</option>
                      <option value="administrator">Administrator</option>
                    </select>
                </div>
                <!-- Dodavanje id atributa na gumb za pohranu (uloga ovog gumba je ovisna o tome je li postavljena vrijednost u polje IDKorisnika) -->
                <button title="Spasi ili uredi korisnika" data-toggle="tooltip" data-placement="top"  type="submit" id="save" class="btn btn-primary">
                  <i class="fas fa-save"></i>
                </button>
            </form>
        </div>
    </div>
</div>
<script>
// Spinner ikonica koja će se postaviti unutar kliknutog buttona
var spinner = "<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"></div>";
// ovaj dio je čisti javascript
function dohvati_korisnika (e){
  
  e.preventDefault();
  
  // Ukoliko je korisnik kliknuo na ikonicu dohvati "roditelj" element (jer je na njemu ref atribut gdje se nalazi ID)
  var target
  if (e.target.tagName.toUpperCase() == "I")
    target = e.target.parentNode
  else
    target = e.target

  // dohvati ID 
  var id = target.getAttribute("ref");
  // ikonuca koju ćemo vratiti na gumb nakon što request završi
  var icon = "<i class=\"fas fa-edit\"></i>";
  
  target.innerHTML = spinner;

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200){
      
      // Ovdje smo stali, sve unutar ove funkcije nije napravljeno na vježbama 16.12.2020.

      // Pretvori niz znakova u objekt
      var user = JSON.parse(this.responseText)
      // Postavi vrijednosti u odgovarajuće elemente
      document.getElementsByName("idKorisnika")[0].value = user.ID;
      document.getElementsByName("imeKorisnika")[0].value = user.ime;
      document.getElementsByName("prezimeKorisnika")[0].value = user.prezime;
      document.getElementsByName("jmbgKorisnika")[0].value = user.JMBG;
      document.getElementsByName("emailKorisnika")[0].value = user.email;
      document.getElementsByName("ulogaKorisnika")[0].value = user.uloga;
      // Vrati ikonicu
      target.innerHTML = icon;

    }
  }
  xhttp.open("GET", "users/get.php?id="+id, true);
  xhttp.send()
}

// ovaj dio je jquery slanje podataka na server i spašavanje u bazu
$("#save").click(function (evt) {
  evt.preventDefault();
  if ($("input[name=idKorisnika]").val() == ""){
    $("#addUserForm").submit()
  } else {
    $.ajax({
      type: "POST",
      url: "users/edit.php",
      data: $("#addUserForm").serialize(),
      success: function(data) {
        // dohvati id korisnika
        var id = $("input[name=idKorisnika]").val()
        // ažuriraj tablicu
        if (data.status == 200){
          console.log($("#korisnik_"+id+" .ime"));
          $("#korisnik_"+id+" .ime").html($("input[name=imeKorisnika]").val());
          $("#korisnik_"+id+" .prezime").html($("input[name=prezimeKorisnika]").val());
          $("#korisnik_"+id+" .email").html($("input[name=emailKorisnika]").val());
          $("#korisnik_"+id+" .jmbg").html($("input[name=jmbgKorisnika]").val());
          $("#info").html(data.message).removeClass("d-none");
        } else {
          $("#info").addClass("d-none");
          $("#error").html(data.message).removeClass("d-none");
        }
      },
      dataType: "json"
    });
  }
});

// potvrda da li stvarno želi pobrisati korisnika
$(".delete-user").click(function (evt) {
  evt.preventDefault();
  var url = $(this).attr("href");
  bootbox.confirm({
    message:"Stvarno želite pobrisati korisnika!", 
    locale: "hr",
    callback:function(result){ 
        if(result){
          $(location).attr('href', url)
        }
    }
  });
})
</script>
<?php
include("static/footer.php");
?>