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
		
<?php if($myrow['rank'] <= 8) { ?>
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
<?php if($myrow['rank'] >= 9) { ?>
			<header class="main-header clearfix">
				<h1 class="main-header__title">
					<i class="icon pe-7s-star"></i>
					In-game
				</h1>
				<ul class="main-header__breadcrumb">
					<li><a style="text-decoration:none; ">UpdateUser</a></li>
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
			<br><br><div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <div class="media">
                <figure class="pull-left alert--icon">
                  <i class="pe-7s-attention"></i>
                </figure>
                <div class="media-body">
                  <h3 class="alert--title">Tome cuidado bonitin...</h3> 
                  <p class="alert--text">Se você não souber o que está fazendo aqui, você pode gerar uma Grande confusão!.<br><br><h3 class="alert--title">Essa função desta página só vai funcionar se o Hotel ou Usuário em que ela pede, estiver Online.</h3></p>
                </div>
              </div>
            </div>
			</header>

<?php
if(isset($_POST['enviar']))
{
	
$achievement_score = $_POST['achievement_score'];
$block_camera_follow = $_POST['block_camera_follow'];
$block_following = $_POST['block_following'];
$block_friendrequests = $_POST['block_friendrequests'];
$block_roominvites = $_POST['block_roominvites'];
$look = $_POST['look'];
$old_chat = $_POST['old_chat'];
$user_id = $_POST['user_id'];

$service_port = 30001;
$address = $Holo['ip'];

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
} else {
 
$teste = '<div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <div class="media">
                <figure class="pull-left alert--icon">
                  <i class="pe-7s-attention"></i>
                </figure>
                <div class="media-body">
                  <h3 class="alert--title">Executado com sucesso!</h3> 
                  <p class="alert--text">O registro abaixo foi executado com sucesso dentro do Hotel.</p>
                </div>
              </div>
            </div>';
}

mysql_query("INSERT INTO stafflogs (action, message, note, userid, timestamp) VALUES ('UpdateUser', 'Usou', '". $myrow['rank'] ."', '". $myrow['id'] ."', '". $date_full ."')");

$result = socket_connect($socket, $address, $service_port);
if ($result === false) {
    echo "<div class='alert alert-danger alert-dismissable'>
              <meta http-equiv='refresh' content='6; url=sendalert.php'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <div class='media'>
                <figure class='pull-left alert--icon'>
                  <i class='pe-7s-attention'></i>
                </figure>
                <div class='media-body'>
                  <h3 class='alert--title'>Algo deu errado ein...</h3> 
                  <p class='alert--text'>Provavelmente o hotel está desligado ou a ação que você tentou usar está pedindo um Usuário que está offline.<br>Estamos atualizando a página em 10 segundos.</p>
                </div>
              </div>
            </div>";
} else {
}

mysql_query("INSERT INTO stafflogs (action, message, note, userid, timestamp) VALUES ('UpdateUser', 'UpdateUser', '". $myrow['rank'] ."', '". $myrow['id'] ."', '". $date_full ."')");

$in = 
'{
  "key": "UpdateUser",
  "data": {
    "achievement_score":"'.$achievement_score.'",
    "block_camera_follow":"'.$block_camera_follow.'",
    "block_following":"'.$block_following.'",
    "block_friendrequests":"'.$block_friendrequests.'",
    "block_roominvites":"'.$block_roominvites.'",
    "look":"'.$look.'",
    "old_chat":"'.$old_chat.'",
    "user_id":"'.$user_id.'"
  }
}';

if(socket_write($socket, $in, strlen($in)) === false)
{
echo "";
}

$out = socket_read($socket, 2048);
}

?>

			<div class="row">
				<div class="col-md-7">
					<article class="widget">
						<div class="widget__content">
						<?php 
							if(isset($teste))
							{
								echo $teste;
							} else {
						?>
						    
							<form method="post">
								<p class="alert--text">achievement_score</p>
								<input class="input-text" name="achievement_score" />
								<p class="alert--text">block_camera_follow</p>
								<input class="input-text" name="block_camera_follow" />
								<p class="alert--text">block_following</p>
								<input class="input-text" name="block_following" />
								<p class="alert--text">block_friendrequests</p>
								<input class="input-text" name="block_friendrequests" />
								<p class="alert--text">block_roominvites</p>
								<input class="input-text" name="block_roominvites" />
								<p class="alert--text">look</p>
								<input class="input-text" name="look" />
								<p class="alert--text">old_chat</p>
								<input class="input-text" name="old_chat" />
								<p class="alert--text">user_id</p>
								<input class="input-text" name="user_id" />
								<button class="btn btn-light pull-right" name="enviar" type="submit">Enviar para o Hotel</button>
								<div class="clearfix"></div>
							</form>
						<?php } ?>
						</div>
					</article>
				</div>
				
				<div class="col-md-5">
					<article class="widget">
					<header class="widget__header">
						<h3 class="widget__title">Atividades mais recentes <span class="color--skyblue-light">(10) de (<?php echo mysql_num_rows(mysql_query("SELECT * FROM stafflogs WHERE action='UpdateUser'")) ?>)</span></h3>
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
								<?php $rcon_a = mysql_query("SELECT * FROM stafflogs WHERE action='UpdateUser' ORDER BY id DESC LIMIT 10");
								while($rcon = mysql_fetch_assoc($rcon_a)){
								$row = mysql_fetch_assoc($row = mysql_query("SELECT username FROM users WHERE id = '".$rcon['userid']."'")); ?>
								<tr>
									<td><?php echo $row['username']; ?></td>
									<td><?php echo $rcon['message']; ?></td>
									<td><?php echo $rcon['timestamp']; ?></td>
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