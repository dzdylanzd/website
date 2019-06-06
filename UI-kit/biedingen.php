<?php
// //////////////////////////////////////////////
// auto refresh pagina biedingen en timer
// //////////////////////////////////////////////
session_start();
require_once('includes/database.php');

$sql = "SELECT Staat, StartPrijs, Valuta, Verzendkosten,VerzendInstructies,BetalingsInstructie FROM Voorwerp WHERE Voorwerpnummer = ? ";
$sth = $dbh->prepare($sql);
if ($sth->execute(array($_SESSION['PID']))) {
    while ($alles = $sth->fetch()) {
        $valuta = $alles['Valuta'];
        // Schrijf valuta om in tekens
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
    }
}

$huidigbod = '';

// Haal het huidige bod op
$sqlBod = 'SELECT BodBedrag FROM Bod WHERE Voorwerp = ? order by BodDagTijd  ';
if ($sthBod = $dbh->prepare($sqlBod)) {
    if ($sthBod->execute(array($_SESSION['PID']))) {
        while ($rowBod = $sthBod->fetch()) {
            $huidigbod = $rowBod['BodBedrag'];
        }
    }
}
?>


<h2>Bieding</h2>
<div class="uk-flex Bieding">
    <div class="uk-width-1-2">
        <h3>Tijd resterend: </h3>
        <?php require_once('includes/database.php');
        include('includes/timer.php'); ?>
    </div>
    <div class="uk-width-1-2">
        <h3>Huidig bod: </h3>
        <?php echo "<h1>" . $valuta . (double)$huidigbod . "</h1>"; ?>
    </div>
</div>
<?php
$sql = "SELECT * from Bod where Voorwerp = ? order by BodDagTijd desc ";
$sth = $dbh->prepare($sql);
$bod = "";
$datumTijd = "";
$bieder = "";


if ($sth->execute(array($_SESSION['PID']))) {
    $text = '';

    while ($alles = $sth->fetch()) {
        $text .= '<tr>';
        $text .= "<td><p>$alles[Gebruiker]</p></td>";
        $text .= "<td><p>" . $valuta . (double)$alles['BodBedrag'] . "</p></td>";
        $text .= "<td><p>" . substr($alles['BodDagTijd'], 0, 19) . " </p></td>";
        $text .= '</tr>';
    }
}
?>
<h2>Vorige biedingen</h2>
<div class="uk-flex scrollbox Vorige-Bieder uk-visible@m">
    <div class="uk-width-1-3">
        <h3>Naam bieder</h3>
        <?php echo $bieder ?>
    </div>
    <div class="uk-width-1-3">
        <h3>Bod</h3>
        <?php echo $bod ?>
    </div>
    <div class="uk-width-1-3">
        <h3>Datum en tijd van bieding</h3>
        <?php echo $datumTijd ?>
    </div>
</div>
<div class="uk-flex scrollbox Vorige-Bieder uk-hidden@s">
    <table>
        <tr>
            <th><h3>Naam</h3></th>
            <th><h3>Bod</h3></th>
            <th><h3>Datum</h3></th>
        </tr>
        <?php echo $text ?>
    </table>
</div>