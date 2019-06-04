<?php
echo $_SESSION['userId'];
require_once('database.php');
$sql = 'select * from Meldingen where Ontvanger = ? and Ontvangen = 0';
$sql2 = '	update Meldingen
set Ontvangen = 1  where MeldingID = ?';
if(isset($_SESSION['userId'])){

if ($sth = $dbh->prepare($sql)) {
    if ($sth->execute(array($_SESSION['userId']))) {      
      while ($alles = $sth->fetch()) {   

echo "<script> UIkit.notification('$alles[Bericht]', {pos: 'bottom-right'}); </script>";

if ($sth2 = $dbh->prepare($sql2)) {
    if ($sth2->execute(array($alles['MeldingID'] ))) {   
    }
}


      }
    }
}

}else{
  
}