<?php require_once("inc/core.god.php");

if(Loged == FALSE)
{
	header("Location: /");
	exit;
}

if(mysql_num_rows($chb) > 0) 
{
    header("Location: banned");
	exit;
}

if(MANTENIMIENTO == '1' && $myrow['rank'] < $Wulez['maxrank']) 
{
    header("Location: mantenimiento");
	exit;
}

if($_GET['action'] == 'logout') {
    session_destroy();
    header("Location: /");
	exit;
}

if(isset($_GET['id'])) {
$badge_code = Securise($_GET['id']);
$badge = mysql_query("SELECT * FROM cms_badges WHERE badge_code = '".$badge_code."'");
$shop = mysql_fetch_assoc($badge);

if(Wulez('Emulator') == "Arcturus") {
$verif_badge = mysql_query("SELECT * FROM users_badges WHERE badge_code = '".$shop['badge_code']."' AND user_id = ".$user['id']."");
} else {
$verif_badge = mysql_query("SELECT * FROM user_badges WHERE badge_code = '".$shop['badge_code']."' AND user_id = ".$user['id']."");
}
if(mysql_num_rows($verif_badge) == 1){
$message = "<div class=\"message error margin\">Le badge demander figure déjà dans votre inventaire.</div>";
} else {
$do = Securise($_GET['id']);
if($do == "".$shop['badge_code']."") {
if($user['credits'] >= $shop['prix']) {
if(Wulez('Emulator') == "Arcturus") {
mysql_query("INSERT INTO `users_badges` (`user_id`, `badge_code`) VALUES ('".$user['id']."', '".$shop['badge_code']."')");
} else {
mysql_query("INSERT INTO `user_badges` (`user_id`, `badge_code`) VALUES ('".$user['id']."', '".$shop['badge_code']."')");
}
mysql_query("UPDATE `users` SET `credits` = `credits` - '".$shop['prix']."' WHERE `id` = ".$user['id']."");
$message = "<div class=\"message hide success\" id=\"result-profile\" style=\"display: block;\">Tu viens de recevoir ton badge!</div>";
} else {
$message = "<div class=\"message error margin\">Tu n'as pas assez de diamants</div>";
}
}
} 
}

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $Wulez['name']; ?> Hotel</title>
	
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="<?php echo $Wulez['url']; ?>/web-gallery/v4/assets/js/jquery.slides.min.js"></script>
	<script src="<?php echo $Wulez['url']; ?>/web-gallery/v4/assets/js/jquery.tipTip.minifiedA.js"></script>
	<script src="<?php echo $Wulez['url']; ?>/web-gallery/v4/assets/js/lightbox-2.6.min.js"></script>
	<script type="text/javascript" src="<?php echo $Wulez['url']; ?>/web-gallery/v4/assets/js/cycle.js"></script>
	<script type="text/javascript" src="<?php echo $Wulez['url']; ?>/web-gallery/v4/assets/js/general2.js"></script>
	
	<link href='http://fonts.googleapis.com/css?family=Roboto|Open+Sans:300italic,400,600,700,300' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Caesar+Dressing' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo $Wulez['url']; ?>/web-gallery/v4/assets/css/grid.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo $Wulez['url']; ?>/web-gallery/v4/assets/css/slider.css" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo $Wulez['url']; ?>/web-gallery/v4/assets/css/general2.css?745" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo $Wulez['url']; ?>/web-gallery/v4/assets/css/bbadges.css?745" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo $Wulez['url']; ?>/web-gallery/v4/assets/css/buttons.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo $Wulez['url']; ?>/web-gallery/v4/assets/css/lightbox.css" />
	<link rel="icon" type="image/png" href="favicon.ico" />
	<link href='//fonts.googleapis.com/css?family=Ubuntu:400,700,400italic,700italic|Ubuntu+Condensed' rel='stylesheet' type='text/css'>

	<?php include("./templates/meta.php"); ?>

	<script>
		$(function(){
			$(".tip").tipTip({defaultPosition:'top',delay:0});
										titlePage('Loja de Emblemas');
						
							subMenu('boutique');
						forumUpdate();
			forumClear();
			menu('boutique');
		});
	</script>
	
</head>
<body>

<div id="details"></div>
<div id="all">
	<br>
	<?php include("./templates/header.php"); ?>

	
	<div id="corp">
	
	<?php include("./templates/dedicaces.php"); ?>
	
	<div class="row">
	<div class="column grid_10">
		<div class="">
			<div class="height"></div>
			<h2>Nosso cardápio de emblemas:</h2>
			<?php if(isset($message)) { echo "".$message.""; } ?>
<div id="badgesList">
<?php $sql = mysql_query("SELECT * FROM cms_badges"); while($b = mysql_fetch_array($sql)) { ?>
<a href="<?php echo $Wulez['url']; ?>/boutique-badges/badge/<?php echo $b['badge_code']; ?>">
	<div bid="<?php echo $b['badge_code'] ?>" price="<?php echo $b['prix'] ?>" class="column grid_1 abadge" style="background:url(<?php echo $Wulez['url_badges']; ?><?php echo $b['badge_code']; ?>.gif) center 40% no-repeat;">
	<div><?php echo $b['prix'] ?> Moedas</div>
</div>
</a>
<?php } ?>
</div>
<div class="clear"></div>
				<div class="height"></div>
			</div>
		</center>
	</div>
</div></div>
</body>
</html>