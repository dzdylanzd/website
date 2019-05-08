
    }



    echo "<ul class=\"noDots\">";
    if ($_GET["root"] != -1) {
      $stmt = $dbh->prepare("SELECT * from Categorieen where ID = ?");

      if ($stmt->execute(array($_GET["root"]))) {

        while ($row = $stmt->fetch()) {
          echo "<li> <a class=\"categorie-terug\" href=\"categorieen.php?root=$row[Parent]\"> <span uk-icon=\"icon: arrow-left\"></span>terug</a></li>  ";
        }
      }
    }
    $stmt = $dbh->prepare("SELECT * from Categorieen where Parent = ?");

    if ($stmt->execute(array($_GET["root"]))) {

      if ($row = $stmt->fetch() > 0) {
        echo "<li> <a class=\"uk-link-heading\" href=\"categorieen.php?root=$row[ID]\">  $row[Name] </a> </li>  ";
        while ($row = $stmt->fetch()) {
          echo "<li> <a class=\"uk-link-heading\" href=\"categorieen.php?root=$row[ID]\">  $row[Name] </a> </li>  ";
        }
        echo "</ul >";
      } else {
        $stmt = $dbh->prepare("SELECT * from Categorieen where ID = ?");

        if ($stmt->execute(array($_GET["root"]))) {

          while ($row = $stmt->fetch()) {
            echo "<li> <a class=\"uk-link-heading\" href=\"categorieen.php?root=$row[Parent]\">  $row[Name] </a> </li>  ";
          }
          echo "</ul>";
        }
      }
    }
  }
  ?>