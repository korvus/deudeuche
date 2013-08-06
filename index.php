<?php

$folderToCrawl = 'i';

include "php/functions.php";

$meta = getGInfos();

?>



<!doctype html>
<html lang="fr" dir="ltr">
<head>
	<meta charset="utf-8">
	<title><?php echo $meta["title"]; ?></title>
	<meta name="description" content="<?php echo $meta["desc"]; ?>" />
	<link rel="stylesheet" href="css/g.css">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" id="favicon">
</head>
<body>
	<div class="content">

		<?php
			$totalNumber = nbrTotalFolder($folderToCrawl);
			$showme = $totalNumber;
		?>

		<h1>
			<?php echo $meta["title"]; ?>
		</h1>

		<?php if($meta["init"]==0){ ?>

			<h2>Bienvenue</h2>			
			<ul>
				<li>
					<a href="admin">
						Cliquez ici pour configurer votre blog.
					</a>
				</li>
			</ul>

		<?php }else{//Si blog déjà initialisé ?>

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

		<?php } ?>

		<?php
			include "php/footer.php";
		?>

</body>
</html>
