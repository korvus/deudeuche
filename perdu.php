<?php

include "php/functions.php";

$meta = getGInfos();

?>

<!doctype html>
<html lang="fr" dir="ltr">
<head>
	<meta charset="utf-8">
	<title><?php echo $meta["title"]; ?></title>
	<link rel="stylesheet" href="css/g.css">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" id="favicon">
</head>
<body>
	<div class="content">

		<h1><?php echo $meta["title"]; ?></h1>
		<div class="show">Cette page n'existe pas :.(</div>


</body>
</html>
