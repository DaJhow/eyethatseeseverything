<?php require_once("../inc/core.god.php");
require_once("../inc/hk_session.php");

if(Loged == false) { 
    header("Location: " . $Holo['url'] ."");
	exit;
}

if(UserH == true) {
    header("Location: " . $Holo['url'] ."/".$Holo['panel']."/home.php");
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

<section class="content">	
				<div class="row">	
<?php echo $msg; ?>				

			<?php if(MANTENIMIENTO == '1') { ?>
			<div class="col-md-10">
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
            </div>
			<?php } ?>
				<div class="col-md-4">
					<article class="widget">
					<header class="widget__header">
						<h3 class="widget__title"><i class="pe-7f-config"></i> Acesse o nosso Painel</h3>
					</header>
					<div class="widget__content">
					<form action="" method="post">
						<p class="alert--text">Os dados da sua conta:</p>
						<input class="input-text" value="<?php echo $myrow['mail']; ?>" disabled />
						<input type="text" class="input-text" required="required" name="HUsername" placeholder="Seu usuário" />
						<input type="password" class="input-text" required="required" name="HPassword" placeholder="Sua senha" />
						<input type="password" class="input-text" required="required" name="HPasscode" placeholder="Seu código de segurança" />
						<p class="alert--text"><?php echo $Holo['name']; ?> está monitorando:</p>
						<input class="input-text" value="<?php echo $myrow['ip_current']; ?>" disabled />
						<input class="input-text" value="<?php echo $myrow['machine_id']; ?>" disabled />
						<input type="checkbox" id="remember" class="checkbox" checked>
						<label for="remember">Salvar login</label>
						<button class="btn btn-light pull-right" type="submit" name="action">Entrar no Painel</button>
						<div class="clearfix"></div>
					</form>
					</div>

					</article>
				</div>
				
				<div class="col-md-6">
					<article class="widget">
					<header class="widget__header">
						<h3 class="widget__title"><i class="pe-7f-config"></i> Saiba disto</h3>
					</header>
					<div class="widget__content">
					<p class="alert--text">Todas as ações feitas aqui e dentro do Painel serão transmitidas em <i>Tempo Real</i> para estas pessoas logo aqui em baixo.<br>Cada cabecinha desta é um de nossos membros atualmente Online dentro do <?php echo $Holo['Name']; ?> Hotel.</p><br>
					<?php $staffs = mysql_query("SELECT * FROM users WHERE rank > 6 AND online='1' ORDER BY id DESC");
					while($staffs = mysql_fetch_assoc($staffs)){ ?>
					<img src="<?php echo $Holo['avatar'] . $staffs['look']; ?>&size=m&direction=3&head_direction=3&gesture=sml&headonly=1" class="staff" data-id="<?php echo $staffs['id'] ?>" data-rank="<?php echo $staffs['rank'] ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $staffs['username'] ?>">
					<?php } ?>
						<br><p class="alert--text">Todas as ações feitas em páginas desta categoria são salvas e passadas detalhadamente para cada um dos membros superiores da equipe.<br><br>Tentativa de invasão, ou má conduta vinda dos membros da equipe Não são toleradas.<br><br>Em caso de erros ou dúvidas, sempre consulte um superior da equipe.<br>Boa sorte.</p>
					</div>

					</article>
				</div>
				</div>
</section>