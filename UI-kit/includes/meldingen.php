<?php

require_once('database.php');
$sql = 'select * from meldingen where ontvanger = ? and ontvangen = 0';
$sql2 = '	update meldingen
set ontvangen = 1  where meldingId = ?';
if(isset($_SESSION['userId'])){

if ($sth = $dbh->prepare($sql)) {
    if ($sth->execute(array($_SESSION['userId']))) {      
      while ($alles = $sth->fetch()) {   

echo "<script> UIkit.notification('$alles[bericht]', {pos: 'bottom-right'}); </script>";

if ($sth2 = $dbh->prepare($sql2)) {
    if ($sth2->execute(array($alles['meldingId'] ))) {   
    }
}


      }
    }
}

}else{
  
}