<?php require_once("inc/core.god.php");

if(Loged == FALSE)
{
	header("Location: /");
	exit;
}

if(mysql_num_rows($chb) > 0) 
{
    header("Location: banned");
	exit;
}

if($_GET['action'] == 'logout') {
    session_destroy();
    header("Location: /");
	exit;
}

if(MANTENIMIENTO == '1') 
{
    header("Location: mantenimiento");
	exit;
}

$_config['client'] = array(
	'host' 				 				=> 'localhost',
	'port' 				 				=> '30000',
	'client_starting' 		 		 	=> 'Por favor aguarde! O '.$Holo['name'].' est\u00E1 carregando...',
	'client_starting_revolving' 		=> 'Quando voc\u00EA menos esperar...terminaremos de carregar...\/Carregando mensagem divertida! Por favor espere.\/Voc\u00EA quer batatas fritas para acompanhar?\/Siga o pato amarelo.\/O tempo \u00E9 apenas uma ilus\u00E3o.\/J\u00E1 chegamos?!\/Eu gosto da sua camiseta.\/Olhe para um lado. Olhe para o outro. Pisque duas vezes. Pronto!\/N\u00E3o \u00E9 voc\u00EA, sou eu.\/Shhh! Estou tentando pensar aqui.\/Carregando o universo de pixels.',
	'external_variables' 			 	=> 'http://localhost/gamedata/external_variables.txt',
	'external_variables_override' 		=> 'http://localhost/gamedata/override/external_override_variables.txt',
	'external_flash_texts'  			=> 'http://localhost/gamedata/external_flash_texts_br.txt',
	'external_flash_texts_override' 	=> 'http://localhost/gamedata/override/external_flash_override_texts_br.txt',
	'productdata' 			 			=> 'http://localhost/gamedata/productdata_br.txt',
	'furnidata' 			 			=> 'http://localhost/gamedata/furnidata.xml',	
	'external_figurepartlist' 			=> 'http://localhost/gamedata/figuredata.xml',	
	'avatareditor_promohabbos' 			=> 'http://localhost/gamedata/hotlooks.xml',	
	'flash_client_url' 	 				=> 'http://localhost/gordon/PRODUCTION-201904011212-888653470/',
	'habbo_swf' 		 				=> 'asmd.swf'
);

$ticket = time().sha1(rand(10000,99999));

mysql_query("UPDATE users SET auth_ticket = '', auth_ticket = '".$ticket."', ip_current = '', ip_current = '".$ip."' WHERE id = '".$myrow['id']."'") or die(mysql_error());
	
