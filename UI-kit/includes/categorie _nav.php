 <?php
  require_once('includes\database.php');
  if (!isset($_GET["root"])) {
    $stmt = $dbh->prepare("SELECT * from Rubriek where Volgnr = ?");

    if ($stmt->execute(array(-1))) {
      echo "<ul class=\"noDots\">";
      while ($row = $stmt->fetch()) {
        if ($row["Rubrieknummer"] != -1) {
          
          echo "<li> <a class=\"uk-link-heading\" href=\"categorieen.php?root=$row[Rubrieknummer]\">  $row[Rubrieknaam] </a></li>";
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
                //breadcrumb
                $text =  "<a class=\"uk-link-heading\" href=\"categorieen.php?root=$row2[Rubrieknummer]\">  $row2[Rubrieknaam] </a> /  $text";
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
            // terug knop
            echo "<li> <a class=\"categorie-terug\" href=\"index.php\"> <span uk-icon=\"icon: arrow-left\"></span>terug</a></li>  ";
          } else {
            echo "<li> <a class=\"categorie-terug\" href=\"categorieen.php?root=$row[Volgnr]\"> <span uk-icon=\"icon: arrow-left\"></span>terug</a></li>  ";
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
            // link naar rubriek
            echo "<li> <a class=\"uk-link-heading\" href=\"categorieen.php?root=$row[Rubrieknummer]\">  $row[Rubrieknaam] </a> </li>  ";
          }
        }
      } else {
        $stmt = $dbh->prepare("SELECT * from Rubriek where Rubrieknummer = ?");

        if ($stmt->execute(array($_GET["root"]))) {

          while ($row = $stmt->fetch()) {
            if ($row["Rubrieknummer"] != -1) {
              //link naar parent rubriek
              echo "<li> <a class=\"uk-link-heading\" href=\"categorieen.php?root=$row[Volgnr]\">  $row[Rubrieknaam] </a> </li>  ";
            }
          }
        }
      }
      echo "</ul >";
    }
  }
  ?>