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
	<link rel="shortcut icon" href="<?php echo $Holo['url']; ?>/img/favicon.ico" type="image/vnd.microsoft.icon" />
	<link href="<?php echo $Holo['url']; ?>/housekeeping/css/bootstrap/bootstrap.min.css" rel="stylesheet" />
	<script src="<?php echo $Holo['url']; ?>/housekeeping/ckeditor/ckeditor.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/housekeeping/css/jquery-jvectormap-1.2.2.css"/>
	<link href="<?php echo $Holo['url']; ?>/housekeeping/css/style.css" rel="stylesheet" />
	<link href="<?php echo $Holo['url']; ?>/css/wulles.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

</head>
<body>

	<?php include ("header.php"); ?>

	<div class="wrapper">

		<?php include ("menulinks.php"); ?>
		
		<section class="content">
			<header class="main-header clearfix">
			<?php echo OnlineStatusRcon(); ?>
				<h1 class="main-header__title">
					<i class="icon pe-7s-photo-gallery"></i>
					Notícias
				</h1>
				<ul class="main-header__breadcrumb">
					<li><a style="text-decoration:none; ">Divulgar notícias</a></li>
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
				<div class="col-md-12">
					<article class="widget">
					<header class="widget__header">
					<h3 class="widget__title">Outras notícias</h3>
					</header>

				<div class="widget__content" style="height:800px;width:100%;overflow:auto;">
						<table class="table">
							<thead>
                        <tr>
                            <th>ID e Link</th>
                            <th>Título</th>
                            <th>Por</th>
                            <th>Divulgar</th>
                        </tr>
                        </thead>
							<tbody>
<?php 

$e = mysql_query("SELECT * FROM cms_news ORDER BY id DESC LIMIT 50");
while($f = mysql_fetch_array($e)){

if(isset($_POST['enviar']))
{
	
	$bubble_key = $_POST['bubble_key'];
	$message = $_POST['message'];
	$title = $_POST['title'];
	$url = $_POST['url'];
	$url_message = $_POST['url_message'];

$service_port = 30001;
$address = $Holo['ip'];

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
} else {
 
 $teste = '<div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <div class="media">
                <figure class="pull-left alert--icon">
                  <i class="pe-7s-attention"></i>
                </figure>
                <div class="media-body">
                  <h3 class="alert--title">Conseguiu!</h3> 
                  <p class="alert--text">Você divulgou uma notícia para o Hotel todinho.</p>
                </div>
              </div>
            </div>';
}

$result = socket_connect($socket, $address, $service_port);
if ($result === false) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
} else {
}

$in = 
'{
  "key": "hotelalert",
  "data": {
    "bubble_key":"1",
    "message":"Confira essa notícia, aposto que vai gostar:<br><br><b>'.$columnas['title'].'</b><br><br><i>Clique em Mais informações para ler.</i>",
    "title":"'.$columnas['title'].'",
    "url":"'.$Holo['url'].'/news/'.$columnas['id'].'/",
    "url_message":"Clique para lêr"
  }
}';

if(socket_write($socket, $in, strlen($in)) === false)
{
echo socket_strerror( socket_last_error($socket) );
}

$out = socket_read($socket, 2048);
}
?>
								<tr>
									<td><a class="btn btn-violet" style="text-decoration:none;"><?php echo $f['id']; ?></a> <a href="<?php echo $Holo['url']; ?>/news/<?php echo $f['id']; ?>" target="_blank" class="btn btn-green" style="text-decoration:none;">Abrir notícia</a></td>
									<td><?php echo $f['title']; ?></td>
									<td><?php echo $f['author']; ?></td>
									<form method="post"><td><button class="btn btn-green" name="enviar" type="submit">Enviar para o Hotel</button></td></form>
								</tr>
<?php } ?>
							</tbody>
						</table>

					</article>
				</div>
					</article>
				</div>
				
			</div>
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