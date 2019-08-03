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
$get = mysql_query("SELECT * FROM guilds WHERE id = '".$idd."'");
if(mysql_num_rows($get) == 1)
{
    $grps = mysql_fetch_object($get);
}else
{
    $exits = '0';   
}

?>
<?php if($exits == '0')
            {
                echo '<div class="giant-link red d-flex justify-content-center align-items-center"><div class="mr-auto"><font size="3">Aparentemente você não pode ver este perfil, ele pode estar Bloqueado ou o usuário banido, também ele pode não existir.<br><br><form action="/groups" method="get"><button class="button button-white text-center">Voltar para o Início</button></form></font></div><div class="icon"><i class="fas fa-file-invoice"></i></div></div>';
            }else{   
?>
        <div id="page-content">
            <div class="container">
                <div id="gang-page">
                    <div class="gang-info">
                        <div class="main-info content-box blue">
                            <div class="title clothes-colour-<?php echo mysql_real_escape_string($grps->color_one); ?> room-item__title"><?php echo mysql_real_escape_string($grps->name); ?></div>
                            <div class="box-body">
                                <div class="gang-colours float-right">
                                    <div class="colour colour-primary clothes-colour-<?php echo mysql_real_escape_string($grps->color_one); ?>"></div>
                                    <div class="colour colour-secondary clothes-colour-<?php echo mysql_real_escape_string($grps->color_two); ?>"></div>
                                </div>
<?php $owners = mysql_query("SELECT * FROM guilds_members WHERE guild_id = '". $grps->id ."' AND level_id = '0' ORDER BY member_since ASC LIMIT 1");
while($owner = mysql_fetch_assoc($owners)){
$ownerinfo = mysql_fetch_assoc($ownerinfo = mysql_query("SELECT * FROM users WHERE id = '".$owner['user_id']."'")); ?>
                                <div class="leader-name"><small>Criado em: <strong><?php echo date("d/m",mysql_real_escape_string($grps->date_created)); ?> de <?php echo date("Y",mysql_real_escape_string($grps->date_created)); ?></strong></small></div>
								<div class="leader-name"><small>Criado por: <strong><span class="user-style <?php echo $ownerinfo['user_style']; ?>"><?php echo $ownerinfo['username']; ?></span></strong></small></div>
                                <div class="leader-figure" style="max-height:140px; overflow: hidden;"><img src="<?php echo $Holo['avatar'] . $ownerinfo['look']; ?>&amp;head_direction=3&amp;gesture=sml&amp;size=l"></div>
<?php } ?>
                            </div>
                        </div>
                        <div class="stats">
                            <div class="content-box blue">
                                <div class="title">Descrição do Grupo</div>
                                <div class="box-body">
                                <p class="room-item__title"><?php echo mysql_real_escape_string($grps->description); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="stats">
                            <div class="content-box blue">
                            <div class="title">Central do Grupo</div>
<?php $roominfos = mysql_query("SELECT * FROM guilds WHERE id = '". $grps->id ."'");
while($roominfo = mysql_fetch_assoc($roominfos)){
$roominfof = mysql_fetch_assoc($roominfof = mysql_query("SELECT * FROM rooms WHERE id = '".$roominfo['room_id']."'")); ?>
                            <div class="promotion">
		                        <div class="d-flex">
			                        <div class="promo-img left-img2"><img src="<?php echo $Holo['thumbsurl']; ?><?php echo $roominfof['id']; ?>.png"></div>
			                        <div class="mr-auto promo-info align-self-center"><div class="room-item__title"><small><?php echo $roominfof['name']; ?></small></div></div>
		                        </div>
                            </div>
<?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="gang-ranks">
                        <div class="gang-rank">
                            <div class="content-box">
                                <div class="title">Administradores desse Grupo</div>
                                <div class="box-body" style="height:220px;width:790px;overflow:auto;">
                                    <div class="employee-container">
<?php $memberinfos = mysql_query("SELECT * FROM guilds_members WHERE guild_id = '". $grps->id ."' AND level_id = '0' ORDER BY member_since ASC");
while($memberinfo = mysql_fetch_assoc($memberinfos)){
$rowmember = mysql_fetch_assoc($rowmember = mysql_query("SELECT * FROM users WHERE id = '".$memberinfo['user_id']."'")); ?>
                                        <div class="content-box employee-box">
                                            <div class="d-flex align-items-center">
                                                <div class="employee-look-wrapper <?php if($rowmember['online'] == '1') { echo ''; } else { echo 'grayscale'; } ?>">
                                                    <a class="employee-look" href="<?php echo $Holo['url']; ?>/home/<?php echo $rowmember['username']; ?>" style="background-image: url(<?php echo $Holo['avatar'] . $rowmember['look']; ?>&amp;head_direction=3&amp;gesture=sml);"></a>
                                                </div>
                                                <div>
                                                    <a href="<?php echo $Holo['url']; ?>/home/<?php echo $rowmember['username']; ?>" class="employee-name font-weight-bold no-decoration"><span class="user-style <?php echo $rowmember['user_style']; ?>"><?php echo $rowmember['username']; ?></span> </a>
                                                    <div class="police-stats" style="font-size: 11px;">
													    <div><?php if($rowmember['rank'] < '6') { echo ''; } else { echo '<span class="text-danger name-addition">(Staff)</span>'; } ?><?php if($rowmember['rank'] == '2') { echo '<span class="text-success name-addition">(VIP)</span>'; } else { echo ''; } ?><?php if($rowmember['rank'] == '1') { echo '<span class="text-info name-addition">(Verificado)</span>'; } else { echo ''; } ?></div>
                                                        <div>Entrou <?php echo GetLast($memberinfo['member_since']); ?> atrás</div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-center flex-fill">
                                                    <?php if($rowmember['online'] == '1') { echo '<img src="'.$Holo['url'].'/img/online.gif">'; } else { echo '<img src="'.$Holo['url'].'/img/offline.gif">'; } ?>
                                                </div>
                                            </div>
                                        </div>
<?php } ?>
<?php $memberinfos = mysql_query("SELECT * FROM guilds_members WHERE guild_id = '". $grps->id ."' AND level_id = '1' ORDER BY member_since ASC");
while($memberinfo = mysql_fetch_assoc($memberinfos)){
$rowmember = mysql_fetch_assoc($rowmember = mysql_query("SELECT * FROM users WHERE id = '".$memberinfo['user_id']."'")); ?>
                                        <div class="content-box employee-box">
                                            <div class="d-flex align-items-center">
                                                <div class="employee-look-wrapper <?php if($rowmember['online'] == '1') { echo ''; } else { echo 'grayscale'; } ?>">
                                                    <a class="employee-look" href="<?php echo $Holo['url']; ?>/home/<?php echo $rowmember['username']; ?>" style="background-image: url(<?php echo $Holo['avatar'] . $rowmember['look']; ?>&amp;head_direction=3&amp;gesture=sml);"></a>
                                                </div>
                                                <div>
                                                    <a href="<?php echo $Holo['url']; ?>/home/<?php echo $rowmember['username']; ?>" class="employee-name font-weight-bold no-decoration"><span class="user-style <?php echo $rowmember['user_style']; ?>"><?php echo $rowmember['username']; ?></span> </a>
                                                    <div class="police-stats" style="font-size: 11px;">
													    <div><?php if($rowmember['rank'] < '6') { echo ''; } else { echo '<span class="text-danger name-addition">(Staff)</span>'; } ?><?php if($rowmember['rank'] == '2') { echo '<span class="text-success name-addition">(VIP)</span>'; } else { echo ''; } ?><?php if($rowmember['rank'] == '1') { echo '<span class="text-info name-addition">(Verificado)</span>'; } else { echo ''; } ?></div>
                                                        <div>Entrou <?php echo GetLast($memberinfo['member_since']); ?> atrás</div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-center flex-fill">
                                                    <?php if($rowmember['online'] == '1') { echo '<img src="'.$Holo['url'].'/img/online.gif">'; } else { echo '<img src="'.$Holo['url'].'/img/offline.gif">'; } ?>
                                                </div>
                                            </div>
                                        </div>
<?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gang-rank">
                            <div class="content-box">
                                <div class="title">Membros desse Grupo</div>
                                <div class="box-body" style="height:220px;width:790px;overflow:auto;">
                                    <div class="employee-container">
<?php $memberinfos = mysql_query("SELECT * FROM guilds_members WHERE guild_id = '". $grps->id ."' AND level_id = '2' ORDER BY member_since ASC");
while($memberinfo = mysql_fetch_assoc($memberinfos)){
$rowmember = mysql_fetch_assoc($rowmember = mysql_query("SELECT * FROM users WHERE id = '".$memberinfo['user_id']."'")); ?>
                                        <div class="content-box employee-box">
                                            <div class="d-flex align-items-center">
                                                <div class="employee-look-wrapper <?php if($rowmember['online'] == '1') { echo ''; } else { echo 'grayscale'; } ?>">
                                                    <a class="employee-look" href="<?php echo $Holo['url']; ?>/home/<?php echo $rowmember['username']; ?>" style="background-image: url(<?php echo $Holo['avatar'] . $rowmember['look']; ?>&amp;head_direction=3&amp;gesture=sml);"></a>
                                                </div>
                                                <div>
                                                    <a href="<?php echo $Holo['url']; ?>/home/<?php echo $rowmember['username']; ?>" class="employee-name font-weight-bold no-decoration"><span class="user-style <?php echo $rowmember['user_style']; ?>"><?php echo $rowmember['username']; ?></span> </a>
                                                    <div class="police-stats" style="font-size: 11px;">
													    <div><?php if($rowmember['rank'] < '6') { echo ''; } else { echo '<span class="text-danger name-addition">(Staff)</span>'; } ?><?php if($rowmember['rank'] == '2') { echo '<span class="text-success name-addition">(VIP)</span>'; } else { echo ''; } ?><?php if($rowmember['rank'] == '1') { echo '<span class="text-info name-addition">(Verificado)</span>'; } else { echo ''; } ?></div>
                                                        <div>Entrou <?php echo GetLast($memberinfo['member_since']); ?> atrás</div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-center flex-fill">
                                                    <?php if($rowmember['online'] == '1') { echo '<img src="'.$Holo['url'].'/img/online.gif">'; } else { echo '<img src="'.$Holo['url'].'/img/offline.gif">'; } ?>
                                                </div>
                                            </div>
                                        </div>
<?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
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