<?php defined('SYSPATH') OR die('No direct access allowed.') ?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8" />
	<title><?php echo empty($title) ? 'Projekt zespołowy' : $title ?></title>

	<script src="<?php echo url::site('media/js/script.js')?>"></script>
	<script src="<?php echo url::site('media/js/jquery-1.4.2.min.js')?>"></script>
	<script src="<?php echo url::site('media/js/autoajax.js')?>"></script>
	<link rel="stylesheet" href="<?php echo url::site('media/style.css') ?>" type="text/css" media="screen" />
	<!--[if IE 6]><link rel="stylesheet" href="<?php echo url::site('media/style.ie6.css')?>" type="text/css" media="screen" /><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" href="<?php echo url::site('media/style.ie7.css')?>" type="text/css" media="screen" /><![endif]-->
</head>
<body>
	<div id="art-page-background-gradient"></div>
	<div id="art-main">
		<div class="art-Sheet">
			<div class="art-Sheet-tl"></div>
			<div class="art-Sheet-tr"></div>
			<div class="art-Sheet-bl"></div>
			<div class="art-Sheet-br"></div>
			<div class="art-Sheet-tc"></div>
			<div class="art-Sheet-bc"></div>
			<div class="art-Sheet-cl"></div>
			<div class="art-Sheet-cr"></div>
			<div class="art-Sheet-cc"></div>
			<div class="art-Sheet-body">
				<div class="art-Header">
					<div class="art-Header-jpeg"></div>
					<div class="art-Logo">
						<h1 id="name-text" class="art-Logo-name"><a href="<?php echo url::base() ?>"><span>Hurtex</span></a></h1>
					</div>
					
					<div id="art-Header-login-form">
<?php if($user and $user->logged_in()): ?>
						<div class="art-Header-logged-in">
							<b>Zalogowano jako <?php echo $user->email ?></b><br />
							<?php echo html::anchor('account', 'Zarządzaj kontem') ?><br />
							<?php echo html::anchor('account/logout', 'Wyloguj') ?>
						</div>
<?php else: ?>
						<?php echo form::open('account/login') ?>
							<dl>
								<dt><label for="field-header-email">Email:</label></dt>
								<dd><input type="text" name="email" id="field-header-email" value="marian@mail.com" /></dd>
							</dl>
							
							<dl>
								<dt><label for="field-header-password">Hasło:</label></dt>
								<dd><input type="password" name="password" id="field-header-password" value="test" /></dd>
							</dl>
							
							<dl>
								<dd>
									<input class="art-button" type="submit" name="send" value="Zaloguj" />
								</dd>
								<dd>
									<div>
										<?php echo html::anchor('account/create', 'Zarejestruj')?>
									</div>
									<div>
										<?php echo html::anchor('account/reminder', 'Przypomnij hasło') ?>
									</div>
								</dd>
							</dl>
						<?php echo form::close() ?>
<?php endif ?>
					</div>
				
					<div id="art-Header-search">
						<?php echo form::open('products/search') ?>
						 	<dl>
						 		<dt>Szukaj:</dt>
						 		<dd><?php echo form::input('query', !empty($query) ? html::chars($query) : NULL, array('placeholder' => 'Szukaj&hellip;')) ?></dd>
						 		<dd><?php echo form::submit('search', 'Szukaj', array('class' => 'art-button')) ?></dd>
						 	</dl>
						<?php echo form::close() ?>
					</div>
				</div>
				<div class="art-contentLayout">
					
					<div class="art-sidebar1">
						<div class="art-Block">
							<div class="art-Block-tl"></div>
							<div class="art-Block-tr"></div>
							<div class="art-Block-bl"></div>
							<div class="art-Block-br"></div>
							<div class="art-Block-tc"></div>
							<div class="art-Block-bc"></div>
							<div class="art-Block-cl"></div>
							<div class="art-Block-cr"></div>
							<div class="art-Block-cc"></div>
							<div class="art-Block-body">
										<div class="art-BlockHeader">
											<div class="l"></div>
											<div class="r"></div>
										   <div class="art-header-tag-icon">
												<div class="t">Kategorie</div>
											</div>
										</div><div class="art-BlockContent">
											<div class="art-BlockContent-body">
												<div>
													<?php echo Request::load('categories') ?>
												</div>
												<div class="cleared"></div>
											</div>
										</div>
								<div class="cleared"></div>
							</div>
						</div>
						<div class="art-Block">
							<div class="art-Block-tl"></div>
							<div class="art-Block-tr"></div>
							<div class="art-Block-bl"></div>
							<div class="art-Block-br"></div>
							<div class="art-Block-tc"></div>
							<div class="art-Block-bc"></div>
							<div class="art-Block-cl"></div>
							<div class="art-Block-cr"></div>
							<div class="art-Block-cc"></div>
							<div class="art-Block-body">
										<div class="art-BlockHeader">
											<div class="l"></div>
											<div class="r"></div>
											<div class="art-header-tag-icon">
												<div class="t">Koszyk</div>
											</div>
										</div><div class="art-BlockContent">
											<div class="art-BlockContent-body align-center">
												<a href="<?php echo url::site('cart') ?>"><?php echo html::image('media/images/cart.png') ?></a>
												<br />
												<a href="<?php echo url::site('cart') ?>">Przejdź do koszyka</a>
												<div class="cleared"></div>
											</div>
										</div>
								<div class="cleared"></div>
							</div>
						</div>
						<div class="art-Block">
							<div class="art-Block-tl"></div>
							<div class="art-Block-tr"></div>
							<div class="art-Block-bl"></div>
							<div class="art-Block-br"></div>
							<div class="art-Block-tc"></div>
							<div class="art-Block-bc"></div>
							<div class="art-Block-cl"></div>
							<div class="art-Block-cr"></div>
							<div class="art-Block-cc"></div>
							<div class="art-Block-body">
										<div class="art-BlockHeader">
											<div class="l"></div>
											<div class="r"></div>
											<div class="art-header-tag-icon">
												<div class="t">Kontakt</div>
											</div>
										</div>
										<div class="art-BlockContent">
											<div class="art-BlockContent-body">
											   Dział obsługi klienta:<br />
											   E-mail: <a href="mailto:<?php echo html::email('BOK@hurtex.pl') ?>"><?php echo html::email('BOK@hurtex.pl') ?></a>
												<div class="cleared"></div>
											</div>
										</div>
								<div class="cleared"></div>
							</div>
						</div>
					</div>
					<div class="art-content">
					<div class="art-Post">
						<div class="art-Post-body">
							<div class="art-Post-inner">
							<!--
								<h2 class="art-PostHeader">
									Welcome
									url::site('{#add-to-cart#}')	
								</h2>
							-->
								<div class="art-PostContent">
									<?php echo $content ?>
								</div>
							</div>
						</div>
					</div>
					</div>
					<div class="cleared"></div>
				</div>
				<div class="art-Footer">
					<div class="art-Footer-inner">
						<div class="art-Footer-text">
							<p>
								Copyright &copy; 2010. All Rights Reserved.
							</p>
						</div>
					</div>
				<div class="art-Footer-background"></div>
				<div class="cleared"></div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>