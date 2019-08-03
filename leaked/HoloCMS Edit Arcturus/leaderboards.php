<?php require_once("inc/core.god.php");

if(Loged == FALSE)
{
	header("Location: /");
	exit;
}

if(MANTENIMIENTO == '1') 
{
    header("Location: mantenimiento");
	exit;
}

if($_GET['action'] == 'logout') {
    session_destroy();
    header("Location: /");
	exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=1140">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $Holo['name']; ?> Hotel</title>
  <link rel="shortcut icon" href="<?php echo $Holo['url']; ?>/img/favicon.ico" type="image/vnd.microsoft.icon" />
  <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $Holo['url']; ?>/css/v3.css">
  <link rel="stylesheet" href="<?php echo $Holo['url']; ?>/css/wulles.css">
  <meta name="description" content="Crie amigos, quartos, festas, e divirta-se no <?php echo $Holo['name']; ?>">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="<?php echo $Holo['name']; ?> Hotel">
  <meta property="og:title" content="<?php echo $Holo['name']; ?>: Entre agora.">
  <meta property="og:description" content="Crie amigos, quartos, festas, e divirta-se no <?php echo $Holo['name']; ?>.">
  <meta property="og:url" content="<?php echo $Holo['url']; ?>">
  <meta property="og:image" content="<?php echo $Holo['url']; ?>/img/website/app_summary_image.png">
  <meta property="og:image:height" content="628">
  <meta property="og:image:width" content="1200">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo $Holo['name']; ?> Hotel">
  <meta name="twitter:description" content="Crie amigos, quartos, festas, e divirta-se no <?php echo $Holo['name']; ?>.">
  <meta name="twitter:image" content="<?php echo $Holo['url']; ?>/img/website/app_summary_image.png">
  <meta name="twitter:site" content="@<?php echo $Holo['twitter']; ?>">
  <meta itemprop="name" content="<?php echo $Holo['name']; ?> Hotel">
  <meta itemprop="description" content="Crie amigos, quartos, festas, e divirta-se no <?php echo $Holo['name']; ?>.">
  <meta itemprop="image" content="<?php echo $Holo['url']; ?>/img/website/app_summary_image.png">
  <meta name="description" content="Crie amigos, quartos, festas, e divirta-se no <?php echo $Holo['name']; ?>." />
</head>
  
<body>
<div id="page-wrap">
			
	<div class="header">
    <div class="top-bar">
      <div class="container d-flex">
        <div class="user">
					<form id="logout-form" action="<?php echo $Holo['url']; ?>/logout" method="POST" style="display: none;">
						<input type="hidden" name="_token">
					</form>
          <div class="username">
			<a href="<?php echo $Holo['url']; ?>/home/<?php echo $myrow['username']; ?>">
            <img src="<?php echo $Holo['avatar'] . $myrow['look']; ?>&direction=2&gesture=sml">
            <span><font color="#FFFFFF"><?php echo $myrow['username']; ?></font></span>
			</a>
          </div>
        </div>
        <div class="ml-auto d-flex align-items-center">
		  <a href="<?php echo $Holo['url']; ?>/way" class="log-out pr-3 font-weight-bold text-info"><?php echo $Holo['name']; ?> Etiqueta</a> |   <?php if($myrow['rank'] >= $Holo['minhkr']) { ?><a href="<?php echo $Holo['url'] . '/' . $Holo['panel']; ?>" target="_blank" class="log-out pr-3 font-weight-bold"><font color="#e216da">Painel de Controle</font></a> | <?php } ?>
          <a class="log-out pl-3 font-weight-bold " href="<?php echo $Holo['url']; ?>/me?action=logout">Desconectar</a>
        </div>
      </div>
    </div>
    <div class="header-main">
      <div class="container">
          <div class="row align-items-center justify-content-md-start justify-content-center">
            <div class="col-auto">
              <a class="logo" href="<?php echo $Holo['url']; ?>"></a>
            </div>
            <div class="col-auto ml-auto">
              <a class="enter-client" href="<?php echo $Holo['url']; ?>/hotel">Entrar no <?php echo $Holo['name']; ?></a>
            </div>
          </div>
        </div>
    </div>
  </div>
  <div class="navigation align-self-center">
    <div class="container d-flex">
      <div class="nav-inner">
        <div class="nav-button">
          <a>
            <img src="<?php echo $Holo['url']; ?>/img/website/nav/home.png">
            <span class="nav-button-text">Início</span>
          </a>
          <div class="dropdown">
            <a href="<?php echo $Holo['url']; ?>/me">Página inicial</a>
            <a href="<?php echo $Holo['url']; ?>/home/<?php echo $myrow['username']; ?>">Meu perfil</a>
			<a href="<?php echo $Holo['url']; ?>/account/correo">Configurações</a>
          </div>
        </div>
        <div class="nav-button">
          <a>
            <img src="<?php echo $Holo['url']; ?>/img/website/nav/community.png">
            <span class="nav-button-text">Comunidade</span>
          </a>
          <div class="dropdown">
            <a href="<?php echo $Holo['url']; ?>/groups"><?php echo $Holo['name']; ?> Grupos</a>
            <a href="<?php echo $Holo['url']; ?>/leaderboards">Os mais ricos</a>
            <a href="<?php echo $Holo['url']; ?>/staff">Nossa equipe</a>
          </div>
        </div>
		<?php $news = mysql_query("SELECT * FROM cms_news ORDER BY id DESC LIMIT 1");
		while($new = mysql_fetch_assoc($news)){ ?>
        <div class="nav-button" href="<?php echo $Holo['url']; ?>/news/<?php echo $new['id'] ?>">
          <a class="nav-button" href="<?php echo $Holo['url']; ?>/news/<?php echo $new['id'] ?>">
            <img src="<?php echo $Holo['url']; ?>/img/website/nav/new.png">
            <span class="nav-button-text">Notícias</span>
          </a>
        </div>
		<?php } ?>
        <div class="nav-button" href="<?php echo $Holo['url']; ?>/store">
          <a class="nav-button" href="<?php echo $Holo['url']; ?>/store">
            <img src="<?php echo $Holo['url']; ?>/img/website/nav/store.png">
            <span class="nav-button-text">Loja</span>
          </a>
        </div>
      </div>
      <a href="<?php echo $Holo['url']; ?>/onlines" class="ml-auto d-flex align-items-center">
        <div class="online-count">
          <b><?php echo Onlines(); ?></b> <?php echo $Holo['name']; ?>s no Hotel
        </div>
      </a>
    </div>
  </div>
	<div class="page-content">
		<div class="container">
			
		</div>
	</div>
	
<div class="content">
		<div class="container">
			
<div class="container" style="margin-bottom: 30px;">
	<div class="row">

		<div class="col-4">
			<div class="content-box blue leaderboards">
				<div class="title">Mais Moedas</div>
				<div class="box-body">
					<div class="leaderboard-users">
						<div class="ldearboard-user">
<?php
$getCredits = mysql_query("SELECT `look`,`username`,`credits`,`user_style` FROM `users` WHERE `rank` <= '3' ORDER BY `credits` DESC LIMIT 10");
while($creditsStats = mysql_fetch_array($getCredits)) {
echo '								<a class="leaderboard-user" href="'.$Holo['url'].'/home/'.$creditsStats['username'].'">
									<div class="leaderboard-user-portrait" style="background-image: url('.$Holo['avatar'] . $creditsStats['look'].'&amp;head_direction=2&amp;gesture=sml);"></div>
									<div class="leaderboard-user-info">
										<div class="leaderboard-user-name no-text-decoration text-info"><span class="user-style '.$creditsStats['user_style'].'">'.$creditsStats['username'].'</span></div>
										<div class="leaderboard-user-stat"><font color="#bf6211">'.$creditsStats['credits'].' Moedas</font></div>
									</div>
								</a>';
}
?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-4">
			<div class="content-box blue leaderboards">
				<div class="title">Mais Conquistas</div>
				<div class="box-body">
					<div class="leaderboard-users">
						<div class="ldearboard-user">
<?php
$getScore = mysql_query("SELECT * FROM users INNER JOIN users_settings ON users.id=users_settings.user_id WHERE users.rank < 3 ORDER BY users_settings.achievement_score DESC LIMIT 10");
while($scoreStats = mysql_fetch_array($getScore)) {
echo '								<a class="leaderboard-user" href="'.$Holo['url'].'/home/'.$scoreStats['username'].'">
									<div class="leaderboard-user-portrait" style="background-image: url('.$Holo['avatar'] . $scoreStats['look'].'&amp;head_direction=3&amp;gesture=sml);"></div>
									<div class="leaderboard-user-info">
										<div class="leaderboard-user-name no-text-decoration text-info"><span class="user-style '.$scoreStats['user_style'].'">'.$scoreStats['username'].'</span></div>
										<div class="leaderboard-user-stat">'.$scoreStats['achievement_score'].' Pontos de conquista</div>
									</div>
								</a>';
}
?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-4">
			<div class="content-box blue leaderboards">
				<div class="title">Mais Diamantes</div>
				<div class="box-body">
					<div class="leaderboard-users">
						<div class="ldearboard-user">
<?php
$getDaimands = mysql_query("SELECT * FROM users INNER JOIN users_currency ON users.id=users_currency.user_id WHERE users_currency.type = '5' AND users.rank < 3 ORDER BY users_currency.amount DESC LIMIT 10");
while($daimands = mysql_fetch_array($getDaimands)) {
echo '								<a class="leaderboard-user" href="'.$Holo['url'].'/home/'.$daimands['username'].'">
									<div class="leaderboard-user-portrait" style="background-image: url('.$Holo['avatar'] . $daimands['look'].'&amp;head_direction=4&amp;gesture=sml);"></div>
									<div class="leaderboard-user-info">
										<div class="leaderboard-user-name no-text-decoration text-info"><span class="user-style '.$daimands['user_style'].'">'.$daimands['username'].'</span></div>
										<div class="leaderboard-user-stat"><font color="#2977a9">'.$daimands['amount'].' Diamantes</font></div>
									</div>
								</a>';
}
?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-4">
			<div class="content-box blue leaderboards">
				<div class="title">Mais Respeitos</div>
				<div class="box-body">
					<div class="leaderboard-users">
						<div class="ldearboard-user">
<?php
$getRespects = mysql_query("SELECT * FROM users INNER JOIN users_settings ON users.id=users_settings.user_id WHERE users.rank < 3 ORDER BY users_settings.respects_received DESC LIMIT 10");
while($respectStats = mysql_fetch_array($getRespects)) {
echo '								<a class="leaderboard-user" href="'.$Holo['url'].'/home/'.$respectStats['username'].'">
									<div class="leaderboard-user-portrait" style="background-image: url('.$Holo['avatar'] . $respectStats['look'].'&amp;head_direction=2&amp;gesture=sml);"></div>
									<div class="leaderboard-user-info">
										<div class="leaderboard-user-name no-text-decoration text-info"><span class="user-style '.$respectStats['user_style'].'">'.$respectStats['username'].'</span></div>
										<div class="leaderboard-user-stat">'.$respectStats['respects_received'].' Respeitos</div>
									</div>
								</a>';
}
?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-4">
			<div class="content-box blue leaderboards">
				<div class="title">Mais Duckets</div>
				<div class="box-body">
					<div class="leaderboard-users">
						<div class="ldearboard-user">
<?php
$getDuckets = mysql_query("SELECT * FROM users INNER JOIN users_currency ON users.id=users_currency.user_id WHERE users_currency.type = '0' AND users.rank < 3 ORDER BY users_currency.amount DESC LIMIT 10");
while($ducketsStats = mysql_fetch_array($getDuckets)) {
echo '								<a class="leaderboard-user" href="'.$Holo['url'].'/home/'.$ducketsStats['username'].'">
									<div class="leaderboard-user-portrait" style="background-image: url('.$Holo['avatar'] . $ducketsStats['look'].'&amp;head_direction=3&amp;gesture=sml);"></div>
									<div class="leaderboard-user-info">
										<div class="leaderboard-user-name no-text-decoration text-info"><span class="user-style '.$ducketsStats['user_style'].'">'.$ducketsStats['username'].'</span></div>
										<div class="leaderboard-user-stat"><font color="#7c189c">'.$ducketsStats['amount'].' Duckets</font></div>
									</div>
								</a>';
}
?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-4">
			<div class="content-box blue leaderboards">
				<div class="title">Mais Tempo Jogando</div>
				<div class="box-body">
					<div class="leaderboard-users">
						<div class="ldearboard-user">
<?php
$getTime = mysql_query("SELECT * FROM users INNER JOIN users_settings ON users.id=users_settings.user_id WHERE users.rank < 3 ORDER BY users_settings.online_time DESC LIMIT 10");
$time = 3600*24; // 60*60*24
while($TimeStats = mysql_fetch_array($getTime)) {
echo '								<a class="leaderboard-user" href="'.$Holo['url'].'/home/'.$TimeStats['username'].'">
									<div class="leaderboard-user-portrait" style="background-image: url('.$Holo['avatar'] . $TimeStats['look'].'&amp;head_direction=4&amp;gesture=sml);"></div>
									<div class="leaderboard-user-info">
										<div class="leaderboard-user-name no-text-decoration text-info"><span class="user-style '.$TimeStats['user_style'].'">'.$TimeStats['username'].'</span></div>
										<div class="leaderboard-user-stat">' . date('j \H\o\r\a\s\ ', $TimeStats['online_time']) . '</div>
									</div>
								</a>';
}
?>
						</div>
					</div>
				</div>
			</div>
		</div>
				
				
				
				
				
				
			</div>
</div>

		</div>
	</div>
	
	<div class="footer">
		<div class="container"><strong>Sirio Project</strong> &copy; 2010-2019</div>
	</div>
</div>

<script src="<?php echo $Holo['url']; ?>/js/jquery-3.2.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>
</html>