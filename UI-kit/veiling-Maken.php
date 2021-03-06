<!DOCTYPE html>
<html>

<head>
  <title>EenmaalAndermaal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/uikit.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <script src="js/uikit.min.js"></script>
  <script src="js/uikit-icons.min.js"></script>
</head>

<body>
  <?php include 'includes\nav-L-M.php';
  include 'includes/defaultMobileNav.php';
  require_once('includes/database.php'); ?>
  <div class="page-container">
    <div class="content-wrap">

      <?php
      // error handlers
      if (isset($_GET['error'])) {
        if ($_GET['error'] == "geenFoto") {
          echo '<p class="errors">U moet een foto kiezen.</p>';
        } else if ($_GET['error'] == "leeg") {
          echo '<p class="errors">U heeft een veld niet ingevuld.</p>';
        } else if ($_GET['error'] == "geenCategorie") {
          echo '<p class="errors">U moet een categorie kiezen.</p>';
        }
      }

      ?>

      <div class="uk-flex-center uk-flex-column">
        <div class="registreren">
          <h2 class="veiling-Plaatsen">Veiling Plaatsen</h2>
        </div>
        <div class="veiling-maken-box">
          <h3>Foto's</h3>
          <?php
          // als foto's nog niet is aangemaakt maak het aan
          if (!isset($_SESSION['fotos']) && !isset($_SESSION['index'])) {
            $_SESSION['fotos'] = array("https://via.placeholder.com/150", "https://via.placeholder.com/150", "https://via.placeholder.com/150", "https://via.placeholder.com/150");
            $_SESSION['index'] = 0;
          }
          ?>
          <!-- display foto -->
          <div class="flex-column-phone">
            <div class="uk-card uk-card-default  uk-width-2-5@s uk-width-1-1  uk-height-medium@s "><img class="uk-width-1-1 uk-height-1-1" src="<?php echo $_SESSION['fotos'][0];  ?>" alt="Foto 1"></div>
            <div class=" uk-width-expand ">
              <div class="  uk-width-expand uk-height-small@s ">
                <div class="flex-column-phone ">
                  <img class="maximg400 uk-height-small@s uk-width-1-3@s uk-width-1-1" src="<?php echo $_SESSION['fotos'][1];  ?>" alt="Foto 2">

                  <img class="maximg400 uk-height-small@s uk-width-1-3@s uk-width-1-1 " src="<?php echo $_SESSION['fotos'][2];  ?>" alt="Foto 3">

                  <img class="maximg400 uk-width-1-3@s uk-width-1-1 uk-height-small@s" src="<?php echo $_SESSION['fotos'][3];  ?>" alt="Foto 4">
                </div>
              </div>
              <form class="upload-form" action="includes/uploadFoto.php" method="post" enctype="multipart/form-data">
                <div class="uk-hidden@s"><br></div>
                Selecteer een bestand om te uploaden:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <div class="uk-hidden@s"><br></div>
                <input type="submit" value="Foto uploaden" name="submit">
              </form>
            </div>
          </div>
        </div>
        <div class="veiling-maken-box">
          <div class="uk-flex">
            <div class="uk-width-1-3 uk-visible@s"> </div>
            <div class="uk-width-1-3@s uk-wdith-1-1 uk-text-left">
              <form action="includes\veiling-maken.inc.php" method="post">
               
              <!-- rubriek laten zien begin -->
              <h3 class="rubriek">Rubrieken</h3>
                <?php
                require_once('includes\database.php');
                if (!isset($_GET["root"])) {
                  $stmt = $dbh->prepare("SELECT * from Rubriek where Volgnr = ?");

                  if ($stmt->execute(array(-1))) {
                    echo "<ul class=\"noDots\">";
                    while ($row = $stmt->fetch()) {
                      if ($row["Rubrieknummer"] != -1) {
                        echo "   <li><input type=\"radio\" name=\"Rubriek\" id=\"Rubriek\" value=\"$row[Rubrieknummer]\"> <a class=\"uk-link-heading\" href=\"veiling-Maken.php?root=$row[Rubrieknummer]\">  $row[Rubrieknaam] </a></li>";
                      }
                    }
                    echo "</ul>";
                  }
                } else {

                  $stmt = $dbh->prepare("SELECT * from Rubriek where Rubrieknummer = ?");

                  if ($stmt->execute(array($_GET["root"]))) {

                    while ($row = $stmt->fetch()) {
                      if ($row["Rubrieknummer"] != -1) {
                        $text = $row["Rubrieknaam"];
                        $parent = $row["Volgnr"];

                        while ($parent > 0) {
                          $stmt2 = $dbh->prepare("SELECT * from Rubriek where Rubrieknummer = ?");

                          if ($stmt2->execute(array($parent))) {
                            while ($row2 = $stmt2->fetch()) {
                              $text =  " <a class=\"uk-link-heading\" href=\"veiling-Maken.php?root=$row2[Rubrieknummer]\">  $row2[Rubrieknaam] </a> /  $text";
                              $parent = $row2["Volgnr"];
                            }
                          }
                        }
                      }
                    }
                    $text = "<div> $text </div>";
                    echo $text;
                    echo "<div class=\"-margin20\"></div>";
                  }



                  echo "<ul class=\"noDots\">";
                  if ($_GET["root"] != -1) {
                    $stmt = $dbh->prepare("SELECT * from Rubriek where Rubrieknummer = ?");

                    if ($stmt->execute(array($_GET["root"]))) {

                      while ($row = $stmt->fetch()) {
                        if ($row["Volgnr"] == -1) {
                          echo "<li> <a class=\"categorie-terug\" href=\"veiling-Maken.php\"> <span uk-icon=\"icon: arrow-left\"></span>terug</a></li>  ";
                        } else {
                          echo "<li> <a class=\"categorie-terug\" href=\"veiling-Maken.php?root=$row[Volgnr]\"> <span uk-icon=\"icon: arrow-left\"></span>terug</a></li>  ";
                        }
                      }
                    }
                  }
                  $stmt = $dbh->prepare("SELECT * from Rubriek where Volgnr = ?");

                  if ($stmt->execute(array($_GET["root"]))) {
                    if ($row = $stmt->fetch() > 0) {
                      $stmt->execute(array($_GET["root"]));
                      while ($row = $stmt->fetch()) {
                        if ($row["Rubrieknummer"] != -1) {
                          echo "<li><input type=\"radio\" name=\"Rubriek\" id=\"Rubriek\" value=\"$row[Rubrieknummer]\"> <a class=\"uk-link-heading\" href=\"veiling-Maken.php?root=$row[Rubrieknummer]\">  $row[Rubrieknaam] </a> </li>  ";
                        }
                      }
                    } else {
                      $stmt = $dbh->prepare("SELECT * from Rubriek where Rubrieknummer = ?");

                      if ($stmt->execute(array($_GET["root"]))) {

                        while ($row = $stmt->fetch()) {
                          if ($row["Rubrieknummer"] != -1) {
                            echo "<li><input type=\"radio\" name=\"Rubriek\" id=\"Rubriek\"  value=\"$row[Rubrieknummer]\"> <a class=\"uk-link-heading\" href=\"veiling-Maken.php?root=$row[Volgnr]\">  $row[Rubrieknaam] </a> </li>  ";
                          }
                        }
                      }
                    }
                    echo "</ul >";
                  }
                }
                ?>

            </div>
            <div class="uk-width-1-3  uk-visible@s"> </div>
          </div>
        </div>
