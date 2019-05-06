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

while ($alles = $sth->fetch()) {
    echo "$alles[Titel] <br>"; 
}
}


}
?>