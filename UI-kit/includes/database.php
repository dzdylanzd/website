<?php
/*
$hostname = "(local)";
$dbname = 'IProject';
$username = 'iproject37';
$pw = 'iproject2019';
try {
        $dbh = new PDO("sqlsrv:Server=$hostname;Database=$dbname;
    ConnectionPooling=0", "$username", "$pw");
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {	 
die ( "Fout met de database: {$e->getMessage()} " );
}
*/

$hostname = "(local)";
$dbname = 'iproject37';
$username = 'iproject37';
$pw = 'H3fvTCuE8w';
try {
        $dbh = new PDO("sqlsrv:Server=$hostname;Database=$dbname;
    ConnectionPooling=0", "$username", "$pw");
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {	 
die ( "Fout met de database: {$e->getMessage()} " );
}


/*
$hostname = "(mssql.iproject.icasites.nl)";
$dbname = 'iproject37';
$username = 'iproject37';
$pw = 'H3fvTCuE8w';
try {
        $dbh = new PDO("sqlsrv:Server=$hostname;Database=$dbname;
    ConnectionPooling=0", "$username", "$pw");
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {	 
die ( "Fout met de database: {$e->getMessage()} " );
}
*/