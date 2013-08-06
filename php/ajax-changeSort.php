<?php


function setDir($target,$to){
    if(is_dir("../i/".$target)){
        usleep(1);
        rename("../i/".$target, "../i/0".$to);
    }
}

function cleanDir($numb){
    if(is_dir("../i/0".$numb)){
        usleep(1);
        rename("../i/0".$numb, "../i/".$numb);
    }	
}

$toSwitch = $_POST["Toswitch"];
$allFiles = split(";", $toSwitch);
$bim = array_pop($allFiles);
//var_dump($allFiles);

$hm = count($allFiles);
//will:was
$a=0;
while ($a < $hm){
	$toCheck[$a] = split(":",$allFiles[$a]);
	//echo $toCheck[$a][0]."/".$toCheck[$a][1]."<br />";
	setDir($toCheck[$a][1],$toCheck[$a][0]);
	$a++;
}

$b = 0;
while ($b < $hm){
	cleanDir($b+1);
	$b++;
}