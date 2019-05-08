 <?php
  require_once('includes\database.php');
  if (!isset($_GET["root"])) {
    $stmt = $dbh->prepare("SELECT * from Categorieen where Parent = ?");

    if ($stmt->execute(array(-1))) {
      echo "<ul class=\"noDots\">";
      while ($row = $stmt->fetch()) {
        echo "<li> <a class=\"uk-link-heading\" href=\"categorieen.php?root=$row[ID]\">  $row[Name] </a> </li>";
      }
      echo "</ul>";
    }
  } else {

    $stmt = $dbh->prepare("SELECT * from Categorieen where ID = ?");

    if ($stmt->execute(array($_GET["root"]))) {

      while ($row = $stmt->fetch()) {
        if($row["ID"] != -1){
        $text =  "$row[Name] ";
        $parent = $row["Parent"];
       
          while($parent > 0){
            $stmt2 = $dbh->prepare("SELECT * from Categorieen where ID = ?");

            if ($stmt2->execute(array($parent))) {
              while ($row2 = $stmt2->fetch()) { 
              $text =  "<a class=\"uk-link-heading\" href=\"categorieen.php?root=$row2[ID]\">  $row2[Name] </a> /  $text";
              $parent = $row2["Parent"];
              }
            }
          }
        echo $text;
        }        
      }
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
        $stmt->execute(array($_GET["root"]));
        while ($row = $stmt->fetch()) {
         
      
            echo "<li> <a class=\"uk-link-heading\" href=\"categorieen.php?root=$row[ID]\">  $row[Name] </a> </li>  ";
        
          
        
      }
    }else{
      $stmt = $dbh->prepare("SELECT * from Categorieen where ID = ?");

        if ($stmt->execute(array($_GET["root"]))) {

          while ($row = $stmt->fetch()) {
            echo "<li> <a class=\"uk-link-heading\" href=\"categorieen.php?root=$row[Parent]\">  $row[Name] </a> </li>  ";
          }
    }
  }
        echo "</ul >";
     
    }
  }
  ?>