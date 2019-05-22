<?php



?>


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
    require_once('includes/database.php'); ?>
    <div class="page-container">
        <div class="content-wrap">

            <!-- header -->
            <div class="uk-hidden@s">
                <nav class="uk-navbar-container uk-flex-center uk-flex-column" uk-navbar>
                    <div class="uk-navbar-nav  uk-flex-center">
                        <a class=" uk-logo uk-navbar-item " href="index.php"><img src="media\logo.png" alt="logo" width=100em></a>
                    </div>
                    <div class="uk-navbar-nav  uk-flex-center">
                        <div class="uk-navbar-item ">
                            <form action="productpage.php">
                                <div class="uk-inline">
                                    <button class="uk-form-icon uk-form-icon-flip" uk-icon="icon: search" type="Submit"></button>
                                    <input class="uk-input" type="text" name="search" placeholder="Waar bent u naar op zoek?">
                                </div>
                            </form>
                            <a class="uk-margin-left" href="index.php" uk-icon="icon: user"></a>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="uk-flex-center uk-flex-column">
                <div class="registreren">
                    <h2>Veiling Plaatsen</h2>
                </div>
              
                    <div class="registreerbox">

                        <h3>foto's</h3>
                <?php
         if(!isset($_SESSION['fotos']) && !isset($_SESSION['index']) ){       
$_SESSION['fotos'] = array("https://via.placeholder.com/150","https://via.placeholder.com/150","https://via.placeholder.com/150","https://via.placeholder.com/150");
$_SESSION['index'] = 0;
}

                ?>
                        <div class="uk-flex">
    <div class="uk-card uk-card-default  uk-width-2-5 uk-height-medium "><img class="uk-width-1-1 uk-height-1-1" src="<?php echo$_SESSION['fotos'][0];  ?>" alt="Girl in a jacket"></div>
    
    
    <div class=" uk-width-expand ">
    <div class="uk-card uk-card-default  uk-width-expand uk-height-small ">
<div class="uk-flex">
<img class="uk-width-1-3 uk-height-1-1" src="<?php echo$_SESSION['fotos'][1];  ?>" alt="Girl in a jacket">
<img class="uk-width-1-3 uk-height-1-1" src="<?php echo$_SESSION['fotos'][2];  ?>" alt="Girl in a jacket">
<img class="uk-width-1-3 uk-height-1-1" src="<?php echo$_SESSION['fotos'][3];  ?>" alt="Girl in a jacket">
</div>

    </div>
    <div class="uk-card uk-card-default  uk-width-expand uk-height-small ">
    <form action="includes/uploadFoto.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
<button onclick=" Session_start(); $_SESSION['index'] = 0;">test</button>
    </div>


    </div>
</div>



                    </div>
                    
                    <div class="registreerbox">

                    <div class="uk-flex">
                       <div class="uk-width-1-3"> </div>
                       <div class="uk-width-1-3 uk-text-left"> 


                       <form action="veiling-Maken.php" method="get">
<?php
  require_once('includes\database.php');
  if (!isset($_GET["root"])) {
    $stmt = $dbh->prepare("SELECT * from Rubriek where Volgnr = ?");

    if ($stmt->execute(array(-1))) {
      echo "<ul class=\"noDots\">";
      while ($row = $stmt->fetch()) {
        if ($row["Rubrieknummer"] != -1) {
          echo "   <li><input type=\"radio\" name=\"Rubriek\" value=\"$row[Rubrieknummer]\"> <a class=\"uk-link-heading\" href=\"veiling-Maken.php?root=$row[Rubrieknummer]\">  $row[Rubrieknaam] </a></li>";
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
            echo "<li><input type=\"radio\" name=\"Rubriek\" value=\"$row[Rubrieknummer]\"> <a class=\"uk-link-heading\" href=\"veiling-Maken.php?root=$row[Rubrieknummer]\">  $row[Rubrieknaam] </a> </li>  ";
          }
        }
      } else {
        $stmt = $dbh->prepare("SELECT * from Rubriek where Rubrieknummer = ?");

        if ($stmt->execute(array($_GET["root"]))) {

          while ($row = $stmt->fetch()) {
            if ($row["Rubrieknummer"] != -1) {
              echo "<li><input type=\"radio\" name=\"Rubriek\" value=\"$row[Rubrieknummer]\"> <a class=\"uk-link-heading\" href=\"veiling-Maken.php?root=$row[Volgnr]\">  $row[Rubrieknaam] </a> </li>  ";
            }
          }
        }
      }
      echo "</ul >";
    }
  }
  ?>

                       </div>
                       <div class="uk-width-1-3"> </div>
                   </div>



                   
    
