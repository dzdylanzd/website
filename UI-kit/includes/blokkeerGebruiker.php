<?php
require_once('database.php');

$gebruiker = $_POST['gebruikersnaam'];

if(isset($_POST['GebruikerDeblokkeren'])){
$BlokkeerStatus = 0;
}else if(isset($_POST['GebruikerBlokkeren'])){
  
  $BlokkeerStatus = 1;

}
$sql = 'update Gebruiker 
set Geblokkeerd = ? 
where Gebruikersnaam = ?'; 

try {
    $sth = $dbh->prepare($sql);
    if ($sth->execute(array( $BlokkeerStatus,$gebruiker))) {



      $to = $kopermail;
      $subject = "U heeft een veiling gewonnen!";

      $message = '
          <html>
          <head>
          <title>EenmaalAndermaal</title>
          </head>
          <body>
          
          Beste ' . $voorletter . '. ' . $achternaam . ',<br><br>

          Gefeliciteerd! U heeft de veiling ' . $titel . ' gewonnen!<br><br>
          
          U kan de veiling vinden op de \'Mijn biedingen\' pagina, of via onderstaande link.<br><br>

          <a href="http://iproject37.icasites.nl/productPage.php?ID=' . $_SESSION['PID'] . '">Productpagina gewonnen veiling</a><br><br><br>


          Met vriendelijke groeten,<br>
          iConcepts<br>
          Heyendaalseweg 98<br>
          6525 EE Nijmegen<br>
          <a href=http://iproject37.icasites.nl>EenmaalAndermaal</a><br>

          <img src="http://iproject37.icasites.nl/media/logomail.png" alt="Logo" height="150px" width="150px">
          </body>
          </html>
          ';

      // Always set content-type when sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      // More headers
      $headers .= 'From: <webmaster@example.com>' . "\r\n";
      $headers .= 'Cc: myboss@example.com' . "\r\n";

      mail($to, $subject, $message, $headers);



        header("location: ../blokkeerGebruiker.php");
        exit();
    }

} 
catch (PDOException $e) {
    $error = $e->getMessage();
    header("location: ../blokkeerGebruiker.php?error=$error");
    exit();
  }





?>