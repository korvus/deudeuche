<?php

include "../../php/functions.php";

function suppressFolder($fileToOpen,$number){
	if(rmdir($fileToOpen)){
		clearstatcache(TRUE, $fileToOpen);
		if(file_exists($fileToOpen)){
			echo 0;
		}else{
			checkIfAllisFine($number);
		}
	}
}

$target = $_POST["idblog"];
$number = $_POST["total"];

$fileToOpen = ROOT."/i/$target";
$files = scandir($fileToOpen);

foreach ($files as $file){
	if($file != '.' && $file != '..'){
		unlink($fileToOpen."/".$file);
	}
}

suppressFolder($fileToOpen, $number);

