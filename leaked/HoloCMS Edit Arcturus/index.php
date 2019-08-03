<?php require_once("inc/core.god.php");

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

if(isset($_POST['Username']) && isset($_POST['Password']) && isset($_POST['Passcode']))
{
	
	$Getuser = mysql_query("SELECT * FROM users WHERE username = '". $_POST['Username'] ."' AND password = '". md5($_POST['Password']) ."' AND passcode = '". md5($_POST['Passcode']) ."'");

	if(empty($_POST['Username']) || empty($_POST['Password']) || empty($_POST['Passcode']))
	{
		$loginerror = '<div class="alert-wrapper"><div class="alert alert-danger"><strong><i class="far fa-times-circle"></i> ERRO:</strong> Você deve preencher todos os campos.</div></div>';
	}

	elseif(mysql_num_rows($Getuser) == 0)
	{
		$loginerror = '<div class="alert-wrapper"><div class="alert alert-danger"><strong><i class="far fa-times-circle"></i> ERRO:</strong> O usuário não existe ou tente outra senha e código.</div></div>';
	}

	else 
	{
		if(mysql_num_rows($Getuser) > 0)
		{
			$_SESSION['Username'] = $_POST['Username'];
			$_SESSION['Password'] = $_POST['Password'];
			$_SESSION['Passcode'] = $_POST['Passcode'];
			header("Location: me");
		}
	}
} ?>
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
  <link rel="stylesheet" href="<?php echo $Holo['url']; ?>/css/index.css">
  <link rel="stylesheet" href="<?php echo $Holo['url']; ?>/css/wulles.css">
</head>

<body>

<div class="index-wrapper">
		<?php if($loginerror !== NULL) { echo $loginerror; } ?>

	<div class="login-wrapper">
		<div class="flex-fill" style="flex-basis: 0 !important;">
			<div class="login-left d-flex flex-column align-items-center justify-content-center">
				<a class="logo mb-4"></a>
				<div class="text-center">
					<form role="form" method="POST" class="form">
						<div class="form-group">
							<input type="text" name="Username" class="form-control username-input" placeholder="Seu usuário" required autofocus autocomplete="off">
						</div>
						<div class="form-group">
							<input type="password" name="Password" class="form-control password-input" placeholder="Sua senha" required autocomplete="off">
						</div>
						<div class="form-group">
						<input type="password" name="Passcode" class="form-control passcode-input" name="mail" placeholder="Seu código" required autocomplete="off">
						</div>
						<div class="form-group">
							<input type="checkbox" name="remember" value="1"> Lembrar meus dados
						</div>
						<button name="login" type="submit" class="button button-blue login-button pull-right">Acessar minha Conta</button>
					</form>
				</div>
			</div>
		</div>
		<div class="flex-fill login-right d-flex align-items-center justify-content-center" style="flex-basis: 0 !important;">
			<div class="register-button">
				<a href="<?php echo $Holo['url']; ?>/register"><button type="submit" class="register-button button button-green register-button pull-right">Criar uma Conta</button></a>
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