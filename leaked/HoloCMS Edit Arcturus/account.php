<?php require_once("inc/core.god.php");

if(Loged == FALSE)
{
	header("Location: /");
	exit;
}

if(mysql_num_rows($chb) > 0) 
{
    header("Location: /banned");
	exit;
}

if(MANTENIMIENTO == '1') 
{
    header("Location: mantenimiento");
	exit;
}

//missão
if(isset($_POST['mision']))
{
    $m = filtro($_POST['mision']);

    if(empty($m))
    {
        $aerror = 'No dejes los campos de misión vacíos';
    }
    else
    {
        mysql_query("UPDATE users SET motto = '". $m ."' WHERE id = '". $myrow['id'] ."'");
        echo '<script type="text/javascript"></script>';
    }
}

//email
if(isset($_POST['email_a']) && isset($_POST['email_n']) && isset($_POST['email_nr']))
{
    $EA = filtro($_POST['email_a']);
    $EN = filtro($_POST['email_n']);
    $ENR = filtro($_POST['email_nr']);

    $Checkmail = mysql_query("SELECT * FROM users WHERE mail = '". $EN ."'");

    if(empty($EA) || empty($EN) || empty($ENR))
    {
        $aerror = 'Os campos estão vazios';
    }
    elseif(mysql_num_rows($Checkmail) > 0) 
    {
        $aerror = 'O email que você colocou já existe, coloque outro';
    }
    elseif($EN != $ENR)
    {
        $aerror = 'Os emails não são os mesmos, tente novamente';
    }
    elseif($EA != $myrow['mail'])
    {
        $aerror = 'O e-mail antigo não é o correto';
    }
    else
    {
        mysql_query("UPDATE users SET mail = '". $EN ."' WHERE id = '". $myrow['id'] ."'");
        $aok = 'Você mudou seu e-mail corretamente';
    }
}

//discord
if(isset($_POST['discord']))
{
    $DISCORD = filtro($_POST['discord']);

    mysql_query("UPDATE users SET discord_name = '". $DISCORD ."' WHERE id = '". $myrow['id'] ."'");
    $aok = 'Discord adicionado com sucesso.';
}

//senha
if(isset($_POST['Pass']) && isset($_POST['NPass']) && isset($_POST['RNPass']))
{
    $Pass = filtro($_POST['Pass']);
    $NPass = filtro($_POST['NPass']);
    $RNPass = filtro($_POST['RNPass']);

    $Checkpass = mysql_query("SELECT * FROM users WHERE id = '". $myrow['id'] ."'");
    $passss = mysql_fetch_assoc($Checkpass);

    if(empty($Pass) || empty($NPass) || empty($RNPass))
    {
        $aerror = 'Não deixe campos vazios';
    }
    elseif($NPass != $RNPass)
    {
        $aerror = 'Novas senhas não correspondem';
    }
    elseif(md5($Pass) != $passss['password'])
    {
        $aerror = 'A senha antiga não está correta';
    }
    else
    {
        mysql_query("UPDATE users SET password = '". md5($NPass) ."' WHERE id = '". $myrow['id'] ."'");
        echo "<script type=\"text/javascript\">alert('Você alterou sua senha com sucesso, você precisa fazer login novamente.');</script>";
        session_destroy();
        echo header("Location: /");
    }
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
			<div class="container d-flex">
	<div class="col-8" style="padding-right: 10px;">
		<div class="content-box orange">
			<div class="title">Atualizando a sua conta</div>
			<div class="box-body">
		<?php 
            if($aerror !== NULL)
            {
             echo  '<div class="alert alert-danger">'.$aerror.'</div>';   
            }
			if($aok !== NULL)
			{
				echo  '<div class="alert alert-success">'.$aok.'</div>'; 
			}
        ?>
			<?php if($_GET['item'] == "correo"){ ?>
			<form method="POST" action="" class="form-block">
					<div class="form-group">
						<label for="current-password">Nos informe qual é o seu atual e-mail</label>
						<input type="email" name="email_a" class="form-control" placeholder="Seu e-mail atual" required autofocus autocomplete="off">
					</div>
					<div class="form-group">
						<label for="current-password">Agora coloque o seu Novo e-mail</label>
						<input type="email" name="email_n" class="form-control" placeholder="Seu novo e-mail" required autocomplete="off">
					</div>
					<div class="form-group">
						<input type="email" name="email_nr" class="form-control" placeholder="Repita seu novo e-mail" required autocomplete="off">
					</div>
					<button type="submit" name="account" class="button button-green">Pronto! Mudar meu e-mail</button>
			</form>
			<?php }elseif($_GET['item'] == "contra"){ ?>
			<form method="POST" action="" class="form-block">
					<div class="form-group">
						<label for="current-password">Coloque a sua senha Atual</label>
						<input type="password" name="Pass" class="form-control" placeholder="Coloque sua senha atual" required autofocus autocomplete="off">
					</div>
					<div class="form-group">
						<label for="current-password">Agora nos informe a sua Nova senha</label>
						<input type="password" name="NPass" class="form-control" placeholder="Agora sua nova senha" required autocomplete="off">
					</div>
					<div class="form-group">
						<input type="password" name="RNPass" class="form-control" placeholder="Repita a sua nova senha" required autocomplete="off">
					</div>
					<button type="submit" name="account" class="button button-green">Pronto! Mudar minha senha</button>
			</form>
			<?php }elseif($_GET['item'] == "perfil"){ ?>
			<form method="POST" action="" class="form-block">
					<div class="form-group">
						<label for="current-password">Nos informe qual é o nome de usuário do seu Discord</label>
						<input type="text" name="discord" class="form-control" placeholder="Seu nome de usuário do Discord" required autofocus autocomplete="off">
						<small>Exemplo: Wulles#2019</small>
					</div>
					<button type="submit" name="account" class="button button-green">Pronto! Atualizar meu contato</button>
			</form>
			<?php } ?>
			</div>
		</div>
	</div>
	<div class="s12">
		<div class="content-box blue">
			<div class="title">O que vai fazer?</div>
			<div class="box-body">
			<p>Escolha a <b>categoria</b> que você deseja alterar.</p>
			<p>Tome cuidado em qualquer modificação que for fazer em sua conta, as vezes os danos realizados aqui, podem se tornar Irreversíveis.</p>
			<div class="text-center">
			<a class="button button-blue corporation-site-button" href="/account/correo"> Mudar Email <i class="pl-2 fa fa fa-arrow-circle-right"></i></a><br>
			<a class="button button-blue corporation-site-button" href="/account/contra">Mudar Senha <i class="pl-2 fa fa fa-arrow-circle-right"></i></a><br>
			<a class="button button-blue corporation-site-button" href="/account/perfil">Adicionar Discord <i class="pl-2 fa fa fa-arrow-circle-right"></i></a>
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