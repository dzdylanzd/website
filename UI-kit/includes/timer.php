<?php
$sql ="select isVeilingGesloten, LooptijdEinde  from Voorwerp where VoorwerpNummer = ?";
$sth = $dbh->prepare($sql);
if($sth->execute(array($_GET["ID"]))){
    while ($row = $sth->fetch()) {
       if($row["LooptijdEinde"] < getdate()){
           
           $sqlchangeIsGesloten = "update Voorwerp
           set  isVeilingGesloten = 1
           where VoorwerpNummer = ? ";
           $changeIsGesloten = $dbh->prepare($sql);
           $changeIsGesloten->execute(array($_GET["ID"]));
       }
        if($row["isVeilingGesloten"] == 0){
            echo"de veiling is open";
            $tijd =   substr(substr_replace($row["LooptijdEinde"], "T", 11,0),0,20) . "+01:00";
            // $tijd =   "2019-05-16T10:22:25+00:00"; 
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
        }else{
            echo"de veiling is gesloten";
        }
    }
}
?>