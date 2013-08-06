<?php

include "init.php";

$folderToCrawl = '../i';

function ScanDirectory($Directory){
	$p1 = "";
	$p2 = "";
	$p3 = "";
	$a = 0;
	$listFolder = array();
  	$MyDirectory = opendir($Directory) or die('Erreur');
	while($Entry = @readdir($MyDirectory)){
		if(is_dir($Directory.'/'.$Entry)&& $Entry != '.' && $Entry != '..'){
			$listFolder[$a]=$Entry;
			$a++;
		}else{
			if($Entry != '.' && $Entry != '..'){
				if($Entry == "meta.json"){
					$json = file_get_contents("$Directory/meta.json");
					$dataI = json_decode($json);
					$p3 = "<input class='title' data-initial='".$dataI->ttl."' value='".$dataI->ttl."' />";
					$p2 = "<span>Le ".date('d/m/Y',$dataI->quand)."</span>";
				}else{
					$folder = explode("/",$Directory);
					$p1 = '<a class="toThePage" href="../'.$folder[2].'"><img height="100" src="'.$Directory.'/'.$Entry.'" /></a>';
				}
			}
        }
	}
	echo $p1.$p2.$p3;
  	closedir($MyDirectory);

  	if(count($listFolder)!=0){sort($listFolder);}

	$b=0;
	while ($b < count($listFolder)){
		echo '<li data-rel="'.($b+1).'">';
		echo '<a class="suppress" href="#">x</a>';
		ScanDirectory($Directory.'/'.$listFolder[$b]);
        echo '</li>';
		$b++;
	}

}


function nbrTotalFolder($Directory){
	$tableau="";
	$nbrFolder=0;
	$handle=opendir("$Directory"); // Chemin du dossier
	while($fichier = readdir($handle)){
	    $nbrFolder++; // Incrémentation
	} // Fin du while
	$nbrFolder =($nbrFolder-2);
	return $nbrFolder;
}

?>

<!doctype html>
<html lang="fr" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Bienvenue sur Tabac info service - La home</title>
	<?php if($checker == 2){ ?>
		<link rel="stylesheet" href="../css/ga.css">
	<?php }else{ ?>
		<link rel="stylesheet" href="../css/init.css">
	<?php } ?>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" id="favicon">
</head>
<body>
	<div class="content">

	<?php if($checker == 2){ ?>

		<?php
			$totalNumber = nbrTotalFolder($folderToCrawl);
			$showme = $totalNumber;
		?>

		<h1>
			Admin
			<span id="count">0 upload en cours.</span>
		</h1>

		<input type="hidden" id="url" value="../upload.php"/>

		<div id="dropArea">
			Déplacer ici les images que tu souhaites mettre en ligne
		</div>
		<canvas width="800" height="30"></canvas>

		<div id="result">
		</div>

		<h2>
			<?php
				echo $totalNumber." planches à voir";
			?>
		</h2>

		<ul class="all">
			<?php
				ScanDirectory($folderToCrawl);
			?>
		</ul>

	<?php }else{ ?>

		<h1>
			Création d'un nouveau blog ?
			<span>Initialiser l'admin</span>
		</h1>

		<?php include "config.php"; ?>

	<?php } ?>

	</div><!-- Fin .content -->

	<?php
		include "footer.php";
	?>

</body>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<?php if($checker == 2){ ?>
	<script type="text/javascript" src="../js/drag.js"></script>
	<script type="text/javascript" src="../js/admin.js"></script>
<?php }else{ ?>
	<script type="text/javascript" src="../js/init.js"></script>
<?php } ?>

</html>
