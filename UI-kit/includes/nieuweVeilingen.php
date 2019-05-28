<?php
require_once('database.php');

$sql = "SELECT TOP 25 * FROM Voorwerp inner join Thumbnail on Voorwerp.VoorwerpNummer = Thumbnail.VoorwerpNummer ORDER BY LooptijdBegin DESC";
if ($sth = $dbh->prepare($sql)) {
    if ($sth->execute(array())) {
        $text ='<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="clsActivated: uk-transition-active; ">
        <ul class="uk-slider-items uk-grid">';
      while ($alles = $sth->fetch()) {     
        if(strpos( $alles['Thumbnailfile'],"img") !== false){
            $alles['Thumbnailfile'] = "http://iproject5.icasites.nl/thumbnails/".  $alles['Thumbnailfile'];
        }else{
            $alles['Thumbnailfile'] =  $alles['Thumbnailfile'];
        }
        $valuta = $alles['Valuta'];
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
        
        $sql5 = "SELECT TOP 1 * FROM bod WHERE Voorwerp = ? ORDER BY BodDagTijd desc ";
        if ($sth5 = $dbh->prepare($sql5)) {
            if ($sth5->execute(array($alles['VoorwerpNummer']))) {
              if ($prijsje = $sth5->fetch()) {
                $prijs = (double)$prijsje['BodBedrag'];
                $geboden = "Huidig bod:";
               }else{
                    $prijs = (double)$alles['StartPrijs'] ;
                    $geboden = "Startprijs:";
               }
            }
          }
          

          $alles["StartPrijs"] = (double)$alles["StartPrijs"];
          $text = $text . "
          <li class=\"uk-width-1-4@l uk-width-1-3@m uk-width-1-2@s\">
          <div class=\"uk-panel\">
             <a href=\"productPage.php?ID=$alles[VoorwerpNummer]\" > <img  class=\"image-square\" src=\"$alles[Thumbnailfile]\" alt=\"\"> </a>
              <div class=\"uk-overlay uk-overlay-primary uk-position-bottom uk-text-center uk-transition-slide-bottom\">
                  <h3 class=\"uk-margin-remove\">";
                  $text = $text . substr($alles["Titel"],0,10);
                  $text = $text . "... </h3>
                  <p class=\"uk-margin-remove\"> $geboden $valuta $prijs</p>
              </div>
          </div>
          </li>"; 
      }
      $text = $text .'</ul>

<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

</div>';
echo$text;
    }
  }

    
    ?>