<?php
session_start();
// maximale bestands grote van een foto 
$maxImageSize = 10000000;  
// doelmap
$target_dir = "../upload/";
// check of je het maximum hebt behaald 
if( $_SESSION['index'] >= 4){
    header("location: ../veiling-Maken.php?error=maxFotos");
    exit();
}

$target_file = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$random_hash = bin2hex(random_bytes(8));
$target_file = $target_dir . $random_hash . "." . $imageFileType;
$file =  "upload/" . $random_hash . "." . $imageFileType;

// Check of de geüploade foto een echte foto is
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "Bestand is een foto - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        header("location: ../veiling-Maken.php?error=geenFoto");
    exit();
        echo "Bestand is geen foto.";
        $uploadOk = 0;
    }
}

// Check of de foto al bestaat
while (file_exists($target_file)) {
    $target_file = basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $random_hash = bin2hex(random_bytes(8));
    $target_file = $target_dir . $random_hash . "." . $imageFileType;
    $file =  $random_hash . "." . $imageFileType;
}

// Check de grootte van het bestand
if ($_FILES["fileToUpload"]["size"] > $maxImageSize) {
    
    echo "Sorry, deze foto is te groot.";
    $uploadOk = 0;

    header("location: ../veiling-Maken.php?error=fotoTeGroot");
    exit();
}

// Check of het bestand JPG, JPEG en PNG is
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
    echo "Sorry, wij accepteren alleen JPG, JPEG of PNG foto's.";
    $uploadOk = 0;
    header("location: ../veiling-Maken.php?error=notRightFormate");
    exit();
}

// Check of de foto door de vorige checks kwam
if ($uploadOk == 0) {
    echo "Sorry, uw bestand is niet geüpload.";

// Als alles klopt, upload het bestand
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Het bestand ". basename( $_FILES["fileToUpload"]["name"]). " is geüpload.";
        $_SESSION['fotos'][$_SESSION['index']] = $file;
        $_SESSION['index']++;
       
        header("location: ../veiling-Maken.php");
        exit();
    } else {
        echo "Sorry, uw bestand is niet geüpload.";
    }
}
?>