$ticketsql = mysql_query("SELECT * FROM users WHERE id = '".$myrow['id']."'") or die(mysql_error());
$ticketrow = mysql_fetch_assoc($ticketsql);
?>
<html>
<head>
      <meta charset="utf-8">
      <title><?php echo $Holo['name']; ?> Hotel</title>
      <link rel="shortcut icon" href="<?php echo $Holo['url']; ?>/img/favicon.ico" type="image/vnd.microsoft.icon" />
      <script src="<?php echo $Holo['url']; ?>/js/jquery-latest.js" type="text/javascript"></script>
      <script src="<?php echo $Holo['url']; ?>/js/jquery-ui.js" type="text/javascript"></script>
      <script src="<?php echo $Holo['url']; ?>/js/flashclient.js"></script>
      <script src="<?php echo $Holo['url']; ?>/js/flash_detect_min.js"></script>
      <script src="<?php echo $Holo['url']; ?>/js/welcome.js"></script>
      <script src="<?php echo $Holo['url']; ?>/js/browse.js"></script>
      <script src="<?php echo $Holo['url']; ?>/js/client.js" type="text/javascript"></script>
      <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
      <link rel="stylesheet" href="<?php echo $Holo['url']; ?>/css/no-flash.css" type="text/css">
      <link rel="stylesheet" href="<?php echo $Holo['url']; ?>/css/client.css" type="text/css">
      <link rel="stylesheet" href="<?php echo $Holo['url']; ?>/css/bilsonnn.css" type="text/css">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
   <body style="overflow:hidden;" class="loaded">

      <center>
         <div id="client-ui">
         <div class="client" id="client" style="height: calc(100% - 0px);height:-moz-calc(100% - 30px);top:initial;">
         <!--<div class="client" id="client" style="height: calc(98.3% - 70px);height:-moz-calc(100% - 30px);/* top:initial; */">-->
		 <embed type="application/x-shockwave-flash" src="<?php echo $_config['client']['flash_client_url'] . $_config['client']['habbo_swf']; ?>" width="100%" height="100%" style="undefined" id="client" name="client" quality="high" base="<?php echo $_config['client']['flash_client_url']; ?>" allowscriptaccess="always" wmode="opaque" flashvars="client.allow.cross.domain=0&amp;client.notify.cross.domain=1&amp;connection.info.host=<?php echo $_config['client']['host']; ?>&amp;connection.info.port=<?php echo $_config['client']['port']; ?>&amp;site.url=<?php echo $Holo['url']; ?>&amp;url.prefix=<?php echo $Holo['url']; ?>&amp;client.reload.url=<?php echo $Holo['url']; ?>/me&amp;client.fatal.error.url=<?php echo $Holo['url']; ?>/me&amp;client.connection.failed.url=<?php echo $Holo['url']; ?>/me&amp;external.override.texts.txt=<?php echo $_config['client']['external_flash_texts_override']; ?>&amp;external.override.variables.txt=<?php echo $_config['client']['external_variables_override']; ?>&amp;external.variables.txt=<?php echo $_config['client']['external_variables']; ?>&amp;external.texts.txt=<?php echo $_config['client']['external_flash_texts']; ?>&amp;external.figurepartlist.txt=<?php echo $_config['client']['external_figurepartlist']; ?>&amp;flash.dynamic.avatar.download.configuration=<?php echo $_config['client']['flash_client_url']; ?>figuremap.xml&amp;productdata.load.url=<?php echo $_config['client']['productdata']; ?>&amp;furnidata.load.url=<?php echo $_config['client']['furnidata']; ?>&amp;use.sso.ticket=1&amp;spaweb=1&amp;has.identity=1&amp;sso.ticket=<?php echo $ticketrow['auth_ticket']; ?>&amp;processlog.enabled=1&amp;client.starting=Dabbzo is loading...&amp;flash.client.url=<?php echo $_config['client']['flash_client_url']; ?>&amp;flash.client.origin=popup&amp;ads.domain="></div>
         <div class="hb-container" id="area-container">
            <h1 class="text" id="client-title"></h1>
            <div id="no-flash" style="display: none;">
               <div id="info-allow"></div>
               <div id="info-allow-button" style="display: none; text-align: center;">
                  <a href="https://get.adobe.com/nl/flashplayer/" target="_blank" id="allow-flash-button-extern" class="client-reload__button" style="display: none;">Allow</a>
                  <button id="allow-flash-button-more" class="client-reload__button" style="display: none; background-color: #f44336;border-color: #d66d66;color: #fff;">Did not succeed?</button>
               </div>
               <p id="info-flash">
                  It is possible that there is no flash installed on your computer, phone or tablet. Unfortunately, you do need this to play Dabbzo! Fortunately, there is a solution for this.                  <br><br>
                 Try the steps below:<br><br>
                  <b style="font-weight: bold;">Are you on your laptop or PC?</b>
               </p>
               <div id="info-flash-extra">
                  <ul>
                     <li>Download <a href="https://get.adobe.com/nl/flashplayer/">Adobe Flash Player</a> Free</li>
                  </ul>
                  <br>
                  <b style="font-weight: bold;">Enable Flash Player on your browser</b>
                  <ul>
                     <li>See Enable Flash Player for <a target="_blank" href="https://helpx.adobe.com/nl/flash-player/kb/enabling-flash-player-chrome.html">Google Chrome</a>
                        for information;                     </li>
                     <li>See Enable Flash Player for <a target="_blank" href="https://helpx.adobe.com/nl/flash-player/kb/install-flash-player-windows.html">Internet Explorer</a>
						for information;                     </li>
                     <li>See Enable Flash Player for <a target="_blank" href="https://helpx.adobe.com/flash-player/kb/flash-player-issues-windows-10-edge.html">Microsoft Edge</a>
                        for information;                     </li>
                     <li>See Enable Flash Player for <a target="_blank" href="https://helpx.adobe.com/nl/flash-player/kb/enabling-flash-player-firefox.html">Firefox</a>
						for information;                     </li>
                     <li>See Enable Flash Player for <a target="_blank" href="https://helpx.adobe.com/nl/flash-player/kb/enabling-flash-player-safari.html">Apple Safari</a>
                        for information;                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <script>
         if(bowser.chrome || bowser.firefox){
           var Client = new SWFObject("<?php echo $_config['client']['flash_client_url'] . $_config['client']['habbo_swf']; ?>", "client", "100%", "100%", "10.0.0");
        }
        else
        {
          var Client = new SWFObject("<?php echo $_config['client']['flash_client_url'] . $_config['client']['habbo_swf']; ?>", "client", "100%", "100%", "10.0.0");
        }
         Client.addVariable("client.allow.cross.domain", "0");
         Client.addVariable("client.notify.cross.domain", "1");
         Client.addVariable("connection.info.host", "<?php echo $_config['client']['host']; ?>");
         Client.addVariable("connection.info.port", "<?php echo $_config['client']['port']; ?>");
         Client.addVariable("site.url", "<?php echo $Holo['url']; ?>");
         Client.addVariable("url.prefix", "<?php echo $Holo['url']; ?>");
         Client.addVariable("client.reload.url", "<?php echo $Holo['url']; ?>/hotel");
         Client.addVariable("client.fatal.error.url", "<?php echo $Holo['url']; ?>/hotel");
         Client.addVariable("client.connection.failed.url", "<?php echo $Holo['url']; ?>/hotel");
         Client.addVariable("external.override.texts.txt", "<?php echo $_config['client']['external_flash_texts_override']; ?>?v=5415454655566");
         Client.addVariable("external.override.variables.txt", "<?php echo $_config['client']['external_variables_override']; ?>?v=54154554");
         Client.addVariable("external.variables.txt", "<?php echo $_config['client']['external_variables']; ?>");
         Client.addVariable("external.texts.txt", "<?php echo $_config['client']['external_flash_texts']; ?>");
         Client.addVariable("external.figurepartlist.txt", "<?php echo $_config['client']['external_figurepartlist']; ?>");
         Client.addVariable("avatareditor.promohabbos", "<?php echo $_config['client']['avatareditor_promohabbos']; ?>");
         Client.addVariable("productdata.load.url", "<?php echo $_config['client']['productdata']; ?>");
         Client.addVariable("furnidata.load.url", "<?php echo $_config['client']['furnidata']; ?>?v=1607201966");
         Client.addVariable("use.sso.ticket", "1");
         Client.addVariable("spaweb", "1");
         Client.addVariable("has.identity", "1");
         Client.addVariable("sso.ticket", "<?php echo $ticketrow['auth_ticket']; ?>");
         Client.addVariable("processlog.enabled", "1");
         Client.addVariable("client.starting", "Por favor aguarde! O Hotel está carregando...");
         Client.addVariable("flash.client.url", "<?php echo $_config['client']['flash_client_url']; ?>");
         Client.addVariable("flash.client.origin", "popup");
         Client.addVariable("nux.lobbies.enabled", "false");
         Client.addVariable("ads.domain", "");
         Client.addParam('base', '<?php echo $_config['client']['flash_client_url']; ?>');
         Client.addParam('allowScriptAccess', 'always');
         Client.addParam('wmode', "opaque");
         Client.write('client');
         $(document).ready(function() {
         if (!FlashDetect.installed) {
         $("#hide-message,#client-support, #no-flash").show();
         $("#client").hide();
         if (bowser.chrome) {
             $("#client-reload, #hide-message, #client-support, #info-flash, #info-flash-extra").hide();
             $("#client-title").html('Allow Flash in Chrome!');
             $("#info-allow").html('It is possible that Flash Player is not allowed on your Google Chrome. Unfortunately, you do need this to play Dabbzo!, there is a solution for this. <br/> <br/> Click &quot;Enable Flash&quot; to play Dabbzo! <br/> <br/>');
             $("#info-allow-button, #allow-flash-button-extern").show();
         } else if (bowser.msedge) {
             $("#client-reload, #hide-message, #client-support, #info-flash, #info-flash-extra").hide();
             $("#client-title").html('Allow Flash in Edge!');
             $("#info-allow").html('It is possible that Flash Player is not allowed on your Edge Browser. Unfortunately, you do need this to play Dabbzo!, there is a solution for this. <br/> <br/> Click &quot;Enable Flash&quot; to play Dabbzo! <br/> <br/>');
             $("#info-allow-button, #allow-flash-button-extern").show();
         }
         $("#flash-wrapper").remove();
         $(".roomenterad-habblet-container").hide();
         connection = false;
         }
         else {document.getElementById("loader-wrapper").style.display = "block";}
         });
         $('#allow-flash-button-extern').click(function(event){
         if(bowser.chrome){
         $("#info-allow").html('You will now be notified by Google Chrome at the top left of your browser. <br/> <br/> <b> Press &quot;allow&quot; to activate flash and play Dabbzo! </b><br/><br/>');
         event.stopPropagation();
         }
         if(bowser.msedge){
         $("#info-allow").html('You will now receive a notification from Edge in the upper right corner of your browser. <br/> <br/> <b> Press &quot;Always allow&quot; to activate flash and play Dabbzo! </b> <br/> <br/>');
         event.stopPropagation();
         }
         $("#allow-flash-button-extern").hide();
         $("#allow-flash-button-more").show();
         });
         $('#allow-flash-button-more').click(function(){
         if(bowser.chrome){
         location.href="https://get.adobe.com/nl/flashplayer/";
         }
       });

                if(!bowser.chrome || !bowser.firefox){$(document).ready(function(e) {  document.getElementById("toolbar").style.display = "none";});}
                if(bowser.chrome || bowser.firefox){$(document).ready(function(e) {  document.getElementById("toolbar").style.display = "block";});}
            </script>
            </div></center>
                        <script type="text/javascript">
               $(document).ready(function(e) {
                   $.ajaxSetup({
                       cache:true
                   });
                   setInterval(function() {
                       $('#count').load('/clientdata/count');
                   }, 8000);
                   $( "#onlinecount").click(function() {
                       $('#onlinecount').load('/onlinecountclient');
                   });
                   $( "#client").click(function() {
                     $('#count').load('/clientdata/count');
                     $('#memenu').load('/clientdata/look');
                   });
               });
               $(document).on('click', function(e) {
                 $('#count').load('/clientdata/count');
                 $('#memenu').load('/clientdata/look');
                 return false;
               });
            </script>
                  <div id="loader-wrapper" style="display: block;">
        <div id="loader">Entering...<br><small>(100%)</small></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
     </div>

     <div class="disconnected_filter" id="disconnected">
        <div class="disconnected_window">
           <div class="disconnected_text">You have Disconnected!</div>
           <div class="disconnected_button" onclick="window.location.reload()">Reload</div>
        </div>
     </div>
     
<div style="position:fixed; top:0; left:0; overflow:hidden;"><input style="position:absolute; left:-300px;" type="text" value="" id="focus_retriever" readonly="true"></div>

</body>
</html>