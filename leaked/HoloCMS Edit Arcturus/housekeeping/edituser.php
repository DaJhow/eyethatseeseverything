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
	<link href="<?php echo $Holo['url']; ?>/css/wulles.css" rel="stylesheet" />
	<link rel="shortcut icon" href="<?php echo $Holo['url']; ?>/img/favicon.ico" type="image/vnd.microsoft.icon" />
	<link href="<?php echo $Holo['url']; ?>/housekeeping/css/bootstrap/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/housekeeping/css/jquery-jvectormap-1.2.2.css"/>
	<link href="<?php echo $Holo['url']; ?>/housekeeping/css/style.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

</head>
<body>

	<?php include ("header.php"); ?>

	<div class="wrapper">

		<?php include ("menulinks.php"); ?>
		
		<section class="content">
		
<?php if($myrow['rank'] <= 7) { ?>
			<meta http-equiv="refresh" content="10; url=home.php">
			<header class="main-header clearfix">
            <div class="alert alert-danger alert-dismissable">
              <div class="media">
                <figure class="pull-left alert--icon">
                  <i class="pe-7s-attention"></i>
                </figure>
                <div class="media-body">
                  <h3 class="alert--title">Você não pode fazer isso.</h3> 
                  <p class="alert--text">Ei <?php echo $myrow['username']; ?>, descobrimos que você não tem permissões para estar aqui.<br>Vamos te levar de volta em 10 segundos.</p>
                </div>
              </div>
            </div>
			</header>
<?php } ?>
<?php if($myrow['rank'] >= 8) { ?>
		
			<header class="main-header clearfix">
				<h1 class="main-header__title">
					<i class="icon pe-7s-tools"></i>
					Configurações
				</h1>
				<ul class="main-header__breadcrumb">
					<li><a style="text-decoration:none; ">Enviar Alerta</a></li>
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

			<div class="row">
				<div class="col-md-5">
					<article class="widget">
						<header class="widget__header">
							<h3 class="widget__title">Editar usuários</h3>					
						</header>
						<div class="widget__content">
<?php
$do = $_GET['do'];
$key = $_GET['key'];
if($do == "dele"){
	$check = mysql_query("SELECT id FROM users WHERE id = '". $key ."' LIMIT 1");
	if(mysql_num_rows($check) > 0){
		mysql_query("UPDATE users SET account_disabled = '1' WHERE id = '".$key."'");
		mysql_query("INSERT INTO stafflogs SET action = 'Usuarios', message = 'Desativou uma conta', note = '". $myrow['rank'] ."', userid = '". $myrow['id'] ."', timestamp = '". $date_full ."'");
		echo '<div class="col-12"><div class="card rules-card"><div class="card-body"><div class="alert alert-success" role="alert"><div class="row align-items-center"><div class="col-1 alert-icon-col"><i class="fas fa-file-invoice" style="font-size: 36px;"></i></div><div class="col"><b>Você desativou uma conta com sucesso!<br>Aguarde dois segundos...</div></div></div></div></div></div><meta http-equiv="refresh" content="3;URL=edituser.php">';
	} else {
		echo '<div class="col-12"><div class="card rules-card"><div class="card-body"><div class="alert alert-danger" role="alert"><div class="row align-items-center"><div class="col-1 alert-icon-col"><i class="fas fa-file-invoice" style="font-size: 36px;"></i></div><div class="col"><b>Algo deu errado, verifique tudo!<br>Aguarde cinco segundos...</div></div></div></div></div></div><meta http-equiv="refresh" content="6;URL=edituser.php">';
	}
}
?>
							<form name="buscar" action="" method="get">
								<p class="alert--text">Nome do usuário que deseja editar:</p>
								<input value="<?php echo $_GET['frase']; ?>" name="frase" class="input-text" required />
								<button class="btn btn-light pull-right" type="submit" name="buscar" value="Buscar">Editar usuário</button>
								<div class="clearfix"></div>
							</form>
						</div>
						<p class="alert--text">Edite usuários com Atenção.</p>
					</article>
				</div>
				
				<div class="col-md-7">
					<article class="widget">
					<header class="widget__header">
						<h3 class="widget__title">Resultados da busca</h3>
					</header>

<?php
// Verificamos que el formulario halla sido enviado
if(isset($_GET['buscar']) && $_GET['buscar'] == 'Buscar'){
    $frase = addslashes($_GET['frase']);
    // hacemos la consulta de busqueda
    // ver explicación mas abajo
    $sqlBuscar = mysql_query("SELECT * FROM users WHERE account_disabled = '0' ORDER BY id ASC")
                            or die(mysql_error());
    $totalRows = mysql_num_rows($sqlBuscar);
    // Enviamos un mensaje
    // indicando la cantidad de resultados ($totalRows)
    // para la frase busada ($frase)
    if(!empty($totalRows)){
		mysql_query("INSERT INTO stafflogs (action, message, note, userid, timestamp) VALUES ('Usuarios', 'Buscou por $frase.', '". $myrow['rank'] ."', '". $myrow['id'] ."', '". $date_full ."')");
        // mostramos los resultados
        while($row = mysql_fetch_array($sqlBuscar)){
		    $ipusers = mysql_query("SELECT * FROM users WHERE username = '". $row['username'] ."'");
            while($users = mysql_fetch_assoc($ipusers)) {		
?>
					<div class="widget__content">
						<table class="table">
							<thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuário</th>
                            <th>Rank</th>
                            <th>IP registrado</th>
                            <th>último IP</th>
                            <th>Ações disponíveis</th>
                        </tr>
                        </thead>
							<tbody>
								<tr>
									            <td><?php echo $users['id']; ?></td>
									            <td><?php echo $users['username']; ?></td>
									            <td><?php echo $users['rank']; ?></td>
									            <td><a href="http://whois.domaintools.com/<?php echo $row['ip_register']; ?>" target="_blank"><?php echo $row['ip_register']; ?></a></td>
									            <td><a href="http://whois.domaintools.com/<?php echo $row['ip_current']; ?>" target="_blank"><?php echo $row['ip_current']; ?></a></td>
									            <td><a href="edituser.php?action=<?php echo $users['id']; ?>" title="Editar" class="btn btn-orange" style="text-decoration:none;">Editar</a> <a href="edituser.php?do=dele&key=<?php echo $row['id']; ?>" class="btn btn-red" style="text-decoration:none;">Desativar</a></td>
								</tr>
							</tbody>
						</table>
					</div>
<?php
            }
        }
    }
    // si se ha enviado vacio el formulario
    // mostramos un mensaje del tipo Oops...!
    elseif(empty($_GET['frase'])){
        echo "<div class='col-12'><div class='card rules-card'><div class='card-body'><div class='alert alert-info' role='alert'><div class='row align-items-center'><div class='col-1 alert-icon-col'><i class='fas fa-file-invoice' style='font-size: 36px;'></i></div><div class='col'><b>Você deixou algo vazio mana, veja direito.<br>Aguarde cinco segundos...</div></div></div></div></div></div><meta http-equiv='refresh' content='6'>";
    }
    // si no hay resultados //
    elseif($totalRows == 0){
        echo stripslashes("<div class='col-12'><div class='card rules-card'><div class='card-body'><div class='alert alert-success' role='alert'><div class='row align-items-center'><div class='col-1 alert-icon-col'><i class='fas fa-file-invoice' style='font-size: 36px;'></i></div><div class='col'><b>Não encontramos nada para: $frase<br>Aguarde cinco segundos...</div></div></div></div></div></div><meta http-equiv='refresh' content='6'>");
    }
}
?>

<?php
if(isset($_GET['action']))
{
	if(!empty($_GET['action']))
	{

		$id_user = mysql_real_escape_string($_GET['action']);
	    $query_user = mysql_query("SELECT * FROM users WHERE id = '". $id_user ."'");
	    if(mysql_num_rows($query_user) > 0)
	    {

	    	while($perfil = mysql_fetch_assoc($query_user))
	    	{
			
			if(isset($_POST['editar']))
			{
					mysql_query("UPDATE users SET user_style = '". $_POST['user_style'] ."', mail = '". $_POST['email'] ."', motto = '". $_POST['mision'] ."', look = '". $_POST['look'] ."', rank = '". $_POST['rank'] ."', credits = '". $_POST['creditos'] ."' WHERE id = '". $perfil['id'] ."'");
					mysql_query("UPDATE users_currency SET amount = '". $_POST['duckets'] ."' WHERE user_id = '". $perfil['id'] ."' AND type = '0'");
					mysql_query("UPDATE users_currency SET amount = '". $_POST['diamonds'] ."' WHERE user_id = '". $perfil['id'] ."' AND type = '5'");
			        mysql_query("INSERT INTO stafflogs (action, message, note, userid, timestamp) VALUES ('Usuarios', 'Editou ". $perfil['username'] ."', '". $myrow['rank'] ."', '". $myrow['id'] ."', '". $date_full ."')");
			        echo '<div class="col-12"><div class="card rules-card"><div class="card-body"><div class="alert alert-success" role="alert"><div class="row align-items-center"><div class="col-1 alert-icon-col"><i class="fas fa-file-invoice" style="font-size: 36px;"></i></div><div class="col"><b>Você editou a conta de '.$perfil['username'].' com sucesso!<br>Aguarde dois segundos...</div></div></div></div></div></div><meta http-equiv="refresh" content="3">';
			}
?>
<div class="widget__content">
<form action="" method="post">
<?php if($perfil['online'] == '1') { echo '<div class="col-12"><div class="card rules-card"><div class="card-body"><div class="alert alert-danger" role="alert"><div class="row align-items-center"><div class="col-1 alert-icon-col"><i class="fas fa-file-invoice" style="font-size: 36px;"></i></div><div class="col"><b>A conta de '.$perfil['username'].' está Conectada agora!</b><br>Recomendamos que faça edições nesta conta quando ela estiver Offline.</div></div></div></div></div></div>'; } else { echo ''; } ?>
<?php
if(isset($_POST['enviar']))
{

$service_port = $Holo['rconport'];
$address = $Holo['ip'];

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
} else {
 
 $teste = '<div class="col-12"><div class="card rules-card"><div class="card-body"><div class="alert alert-info" role="alert"><div class="row align-items-center"><div class="col-1 alert-icon-col"><i class="fas fa-file-invoice" style="font-size: 36px;"></i></div><div class="col"><b>Você Desconectou a conta de '.$perfil['username'].' com sucesso!<br>Aguarde dois segundos...</div></div></div></div></div></div><meta http-equiv="refresh" content="3">';
}

$result = socket_connect($socket, $address, $service_port);
if ($result === false) {
    echo "<div class='col-12'><div class='card rules-card'><div class='card-body'><div class='alert alert-danger' role='alert'><div class='row align-items-center'><div class='col-1 alert-icon-col'><i class='fas fa-file-invoice' style='font-size: 36px;'></i></div><div class='col'><b>Algo deu errado, tente novamente.<br>Aguarde dois segundos...</div></div></div></div></div></div><meta http-equiv='refresh' content='3'>";
} else {
}

$in = 
'{
  "key": "DisconnectUser",
  "data": {
    "user_id": "'.$perfil["id"].'",
    "username": "'.$perfil["username"].'"
  }
}';

if(socket_write($socket, $in, strlen($in)) === false)
{
echo socket_strerror( socket_last_error($socket) );
}

$out = socket_read($socket, 2048);
}

?>
<?php $newuser = mysql_query("SELECT * FROM users WHERE id = '".$perfil['id']."' AND online = '1'");
while($newuse = mysql_fetch_assoc($newuser)){ ?>
						<?php 
							if(isset($teste))
							{
								echo $teste;
							} else {
						?>
							<form method="post">
								<button class="btn btn-orange pull-left" name="enviar" type="submit">Clique aqui para Desconectar a conta de <?php echo $perfil['username']; ?></button>
								<div class="clearfix"></div>
							</form>
						<?php } ?>
<?php } ?>

<p class="alert--text">Você está editando a conta de:</p>
            <td><input type="text" class="input-text" value="<?php echo $perfil['username']; ?>" disabled="true" /></td>
<p class="alert--text">Estilo do efeito no nome: (<span class="user-style <?php echo $perfil['user_style']; ?>"><?php echo $perfil['username'] ?></span>)</p>
            <td><input type="text" class="input-text" value="<?php echo $perfil['user_style']; ?>" name="user_style" /></td>
<p class="alert--text">ID de <?php echo $perfil['username']; ?>:</p>
            <td><input type="text" class="input-text" value="<?php echo $perfil['id']; ?>" disabled="true" style="width: 25px;" /></td>
<p class="alert--text">ID de cargo de <?php echo $perfil['username']; ?>:</p>
            <td><input type="text" class="input-text" value="<?php echo $perfil['rank']; ?>" name="rank" maxlength="1" style="width: 25px;" /></td>
<p class="alert--text">Missão de <?php echo $perfil['username']; ?>:</p>
            <td><input type="text" class="input-text" name="mision" value="<?php echo $perfil['motto']; ?>" /></td>
<p class="alert--text">E-mail de <?php echo $perfil['username']; ?>:</p>
            <td><input type="text" class="input-text" value="<?php echo $perfil['mail']; ?>" name="email" /></td>
<p class="alert--text">Vísual de <?php echo $perfil['username']; ?>: <?php if($perfil['online'] == '1') { echo '<font color="#60c6cf">'.$perfil['username'].' está Online, modificações aqui não serão salvas enquanto a pessoa estiver Online</font>)'; } else { echo ''; } ?></p>
            <td><figure class="pull-left rounded-image social_msg__img"><img src="<?php echo $Holo['avatar'] . $perfil['look']; ?>&action=&direction=2&head_direction=2" alt="user"></figure><br><br><input type="text" class="input-text" value="<?php echo $perfil['look']; ?>" name="look" style="width: 500px;" /></td>
<p class="alert--text">IP de registro:</p>
            <td><input type="text" class="input-text" value="<?php echo $perfil['ip_register']; ?>" disabled="true" /></td>
<p class="alert--text">IP atual:</p>
            <td><input type="text" class="input-text" value="<?php echo $perfil['ip_current']; ?>" disabled="true" /></td>
<p class="alert--text">Conta criada em:</p>
            <td><input type="text" class="input-text" value="<?php echo date("d/m/Y", $perfil['account_created']); ?>" disabled="true" /></td>
<p class="alert--text">Última conexão:</p>
            <td><input type="text" class="input-text" value="<?php echo date("d/m/Y", $perfil['last_online']); ?>" disabled="true" /></td>
<p class="alert--text">Moedas de <?php echo $perfil['username']; ?>: <?php if($perfil['online'] == '1') { echo '<font color="#60c6cf">'.$perfil['username'].' está Online, modificações aqui não serão salvas enquanto a pessoa estiver Online</font>)'; } else { echo ''; } ?></p>
            <td><input type="text" class="input-text" name="creditos" placeholder="<?php echo $perfil['credits']; ?>" value="<?php echo $perfil['credits']; ?>" /></td>
<p class="alert--text">Duckets de <?php echo $perfil['username']; ?>: <?php if($perfil['online'] == '1') { echo '<font color="#60c6cf">'.$perfil['username'].' está Online, modificações aqui não serão salvas enquanto a pessoa estiver Online</font>)'; } else { echo ''; } ?></p>
            <td><input type="text" class="input-text" name="duckets" placeholder="<?php $getDuckets = mysql_query("SELECT * FROM users INNER JOIN users_currency ON users.id=users_currency.user_id  WHERE users_currency.type = '0' AND users.id = '".$perfil['id']."'");
			while($ducketsStats = mysql_fetch_array($getDuckets)) {
			echo ''.$ducketsStats['amount'].'';
		    } ?>" value="<?php echo $perfil['duckets']; ?>" /></td>
<p class="alert--text">Diamantes de <?php echo $perfil['username']; ?>: <?php if($perfil['online'] == '1') { echo '<font color="#60c6cf">'.$perfil['username'].' está Online, modificações aqui não serão salvas enquanto a pessoa estiver Online</font>)'; } else { echo ''; } ?></p>
            <td><input type="text" class="input-text" name="diamonds" placeholder="<?php $getDiamonds = mysql_query("SELECT * FROM users INNER JOIN users_currency ON users.id=users_currency.user_id  WHERE users_currency.type = '5' AND users.id = '".$perfil['id']."'");
			while($diamondsStats = mysql_fetch_array($getDiamonds)) {
			echo ''.$diamondsStats['amount'].'';
			} ?>" value="<?php echo $perfil['diamonds']; ?>" /></td>
			
			<button class="btn btn-green pull-left" type="submit" name="editar" value="Editar">Salvar as edições em <?php echo $perfil['username']; ?></button>
			<div class="clearfix"></div>
</form>
</div>
<?php
	    	}
	    }
	    else
	    {
	    	echo '<div class="col-12"><div class="card rules-card"><div class="card-body"><div class="alert alert-danger" role="alert"><div class="row align-items-center"><div class="col-1 alert-icon-col"><i class="fas fa-file-invoice" style="font-size: 36px;"></i></div><div class="col"><b>O perfil solicitado Não existe.<br>Aguarde cinco segundos...</div></div></div></div></div></div><meta http-equiv="refresh" content="6">';
	    }
	}
	else 
	{
		echo '1';
    }
}
else
{
	echo '';
}
?>

					</article>
				</div>

			</div>

<?php } ?>

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