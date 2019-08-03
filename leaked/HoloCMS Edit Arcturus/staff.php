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
  <meta http-equiv="refresh" content="60;">
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
			

<div class="row">
	<div class="col-8">
			<div class="content-box">
				<div class="title"><strong>Proprietários e Desenvolvedores</strong><br><small>Proprietários e Desenvolvedores são responsáveis ​​por atualizações e gerenciamento geral.</small></div>
				<div class="box-body">
					<div class="row">
<?php $e = mysql_query("SELECT * FROM users WHERE rank='10' ORDER BY id DESC");
while($f = mysql_fetch_array($e)){ ?>
							<div class="col-6">
								<div class="staff-member d-flex align-items-center">
									<div class="staff-member-avatar">
										<img src="<?php echo $Holo['avatar'] . $f['look']; ?>&amp;size=l&amp;head_direction=3">
									</div>
									<div>
										<div class="staff-username"><a class="no-text-decoration text-info" href="/home/<?php echo $f['username']; ?>"><span class="user-style <?php echo $f['user_style']; ?>"><?php echo $f['username'] ?></span></a></div>
										<div class="staff-role">Desenvolvedor</div>
										<div class="staff-discord"><i class="fab fa-discord"></i> <?php echo $f['discord_name']; ?></div>
									</div>
									<div class="staff-online flex-grow-1 text-center"><?php if($f['online'] == '1') { echo '<img src="/img/online_img.png">'; } else { echo '<img src="/img/offline_img.png">'; } ?></div>
								</div>
							</div>
<?php } ?>
<?php $e = mysql_query("SELECT * FROM users WHERE rank='9' ORDER BY id DESC");
while($f = mysql_fetch_array($e)){ ?>
							<div class="col-6">
								<div class="staff-member d-flex align-items-center">
									<div class="staff-member-avatar">
										<img src="<?php echo $Holo['avatar'] . $f['look']; ?>&amp;size=l&amp;head_direction=3">
									</div>
									<div>
										<div class="staff-username"><a class="no-text-decoration text-info" href="/home/<?php echo $f['username']; ?>"><span class="user-style <?php echo $f['user_style']; ?>"><?php echo $f['username'] ?></span></a></div>
										<div class="staff-role">Proprietário</div>
										<div class="staff-discord"><i class="fab fa-discord"></i> <?php echo $f['discord_name']; ?></div>
									</div>
									<div class="staff-online flex-grow-1 text-center"><?php if($f['online'] == '1') { echo '<img src="/img/online_img.png">'; } else { echo '<img src="/img/offline_img.png">'; } ?></div>
								</div>
							</div>
<?php } ?>
					</div>
				</div>
			</div>
			
			<div class="content-box">
				<div class="title"><strong>Gerênciamento e Administração</strong><br><small>Nossa administração cuida do <?php echo $Holo['name']; ?>, e nossa gerência cuida da nossa Equipe.</small></div>
				<div class="box-body">
					<div class="row">
<?php $e = mysql_query("SELECT * FROM users WHERE rank='8' ORDER BY id DESC");
while($f = mysql_fetch_array($e)){ ?>
							<div class="col-6">
								<div class="staff-member d-flex align-items-center">
									<div class="staff-member-avatar">
										<img src="<?php echo $Holo['avatar'] . $f['look']; ?>&amp;size=l&amp;head_direction=3">
									</div>
									<div>
										<div class="staff-username"><a class="no-text-decoration text-info" href="/home/<?php echo $f['username']; ?>"><span class="user-style <?php echo $f['user_style']; ?>"><?php echo $f['username'] ?></span></a></div>
										<div class="staff-role">Gerente</div>
										<div class="staff-discord"><i class="fab fa-discord"></i> <?php echo $f['discord_name']; ?></div>
									</div>
									<div class="staff-online flex-grow-1 text-center"><?php if($f['online'] == '1') { echo '<img src="/img/online_img.png">'; } else { echo '<img src="/img/offline_img.png">'; } ?></div>
								</div>
							</div>
<?php } ?>
<?php $e = mysql_query("SELECT * FROM users WHERE rank='7' ORDER BY id DESC");
while($f = mysql_fetch_array($e)){ ?>
							<div class="col-6">
								<div class="staff-member d-flex align-items-center">
									<div class="staff-member-avatar">
										<img src="<?php echo $Holo['avatar'] . $f['look']; ?>&amp;size=l&amp;head_direction=3">
									</div>
									<div>
										<div class="staff-username"><a class="no-text-decoration text-info" href="/home/<?php echo $f['username']; ?>"><span class="user-style <?php echo $f['user_style']; ?>"><?php echo $f['username'] ?></span></a></div>
										<div class="staff-role">Administrador</div>
										<div class="staff-discord"><i class="fab fa-discord"></i> <?php echo $f['discord_name']; ?></div>
									</div>
									<div class="staff-online flex-grow-1 text-center"><?php if($f['online'] == '1') { echo '<img src="/img/online_img.png">'; } else { echo '<img src="/img/offline_img.png">'; } ?></div>
								</div>
							</div>
<?php } ?>
					</div>
				</div>
			</div>
			
			<div class="content-box">
				<div class="title"><strong>Moderação</strong><br><small>Moderadores estão disponíveis para ajudá-los, e diverti-los com eventos.</small></div>
				<div class="box-body">
					<div class="row">
<?php $e = mysql_query("SELECT * FROM users WHERE rank='6' ORDER BY id DESC");
while($f = mysql_fetch_array($e)){ ?>
							<div class="col-6">
								<div class="staff-member d-flex align-items-center">
									<div class="staff-member-avatar">
										<img src="<?php echo $Holo['avatar'] . $f['look']; ?>&amp;size=l&amp;head_direction=3">
									</div>
									<div>
										<div class="staff-username"><a class="no-text-decoration text-info" href="/home/<?php echo $f['username']; ?>"><span class="user-style <?php echo $f['user_style']; ?>"><?php echo $f['username'] ?></span></a></div>
										<div class="staff-role">Moderador</div>
										<div class="staff-discord"><i class="fab fa-discord"></i> <?php echo $f['discord_name']; ?></div>
									</div>
									<div class="staff-online flex-grow-1 text-center"><?php if($f['online'] == '1') { echo '<img src="/img/online_img.png">'; } else { echo '<img src="/img/offline_img.png">'; } ?></div>
								</div>
							</div>
<?php } ?>
					</div>
				</div>
			</div>

	</div>
	
	<div class="col pl-0">
		<div class="content-box blue">
			<div class="title" style="background-image: url('/c_images/album1584/ADM.gif')">Equipe do <?php echo $Holo['name']; ?></div>
			<div class="box-body">A equipe de funcionários do <?php echo $Holo['name']; ?> Hotel, é responsável por impor nossas regras e garantir que todos tenham um clima agradável no jogo.<hr><?php echo $Holo['name']; ?> recruta novos Moderators para a equipe regularmente ou conforme as necessidades, procure anúncios sobre quando estamos aceitando Novas inscrições.</div>
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