<?php require_once("inc/core.god.php");
require_once("inc/class.recaptchalib.php");

if(Loged == TRUE)
{
	header("Location: me");
	exit;
}

if(MANTENIMIENTO == '1') 
{
    header("Location: mantenimiento");
	exit;
}

if(isset($_POST['Usuario']) && isset($_POST['Mail']) && isset($_POST['Contrasena']) && isset($_POST['RContrasena']) && isset($_POST['Contracode']))
{   

	$Getnombre = mysql_query("SELECT * FROM users WHERE username = '". $_POST['Usuario'] ."'");
	$Getmail = mysql_query("SELECT * FROM users WHERE mail = '". $_POST['Mail'] ."'");

	if(isset($_POST['g-recaptcha-response'])){
          $captcha = $_POST['g-recaptcha-response'];
    }

	if(empty($_POST['Usuario']) || empty($_POST['Mail']) || empty($_POST['Contrasena']) || empty($_POST['RContrasena']) || empty($_POST['Contracode']))
	{
		$regerror = '<div class="alert-wrapper"><div class="alert alert-danger"><strong><i class="far fa-times-circle"></i> ERRO:</strong> Não deixe campos vázios.</div></div>';
	}
	elseif(mysql_num_rows($Getnombre) > 0)
	{
		$regerror = '<div class="alert-wrapper"><div class="alert alert-danger"><strong><i class="far fa-times-circle"></i> ERRO:</strong> Tente usar outro nome de usuário.</div></div>';
	}
	elseif(mysql_num_rows($Getmail) > 0)
	{
		$regerror = '<div class="alert-wrapper"><div class="alert alert-danger"><strong><i class="far fa-times-circle"></i> ERRO:</strong> Tente usar outro endereço de e-mail válido.</div></div>';
	}
	elseif($_POST['Contrasena'] !== $_POST['RContrasena'])
	{
		$regerror = '<div class="alert-wrapper"><div class="alert alert-danger"><strong><i class="far fa-times-circle"></i> ERRO:</strong> As senhas não são as mesmas.</div></div>';
	}
    elseif(strlen($_POST['Usuario']) > 12 || strlen($_POST['Usuario']) < 3) 
	{
        $regerror = '<div class="alert-wrapper"><div class="alert alert-danger"><strong><i class="far fa-times-circle"></i> ERRO:</strong> Seu nome tem de ter entre 3 a 12 letras.</div></div>';
	}
	elseif(strlen($_POST['Contracode']) > 10 || strlen($_POST['Contracode']) < 4) 
	{
        $regerror = '<div class="alert-wrapper"><div class="alert alert-danger"><strong><i class="far fa-times-circle"></i> ERRO:</strong> Seu código tem de ter entre 4 a 10 letras.</div></div>';
	}
	elseif(strrpos($_POST['Usuario'], "MOD-") || strrpos($_POST['Usuario'], "MOD_") !== false) 
	{
	    $regerror = '<div class="alert-wrapper"><div class="alert alert-danger"><strong><i class="far fa-times-circle"></i> ERRO:</strong> Você não pode se registrar usando MOD no nome.</div></div>';
    }
	elseif(strrpos($_POST['Usuario'], "Wulles") !== false) 
	{
	    $regerror = '<div class="alert-wrapper"><div class="alert alert-warning"><strong><i class="far fa-times-circle"></i> ERRO:</strong> Voa viado, ta loca?.</div></div>';
    }
	elseif(strrpos($_POST['Usuario'], " ") || strrpos($_POST['Usuario'], " ") !== false) 
	{
	    $regerror = '<div class="alert-wrapper"><div class="alert alert-danger"><strong><i class="far fa-times-circle"></i> ERRO:</strong> Você não pode deixar campos vázios.</div></div>';
	}
	elseif(strrpos($_POST['Usuario'], ".") || strrpos($_POST['Usuario'], ".") !== false) 
	{
	    $regerror = '<div class="alert-wrapper"><div class="alert alert-danger"><strong><i class="far fa-times-circle"></i> ERRO:</strong> Você não pode usar Pontos em seu nome.</div></div>';
	}
	elseif (!$captcha) 
	{
        $regerror = '<div class="alert-wrapper"><div class="alert alert-danger"><strong><i class="far fa-times-circle"></i> ERRO:</strong> Você esqueceu de nos informar que você Não é um Robô.</div></div>';
    }
	else
	{
		mysql_query("INSERT INTO users (username, password, passcode, mail, look, gender, motto, ip_register, credits, account_created, account_day_of_birth) VALUES ('". filtro($_POST['Usuario']) ."', '".md5($_POST['Contrasena'])."', '".md5($_POST['Contracode'])."', '". filtro($_POST['Mail']) ."', '". $Holo['look'] ."', '". $Holo['gender'] ."', '". $Holo['mision'] ."', '". $ip ."', '". $Holo['monedas'] ."', '" . time() ."', '" . time() ."')");
		$_SESSION['Username'] = $_POST['Usuario'];
		$_SESSION['Password'] = $_POST['Contrasena'];
		$_SESSION['Contracode'] = $_POST['Contracode'];
		header("Location: way");
	}
}

