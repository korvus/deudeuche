<?php

include "functions.php";

$target = $_POST["idblog"];
$number = $_POST["total"];

$fileToOpen = "../i/$target/";
$operation = @opendir($fileToOpen);

while($Entry = @readdir($operation)){
	if($Entry != '.' && $Entry != '..'){
		//echo $Entry;
		unlink($fileToOpen.$Entry);
	}
}
rmdir($fileToOpen);

checkIfAllisFine("../i/",$number);

echo 1;

