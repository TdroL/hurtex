<?php defined('SYSPATH') or die('No direct script access.'); ?>
<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
	<meta charset="UTF-8">
	<title>Zamówienie ID.<?php echo $order->paragon_number ?></title>
	<?php echo html::style('media/printable.css').PHP_EOL ?>
	
</head>
<body>
	<table class="art-article">
	<caption>Potwierdzenie odbioru towarów z magazynu <br /> Zamówienie ID.<?php echo $order->paragon_number ?></caption>
	<thead>
		<tr>
			<th>Nazwa produktu</th>
			<th>Ilość</th>
			<th>Cena netto</th>
			<th class="price_vat">VAT</th>
			<th>Cena brutto</th>
		</tr>
	</thead>
<?php if($products->is_empty()): ?>
	<tbody>
		<tr>
			<td colspan="5">Brak produktów</td>
		</tr>
	</tbody>
<?php else: ?>
	<tbody>
<?php foreach($products as $v):  ?>
		<tr id="product_<?php echo !empty($v->product->id) ? $v->product->id : uniqid() ?>">
			<td><p class="product_name"><b><?php echo $v->product->name ?></b>
			</p></td>
			<td ><p class="product_name">
					<?php echo ($v->product->unit->type == 'integer') ? (int) $v->quantity : number_format($v->quantity, 2) ?>
					<?php echo $v->product->unit->name ?>
			</p></td>
			<td><p class="product_name"><?php echo number_format($v->product->price->value*$v->quantity, 2) ?> zł</p></td>
			<td><p class="product_name"><?php echo $v->product->price->vat->name ?></p></td>
			<td><p class="product_name"><?php echo number_format(($v->product->price->value*$v->quantity) * (1 + $v->product->price->vat->value), 2) ?> zł</p></td>
		</tr>
<?php endforeach ?>
		<tr>
			<td colspan="2" class="align-right">Suma</td>
			<td><b><?php echo number_format($sum_netto, 2) ?> zł</b></td>
			<td class="price_vat"></td>
			<td><b><?php echo number_format($sum_brutto, 2) ?> zł</b></td>
		</tr>
		<tr>
			<td class="align-right">Forma dostawy</td>
			<td colspan="4">
				<?php echo $order->sendform->name ?>
				 - <?php echo number_format($order->sendform->value, 2) ?> zł
			</td>
		</tr>
		<tr>
			<td class="align-right">Forma płatności</td>
			<td colspan="4">
				<?php echo $order->meta()->fields('payment')->choices[$order->payment] ?>
			</td>
		</tr>
		<tr>
			<td class="align-right">Adres dostawy</td>
			<td colspan="4">
				<?php echo nl2br(html::chars($order->address)) ?>
			</td>
		</tr>
		<tr>
			<td class="align-right">Do zapłaty</td>
			<td colspan="4">
				Netto: <b><?php echo number_format($sum_netto_plus, 2) ?> zł</b><br />
				Brutto: <b><?php echo number_format($sum_brutto_plus, 2) ?> zł</b>
			</td>
		</tr>
		<tr>
			<td class="align-right"><b>Status</b></td>
			<td colspan="4"><?php echo $order->meta()->fields('status')->choices[$order->status] ?></td>
		</tr>
	</tbody>

<?php endif ?>
	</table>
	<div>
	<table class="sign_border"><tr>
	<td class="no_border"><small>Podpis odbierającego</small></td><td class="no_border" align="right"><small> Podpis wydającego</small></td>
	</tr></table></div>
</body>
</html>
