<?php

$target = $_POST["idblog"];
$nttl = $_POST["neoValue"];

/* On va chercher les infos dans le json original */
$json = file_get_contents("../i/$target/meta.json");
$dataI = json_decode($json);
$dataI->ttl = $nttl;
$newJson = json_encode($dataI);

/* On réécrit */
$handle = fopen("../i/$target/meta.json", "w+");
fwrite($handle, $newJson);
if(fclose($handle)){
	echo 1;
}

