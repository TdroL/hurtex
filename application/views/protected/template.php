<!DOCTYPE html>
<html lang="pl">
<head>
	<title>Formatki - szkielet</title>
	<meta charset="utf-8" />
	<style type="text/css">
		@import url("<?php echo url::site('media/admin/style.css') ?>");
	</style>

</head>
<body>
	<div id="root">
		<header>
			Panel zarządzania
		</header>

		<div id="subroot">
			<nav>
				<ul>
					<!-- class="active" -->
					<li><a href="<?php echo url::site('admin/main') ?>">Powiadomienia</a></li>
					<li><a href="<?php echo url::site('admin/products') ?>">Produkty</a></li>
					<li><a href="<?php echo url::site('admin/warehouse') ?>">Magazyn</a></li>
					<li><a href="<?php echo url::site('admin/categories') ?>">Kategorie</a></li>
					<li><a href="<?php echo url::site('admin/clients') ?>">Klienci</a></li>
					<li><a href="<?php echo url::site('admin/orders') ?>">Zamówienia</a></li>
					<li><a href="<?php echo url::site('admin/suppliers') ?>">Dostawcy</a></li>
					<li><a href="<?php echo url::site('admin/vats') ?>">Stawki VAT</a></li>
					<li><a href="<?php echo url::site('admin/units') ?>">Jednostki miary</a></li>
					<li><a href="<?php echo url::site('admin/sendforms') ?>">Formy wysyłki</a></li>
					<li><a href="<?php echo url::site('admin/reports') ?>">Raporty</a></li>
					<li><a href="<?php echo url::site('admin/users') ?>">Użytkownicy</a></li>
					<li class="logout-link"><a href="<?php echo url::site('admin/users/logout') ?>">Wyloguj</a></li>
				</ul>
			</nav>

			<section id="contents">
				<?php echo $content ?>
			</section>
		</div>

		<footer>
			<small>Jakieś &copy;copywrite...</small>
		</footer>
	</div>
</body>
</html>