<!-- rubriek laten zien einde -->


        <div class="veiling-maken-box">

          <h3>Algemene informatie</h3>
          <label class="registreerlabel" for="titel">Titel</label><br>
          <input class="uk-input input-registratie" type="text" id="titel" name="titel"><br>
          <label class="registreerlabel" for="staat">Staat van het product</label><br>
          <select class="uk-select input-registratie" name="staat"><br>
            <option value="Nieuw">Nieuw</option>
            <option value="Zo goed als nieuw">Zo goed als nieuw</option>
            <option value="Gebruikt">Gebruikt</option>
          </select><br>

          <label class="registreerlabel" for="beschrijving">Beschrijving</label><br>
          <textarea class="uk-textarea beschrijving" name="message" rows="5" cols="20"></textarea>
        </div>
        <div class="veiling-maken-box">
          <h3>Veilinginformatie</h3>
          <label class="registreerlabel" for="lengte">Lengte van de veiling</label><br>
          <select class="uk-select input-registratie" name="lengte"><br>
            <option value="1">1 dag</option>
            <option value='3'>3 dagen</option>
            <option value='5'>5 dagen</option>
            <option value='7' selected>7 dagen</option>
            <option value='10'>10 dagen</option>
          </select><br>
          <label class="registreerlabel" for="valuta">Valuta</label><br>
          <select class="uk-select input-registratie" name="valuta"><br>
            <?php
            // haal valuta op
            $sql = "select distinct Valuta from Voorwerp";
            if ($sth = $dbh->prepare($sql)) {
              if ($sth->execute(array())) {
                while ($alles = $sth->fetch()) {

                  $tekst = "<option value='$alles[Valuta]'>$alles[Valuta]</option>";

                  echo $tekst;
                }
              }
            }
            ?>
          </select><br>
          <label class="registreerlabel" for="prijs">Startprijs</label><br>
          <input class="uk-input input-registratie" type="number" min="0.00"  step="0.01" id="prijs" name="prijs"><br>
          <label class="registreerlabel" for="verzendkosten">Verzendkosten</label><br>
          <input class="uk-input input-registratie" type="number" min="0.00" max="10000.00" step="0.01" id="verzendkosten" name="verzendkosten"><br>
          <label class="registreerlabel" for="verzendinstructies">Verzendinstructies</label><br>
          <input class="uk-input input-registratie" type="text" id="verzendinstructies" name="verzendinstructies"><br>
          <label class="registreerlabel" for="betalingswijze">Betalingswijze</label><br>
          <select class="uk-select input-registratie" name="betalingswijze"><br>
            <option value="Contant">Contant</option>
            <option value="Bank">Bank</option>
            <option value="Giro">Giro</option>
            <option value="Anders">Anders</option>
          </select><br>
          <label class="registreerlabel" for="betalingsinstructies">Betalingsinstructies</label><br>
          <input class="uk-input input-registratie" type="text" id="betalingsinstructies" name="betalingsinstructies"><br>

        </div>
        <div class="veiling-maken-box">
          <h3>Locatie van het product</h3>
          <label class="registreerlabel" for="plaatsnaam">Plaatsnaam</label><br>
          <input class="uk-input input-registratie" type="text" id="plaatsnaam" name="plaatsnaam"><br>
          <label class="registreerlabel" for="land">Land</label><br>
          <select class="uk-select input-registratie" name="land"><br>
            <?php
            // haal landen op
            $sql = "SELECT LandNaam FROM Landen ORDER BY LandNaam ASC";
            if ($sth = $dbh->prepare($sql)) {
              if ($sth->execute(array())) {
                while ($alles = $sth->fetch()) {
                  if ($alles['LandNaam'] == "Nederland") {
                    $tekst = "<option value='$alles[LandNaam]' selected>$alles[LandNaam]</option>";
                  } else {
                    $tekst = "<option value='$alles[LandNaam]'>$alles[LandNaam]</option>";
                  }
                  echo $tekst;
                }
              }
            }
            ?>
          </select><br>
        </div>
        <button type="submit" name="veiling-maken-button" class="uk-button knop-registreren ">Veiling plaatsen</button>
        </form>
      </div>
    </div>
  </div>
  <?php include 'includes/footer.inc.php'; ?>
</body>

</html> 