<?php defined('SYSPATH') or die('No direct script access.'); ?>
<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
	<meta charset="UTF-8">
	<title>Faktura <?php echo $order->invoice ?></title>
	<?php echo html::style('media/admin/printable.css').PHP_EOL ?>
</head>
<body>
<div>
Faktura VAT NR <?php echo $order->invoice ?>
</div>
<div>
<dl>Sprzedawca:
<dd>Hurtex</dd>
<dd>20-501 Lublin ul. Nadbystrzycka 48</dd>
<dd>NIP 324-21-32-123</dd>
</dl>
</div>
<div>
<dl>Nabywca:
<?php if (!empty($order->client->company_name)):?>
<dd><?php echo $order->client->company_name ?></dd>
<?php else: ?>
<dd><?php echo $order->client->second_name ?> <?php echo $order->client->first_name ?></dd>
<?php endif ?>
<dd><?php echo $order->client->address ?></dd>
<?php if(!empty($order->client->NIP)):?>
<dd>NIP <?php echo $order->client->NIP?></dd>
<?php endif ?>
</dl>
</div>
	<table>
	<thead>
		<tr>
			<th>Lp.</th>
			<th>Nazwa produktu</th>
			<th>J.m.</th>
			<th>Ilość</th>
			<th>Cena netto</th>
			<th class="price_vat">VAT</th>
			<th>Cena brutto</th>
		</tr>
	</thead>
<?php if($products->is_empty()): ?>
	<tbody>
		<tr>
			<td colspan="6">Brak produktów</td>
		</tr>
	</tbody>
<?php else: ?>
<?php $i = 1; ?>
	<tbody>
<?php foreach($products as $v):  ?>
		<tr id="product_<?php echo !empty($v->product->id) ? $v->product->id : uniqid() ?>">
			<td><?php echo $i++ ?></td>
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
</body>
</html>