$_GET['Usuario'] = $_POST['Usuario'];
$_GET['Mail'] = $_POST['Mail'];
$_GET['Contrasena'] = $_POST['Contrasena'];
$_GET['RContrasena'] = $_POST['RContrasena'];
$_GET['Contracode'] = $_POST['Contracode'];

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
  <link rel="stylesheet" href="<?php echo $Holo['url']; ?>/css/register.css">
  <link rel="stylesheet" href="<?php echo $Holo['url']; ?>/css/wulles.css">
</head>

<body>

<div class="index-wrapper">
		<?php if($regerror !== NULL) { echo $regerror; } ?>

	<div class="register-wrapper">
		<div class="col pr-0 pl-0">
			<div class="register-left d-flex flex-column align-items-center justify-content-center">
				<div class="register-button">
					<a href="<?php echo $Holo['url']; ?>"><button type="submit" class="button button-blue register-button pull-right">Acessar minha Conta</button></a>
				</div>
			</div>
		</div>
		<div class="col pl-0 pr-0">
			<div class="register-right d-flex flex-column align-items-center justify-content-center">
				<form role="form" method="POST" id="register-form" class="form-horizontal">
					<div class="form-group">
						<input type="text" name="Usuario" class="form-control username-input" placeholder="Seu usuário" required autofocus autocomplete="off">
					</div>
					<div class="create-password">
						<div class="form-group">
							<input type="password" name="Contrasena" class="form-control password-input" placeholder="Sua senha" required autocomplete="off">
						</div>
						<div class="form-group">
							<input type="password" name="RContrasena" class="form-control password-input" placeholder="Repita sua senha" required autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<input type="email" name="Mail" class="form-control email-input" placeholder="Seu email" required autocomplete="off">
					</div>
					<div class="form-group">
						<script src="https://www.google.com/recaptcha/api.js"></script>
						<center><div class="g-recaptcha" data-sitekey="<?php echo $Holo['recaptcha'] ?>"></div></center>
					</div>
					<div class="form-group">
						<input type="password" name="Contracode" class="form-control passcode-input" placeholder="Um código de segurança" required autocomplete="off">
					</div>
					<button name="register" type="submit" class="button button-green login-button">Criar minha conta</button>
				</form>
			</div>
		</div>
	</div>
	
	<div class="index-footer d-flex justify-content-center align-items-center">
		<div class="ml-5 mr-5"><strong>Sirio Project</strong> &copy; 2010-2019</div>
		<div class="mr-auto"></div>
		<div class="mr-3"><?php echo Onlines(); ?> pessoas jogando agora</div>
		<div class="ml-5 mr-5">
			<a class="footer-link facebook" href="https://www.facebook.com/<?php echo $Holo['facebook'] ?>" target="_blank"><i class="fab fa-facebook-square"></i></a>
			<a class="footer-link twitter" href="https://twitter.com/<?php echo $Holo['twitter'] ?>" target="_blank"><i class="fab fa-twitter-square"></i></a>
			<a class="footer-link discord" href="<?php echo $Holo['discordid'] ?>" target="_blank"><i class="fab fa-discord"></i></a>  
		</div>
	</div>
</div>
	
<script src="<?php echo $Holo['url']; ?>/js/jquery-3.2.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>
</html>