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
	
<div class="content">
		<div class="container">
<?php
$idd = mysql_real_escape_string($_GET['idd']);
$get = mysql_query("SELECT * FROM users WHERE username = '".$idd."' ");
if(mysql_num_rows($get) == 1)
{
    $usr = mysql_fetch_object($get);
}else
{
    $exits = '0';   
}
?>
<?php if($exits == '0')
            {
                echo '<div class="giant-link red d-flex justify-content-center align-items-center"><div class="mr-auto"><font size="3">Aparentemente você não pode ver este perfil, ele pode estar Bloqueado ou o usuário banido, também ele pode não existir.<br><br><form action="/me" method="get"><button class="button button-white text-center">Voltar para o Início</button></form></font></div><div class="icon"><i class="fas fa-file-invoice"></i></div></div>';
            }else{   
?>
<div class="container">
	<div class="row">
		<div class="col-8">
		
		</div>
		<div class="col-4">
			<div class="card" style="margin-bottom: 30px" ;="">
				<div class="profile-pixel" style="background-image: url(<?php echo $Holo['avatar']; ?>figure=<?php echo mysql_real_escape_string($usr->look); ?>&amp;direction=4&amp;gesture=sml&amp;size=l)"></div>
				<div class="profile-labels text-center">
					<?php if($usr->rank > '6') { 
					echo '<a class="badge badge-danger profile-badge"><font color="#FFFFFF">Membro da Equipe</font></a>'; } ?>
					<?php if($usr->rank == '2') { 
					echo '<a class="badge badge-dark profile-badge"><font color="#FFFFFF">VIP</font></a>'; } ?>
					<?php if($usr->accept_rules == '1') { 
					echo '<a class="badge badge-info profile-badge"><font color="#FFFFFF">Verificado</font></a>'; } ?>
				</div>
				<script language="JavaScript">
				var quotes=new Array()
				quotes[0]='<img src="<?php echo $Holo['url']; ?>/img/website/profile-bg1.png" class="card-img-top">'
				quotes[1]='<img src="<?php echo $Holo['url']; ?>/img/website/profile-bg2.png" class="card-img-top">'
				quotes[2]='<img src="<?php echo $Holo['url']; ?>/img/website/profile-bg3.png" class="card-img-top">'
				quotes[3]='<img src="<?php echo $Holo['url']; ?>/img/website/profile-bg4.png" class="card-img-top">'
				quotes[4]='<img src="<?php echo $Holo['url']; ?>/img/website/profile-bg5.png" class="card-img-top">'
				quotes[5]='<img src="<?php echo $Holo['url']; ?>/img/website/profile-bg6.png" class="card-img-top">'
				var whichquote=Math.floor(Math.random()*(quotes.length))
				document.write(quotes[whichquote])
				</script>
				<div class="card-body"> 
					<h5 class="card-title font-weight-bolder"><span class="user-style <?php echo mysql_real_escape_string($usr->user_style); ?>"><?php echo mysql_real_escape_string($usr->username); ?></span> </h5>
					<p class="card-text"><span class="float-right"><img src="<?php echo $Holo['url']; ?>/img/website/icons/bio.gif"></span> <small><?php echo mysql_real_escape_string($usr->motto); ?></small></p>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><span class="float-right"><img src="<?php echo $Holo['url']; ?>/img/website/icons/account_created.gif"></span> Data de registro<br><strong><?php echo date("d/m",mysql_real_escape_string($usr->account_created)); ?> de <?php echo date("Y",mysql_real_escape_string($usr->account_created)); ?></strong></li>
					<li class="list-group-item"><span class="float-right"><img src="<?php echo $Holo['url']; ?>/img/website/icons/last_online.gif"></span> Última conexão<br><strong><?php if($usr->online == '1') { 
					        echo 'Está jogando agora.';
					    } elseif($usr->last_online == '0') { 
				            echo 'Nunca se conectou.';
					    } else {
					        echo GetLast($usr->last_online);
					    } ?></strong></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php } ?>
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