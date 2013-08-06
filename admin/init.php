<?php

//echo $_SERVER["DOCUMENT_ROOT"];

$here = opendir(".") or die('Erreur');
$checker = 0;
while($checkpoint = @readdir($here)){
	if($checkpoint == ".htpasswd" || $checkpoint == ".htaccess"){
		$checker++;
	}
}
closedir($here);