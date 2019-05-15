<?php
session_start();
$maxTijd = 4 * 60 * 60;
$code = $_SESSION["emailCode"];
$datTime = $_SESSION["EmailDateTime"];

$date1 = strtotime(date("Y-m-d H:i:s"));
$date2 = strtotime($datTime);

var_dump($date1);
var_dump($date2);

$secondes =  $date1 - $date2 ;
if($secondes > $maxTijd ){
    echo"je kode is te lang";
}else{
  if(  $_POST['emailbevestiging']){
      
  }
}






?>