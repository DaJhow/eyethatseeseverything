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
	<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/css/wulles.css">
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
					<li><a style="text-decoration:none; ">Postar notícias</a></li>
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
            <h3 class="widget__title">Postar uma notícia</h3>
          </header>
<?php 
if(isset($_POST['añadir']))
{ 
    $titulo = mysql_real_escape_string($_POST['titulo']);
    $texto_corto = mysql_real_escape_string($_POST['texto_corto']);
	$Imagem = mysql_real_escape_string($_POST['topstory']);
	$texto = mysql_real_escape_string($_POST['texto']);
    if(!empty($titulo) && !empty($texto_corto) && !empty($Imagem) && !empty($texto))
    { 
        $query_NuevaNoticia = mysql_query("INSERT INTO cms_news SET title = '".$titulo."', image = '". $Imagem ."' , shortstory = '".$texto_corto."', longstory = '". ($texto) ."', date = '". time() . "', author = '". $myrow['username'] ."'");
		mysql_query("INSERT INTO stafflogs SET action = 'Noticias', message = 'Ele fez a notícia $titulo', note = '". $myrow['rank'] ."', userid = '". $myrow['id'] ."', timestamp = '". $date_full ."'");
  
        if($query_NuevaNoticia) 
        { 
            echo '<div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <div class="media">
                <figure class="pull-left alert--icon">
                  <i class="icon pe-7s-photo-gallery"></i>
                </figure>
                <div class="media-body">
                  <h3 class="alert--title">Parabéns meu amor!</h3> 
                  <p class="alert--text">Você públicou uma nova notícia.</p>
                </div>
              </div>
            </div>';
        } 
        else 
        { 
            echo '<div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <div class="media">
                <figure class="pull-left alert--icon">
                  <i class="icon pe-7s-photo-gallery"></i>
                </figure>
                <div class="media-body">
                  <h3 class="alert--title">Etcha vida...</h3> 
                  <p class="alert--text">Alguma coisa deu errado, verifique tudo certinho e tente novamente.</p>
                </div>
              </div>
            </div>';

        } 
    } 
    else 
    { 
        echo '<div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <div class="media">
                <figure class="pull-left alert--icon">
                  <i class="icon pe-7s-photo-gallery"></i>
                </figure>
                <div class="media-body">
                  <h3 class="alert--title">Al_um_ coisa ta faltando!</h3> 
                  <p class="alert--text">Tem <i>alguma</i> coisa faltando, verifique tudo e tente novamente.</p>
                </div>
              </div>
            </div>';
    } 
} 

?>
        <div class="widget__content">

        <form method="post" action="">
            <input type="text" class="input-text" name="titulo" placeholder="Título da notícia" />
            <input type="text" class="input-text" name="texto_corto"  placeholder="Descrição da notícia" />
            <input type="text" class="input-text" name="topstory" placeholder="Imagem da notícia" />
            <input type="text" class="input-text" value="<?php echo $myrow['username']; ?>" disabled />
            <textarea name="texto" id="texto" style="width: 100%; height: 150px;"></textarea>
            <script>CKEDITOR.replace( 'texto' );</script>
        <button class="btn btn-light pull-right" type="submit" name="añadir">Pronto! Postar notícia</button>
        </form>
		
        <div class="clearfix"></div>
          
        </div>
			<?php
	$do = $_GET['do'];
	$key = $_GET['key'];
	if($do == "dele"){
		$check = mysql_query("SELECT id FROM cms_news WHERE id = '". $key ."' LIMIT 1");
		if(mysql_num_rows($check) > 0){
			mysql_query("DELETE FROM cms_news WHERE id = '". $key ."' LIMIT 1");
			mysql_query("INSERT INTO stafflogs SET action = 'Noticias', message = 'Apagar notícia', note = '". $myrow['rank'] ."', userid = '". $myrow['id'] ."', timestamp = '". $date_full ."'");
			echo '<div class="col s12 m12">
        <div class="card-panel green">
          <span class="white-text">Notícia apagada corretamente.</span>
        </div>
      </div>';
		} else {
			echo '<div class="col s12 m12">
        <div class="card-panel red">
          <span class="white-text">A notícia não foi apagada.</span>
        </div>
      </div>';
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