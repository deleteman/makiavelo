<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>MakBlog</title>
	<script type="text/javascript" src="/javascripts/jquery-1.8.2.min.js" ></script>
	<script type="text/javascript" src="/javascripts/jquery-ui-1.8.23.custom.min.js" ></script>
	<script type="text/javascript" src="/javascripts/jquery.ui.datepicker-es.js" ></script>
	<script type="text/javascript" src="/javascripts/jquery.timePicker.js" ></script>
	<script type="text/javascript" src="/javascripts/bootstrap.js" ></script>
	<script type="text/javascript" src="/javascripts/application.js" ></script>
	<link rel="stylesheet" href="/stylesheets/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="/stylesheets/styles.css" type="text/css" />
	<link rel="stylesheet" href="/stylesheets/timePicker.css" type="text/css" />
	<link rel="stylesheet" href="/stylesheets/ui-lightness/jquery-ui-1.8.23.custom.css" type="text/css" />
</head>
<body>
	<div class="container">
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<a href="<?=home_root_path_path()?>" class="brand">MakiBlog</a>
				<ul class="nav">
					<? if(user_logged_in()) { ?>
					<li class="hello-user">
						Hola <?= current_user()->username?>
					</li>
					<li  >
						<a href="<?=post_new_path()?>" >New Post</a>
					</li>
					
					<li><?= link_to(login_sign_out_path(),"Sign-out")?> </li>
					<?php } else { ?>
					<li><?= link_to(login_login_path(),"Sign in")?> </li>
					<li><?= link_to(user_new_path(),"Sign up")?> </li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div id="main-wrapper">
		<?php
		$flash_msg = $this->flash->getSuccess();
		if($flash_msg != "") {
		?>
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<h4>&Eacute;xito!</h4> <?=$flash_msg?>
			</div>
		<?php
		}

		$flash_error_msg = $this->flash->getError();
		if($flash_error_msg != "") {
		?>
			<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<h4>Error!</h4> <?=$flash_error_msg?>
			</div>
		<?php
		}
		?>
		<div class="row">
			<?= $this->renderView(); ?>
		</div>
	</div>
	
</body>
</html>
