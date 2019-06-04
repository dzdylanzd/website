<?php

$gebruiker = $_POST['gebruikersnaam'];

$sql = 'update Gebruiker 
set Geblokeerd = 1 
where Gebruikersnaam = ?'; 



?>