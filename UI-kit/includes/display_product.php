<?php

function displayCatogorie($nummer, $dbh){
    

        $sql= "SELECT * from Categorieen where parent = any(
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
            
            SELECT id FROM Categorieen WHERE Parent= $nummer or id = $nummer ))))";

$sth = $dbh->prepare($sql);
if($sth->execute(array())){
$sql2 = "SELECT top 10 Titel from items where  ";
while ($alles = $sth->fetch()) {
    $sql2 = "$sql2 Categorie = $alles[ID] or";
}
}
$sql2 = "$sql2 1 < 0";
$sth = $dbh->prepare($sql2);
if($sth->execute(array())){
    if($alles = $sth->fetch() >0){
while ($alles = $sth->fetch()) {
echo "$alles[Titel] <br>"; 
}

return true;
    }else return false;
    
}

}
?>