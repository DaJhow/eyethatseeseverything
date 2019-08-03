<?php require_once("../inc/core.god.php");
require_once("../inc/hk_session.php");

if(Loged == false) { 
    header("Location: " . $Holo['url'] ."");
	exit;
}

if(UserH == false) {
    header("Location: " . $Holo['url'] ."/".$Holo['panel']."");
	exit;
}

if($myrow['rank'] < $Holo['minhkr']) {
    header("Location: " . $Holo['url'] ."");
	exit;
}

if(mysql_num_rows($chb) > 0) {
    header("Location: " . $Holo['url'] . "/banned");
	exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $Holo['name']; ?> Painel</title>
	<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/css/wulles.css">
	<link rel="shortcut icon" href="<?php echo $Holo['url']; ?>/img/favicon.ico" type="image/vnd.microsoft.icon" />
	<link href="<?php echo $Holo['url']; ?>/housekeeping/css/bootstrap/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/housekeeping/css/jquery-jvectormap-1.2.2.css"/>
	<link href="<?php echo $Holo['url']; ?>/housekeeping/css/style.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

</head>
<body>

	<?php include ("header.php"); ?>

	<div class="wrapper">

		<?php include ("menulinks.php"); ?>
		
		<section class="content">
		
<?php if($myrow['rank'] <= 7) { ?>
			<meta http-equiv="refresh" content="10; url=home.php">
			<header class="main-header clearfix">
            <div class="alert alert-danger alert-dismissable">
              <div class="media">
                <figure class="pull-left alert--icon">
                  <i class="pe-7s-attention"></i>
                </figure>
                <div class="media-body">
                  <h3 class="alert--title">Você não pode fazer isso.</h3> 
                  <p class="alert--text">Ei <?php echo $myrow['username']; ?>, descobrimos que você não tem permissões para estar aqui.<br>Vamos te levar de volta em 10 segundos.</p>
                </div>
              </div>
            </div>
			</header>
<?php } ?>
<?php if($myrow['rank'] >= 8) { ?>
			<header class="main-header clearfix">

				<h1 class="main-header__title">
					<i class="icon pe-7s-tools"></i>
					Configurações
				</h1>
				<ul class="main-header__breadcrumb">
					<li><a style="text-decoration:none; ">Manutenção</a></li>
				</ul>
			<?php if(MANTENIMIENTO == '1') { ?>
            <div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <div class="media">
                <figure class="pull-left alert--icon">
                  <i class="pe-7s-attention"></i>
                </figure>
                <div class="media-body">
                  <h3 class="alert--title">Detectamos que o <?php echo $Holo['name']; ?> está em Manutenção.</h3> 
                  <p class="alert--text">Motivo: <?php echo $mantenimientoo['motivo']; ?></p>
                </div>
              </div>
            </div>
			<?php } ?>
			</header>
			
			<div class="row">	
				<div class="col-md-7">
					<article class="widget">
					<header class="widget__header">
						<h3 class="widget__title">Painel de Manutenção</h3>
					</header>
<?php
if(isset($_POST['motivo']))
{
$Motivo = $_POST['motivo'];

if(empty($Motivo))
{
echo '<div class="alert alert-warning alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<div class="media">
								<figure class="pull-left alert--icon">
									<i class="pe-7s-attention"></i>
								</figure>
								<div class="media-body">
									<h3 class="alert--title">Iti malia, algo está errado.</h3> 
									<p class="alert--text">Você precisa colocar um Motivo para que você possa colocar o hotel em Manutenção.</p>
								</div>
							</div>
						</div>';
} else {
mysql_query("UPDATE cms_mantenimiento SET mantenimiento = '1', motivo = '". $Motivo ."'");
mysql_query("INSERT INTO stafflogs (action, message, note, userid, timestamp) VALUES ('Maintenance', 'Ativou', '". $myrow['rank'] ."', '". $myrow['id'] ."', '". $date_full ."')");
echo '<meta http-equiv="refresh" content="0">';
}
}
if(isset($_POST['quitar']))
{
mysql_query("UPDATE cms_mantenimiento SET mantenimiento = '0', motivo = ''");
mysql_query("INSERT INTO stafflogs (action, message, note, userid, timestamp) VALUES ('Maintenance', 'Desativou', '". $myrow['rank'] ."', '". $myrow['id'] ."', '". $date_full ."')");
echo '<meta http-equiv="refresh" content="0">';
}
?>

					<div class="widget__content">
<?php $sqlputo = mysql_query("SELECT * FROM cms_mantenimiento");
$putito = mysql_fetch_assoc($sqlputo);
if($putito['mantenimiento'] == '0') { ?>
					<form method="post">
						<p class="alert--text">Título da manutenção:</p>
						<input class="input-text" value="Estamos em Manutenção." disabled />
						<p class="alert--text">Motivo da manutenção:</p>
						<textarea name="motivo" style="width: 100%; height: 150px;"></textarea>
						<button class="btn btn-light pull-right" type="submit">Colocar em manutenção</button>
						<div class="clearfix"></div>
					</form>
<?php } else { ?>
					<form method="post">
						<p class="alert--text">O <?php echo $Holo['name']; ?> Hotel está em manutenção agora, pelo motivo: <?php echo $mantenimientoo['motivo']; ?><br>Você pode deixar ele aberto ao público novamente clicando no botão que está logo a baixo.</p>
						<button class="btn btn-light pull-left" type="submit" name="quitar">Retirar da manutenção</button>
						<div class="clearfix"></div>
					</form>
					</div>
<?php } ?>
					</article>
				</div>
				
				<div class="col-md-5">
					<article class="widget">
					<header class="widget__header">
						<h3 class="widget__title">Atividades de Manutenção mais recentes <span class="color--skyblue-light">(10) de (<?php echo mysql_num_rows(mysql_query("SELECT * FROM stafflogs WHERE action='Maintenance'")) ?>)</span></h3>
					</header>

					<div class="widget__content">
						<table class="table">
							<thead>
                        <tr>
                            <th>Usuário</th>
                            <th>Ação</th>
                            <th>Data</th>
                        </tr>
                        </thead>
							<tbody>
								<?php $maintenance_a = mysql_query("SELECT * FROM stafflogs WHERE action='Maintenance' ORDER BY id DESC LIMIT 10");
								while($maintenance = mysql_fetch_assoc($maintenance_a)){
								$row = mysql_fetch_assoc($row = mysql_query("SELECT username FROM users WHERE id = '".$maintenance['userid']."'")); ?>
								<tr>
									<td><?php echo $row['username']; ?></td>
									<td><?php echo $maintenance['message']; ?></td>
									<td><?php echo $maintenance['timestamp']; ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					</article>
				</div>
			</div>
<?php } ?>
			</section>

		</div>

		<script type="text/javascript" src="<?php echo $Holo['url']; ?>/housekeeping/js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="<?php echo $Holo['url']; ?>/housekeeping/js/jquery-ui.js"></script>
		<script type="text/javascript" src="<?php echo $Holo['url']; ?>/housekeeping/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo $Holo['url']; ?>/housekeeping/js/amcharts.js"></script>
		<script type="text/javascript" src="<?php echo $Holo['url']; ?>/housekeeping/js/serial.js"></script>
		<script type="text/javascript" src="<?php echo $Holo['url']; ?>/housekeeping/js/pie.js"></script>
		<script type="text/javascript" src="<?php echo $Holo['url']; ?>/housekeeping/js/chart.js"></script>
		<script type="text/javascript" src="<?php echo $Holo['url']; ?>/housekeeping/js/map.js"></script>
		<script src="<?php echo $Holo['url']; ?>/housekeeping/js/jquery-jvectormap-1.2.2.min.js"></script>
		<script src="<?php echo $Holo['url']; ?>/housekeeping/js/jquery-jvectormap-us-aea-en.js"></script>
		<script type="text/javascript" src="<?php echo $Holo['url']; ?>/housekeeping/js/main.js"></script>


	</body>
	
</html>