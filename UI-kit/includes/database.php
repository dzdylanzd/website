<?php

$hostname = "(local)";
$dbname = 'IProject';
$username = 'sa';
$pw = 'Dylan1314';
try {
        $dbh = new PDO("sqlsrv:Server=$hostname;Database=$dbname;
    ConnectionPooling=0", "$username", "$pw");
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {	 
die ( "Fout met de database: {$e->getMessage()} " );
}
