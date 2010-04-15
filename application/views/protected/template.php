<!DOCTYPE html>
<html lang="pl">
<head>
	<title>Formatki - szkielet</title>
	<meta charset="utf-8" />
	<?php echo html::style('media/style.css') ?>
</head>
<body>
	<div id="root">
		<header>
			Panel zarządzania
		</header>

		<div id="subroot">
			<nav>
				<ul>
					<li><a href="#">Home</a></li>
					<li class="active"><a href="#">Produkty</a></li>
					<li><a href="#">Kategorie</a></li>
					<li><a href="#">Klienci</a></li>
					<li><a href="#">Zamówienia</a></li>
					<li><a href="#">Dostawcy</a></li>
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



