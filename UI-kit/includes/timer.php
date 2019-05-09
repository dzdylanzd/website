<?php
$sql ="select isVeilingGesloten, LooptijdEinde  from Voorwerp where VoorwerpNummer = ?";
$sth = $dbh->prepare($sql);
if($sth->execute(array($_GET["ID"]))){
    while ($row = $sth->fetch()) {
       
        if($row["isVeilingGesloten"] == 0){
            echo"de veiling is open";
            $tijd =   substr(substr_replace($row["LooptijdEinde"], "T", 11,0),0,20) . "+01:00";
            $tijd =  str_replace(" ","",$tijd);
          
            echo "<div class=\"uk-grid-small uk-child-width-auto\" uk-grid uk-countdown=\"date:  $tijd\">
            <div>
                <div class=\"uk-countdown-number uk-countdown-days\"></div>
                <div class=\"uk-countdown-label uk-margin-small uk-text-center uk-visible@s\">Dagen</div>
            </div>
            <div class=\"uk-countdown-separator\">:</div>
            <div>
                <div class=\"uk-countdown-number uk-countdown-hours\"></div>
                <div class=\"uk-countdown-label uk-margin-small uk-text-center uk-visible@s\">Uren</div>
            </div>
            <div class=\"uk-countdown-separator\">:</div>
            <div>
                <div class=\"uk-countdown-number uk-countdown-minutes\"></div>
                <div class=\"uk-countdown-label uk-margin-small uk-text-center uk-visible@s\">Minuten</div>
            </div>
            <div class=\"uk-countdown-separator\">:</div>
            <div>
                <div class=\"uk-countdown-number uk-countdown-seconds\"></div>
                <div class=\"uk-countdown-label uk-margin-small uk-text-center uk-visible@s\">Seconden</div>
            </div>
        </div>";
        if(strtotime($row["LooptijdEinde"]) < strtotime("today")){
           
            $sqlchangeIsGesloten = "update Voorwerp
            set  isVeilingGesloten = 1
            where VoorwerpNummer = ?";
            $changeIsGesloten = $dbh->prepare($sqlchangeIsGesloten);
            if($changeIsGesloten->execute(array($_GET["ID"]))){
            echo"<script> window.location.reload();</script>";
            }
        }
        }else{
            
            echo"<h2>Sorry, de veiling is gesloten</h2>";
        }
    }
}
?>