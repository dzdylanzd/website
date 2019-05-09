<?php

function displayCategorie($nummer, $dbh, $hoeveel) {
    
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

$sth = $dbh->prepare($sql);
if($sth->execute(array())){
echo'<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="clsActivated: uk-transition-active; ">

<ul class="uk-slider-items uk-grid">';
while ($alles = $sth->fetch()) {
    $sqlImage = "SELECT TOP 1 * FROM Illustraties WHERE Voorwerpnummer = ? ";
    $sthImage = $dbh->prepare($sqlImage);
if($sthImage->execute(array($alles["Voorwerp"]))){
    $image = $sthImage->fetch();
    $titel = substr($alles["Titel"],6);
}
if($alles["Valuta"] = "EUR"){
    $valutaTeken = "€";
}else if($alles["Valuta"] = "USD"){
    $valutaTeken = "$";
}else if($alles["Valuta"] = "GBP"){
    $valutaTeken = "£";
}else if($alles["Valuta"] = "AUD"){
    $valutaTeken = "\$A";
}
    echo "
            <li class=\"uk-width-1-4@l uk-width-1-3@m uk-width-1-2@s\">
            <div class=\"uk-panel\">
               <a href=\"productPage.php?ID=$alles[VoorwerpNummer]\" > <img  class=\"image-square\" src=\"http://iproject5.icasites.nl/thumbnails/$alles[Thumbnail]\" alt=\"\"> </a>
                <div class=\"uk-overlay uk-overlay-primary uk-position-bottom uk-text-center uk-transition-slide-bottom\">
                    <h3 class=\"uk-margin-remove\">";
                    echo substr($alles["Titel"],0,10);
                    echo "... </h3>
                    <p class=\"uk-margin-remove\"> $valutaTeken $alles[Prijs]</p>
                </div>
            </div>
        </li>";
}
echo'</ul>

<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

</div>';
}


}
