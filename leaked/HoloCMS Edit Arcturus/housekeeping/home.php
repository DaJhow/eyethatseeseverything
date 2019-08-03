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
	<link rel="shortcut icon" href="<?php echo $Holo['url']; ?>/img/favicon.ico" type="image/vnd.microsoft.icon" />
	<link href="<?php echo $Holo['url']; ?>/housekeeping/css/bootstrap/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/housekeeping/css/jquery-jvectormap-1.2.2.css"/>
	<link href="<?php echo $Holo['url']; ?>/housekeeping/css/style.css" rel="stylesheet" />
	<link href="<?php echo $Holo['url']; ?>/css/wulles.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

</head>
<body>

	<?php include ("header.php"); ?>

	<div class="wrapper">

		<?php include ("menulinks.php"); ?>
		
		<section class="content">
			<header class="main-header clearfix">
				<h1 class="main-header__title">
					<i class="icon pe-7s-home"></i>
					Administração
				</h1>
				<ul class="main-header__breadcrumb">
					<li><a style="text-decoration:none; ">Início</a></li>
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
			
			<div class="main-stats row">
				<div class="main-stats__stat col-lg-3 col-md-12 col-sm-12">
					<h3 class="stat__title">Usuários registrados</h3>
					<div class="stat__number" id="inscrit"> <?php echo mysql_num_rows(mysql_query("SELECT * FROM users")) ?></div>
					<div class="progress" id="progress-inscrit">
						<div class="progress-bar progress-bar--skyblue" role="progressbar" aria-valuenow="<?php echo mysql_num_rows(mysql_query("SELECT * FROM users")) ?>" aria-valuemin="0" aria-valuemax="10000" style="width: <?php echo mysql_num_rows(mysql_query("SELECT * FROM users")) ?>%;"></div>
					</div>
				</div>
				
				<div class="main-stats__stat col-lg-3 col-md-12 col-sm-12">
					<h3 class="stat__title">Quartos criados</h3>
					<div class="stat__number" id="online"> <?php echo mysql_num_rows(mysql_query("SELECT * FROM rooms")) ?></div>
					<div class="progress" id="progress-online">
						<div class="progress-bar progress-bar--anzac" role="progressbar" aria-valuenow="<?php echo mysql_num_rows(mysql_query("SELECT * FROM rooms")) ?>" aria-valuemin="0" aria-valuemax="1000" style="width: <?php echo mysql_num_rows(mysql_query("SELECT * FROM rooms")) ?>%;"></div>
					</div> 
				</div> 

				<div class="main-stats__stat col-lg-3 col-md-12 col-sm-12">
					<h3 class="stat__title">Grupos criados</h3>
					<div class="stat__number" id="visites"> <?php echo mysql_num_rows(mysql_query("SELECT * FROM guilds")) ?></div>
					<div class="progress" id="progress-visites">
						<div class="progress-bar progress-bar--green" role="progressbar" aria-valuenow="<?php echo mysql_num_rows(mysql_query("SELECT * FROM guilds")) ?>" aria-valuemin="0" aria-valuemax="1000" style="width: <?php echo mysql_num_rows(mysql_query("SELECT * FROM guilds")) ?>%;"></div>
					</div>
				</div> 

				<div class="main-stats__stat col-lg-3 col-md-12 col-sm-12">
					<h3 class="stat__title">Usuários banidos</h3>
					<div class="stat__number" id="record"> <?php echo mysql_num_rows(mysql_query("SELECT * FROM bans")) ?></div>
					<div class="progress" id="progress-record">
						<div class="progress-bar progress-bar--red" role="progressbar" aria-valuenow="<?php echo mysql_num_rows(mysql_query("SELECT * FROM bans")) ?>" aria-valuemin="0" aria-valuemax="1000" style="width: <?php echo mysql_num_rows(mysql_query("SELECT * FROM bans")) ?>%;"></div>
					</div>
				</div>
			</div>

			<div class="row">	
				<div class="col-md-7">
					<article class="widget widget--tabbed">
						<div class="tabs">
						
							<input type="radio" name="t" id="tab1" checked>
							<label for="tab1" class="tabs__tab">Equipe do Hotel <font color="#60c6cf">(<?php echo mysql_num_rows(mysql_query("SELECT * FROM users WHERE rank > 6")) ?>)</font></label>
							<input type="radio" name="t" id="tab2">
							<label for="tab2" class="tabs__tab">Últimos registrados <font color="#60c6cf">(10)</font></label>
							<input type="radio" name="t" id="tab3">
							<label for="tab3" class="tabs__tab">Últimas mensagens <font color="#60c6cf">(10)</font></label>
							
							<div class="tabs__content">
								<div class="tabs__content--1" style="height:395px;width:100%;overflow:auto;">
								<?php $e = mysql_query("SELECT * FROM users WHERE rank > 6 ORDER BY online DESC");
								while($f = mysql_fetch_array($e)){ ?>
									<div class="media social_msg">
										<figure class="pull-left rounded-image social_msg__img">
											 <img src="<?php echo $Holo['avatar'] . $f['look']; ?>&action=&direction=2&head_direction=2" alt="user">
										</figure>
										<div class="media-body">
										    <h4 class="media-heading social_msg__heading"><span class="user-style <?php echo $f['user_style']; ?>"><?php echo $f['username'] ?></span> <span>(<?php if($f['online'] == '1') { echo 'Online agora'; } else { echo 'Offline'; } ?>)</span></h4>
											<small class="social_msg__meta">Missão: <?php echo mysql_real_escape_string($f['motto']); ?><br>ID de cargo: <?php echo $f['rank']; ?></small>
										</div>
									</div>
								<?php } ?>
								</div>
								<div class="tabs__content--2" style="height:395px;width:100%;overflow:auto;">
								<?php $e = mysql_query("SELECT * FROM users WHERE rank < 6 ORDER BY id DESC LIMIT 10");
								while($f = mysql_fetch_array($e)){ ?>
									<div class="media social_msg">
										<figure class="pull-left rounded-image social_msg__img">
											 <img src="<?php echo $Holo['avatar'] . $f['look']; ?>&action=&direction=2&head_direction=2" alt="user">
										</figure>
										<div class="media-body">
										    <h4 class="media-heading social_msg__heading"><span class="user-style <?php echo $f['user_style']; ?>"><?php echo $f['username'] ?></span> <span>(<?php if($f['online'] == '1') { echo 'Online agora'; } else { echo 'Offline'; } ?>)</span></h4>
											<small class="social_msg__meta">Se registrou <?php echo GetLast($f['account_created']); ?><br>Missão: <?php echo mysql_real_escape_string($f['motto']); ?></small>
										</div>
									</div>
								<?php } ?>
								</div>
								<div class="tabs__content--3" style="height:395px;width:100%;overflow:auto;">
								<?php $e = mysql_query("SELECT * FROM chatlogs_room ORDER BY timestamp DESC LIMIT 10");
								while($f = mysql_fetch_assoc($e)){
								$row = mysql_fetch_assoc($row = mysql_query("SELECT * FROM users WHERE id = '".$f['user_from_id']."'"));
								$room = mysql_fetch_assoc($room = mysql_query("SELECT * FROM rooms WHERE id = '".$f['room_id']."'")); ?>
									<div class="media social_msg">
										<figure class="pull-left rounded-image social_msg__img">
											 <img src="<?php echo $Holo['avatar'] . $row['look']; ?>&action=&direction=2&head_direction=2" alt="user">
										</figure>
										<div class="media-body">
										    <h4 class="media-heading social_msg__heading"><span class="user-style <?php echo $row['user_style']; ?>"><?php echo $row['username'] ?></span> <span>(<?php if($row['online'] == '1') { echo 'Online agora'; } else { echo 'Offline'; } ?>)</span></h4>
											<small class="social_msg__meta">Enviou: <?php echo mysql_real_escape_string($f['message']); ?><br><?php echo GetLast($f['timestamp']); ?> no quarto: <?php echo mysql_real_escape_string($room['name']); ?></small>
										</div>
									</div>
								<?php } ?>
								</div>
							</div> 

						</div>

					</article>
				</div>


				<div class="col-md-5">
					<article class="widget no-padding--lr">
						<header class="widget__header">
							<h3 class="widget__title">Mais informações sobre você</h3>					
						</header>
						<div class="widget__content">

							<div class="media user user--added">
								<figure class="pull-left rounded-image social_msg__img"><img src="<?php echo $Holo['avatar'] . $myrow['look']; ?>&action=&direction=2&head_direction=2" alt="user"></figure>
								<div class="media-body">
									<h4 class="media-heading user__name"><span class="user-style <?php echo $myrow['user_style']; ?>"><?php echo $myrow['username']; ?></span></h4>
									<small class="user__location"></small>

									<input type="checkbox" class="btn-more-check" id="more3" checked>

									<div class="accordion__details">
										<p>Online:<span><?php if($myrow['online'] == '1') { echo 'Sim'; } else { echo 'Não'; } ?></span></p>
										<p>Style:<span><span class="user-style <?php echo $myrow['user_style']; ?>"><?php echo $myrow['user_style']; ?></span></span></p>
										<p>Missão:<span><?php echo mysql_real_escape_string($myrow['motto']); ?></span></p>
										<p>Moedas:<span><?php echo $myrow['credits']; ?></span></p>
										<p>Duckets:<span><?php $getDuckets = mysql_query("SELECT * FROM users INNER JOIN users_currency ON users.id=users_currency.user_id  WHERE users_currency.type = '0' AND users.id = '".$myrow['id']."'");
										while($ducketsStats = mysql_fetch_array($getDuckets)) {
										echo ''.$ducketsStats['amount'].'';
										} ?></span></p>
										<p>Diamantes:<span><?php $getDiamonds = mysql_query("SELECT * FROM users INNER JOIN users_currency ON users.id=users_currency.user_id  WHERE users_currency.type = '5' AND users.id = '".$myrow['id']."'");
										while($diamondsStats = mysql_fetch_array($getDiamonds)) {
										echo ''.$diamondsStats['amount'].'';
										} ?></span></p>
										<p>E-mail:<span><?php echo $myrow['mail']; ?></span></p>
										<p>IP de Conexão:<span><?php echo $myrow['ip_current']; ?></span></p>
										<p>IP de Registro:<span><?php echo $myrow['ip_register']; ?></span></p>
									</div>
								</div>
							</div>
							
						</div>
					</article>
				</div>

			</div>

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