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
	<thead>
		<tr>
			<td>Nazwa produktu</td>
			<td class="quantity_width">Ilość</td>
			<td class="price_width">Cena netto</td>
			<td class="price_vat">VAT</td>
			<td class="price_width">Cena brutto</td>
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
			<td><p>
				<a class="product_name" href="<?php echo url::site('products/details.'.$v->product->id) ?>"><b><?php echo $v->product->name ?></b></a>
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
			<td colspan="2" class="align-right"><b>Suma</b></td>
			<td><b><?php echo number_format($sum_netto, 2) ?> zł</b></td>
			<td>-</td>
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
			<td class="align-right"><b>Do zapłaty</b></td>
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
<?php if(in_array($order->status, array('added'))): ?>
	<tfoot>
		<tr>
			<td class="align-right"><b>Operacje</b></td>
			<td colspan="4">
				<?php echo html::anchor_confirm('account/cancel.'.$order->id, 'Anuluj zamówienie', 'Czy jesteś pewien? Tej operacji nie będziesz mógł cofnąć!') ?>
			</td>
		</tr>
	</tfoot>
<?php endif ?>
<?php endif ?>
	</table>
</body>
</html>
