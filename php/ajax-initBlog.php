<?php

/* .htaccess + .htpasswd */

$ttl = $_POST["ttl"];
$metaDesc = $_POST["desc"];
$ebps = $_POST["ebps"];
$ebmdp = $_POST["ebmdp"];

/* Creation des racines */
$arr = array('metattl' => $ttl, 'metadesc' => $metaDesc);
$root = json_encode($arr);
$handle0 = fopen("../caracts.json", "w+");
fwrite($handle0, $root);
fclose($handle0);

/* .htpasswd */
$toPuttinHtpsswd1 = $ebps;
$toPuttinHtpsswd2 = crypt($ebmdp);
$toputinhtpsd = $toPuttinHtpsswd1.":".$toPuttinHtpsswd2;
$handle1 = fopen("../admin/.htpasswd", "w+");
fwrite($handle1, $toputinhtpsd);
fclose($handle1);

/* path .htaccess */
$filename = $_SERVER["SCRIPT_FILENAME"];
$splitedPath = explode("/",$filename);
$current = count($splitedPath)-1;
$path = "";
for($i=1 ; $i<$current ; $i++){
	if($splitedPath[$i]=="php"){$splitedPath[$i]="admin";}
	$path = $path."/".$splitedPath[$i];
}
$path = $path."/.htpasswd";
$htaccess = "AuthUserFile $path\nAuthName \"Protected access\"\nAuthType Basic\nRequire valid-user";
$handle2 = fopen("../admin/.htaccess", "w+");
fwrite($handle2, $htaccess);
fclose($handle2);

/* htaccess at root */
$particularity = $_SERVER["REQUEST_URI"];
$toUse = explode("/",$particularity);
$currentDepository = count($toUse)-2;
$PathHtacces = "";
for($j=1 ; $j<$currentDepository ; $j++){
	$PathHtacces = $PathHtacces."/".$toUse[$j];
}

$lvl1htacces = "RewriteEngine on\n\nErrorDocument 403 perdu.php\nErrorDocument 404 perdu.php\nErrorDocument 500 perdu.php\n\n#index\nRewriteBase $PathHtacces/\nRewriteCond $1 !^(admin/)\nRewriteRule ^([0-9]+)$ focus.php?page=$1 [NC,L]";
$handle3 = fopen("../.htaccess", "w+");
fwrite($handle3, $lvl1htacces);
fclose($handle3);

echo 1;