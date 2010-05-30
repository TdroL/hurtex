<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
	<meta charset="UTF-8">
	<title>Zaloguj się</title>
</head>
<style type="text/css">

* {
	margin: 0;
	padding: 0;
	outline: none;
}

dl {
	width: 200px;
	margin: 10% auto;
}

dt {
	margin-bottom: 5px;
}

dd {
	margin-bottom: 10px;
}

dd:last-of-type {
	text-align: center;
}

input {
	border: 1px solid #ccc;
	padding: 3px;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	background: -moz-linear-gradient(center top , #eee, #fff);
}

input[type=text], input[type=password] {
	width: 190px;

}

input[type=submit] {
	width: 100px;
}
input[type=submit]:hover,
input[type=submit]:focus
{
	background: -moz-linear-gradient(center top , #fff, #eee);
}

.hidden {
	visibility: hidden;
}

.visible {
	visibility: show;
}

dt.error {
	color: #f00;
	letter-spacing: 1px;
	font-variant: small-caps;
	border-bottom: 1px solid #f00;
}

dd.error {
	color: #f00;
	padding: 0 10px 5px;
	border-bottom: 1px solid #f00;
}

</style>
<body>
	<?php echo form::open() ?>
	<dl>
		
		<dt class="error <?php echo isset($error) ? 'visible' : 'hidden' ?>">Błąd</dt>
		<dd class="error <?php echo isset($error) ? 'visible' : 'hidden' ?>">Niepoprawny login lub hasło</dd>
		
		<dt><label for="field-username">Login</label></dt>
		<dd><?php echo form::input('username', 'admin') ?></dd>
		
		<dt><label for="field-password">Hasło</label></dt>
		<dd><?php echo form::password('password', 'admin') ?></dd>

		<dd><?php echo form::submit('submit', 'Zaloguj') ?></dd>
	</dl>
	<?php echo form::close() ?>
</body>
</html>