<!DOCTYPE html>
<html lang="pl">
<head>
	<title>Panel zarządzania</title>
	<meta charset="utf-8" />
	<style type="text/css">
		@import url("<?php echo url::site('media/admin/style.css') ?>");
	</style>
	<?php echo html::script('media/js/jquery-1.4.2.min.js') ?>
	<?php echo html::script('media/js/jquery.autohide.js') ?>
</head>
<body>
	<div id="root">
		<header>
			Panel zarządzania
		</header>

		<div id="subroot">
			<nav>
				<ul>
<?php foreach(array(
					'main' => 'Powiadomienia',
					'products' => 'Produkty',
					'warehouse' => 'Magazyn',
					'supplies' => 'Zapotrzebowanie',
					'categories' => 'Kategorie',
					'clients' => 'Klienci',
					'orders' => 'Zamówienia',
					'suppliers' => 'Dostawcy',
					'vats' => 'Stawki VAT',
					'units' => 'Jednostki miary',
					'sendforms' => 'Formy wysyłki',
					'reports' => 'Raporty',
					'users' => 'Użytkownicy',
					'settings' => 'Ustawienia',
					'rolesgroups' => 'Grupy ról',
			) as $uri => $label): ?>
	<?php if($auth->has_role($uri.'.index')): ?>
		<li><a href="<?php echo url::site('admin/'.$uri) ?>"><?php echo $label ?></a></li>
	<?php endif ?>
<?php endforeach ?>
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



