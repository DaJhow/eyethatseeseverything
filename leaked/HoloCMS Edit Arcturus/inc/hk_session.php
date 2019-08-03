<?php if(isset($_POST['HUsername']) && isset($_POST['HPassword']) && isset($_POST['HPasscode']))
{

$HU = $_POST['HUsername'];
$HP = $_POST['HPassword'];
$HC = $_POST['HPasscode'];

$GetuserH = mysql_query("SELECT * FROM users WHERE username = '". $HU ."' AND password = '". md5($HP) ."' AND passcode = '". md5($HC) ."'");

if(empty($HU) || empty($HP) || empty($HC))
{
    $msg = '<div class="col-md-10">
            <div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <div class="media">
                <figure class="pull-left alert--icon">
                  <i class="pe-7s-attention"></i>
                </figure>
                <div class="media-body">
                  <h3 class="alert--title">Como assim?</h3> 
                  <p class="alert--text">Verifique se você não deixou nenhum campo vazio.</p>
                </div>
              </div>
            </div>
            </div>';
}

elseif($myrow['rank'] <= $MINHKR) 
{
    $msg = '<div class="col-md-10">
            <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <div class="media">
                <figure class="pull-left alert--icon">
                  <i class="pe-7s-attention"></i>
                </figure>
                <div class="media-body">
                  <h3 class="alert--title">Ixe, corre...</h3> 
                  <p class="alert--text">Descobrimos que você não tem permissão para estar aqui, e vamos levar você de volta.</p>
                </div>
              </div>
            </div>
            </div><meta http-equiv="refresh" content="6; url=me">';
}

elseif(mysql_num_rows($GetuserH) == 0)
{
    $msg = '<div class="col-md-10">
            <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <div class="media">
                <figure class="pull-left alert--icon">
                  <i class="pe-7s-attention"></i>
                </figure>
                <div class="media-body">
                  <h3 class="alert--title">Acho que deu errado...</h3> 
                  <p class="alert--text">Vimos que o usuário que você tentou entrar <b>Não existe</b>.</p>
                </div>
              </div>
            </div>
            </div>';
}

else
{
	if(mysql_num_rows($GetuserH) > 0)
	{
	$_SESSION['HUsername'] = $HU;
	$_SESSION['HPassword'] = $HP;
	$_SESSION['HPasscode'] = $HC;
	mysql_query("INSERT INTO stafflogs (action, message, note, userid, timestamp) VALUES ('Housekeeping', 'Entro al panel de administracion', '". $myrow['rank'] ."', '". $myrow['id'] ."', '". $date_full ."')");
	}
}
}

if(isset($_SESSION['HUsername']) && isset($_SESSION['HPassword']) && isset($_SESSION['HPasscode']))
{
$HSU = $_SESSION['HUsername'];
$HSP = $_SESSION['HPassword'];
$HSC = $_SESSION['HPasscode'];

$GetUserH = mysql_query("SELECT * FROM users WHERE username = '". $HSU ."' AND password = '". md5($HSP) ."' AND passcode = '". md5($HSC) ."'");
if(mysql_num_rows($GetUserH) > 0)
{
   $myrow = mysql_fetch_assoc($GetUserH);
   define("UserH", true);
}
} else {
   define("UserH", false);
} ?>