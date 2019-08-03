	<header class="top-bar">
		<a class="mobile-nav" href="#"><i class="pe-7s-menu"></i></a>
		<div class="main-logo"><span><?php echo $Holo['name']; ?> Painel</span></div>
		<?php if(MANTENIMIENTO == '1') { ?>
		<input type="checkbox" id="s-logo" class="sw" disabled checked />
		<label class="switch switch--dark switch--header" for="s-logo"></label>
		<?php } ?>
		<?php if(MANTENIMIENTO == '0') { ?>
		<input type="checkbox" id="s-logo" class="sw" disabled />
		<label class="switch switch--dark switch--header" for="s-logo"></label>
		<?php } ?>
		
		<ul class="profile">
			<li>
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" onclick="return false;" class="profile__user">
					<figure class="pull-left rounded-image profile__img">
						<img class="media-object" src="<?php echo $Holo['avatar'] . $myrow['look']; ?>&action=&direction=2&head_direction=2" alt="user">
					</figure>
					<span class="profile__name">
						<span><?php echo $myrow['username']; ?></span> <i class="pe-7s-angle-down"></i>
					</span>
				</a>
				<ul class="dropdown-menu pull-right">
					<li><a href="<?php echo $Holo['url']; ?>/housekeeping/logout.php"><i class="icon pe-7s-close-circle"></i> Sair do Painel</a></li>
				</ul>
			</li>
		</ul>
	</header>