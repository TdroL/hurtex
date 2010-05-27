<?php defined('SYSPATH') or die('No direct script access.'); ?>
<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
	<meta charset="UTF-8">
	<title></title>
	<?php echo html::style('media/payform.css').PHP_EOL ?>
</head>
<body>
	<div>
		<table>
		<tr><td rowspan="16" class="row"></td><td colspan="2" class="head"></td><td rowspan="16" class="row"></td></tr>
		<tr><td colspan="2"><?php echo $company->name ?></td></tr>
		<tr><td colspan="2" class="smal"></td></tr>
		<tr><td colspan="2"><?php echo $company->address ?></td></tr>
		<tr><td colspan="2" class="spacing">12345678901234567890123456</td></tr>
		<tr><td colspan="2" class="smal"></td></tr>
		<tr><td class="type">X</td><td class="price"><?php echo number_format($sum_brutto_plus, 2) ?></td></tr>
		<tr><td colspan="2" class="smal"></td></tr>
		<tr><td colspan="2"><?php echo text::number_to_text($sum_brutto_plus)?></td></tr>
		<tr><td colspan="2" class="smal"></td></tr>
		<tr><td colspan="2"><?php echo $order->client->second_name ?> <?php echo $order->client->first_name ?></td></tr>
		<tr><td colspan="2" class="smal"></td></tr>
		<tr><td colspan="2"><?php echo $order->client->address ?></td></tr>
		<tr><td colspan="2" class="smal"></td></tr>
		<tr><td colspan="2">Opłata za zamówienie </td></tr>
		<tr><td colspan="2">ID.<?php echo $order->paragon_number ?></td></tr>
		<tfoot><td colspan="4" class="foot"></td></tfoot>
		</table>
	</div>
	<div>
		<table>
		<tr><td rowspan="16" class="row"></td><td colspan="2" class="head"></td><td rowspan="16" class="row"></td></tr>
		<tr><td colspan="2"><?php echo $company->name ?></td></tr>
		<tr><td colspan="2" class="smal"></td></tr>
		<tr><td colspan="2"><?php echo $company->address ?></td></tr>
		<tr><td colspan="2" class="spacing">12345678901234567890123456</td></tr>
		<tr><td colspan="2" class="smal"></td></tr>
		<tr><td class="type">X</td><td class="price"><?php echo number_format($sum_brutto_plus, 2) ?></td></tr>
		<tr><td colspan="2" class="smal"></td></tr>
		<tr><td colspan="2"><?php echo text::number_to_text($sum_brutto_plus)?></td></tr>
		<tr><td colspan="2" class="smal"></td></tr>
		<tr><td colspan="2"><?php echo $order->client->second_name ?> <?php echo $order->client->first_name ?></td></tr>
		<tr><td colspan="2" class="smal"></td></tr>
		<tr><td colspan="2"><?php echo $order->client->address ?></td></tr>
		<tr><td colspan="2" class="smal"></td></tr>
		<tr><td colspan="2">Opłata za zamówienie </td></tr>
		<tr><td colspan="2">ID.<?php echo $order->paragon_number ?></td></tr>
		<tfoot><td colspan="4" class="foot"></td></tfoot>
		</table>
	</div>
</body>