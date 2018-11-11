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

if(isset($_POST['dedi'])) {
$dedi = Securise($_POST['dedi']);
if($myrow['credits'] >= Wulez('priceded')) {
mysql_query("UPDATE users SET credits -".Wulez('priceded')." WHERE id = '".$myrow['id']."'");
mysql_query("INSERT INTO `cms_dedicaces` (`uid`, `message`, `date`, `ip`) VALUES ('".$myrow['id']."', '".$dedi."', '".time()."', '".$myrow['ip_current']."');");
$sendDedi = true;   
} else {
$sendErreur = true;
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
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo $Wulez['url']; ?>/web-gallery/v4/assets/css/buttons.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo $Wulez['url']; ?>/web-gallery/v4/assets/css/lightbox.css" />
	<link rel="icon" type="image/png" href="favicon.ico" />
	<link href='//fonts.googleapis.com/css?family=Ubuntu:400,700,400italic,700italic|Ubuntu+Condensed' rel='stylesheet' type='text/css'>

	<?php include("./templates/meta.php"); ?>

	<script>
		$(function(){
			$(".tip").tipTip({defaultPosition:'top',delay:0});
										titlePage('Dedicatórias');
						
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
	
	<div class="clear"></div>
		
			<div class="row">
	<div class="column grid_10">
		<div class="">
			<div class="height"></div>
			<h2>Poste uma dedicatória:</h2>

		<?php if ($sendDedi == true) { ?>
		<div class="message hide success" id="result-profile" style="display: block;">Ta dédicace à bien été envoyer!</div>
		<div class="height"></div>
		<?php } ?>
		<?php if ($sendErreur == true) { ?>
		<div class="message error margin">Tu n'as pas assez de diamants pour envoyer une dédicace!</div>
		<?php } ?>
		<form action="" method="post">
		<div style="position:absolute;width:211px;height:77px;margin-left:810px;margin-top:-50px"><img src="<?php echo $Wulez['url']; ?>/images/demo-type.png?1" width="211"></div>

    <script>
$(function(){
	$('#dedi-in').html('Escreva para ver como fica.');
});
</script>

		<center>
			<input id="dedi-input" style="width:550px;" type="text" name='dedi' maxlength="110" placeholder="Escreva aqui sua dedicatória" onkeypress="refuserToucheEntree(event);" onkeyup="$('#dedi-in').text($(this).val());" required>
			<div style="width:564px;margin-left:auto;margin-right:auto;">
				<div class="left"></div>
				<div class="right"><span id="number"></span> carácters restantes.</div>
				<div class="clear"></div>
			</div>
			<div class="height"></div>
			<div style="width:554px;margin-left:auto;margin-right:auto;background:#eee;padding:5px;border-radius:2px;">
				<div class="left">
					<table style="padding-top:5px;">
						<tr>
							<td><span style="font-size:24px;font-weight:100"><?php echo $Wulez['priceded']; ?></span></td>
							<td><span style="font-size:17px;font-weight:100">Moedas</span></td>
						</tr>
					</table>
									</div>
				<div class="right">
					<input type="submit" name="submit" class="btn cyan rounded" value="Pronto! Postar dedicatória." class="submit">
				</div>
				</form>
				<div class="clear"></div>
			</div>
		</center>
	</div>
</div></div>

<script>
(function($) {
	$.fn.extend( {
		limiter: function(limit, elem) {
			$(this).on("keyup focus", function() {
				setCount(this, elem);
			});
			function setCount(src, elem) {
				var chars = src.value.length;
				if (chars > limit) {
					src.value = src.value.substr(0, limit);
					chars = limit;
				}
				elem.html( limit - chars );
			}
			setCount($(this)[0], elem);
		}
	});
})(jQuery);
$(document).ready( function() {
	var elem = $("#number");
	$("#dedi-input").limiter(110, elem);
});

function refuserToucheEntree(event)
{

    if(!event && window.event) {
        event = window.event;
    }

    if(event.keyCode == 13) {
        event.returnValue = false;
        event.cancelBubble = true;
    }

    if(event.which == 13) {
        event.preventDefault();
        event.stopPropagation();
    }
}
</script>

		<div class="height"></div>

</body>
</html>