</div>





                    <div class="registreerbox">

                        <h3>Algemene informatie</h3>
                        <label class="registreerlabel" for="titel">Titel</label><br>
                        <input class="uk-input input-registratie" type="text" id="titel" name="titel"><br>
                        <label class="registreerlabel" for="staat">Staat van het product</label><br>
                        <select class="uk-select input-registratie" name="staat"><br>

                                 <?php
                            $sql = "select distinct Staat from Voorwerp where staat != ''";
                            if ($sth = $dbh->prepare($sql)) {
                                if ($sth->execute(array())) {
                                    while ($alles = $sth->fetch()) {
                                       
                                            $tekst = "<option value='$alles[Staat]'>$alles[Staat]</option>";
                                        
                                        echo $tekst;
                                    }
                                }
                            }
                            ?>
                        </select><br>
                        <label class="registreerlabel" for="beschrijving">Beschrijving</label><br>
                        <textarea class="uk-textarea" name="message" rows="5" cols="20"></textarea>
                    </div>
                    <div class="registreerbox">
                        <h3>Veilinginformatie</h3>
                        <label class="registreerlabel" for="lengte">lengte van de veiling</label><br>
                        <select class="uk-select input-registratie" name="lengte"><br>
                            <option value="1" >1 dag</option>
                            <option value='3'>3 dagen</option>
                            <option value='5'>5 dagen</option>
                            <option value='7' selected>7 dagen</option>
                            <option value='10'>10 dagen</option>
                        </select><br>
                        <label class="registreerlabel" for="valuta">Valuta</label><br>
                        <select class="uk-select input-registratie" name="valuta"><br>
                        <?php
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
                        <label class="registreerlabel" for="prijs">Prijs</label><br>
                        <input class="uk-input input-registratie" type="number" min="0.00" max="10000.00" step="0.01" id="prijs" name="prijs"><br>
                        <label class="registreerlabel" for="verzendkosten">Verzendkosten</label><br>
                        <input class="uk-input input-registratie" type="number" min="0.00" max="10000.00" step="0.01" id="verzendkosten" name="verzendkosten"><br>
                        <label class="registreerlabel" for="verzendinstructies">verzendinstructies</label><br>
                        <input class="uk-input input-registratie" type="text" id="verzendinstructies" name="verzendinstructies"><br>
                        <label class="registreerlabel" for="betalingswijze">Betalingswijze</label><br>
                        <select class="uk-select input-registratie" name="betalingswijze"><br>
                            <option value="Contant">Contant</option>
                            <option value="Bank">Bank</option>
                            <option value="Giro">Giro</option>
                            <option value="Anders">Anders</option>
                        </select><br>
                        <label class="registreerlabel" for="betalingsinstructies">betalingsinstructies</label><br>
                        <input class="uk-input input-registratie" type="text" id="betalingsinstructies" name="betalingsinstructies"><br>
                           
                    </div>
                    <div class="registreerbox">
                        <h3>Locatie van het product</h3>
                        <label class="registreerlabel" for="plaatsnaam">Plaatsnaam</label><br>
                        <input class="uk-input input-registratie" type="text" id="plaatsnaam" name="plaatsnaam"><br>
                        <label class="registreerlabel" for="land">Land</label><br>
                        <select class="uk-select input-registratie" name="land"><br>
                        <?php
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
                    <button type="submit" name="veiling-maken-button" class="uk-button knop-veiling-maken">Veiling plaatsen</button>
                </form>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.inc.php'; ?>
</body>

</html>