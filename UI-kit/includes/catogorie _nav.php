 <?php
    require_once('includes\database.php');
   if(!isset($_GET["root"])){
        $stmt = $dbh->prepare("SELECT * from Categorieen where Parent = ?");

        if ($stmt->execute(array(-1))) {
            echo "<ul>";
            while ($row = $stmt->fetch()) {   
              echo "<li> <a href=\"index.php?root=$row[ID]\">  $row[Name] </a> </li>  ";
            }
            echo "</ul>";
          }
    }else{
        echo "<ul>";
        if($_GET["root"] != -1){
        $stmt = $dbh->prepare("SELECT * from Categorieen where ID = ?");

                if ($stmt->execute(array($_GET["root"]))) {
                   
                    while ($row = $stmt->fetch()) {   
                        echo "<li> <a href=\"index.php?root=$row[Parent]\">  terug </a> </li>  ";
                      }
                     
            
            
          }
        }
        $stmt = $dbh->prepare("SELECT * from Categorieen where Parent = ?");

        if ($stmt->execute(array($_GET["root"]))) {
            
            if($row = $stmt->fetch() >0){
                
                while ($row = $stmt->fetch()) {   
                    echo "<li> <a href=\"index.php?root=$row[ID]\">  $row[Name] </a> </li>  ";
                  }
                  echo "</ul>";
            }else{
                $stmt = $dbh->prepare("SELECT * from Categorieen where ID = ?");

                if ($stmt->execute(array($_GET["root"]))) {
                   
                    while ($row = $stmt->fetch()) {   
                        echo "<li> <a href=\"index.php?root=$row[Parent]\">  $row[Name] </a> </li>  ";
                      }
                      echo "</ul>";
            
            
          }
        }
    }
}  
    
 
 
?>