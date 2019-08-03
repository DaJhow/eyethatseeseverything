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

if(isset($_POST['rules']))
{
    mysql_query("UPDATE users SET accept_rules = '1' WHERE id = '". $myrow['id'] ."'");
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
			
<div class="row">

	<div class="col-4">
<?php $newuser = mysql_query("SELECT * FROM users WHERE id = '".$myrow['id']."' AND accept_rules = '1'");
while($newuse = mysql_fetch_assoc($newuser)){ ?>
		<div class="content-box">
			<div class="title" style="background-image: url('<?php echo $Holo['url'] ?>/img/website/icons/rules.gif')">Nossas regras</div>
			<div class="box-body clearfix"><div class="text-center"><div class="alert alert-success">Você aceitou nossas regras</div></div></div>
		</div>
<?php } ?>
<?php $newuser = mysql_query("SELECT * FROM users WHERE id = '".$myrow['id']."' AND accept_rules = '0'");
while($newuse = mysql_fetch_assoc($newuser)){ ?>
		<div class="content-box">
			<div class="title" style="background-image: url('<?php echo $Holo['url'] ?>/img/website/icons/rules.gif')">Nossas regras</div>
			<div class="box-body clearfix">
					<p>Para entrar no <?php echo $Holo['name'] ?> pela primeira vez, você deve primeiro aceitar as nossas regras, esta é sua única oportunidade de ler o que não é tolerado dentro do nosso Hotel.</p>
					<p><b>Leia tudo com atenção e concorde.</b></p>
					<div class="text-center">
						<form method="POST">
							<button class="button button-blue text-center" name="rules" type="submit">Eu aceito as regras</button>
						</form>
					</div>
			</div>
		</div>
<?php } ?>

		<div class="content-box">
			<div class="title" style="background-image: url('<?php echo $Holo['url'] ?>/img/website/icons/sticky.gif')">Apelações contra Banimento</div>
			<div class="box-body clearfix">
				<p>Não há <b>recursos contra Banimento</b>!<hr>Se você não seguir as regras claramente estabelecidas, você será banido sem a opção de recorrer contra o mesmo.</p>
			</div>
		</div>
	</div>
	
	<div class="col">
		<div class="content-box blue">
			<div class="title" style="background-image: url('<?php echo $Holo['url'] ?>/img/website/icons/rules1.gif')">Mural de Regras</div>
			<div class="box-body clearfix">
				<p>A lista a baixo são as coisas que <b>Não</b> são toleradas no <?php echo $Holo['name'] ?>:</p>
				<p><b>Assédio e informações pessoais</b></p>
					<ul>
						<li>Assédio excessivo, abuso e intimidação de qualquer tipo.</li>
						<li>Compartilhar ou liberar informações particulares dos usuários ou equipe de qualquer maneira.</li>
						<li>Fazer ameaças de qualquer tipo contra os usuários ou equipe.</li>
					</ul>
				<p></p>
				<p><b>Outros idiomas e Spamming</b></p>
					<ul>
						<li>Não falar Português pode resultar em banimento, por favor use o Bate papo para outros idiomas.</li>
						<li>Não floodar em salas públicas, eventos, ou em quartos que não são seus.</li>
					</ul>
				<p></p>
				<p><b>Scripts e abuso de bugs</b></p>
					<ul>
						<li>É proibido o uso de qualquer programa que lhe dê alguma vantagem.</li>
						<li>Abusar de bugs e falhas, informe-nos imediatamente.</li>
					</ul>
				<p></p>
				<p><b>Venda de contas e Compartilhamentos</b></p>
					<ul>
						<li>A venda de qualquer conta por qualquer motivo.</li>
						<li>A venda de itens no jogo / dinheiro para outra moeda.</li>
						<li>O compartilhamento de contas para fins mal-intencionados, como impulsionar placar de conquista.</li>
						<li>Usando mais de Uma conta por vez.</li>
					</ul>
				<p></p>
				<p><b>Divulgar outros sites e jogos</b></p>
					<ul>
						<li>É claramente proibido qualquer tipo de divulgação de outros jogos, servidores, ou sites sem ser de vínculo conosco.</li>
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