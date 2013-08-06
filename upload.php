<?php

// fixe le niveau de rapport d'erreur
//echo phpversion();

include "php/functions.php";

if (version_compare(phpversion(), '5.3.0', '>=') == 1)
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
  error_reporting(E_ALL & ~E_NOTICE);

function bytesToSize1024($bytes, $precision = 2) {
    $unit = array('B','KB','MB');
    return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), $precision).' '.$unit[$i];
}

if (isset($_FILES['myfile'])){
    $sFileType = $_FILES['myfile']['type'];
    $sFileTmp = $_FILES['myfile']['tmp_name'];
    $sFileSize = bytesToSize1024($_FILES['myfile']['size'], 1);
    $sFileName = $_FILES['myfile']['name'];
    $pattern = '/\.jpg|\.jpeg|\.png|\.gif/i';
    $ttl = preg_replace($pattern, "", $sFileName);

    //$sFileName = ;

/*    echo "
<div class='s'>
    <p>Le fichier : $sFileName a été correctement transféré.</p>
    <p>Type : $sFileType</p>
    <p>Taille : $sFileSize</p>
    <p>Nom temporaire : $sFileTmp</p>";
*/


function getAnewId($ti){
    $ti++;
    if(is_dir("i/".$ti)){
        return getAnewId($ti);
    }else{
        return $ti;
    }
}


echo "<div class='s'>";

$name = $_FILES["pictures"]["name"][$key];

// N'oubliez pas de configurer ce script en renseignant les informations nécessaires et modifiables
// lisiting de tous les fichiers
$tableau="";
$nbrFolder=0;
$handle=@opendir("i"); // Chemin du dossier
while($fichier = @readdir($handle)){
    if($fichier!="." && $fichier!=".."){
        $listing[$fichier]=$nbrFolder;
    }
    $nbrFolder++; // Incrémentation
} // Fin du while
$nbrFolder = ($nbrFolder-1); // Cette variable contient le nombre de fichiers du dossier

checkIfAllisFine("i/",$nbrFolder);

if(mkdir("i/".$nbrFolder, 0777)){
    echo "<img src='../i/$nbrFolder/$sFileName' /></div>";
    move_uploaded_file($sFileTmp, "i/$nbrFolder/$sFileName");

    $metaTime = time();
    $arr = array('quand' => $metaTime, 'ttl' => $ttl,'legend' => "");
    $toWrite = json_encode($arr);
    $file = "file".$nomFile.".json";
    $handle = fopen("i/$nbrFolder/meta.json", "w+");
    fwrite($handle, $toWrite);
    fclose($handle);

}

/* SI on veut faire un nom de dossier basé sur le nom.
$ti = time();
if(is_dir("i/".$ti) == 1){
    $ti = getAnewId($ti);
    if(mkdir("i/".$ti, 0777)){
        echo "<img src='../i/$ti/$sFileName' /></div>";
        move_uploaded_file($sFileTmp, "i/$ti/$sFileName");
    }
}else{
    if(mkdir("i/".$ti, 0777)){
        echo "<img src='../i/$ti/$sFileName' /></div>";
        move_uploaded_file($sFileTmp, "i/$ti/$sFileName");
    }
}
*/


} else {
    echo '<div class="f">Une erreur s\'est produite</div>';
}