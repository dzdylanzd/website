<?php

function displayCategorie($nummer, $dbh, $hoeveel) {
    $text= 123 ;
    
        $sql= "SELECT top $hoeveel * FROM Voorwerp V LEFT JOIN Voorwerpinrubriek VR ON V.VoorwerpNummer = VR.Voorwerp where Rubriekoplaagsteniveau in(
            SELECT Rubrieknummer from Rubriek where Volgnr = any(
            select Rubrieknummer from Rubriek where Volgnr = any(
            select Rubrieknummer from Rubriek where Volgnr = any(
            SELECT Rubrieknummer  FROM Rubriek WHERE Volgnr = any(
            
            SELECT Rubrieknummer FROM Rubriek WHERE Volgnr= $nummer or Rubrieknummer =  $nummer ) or Rubrieknummer = any(
            
            SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer )) or Rubrieknummer = any(
            SELECT Rubrieknummer  FROM Rubriek WHERE Volgnr = any(
            
            SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer ) or Rubrieknummer = any(
            
            SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer ))) or Rubrieknummer = any(
            select Rubrieknummer from Rubriek where Volgnr = any(
            SELECT Rubrieknummer  FROM Rubriek WHERE Volgnr = any(
            
            SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer ) or Rubrieknummer = any(
            
            SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer )) or Rubrieknummer = any(
            SELECT Rubrieknummer  FROM Rubriek WHERE Volgnr = any(
            
            SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer ) or Rubrieknummer = any(
            
            SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer )))) or Rubrieknummer = any(
            select Rubrieknummer from Rubriek where Volgnr = any(
            select Rubrieknummer from Rubriek where Volgnr = any(
            SELECT Rubrieknummer  FROM Rubriek WHERE Volgnr = any(
            
            SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer ) or Rubrieknummer = any(
            
            SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer )) or Rubrieknummer = any(
            SELECT Rubrieknummer  FROM Rubriek WHERE Volgnr = any(
            
            SELECT Rubrieknummer FROM Rubriek WHERE Volgnr=  $nummer or Rubrieknummer =  $nummer ) or Rubrieknummer = any(
            
            SELECT Rubrieknummer FROM Rubriek WHERE Volgnr= $nummer or Rubrieknummer = $nummer ))) or Rubrieknummer = any(
            select Rubrieknummer from Rubriek where Volgnr = any(
            SELECT Rubrieknummer  FROM Rubriek WHERE Volgnr = any(
            
            SELECT Rubrieknummer FROM Rubriek WHERE Volgnr= $nummer or Rubrieknummer = $nummer ) or Rubrieknummer = any(
            
            SELECT Rubrieknummer FROM Rubriek WHERE Volgnr= $nummer or Rubrieknummer = $nummer )) or Rubrieknummer = any(
            SELECT Rubrieknummer  FROM Rubriek WHERE Volgnr = any(
            
            SELECT Rubrieknummer FROM Rubriek WHERE Volgnr= $nummer or Rubrieknummer = $nummer ) or Rubrieknummer = any(
            
            SELECT Rubrieknummer FROM Rubriek WHERE Volgnr= $nummer or Rubrieknummer = $nummer ))))
            ) order by newid()";
// prepared statement 
$sth = $dbh->prepare($sql);
if($sth->execute(array())){

if($alles = $sth->fetch() > 0){
    $sth->execute(array());
   
    // start van de slider 
   $text ='<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="clsActivated: uk-transition-active; ">
           <ul class="uk-slider-items uk-grid">';

while ($alles = $sth->fetch()) {
    $valuta = $alles['Valuta'];
    // haal thumbnail foto op
    $sqlImage = "SELECT TOP 1 * FROM Thumbnail where VoorwerpNummer  = ? ";
    $sthImage = $dbh->prepare($sqlImage);
if($sthImage->execute(array($alles["Voorwerp"]))){
    $image = $sthImage->fetch();

    if(strpos( $image['Thumbnailfile'],"img") !== false){
        $image['Thumbnailfile'] = "http://iproject5.icasites.nl/thumbnails/".  $image['Thumbnailfile'];
    }else{
        $image['Thumbnailfile'] =  $image['Thumbnailfile'];
    }
    // zet de titel tot max 6
    $titel = substr($alles["Titel"],6);
}

// Schrijf valuta om in tekens
switch ($valuta) {
    case 'EUR':
        $valuta = '€';
        break;

    case 'GBP':
        $valuta = '£';
        break;

    case 'AUD':
        $valuta = 'A$';
        break;

    case 'CAD':
        $valuta = 'C$';
        break;

    case 'INR':
        $valuta = '₹';
        break;

    case 'USD':
        $valuta = '$';
        break;
}

$alles["StartPrijs"] = (double)$alles["StartPrijs"];
$text = $text . "
<li class=\"uk-width-1-4@l uk-width-1-3@m uk-width-1-2@s\">
<div class=\"uk-panel\">
   <a href=\"productPage.php?ID=$alles[VoorwerpNummer]\" > <img  class=\"image-square\" src=\"$image[Thumbnailfile]\" alt=\"\"> </a>
    <div class=\"uk-overlay uk-overlay-primary uk-position-bottom uk-text-center uk-transition-slide-bottom\">
        <h3 class=\"uk-margin-remove\">";
        $text = $text . substr($alles["Titel"],0,10);
        $text = $text . "... </h3>
        <p class=\"uk-margin-remove\"> $valuta $alles[StartPrijs]</p>
    </div>
</div>
</li>"; 

  
}
$text = $text .'</ul>

<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

</div>';

}

}

return $text;
}
