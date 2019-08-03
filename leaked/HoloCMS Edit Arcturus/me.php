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
	
	<div class="content">
		<div class="container">
		
		<div class="giant-link green d-flex justify-content-center align-items-center"><div class="mr-auto"><font size="3">Está gostando das novidades <?php echo $myrow['username']; ?>? Mas espere um pouco em, pois ainda não terminamos tudo, estamos em Beta.</font></div><div class="icon"><i class="fas fa-file-invoice"></i></div></div>
		
			<div class="row" style="margin-bottom: 15px">
<?php $news = mysql_query("SELECT * FROM cms_news ORDER BY id DESC LIMIT 3");
while($new = mysql_fetch_assoc($news)){
$row = mysql_fetch_assoc($row = mysql_query("SELECT * FROM users WHERE username = '".$new['author']."'")); ?>
	<div class="col">
		<a href="<?php echo $Holo['url']; ?>/news/<?php echo $new['id']; ?>" class="news d-flex align-items-center no-link-styling">
			<div class="news-bg" style="background-image: url(<?php echo $new['image']; ?>)"></div>
			<div class="news-info-wrapper d-flex align-items-center">
				<div class="news-info d-flex justify-content-center flex-column">
					<div class="news-title"><?php echo $new['title']; ?></div>
					<div>
						<!--<div class="news-comments"><i style="margin-right: 1px;" class="fas fa-comments"></i> 0</div>-->
						<!--<div class="news-comments"><i style="margin-right: 3px;" class="fas fa-thumbs-up"></i>0 </div>-->
						<div class="news-date">Postado <?php echo GetLast($new['date']); ?> atrás</div>
					</div>
				</div>
		 	</div>
		</a>
	</div>
<?php } ?>
	</div>
<div class="row">
	<div class="col-6">
		<div class="row">
			<div class="col pr-2">
				<a href="<?php echo $Holo['discordid'] ?>" target="_blank">
				<div class="giant-link discord d-flex justify-content-center align-items-center">
					<div class="mr-auto">Discord</div>
					<div class="icon"><i class="fab fa-discord"></i></div>
				</div>
				</a>
			</div>
			<div class="col pl-2">
				<a href="https://www.facebook.com/<?php echo $Holo['facebook'] ?>" target="_blank">
				<div class="giant-link facebook d-flex justify-content-center align-items-center">
					<div class="mr-auto">Facebook</div>
					<div class="icon"><i class="fab fa-facebook-square"></i></div>
				</div>
				</a>
			</div>
		</div>
<?php $rooms = mysql_query("SELECT * FROM rooms WHERE score > 1 ORDER BY score DESC LIMIT 3");
while($room = mysql_fetch_array($rooms)){
$user = mysql_fetch_assoc($user = mysql_query("SELECT * FROM users WHERE id = '".$room['owner_id']."'")); ?>
		<div class="promotion">
			<div class="d-flex">
				<div class="promo-img left-img">
					<img src="<?php echo $Holo['thumbsurl']; ?><?php echo $room['id']; ?>.png">
				</div>
				<div class="mr-auto promo-info align-self-center">
					<div class="room-item__title"><?php echo $room['name']; ?></div>
					<br>Quarto de <b><span class="user-style <?php echo $user['user_style']; ?>"><?php echo $user['username']; ?></span> <?php if($user['rank'] < '6') { echo ''; } else { echo '<span class="text-danger name-addition">(Staff)</span>'; } ?></b>, com <b><?php echo $room['score']; ?></b> Notas.
				</div>
			</div>
		</div>
<?php } ?>
	</div>
	<div class="col-6 pl-0">
		<div class="content-box">
			<div class="title" style="background-image: url(<?php echo $Holo['url']; ?>/img/website/icons/sticky.gif);">Atividades recentes nos Grupos</div>
			<div class="box-body latest-posts" style="padding: 0.4rem 0 0.4rem 0">
				<ul class="list-group list-group-flush">
<?php $guilds = mysql_query("SELECT * FROM guilds_members ORDER BY id DESC LIMIT 5");
while($guild = mysql_fetch_array($guilds)){
$usergroup = mysql_fetch_assoc($usergroup = mysql_query("SELECT * FROM users WHERE id = '".$guild['user_id']."'"));
$groupinfo = mysql_fetch_assoc($groupinfo = mysql_query("SELECT * FROM guilds WHERE id = '".$guild['guild_id']."'"));
$groupowner = mysql_fetch_assoc($groupowner = mysql_query("SELECT * FROM users WHERE id = '".$groupinfo['user_id']."'")); ?>
					<a class="list-group-item no-link-styling">
						<div class="thread-title">
							<div class="mr-auto" style="overflow: hidden;"><span class="user-style <?php echo $usergroup['user_style']; ?>"><?php echo $usergroup['username']; ?></span> <?php if($usergroup['rank'] < '6') { echo ''; } else { echo '<span class="text-danger name-addition">(Staff)</span>'; } ?><small> entrou no grupo de </small><span class="user-style <?php echo $groupowner['user_style']; ?>"><?php echo $groupowner['username']; ?></span> <?php if($groupowner['rank'] < '6') { echo ''; } else { echo '<span class="text-danger name-addition">(Staff)</span>'; } ?><small>.</small></div>
							<div class="post-date align-self-center"><?php echo GetLast($guild['member_since']); ?> atrás</div>
						</div>
						<div class="post room-item__title"><?php echo mysql_real_escape_string($groupinfo['name']); ?></div>
					</a>
<?php } ?>
				</ul>
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