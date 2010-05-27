<?php defined('SYSPATH') or die('No direct script access.'); ?>
<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
	<meta charset="UTF-8">
	<title>Faktura <?php echo $order->invoice ?></title>
	<?php echo html::style('media/admin/invoice.css').PHP_EOL ?>
</head>
<body>
<div>
<h2>Faktura VAT NR <?php echo $order->invoice ?></h2>
</div>
<div>
<dl><b>Sprzedawca:</b>
<dd><?php echo $company->name ?></dd>
<dd><?php echo $company->address ?></dd>
<dd><?php echo $company->nip ?></dd>
</dl>
</div>
<div>
<dl><b>Nabywca:</b>
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
<div>
Data sprzedaży:  <?php echo date('Y-m-d', $order->date) ?><br/>
Data wystawienia:  <?php echo date('Y-m-d', $order->date) ?>
</div>
<div>
	<table>
	<thead>
		<tr>
			<th class="lp_width">Lp.</th>
			<th class="product_width">Nazwa produktu</th>
			<th class="lp_width">J.m.</th>
			<th>Ilość</th>
			<th>Cena jedn. <br/>brutto</th>
			<th>Cena brutto</th>
			<th class="price_vat">VAT</th>
			<th>Wartość <br/>VAT</th>
			<th>Cena netto</th>
		</tr>
	</thead>
<?php if($products->is_empty()): ?>
	<tbody>
		<tr>
			<td colspan="9">Brak produktów</td>
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
			<td><?php echo $v->product->unit->name ?></td>
			<td><p class="product_name"><?php echo ($v->product->unit->type == 'integer') ? (int) $v->quantity : number_format($v->quantity, 2) ?></p></td>
			<td><p class="product_name"><?php echo number_format(($v->product->price->value) *(1 + $v->product->price->vat->value),2) ?> zł</p></td>
			<td><p class="product_name"><?php echo number_format(($v->product->price->value*$v->quantity) * (1 + $v->product->price->vat->value), 2) ?> zł</p></td>
			<td><p class="product_name"><?php echo $v->product->price->vat->name ?></p></td>
			<td><p class="product_name"><?php echo number_format(($v->product->price->value*$v->quantity) * ($v->product->price->vat->value), 2) ?> zł</p></td>
			<td><p class="product_name"><?php echo number_format($v->product->price->value*$v->quantity, 2) ?> zł</p></td>
		
		</tr>
<?php endforeach ?>
		<tr>
			<td colspan="5" class="align-right">Suma</td>
			<td><b><?php echo number_format($sum_brutto, 2) ?> zł</b></td>
			<td class="price_vat"></td>
			<td><b><?php echo number_format($sum_vat, 2) ?> zł</b></td>
			<td><b><?php echo number_format($sum_netto, 2) ?> zł</b></td>
		</tr>
		</table>
		<table class="no_border">
		<tr class="no_border">
			<th class="no_border">Forma dostawy:</th>
			<td class="no_border">
				<?php echo $order->sendform->name ?>
				 - <?php echo number_format($order->sendform->value, 2) ?> zł
			</td>
		</tr>
		<tr class="no_border">
			<th class="no_border">Forma płatności:</th>
			<td class="no_border">
				<?php echo $order->meta()->fields('payment')->choices[$order->payment] ?>
			</td>
		</tr>
		<?php if ($order->payment=='transfer'): ?> // jeśli przelew pokaż numer konta
		<tr>
			<th class="no_border">Numer konta:</th>
			<td class="no_border">
				<?php echo $company->account ?>
			</td>
		</tr>
		<?php endif?>
		<tr class="no_border">
			<th class="no_border">Do zapłaty:</th>
			<td class="no_border">
				Brutto: <b><?php echo number_format($sum_brutto_plus, 2) ?> zł</b><br/>
				Słownie: <?php echo text::number_to_text($sum_brutto_plus)?>
				
			</td>
		</tr>
		
		</tbody>

<?php endif ?>
	</table></div>
	<div>
	<table class="sign_border"><tr>
	<td class="no_border"><small>Podpis osoby <br/>upoważnionej do wystawienia faktury</small></td><td class="no_border" align="right"><small> Podpis osoby <br/>upoważnionej do otrzymania faktury</small></td>
	</tr></table></div>
</body>
</html>
