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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

</head>
<body>

	<?php include ("header.php"); ?>

	<div class="wrapper">

		<?php include ("menulinks.php"); ?>
		
		<section class="content">
			<header class="main-header clearfix">
				<h1 class="main-header__title">
					<i class="icon pe-7s-photo-gallery"></i>
					Notícias
				</h1>
				<ul class="main-header__breadcrumb">
					<li><a style="text-decoration:none; ">Gerenciar notícias</a></li>
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
            <h3 class="widget__title">Escolha uma notícia no menu logo a baixo</h3>
          </header>
			<?php
	$do = $_GET['do'];
	$key = $_GET['key'];
	if($do == "dele"){
		$check = mysql_query("SELECT id FROM cms_news WHERE id = '". $key ."' LIMIT 1");
		if(mysql_num_rows($check) > 0){
			mysql_query("DELETE FROM cms_news WHERE id = '". $key ."' LIMIT 1");
			mysql_query("INSERT INTO stafflogs SET action = 'Noticias', message = 'Apagar notícia', note = '". $myrow['rank'] ."', userid = '". $myrow['id'] ."', timestamp = '". $date_full ."'");
			echo '<div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <div class="media">
                <figure class="pull-left alert--icon">
                  <i class="icon pe-7s-photo-gallery"></i>
                </figure>
                <div class="media-body">
                  <h3 class="alert--title">Eita, apagou!</h3> 
                  <p class="alert--text">Você deletou uma notícia com sucesso!<br>Todas as ações foram anotadas e transferidas para a página dos superiores.</p>
                </div>
              </div>
            </div>';
		} else {
			echo '<div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <div class="media">
                <figure class="pull-left alert--icon">
                  <i class="icon pe-7s-photo-gallery"></i>
                </figure>
                <div class="media-body">
                  <h3 class="alert--title">Poxa, não foi!</h3> 
                  <p class="alert--text">Alguma coisa deu errado na hora de apagar a notícia, tenta de novo aí.</p>
                </div>
              </div>
            </div>';
		}
	}

	if(isset($_POST['modificar'])) //
	{ 
		$tituloM = mysql_real_escape_string($_POST['tituloM']);
		$idM = (int) mysql_real_escape_string($_POST['idM']); 
		$texto_cortoM = mysql_real_escape_string($_POST['texto_cortoM']);
		$ImagemM = mysql_real_escape_string($_POST['topstoryM']);
		$textoM = mysql_real_escape_string($_POST['textoM']);
	  
		$query_modificar = mysql_query("UPDATE cms_news SET title = '".$tituloM."', image = '". $ImagemM ."', shortstory = '". $texto_cortoM ."', longstory = '". ($textoM) ."', date = '". time() ."', author ='". $myrow['username'] ."' WHERE id = '".$idM."'"); // Ejecutamos la consulta para actualizar el registro en la base de datos 
		mysql_query("INSERT INTO stafflogs (action, message, note, userid, timestamp) VALUES ('Noticias', 'Modificar notícia $tituloM', '". $myrow['rank']."', '". $myrow['id'] ."', '". $date_full ."')");  
	  
		if($query_modificar) 
		{ 
			echo '<div class="col s12 m12">
        <div class="card-panel green">
          <span class="white-text">A notícia foi modificada corretamente, pressione <a href="'. $Holo['link'] .'/news.php?url='. $idM .'">aqu&iacute;</a> para ver..</span>
        </div>
      </div>'; // Se a consulta foi executada corretamente, mostre esta mensagem
		} 
		else 
		{ 
			echo '<div class="col s12 m12">
        <div class="card-panel red">
          <span class="white-text">A notícia não foi modificada.</span>
        </div>
      </div>'; // Se a consulta não foi bem executada, mostre esta mensagem
		} 
	}

	if(isset($_GET['noticia'])) 
	{ 
		$id_noticia = (int) mysql_real_escape_string($_GET['noticia']); // Recebemos o ID das notícias por meio de GET
		$query_NoticiaCompleta = mysql_query("SELECT * FROM cms_news WHERE id = '".$id_noticia."' LIMIT 1"); // Nós executamos a consulta
		$columna_MostrarNoticia = mysql_fetch_assoc($query_NoticiaCompleta); 
		echo '<div class="widget__content">

        <form method="post" action="">
            <input type="text" class="input-text" name="tituloM" value="'.$columna_MostrarNoticia['title'].'" />
            <input type="text" class="input-text" name="texto_cortoM" value="'. $columna_MostrarNoticia['shortstory'].'" />
            <input type="text" class="input-text" name="topstoryM" value="'. $columna_MostrarNoticia['image'] .'" />
            <input type="text" class="input-text" value="'. $columna_MostrarNoticia['author'] .'" disabled />
            <textarea name="textoM" id="textoM" style="width: 100%; height: 150px;">'. $columna_MostrarNoticia['longstory'] .'</textarea>
            <script>CKEDITOR.replace( "textoM" );</script>
			<input type="hidden" name="idM" value="'.$columna_MostrarNoticia['id'].'" />
        <button class="btn btn-light pull-right" type="button" name="Back2" onclick="history.back()">Cancelar</button>
        <button class="btn btn-light pull-right" type="submit" name="modificar">Pronto! Editar notícia</button>
        </form>
		
        <div class="clearfix"></div>
          
        </div>';
	} else {  
	$noticias = mysql_query("SELECT * FROM cms_news ORDER BY id DESC");
	while($columnas = mysql_fetch_assoc($noticias)) {
	?>    

<?php } } ?>
		
		</article>
      </div>
	  
				<div class="col-md-12">
					<article class="widget">
					<header class="widget__header">
					<a style="text-decoration:none; ">Notícias</a><br><br>
						<h3 class="widget__title">Outras notícias</h3>
					</header>

				<div class="widget__content" style="height:400px;width:100%;overflow:auto;">
						<table class="table">
							<thead>
                        <tr>
                            <th>ID e Link</th>
                            <th>Título</th>
                            <th>Por</th>
                            <th>Ação</th>
                        </tr>
                        </thead>
							<tbody>
<?php $columna = mysql_query("SELECT * FROM cms_news ORDER BY id DESC LIMIT 50");
while($columnas = mysql_fetch_array($columna)){ ?>

								<tr>
									<td><a class="btn btn-violet" style="text-decoration:none;"><?php echo $columnas['id']; ?></a> <a href="<?php echo $Holo['url']; ?>/news/<?php echo $columnas['id']; ?>" target="_blank" class="btn btn-green" style="text-decoration:none;">Abrir notícia</a></td>
									<td><?php echo $columnas['title']; ?></td>
									<td><?php echo $columnas['author']; ?></td>
									<td><a href="aconoticias.php?noticia=<?php echo $columnas['id']; ?>" title="Editar" class="btn btn-orange" style="text-decoration:none;">Editar</a> <a href="aconoticias.php?do=dele&key=<?php echo $columnas['id']; ?>" class="btn btn-red" style="text-decoration:none;">Apagar</a></td>
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