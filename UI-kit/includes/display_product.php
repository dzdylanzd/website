<?php

function displayCatogorie($nummer, $dbh){
    

        $sql= "SELECT top 10 * from items where Categorie in(
            SELECT id from Categorieen where parent = any(
            select id from Categorieen where parent = any(
            select id from Categorieen where parent = any(
            SELECT ID  FROM Categorieen WHERE Parent = any(
            
            SELECT id FROM Categorieen WHERE Parent= $nummer or id =  $nummer ) or id = any(
            
            SELECT id FROM Categorieen WHERE Parent=  $nummer or id =  $nummer )) or id = any(
            SELECT ID  FROM Categorieen WHERE Parent = any(
            
            SELECT id FROM Categorieen WHERE Parent=  $nummer or id =  $nummer ) or id = any(
            
            SELECT id FROM Categorieen WHERE Parent=  $nummer or id =  $nummer ))) or id = any(
            select id from Categorieen where parent = any(
            SELECT ID  FROM Categorieen WHERE Parent = any(
            
            SELECT id FROM Categorieen WHERE Parent=  $nummer or id =  $nummer ) or id = any(
            
            SELECT id FROM Categorieen WHERE Parent=  $nummer or id =  $nummer )) or id = any(
            SELECT ID  FROM Categorieen WHERE Parent = any(
            
            SELECT id FROM Categorieen WHERE Parent=  $nummer or id =  $nummer ) or id = any(
            
            SELECT id FROM Categorieen WHERE Parent=  $nummer or id =  $nummer )))) or id = any(
            select id from Categorieen where parent = any(
            select id from Categorieen where parent = any(
            SELECT ID  FROM Categorieen WHERE Parent = any(
            
            SELECT id FROM Categorieen WHERE Parent=  $nummer or id =  $nummer ) or id = any(
            
            SELECT id FROM Categorieen WHERE Parent=  $nummer or id =  $nummer )) or id = any(
            SELECT ID  FROM Categorieen WHERE Parent = any(
            
            SELECT id FROM Categorieen WHERE Parent=  $nummer or id =  $nummer ) or id = any(
            
            SELECT id FROM Categorieen WHERE Parent= $nummer or id = $nummer ))) or id = any(
            select id from Categorieen where parent = any(
            SELECT ID  FROM Categorieen WHERE Parent = any(
            
            SELECT id FROM Categorieen WHERE Parent= $nummer or id = $nummer ) or id = any(
            
            SELECT id FROM Categorieen WHERE Parent= $nummer or id = $nummer )) or id = any(
            SELECT ID  FROM Categorieen WHERE Parent = any(
            
            SELECT id FROM Categorieen WHERE Parent= $nummer or id = $nummer ) or id = any(
            
            SELECT id FROM Categorieen WHERE Parent= $nummer or id = $nummer ))))
            )";

$sth = $dbh->prepare($sql);
if($sth->execute(array())){
echo'<div uk-slider>

<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">

    <ul class="uk-slider-items uk-child-width-1-5@s uk-grid">';
while ($alles = $sth->fetch()) {
    $sqlImage = "select top 1 * from Illustraties where ItemID = ? ";
    $sthImage = $dbh->prepare($sqlImage);
if($sthImage->execute(array($alles["ID"]))){
    $image = $sthImage->fetch();
  
}
    echo "<li>
    <img src=\"http://iproject5.icasites.nl/pics/$image[IllustratieFile]\" alt=\"\">
    <div class=\"uk-position-center uk-panel\"><p>$alles[Titel]</p></div>
</li>


<li>
                <div class=\"uk-card uk-card-default\">
                    <div class=\"uk-card-media-top\">
                        <img src=\"https://getuikit.com/docs/images/photo3.jpg\" alt=\"\">
                    </div>
                    <div class=\"uk-card-body\">
                        <h3 class=\"uk-card-title\">Headline</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                    </div>
                </div>
            </li>";
}
echo'</ul>

<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

</div>
</div>';
}


}
?>