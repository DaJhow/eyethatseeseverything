		<aside class="sidebar">
			<ul class="main-nav">
				<li class="main-nav--active">
				<li class="main-nav--collapsible">
					<a class="main-nav__link" style="text-decoration:none;" href="<?php echo $Holo['url']; ?>/housekeeping/home.php">
						<span class="main-nav__icon"><i class="icon pe-7s-home"></i></span>
						Início
					</a>
				</li>
				<li>

				<li class="main-nav--active">
				<li class="main-nav--collapsible">
					<a class="main-nav__link" style="text-decoration:none;">
						<span class="main-nav__icon"><i class="icon pe-7s-tools"></i></span>
						Configurações
					</a>
					<ul class="main-nav__submenu">
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/maintenance.php"><span>Manutenção</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/youtube.php"><span>YouTube Vídeos</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/sendalert.php"><span>Enviar Alerta</span></a></li>
					</ul>
				</li>

				<li class="main-nav--active">
				<li class="main-nav--collapsible">
					<a class="main-nav__link" style="text-decoration:none;">
						<span class="main-nav__icon"><i class="icon pe-7s-shopbag"></i></span>
						<?php echo $Holo['name']; ?> Loja
					</a>
					<ul class="main-nav__submenu">
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/shops.php"><span>Páginas ocultas</span></a></li>
					</ul>
				</li>

				<li class="main-nav--active">
				<li class="main-nav--collapsible">
					<a class="main-nav__link" style="text-decoration:none;">
						<span class="main-nav__icon"><i class="icon pe-7s-lock"></i></span>
						Usuários
					</a>
					<ul class="main-nav__submenu">
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/bans.php"><span>Banimentos</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/edituser.php"><span>Editar usuários</span></a></li>
					</ul>
				</li>

				<li class="main-nav--active">
				<li class="main-nav--collapsible">
					<a class="main-nav__link" style="text-decoration:none;">
						<span class="main-nav__icon"><i class="icon pe-7s-photo-gallery"></i></span>
						Notícias
					</a>
					<ul class="main-nav__submenu">
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/noticias.php"><span>Postar notícias</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/aconoticias.php"><span>Gerenciar notícias</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/advnoticias.php"><span>Divulgar notícias</span></a></li>
					</ul>
				</li>

				<!--<li class="main-nav--active">
				<li class="main-nav--collapsible">
					<a class="main-nav__link" style="text-decoration:none;">
						<span class="main-nav__icon"><i class="icon pe-7s-star"></i></span>
						In-game
					</a>
					<ul class="main-nav__submenu">
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/alertuser.php"><span>AlertUser</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/changeroomowner.php"><span>ChangeRoomOwner</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/createmodtoolticket.php"><span>CreateModToolTicket</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/disconnectuser.php"><span>DisconnectUser</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/executecommand.php"><span>ExecuteCommand</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/forwarduser.php"><span>ForwardUser</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/friendrequest.php"><span>FriendRequest</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/givebadge.php"><span>GiveBadge</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/givecredits.php"><span>GiveCredits</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/givepixels.php"><span>GivePixels</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/givepoints.php"><span>GivePoints</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/giverespect.php"><span>GiveRespect</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/ignoreuser.php"><span>IgnoreUser</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/imagehotelalert.php"><span>ImageHotelAlert</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/muteuser.php"><span>MuteUser</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/sendgift.php"><span>SendGift</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/sendroombundle.php"><span>SendRoomBundle</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/setrank.php"><span>SetRank</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/staffalert.php"><span>StaffAlert</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/stalkuser.php"><span>StalkUser</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/talkuser.php"><span>TalkUser</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/updateuser.php"><span>UpdateUser</span></a></li>
					</ul>
				</li>-->

				<li class="main-nav--active">
				<li class="main-nav--collapsible">
					<a class="main-nav__link" style="text-decoration:none;">
						<span class="main-nav__icon"><i class="icon pe-7s-server"></i></span>
						Logs do <?php echo $Holo['name']; ?>
					</a>
					<ul class="main-nav__submenu">
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/logshotel.php"><span>Logs do Hotel</span></a></li>
						<li><a href="<?php echo $Holo['url']; ?>/housekeeping/logspanel.php"><span>Logs do Painel</span></a></li>
					</ul>
				</li>
			</ul>
		</aside>