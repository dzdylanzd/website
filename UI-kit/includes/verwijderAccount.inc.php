<?php
session_start();

$sql = 'delete Gebruiker where Gebruikersnaam = ?';

$gebruiker =  $_SESSION['userId'];


