<?php defined('SYSPATH') or die('No direct script access.'); ?>
<table>
<thead>
	<tr>
		<td>Nazwa produktu</td>
		<td class="quantity_width">Ilość</td>
		<td class="price_width">Cena netto</td>
		<td class="price_vat">VAT</td>
		<td class="brutto_width">Cena brutto</td>
	</tr>
</thead>
<?php if($products->is_empty()): ?>
<tbody>
	<tr>
		<td colspan="5">Brak produktów<td>
	</tr>
</tbody>
<?php else: ?>
<tbody>
<?php foreach($products as $v):  ?>
	<tr id="product_<?php echo !empty($v->product->id) ? $v->product->id : uniqid() ?>">
		<td><p>
			<a href="<?php echo url::site('admin/products/details.'.$v->product->id) ?>"><b><?php echo $v->product->name ?></b></a>
		</p></td>
		<td ><p >
				<?php echo ($v->product->unit->type == 'integer') ? (int) $v->quantity : number_format($v->quantity, 2) ?>
				<?php echo $v->product->unit->name ?>
		</p></td>
		<td><p><?php echo number_format($v->product->price->value*$v->quantity, 2) ?> zł</p></td>
		<td><p><?php echo $v->product->price->vat->name ?></p></td>
		<td><p><?php echo number_format(($v->product->price->value*$v->quantity) * (1 + $v->product->price->vat->value), 2) ?> zł</p></td>
	</tr>
<?php endforeach ?>
	<tr>
		<td colspan="2" class="align-right"><b>Suma</b></td>
		<td><b><?php echo number_format($sum_netto, 2) ?> zł</b></td>
		<td></td>
		<td><b><?php echo number_format($sum_brutto, 2) ?> zł</b></td>
	</tr>
	<tr>
		<td class="align-right">Klient</td>
		<td colspan="4">
			<?php echo $order->client->second_name ?> <?php echo $order->client->first_name ?>
		</td>
	</tr>
	<tr>
		<td class="align-right">Forma dostawy</td>
		<td colspan="4">
			<?php echo $order->sendform->name ?>
			 - <?php echo number_format($order->sendform->value, 2) ?> zł
			 <?php if($order->sendform->name == 'Odbiór osobisty' && $order->status == 'accepted'): ?> <?php echo html::anchor('admin/orders/printable2.' .$order->id, 'Pokwitowanie', array('title' => 'Wydrukuj potwierdzenie wydania towarów')) ?><?php endif ?>
		</td>
	</tr>
	<tr>
		<td class="align-right">Forma płatności</td>
		<td colspan="4">
			<?php echo $order->meta()->fields('payment')->choices[$order->payment] ?>
		</td>
	</tr>
	<?php if ($order->sendform->name != "Odbiór osobisty"): ?>
	<tr>
		<td class="align-right"><?php echo html::anchor('admin/orders/address.' .$order->id,'Adres dostawy', array('title' => 'Wydrukuj adres dostawy')) ?></td>
		<td colspan="4">
			<?php echo nl2br(html::chars($order->address)) ?>
		</td>
	</tr>
	<?php endif ?>
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

<?php endif ?>
<?php endif ?>
</table>
