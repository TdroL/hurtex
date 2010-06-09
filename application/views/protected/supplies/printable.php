<?php defined('SYSPATH') or die('No direct script access.'); ?>
<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
	<meta charset="UTF-8">
	<title>Zamówienie ID.<?php echo ($supply->id) ?></title>
	<?php echo html::style('media/printable.css').PHP_EOL ?>
	
</head>
<body>
	<table class="art-article">
	<caption>Potwierdzenie odbioru towarów <br /> Zamówienie ID.<?php echo ($supply->id) ?></caption>
	
	<thead>
		<tr>
			<td colspan ="2"><b>Data zamówienia:</b><br /><?php echo date('Y-m-d', $supply->date) ?></td>
		</tr>
		<tr>
			<th width= 450pt>Nazwa produktu</th>
			<th>Ilość</th>
		</tr>
	</thead>

	<tbody>

		<tr id="product_<?php echo !empty($supply->product->id) ? $supply->product->id : uniqid() ?>">
			<td><?php echo ($supply->product->name) ?></td>
			<td><?php echo ($supply->product->unit->type == 'integer') ? (int) $supply->quantity : number_format($supply->quantity, 2) ?> <?php echo $supply->product->unit->name ?></td>
		</tr>
	</tbody>
	</table>
	<div>
	<table class="sign_border"><tr>
	<td class="no_border"><small>Podpis odbiorcy</small></td><td class="no_border" align="right"><small> Podpis dostawcy</small></td>
	</tr></table></div>
</body>
</html>
