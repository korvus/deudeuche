<?php

$folderToCrawl = 'i';

include "php/functions.php";

$meta = getGInfos();

$totalNumber = nbrTotalFolder($folderToCrawl);
$toShow = $totalNumber;

if(isset($_GET["page"])){
	if(preg_match('/^[0-9]*$/', $_GET["page"])){
		$toShow = $_GET["page"];
	}else{
		$toShow = $toShow;
	}
}

function display($directory,$toGet){
	$MyDirectory = opendir("$directory/$toGet");
	while($Entry = @readdir($MyDirectory)){
		if($Entry != '.' && $Entry != '..'){
			if(preg_match('/([\.jpnegif]){4,5}$/i', $Entry)){
				$img = "$directory/$toGet/$Entry";
			}elseif($Entry == "meta.json"){
				$json = file_get_contents("$directory/$toGet/meta.json");
				$dataI = json_decode($json);
			}
		}
	}
	if(get_magic_quotes_gpc() == 1){
		$ttl = stripslashes($dataI->ttl);
	}else{
		$ttl = $dataI->ttl;
	}
	$arrFb = array("ttl" => $ttl,"img" => $img);
	return $arrFb;
}

$arrayBack = display($folderToCrawl,$toShow);

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

		<h1>
			<?php
				$p = explode("/",$_SERVER["REQUEST_URI"]);
				$bth = "";
				for($a=1; $a<count($p)-1; $a++){
					$bth = $bth."/".$p[$a];
				}
			?>

			<a href="<?php echo $bth."/"; ?>">
				<?php
					echo $arrayBack["ttl"];
				?>
			</a>
		</h1>

		<div class="show">
			<?php
				if($toShow == 1){
					echo "<nav class='inactive prev'><span>◄</span></nav>";
				}else{
					echo "<a href='".($toShow-1)."' target='_self' class='nav prev'><span>◄</span></a>";
				}

				if($toShow == $totalNumber){
					echo "<nav class='inactive next'><span>►</span></nav>";
				}else{
					echo "<a href='".($toShow+1)."' target='_self' class='nav next'><span>►</span></a>";
				}

				echo "<img src='".$arrayBack['img']."' title='".$arrayBack['ttl']."' />"
			?>
		</div>

		<?php
			include "php/footer.php";
		?>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/g.js"></script>

</body>
</html>
