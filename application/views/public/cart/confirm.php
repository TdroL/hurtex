<?php defined('SYSPATH') or die('No direct script access.'); ?>
<h4>Koszyk</h4>
<?php echo form::open('cart/order') ?>
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
	<tr id="product_<?php echo !empty($v->id) ? $v->id : uniqid() ?>">
		<td><p>
			<a class="product_name" href="<?php echo url::site('products/details.'.$v->id) ?>"><b><?php echo $v->name ?></b></a>
		</p></td>
		<td ><p class="product_name">
				<?php echo ($v->unit->type == 'integer') ? (int) $quantity[$v->id] : number_format($quantity[$v->id], 2) ?>
				<?php echo $v->unit->name ?>
		</p></td>
		<td><p class="product_name"><?php echo number_format($v->price->value*$quantity[$v->id], 2) ?> zł</p></td>
		<td><p class="product_name"><?php echo $v->price->vat->name ?></p></td>
		<td><p class="product_name"><?php echo number_format(($v->price->value*$quantity[$v->id]) * (1 + $v->price->vat->value), 2) ?> zł</p></td>
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
		<td class="align-right">Faktura</td>
		<td colspan="4">
			<?php echo $order->invoice ? 'Tak' : 'Nie' ?>
<?php if(empty($controller->user->nip)): ?>
			<small>Pamiętaj aby uzupełnić NIP w profilu.</small>
<?php endif ?>
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
</tbody>
<tfoot>
	<tr>
		<td>
			<?php echo form::submit('back-step-1', 'Wróć', array('class' => 'art-button')) ?>
		</td>
		<td colspan="4" class="align-right">
			<?php echo form::submit('next-step-2', 'Zamów', array('class' => 'art-button')) ?>
		</td>
	</tr>
</tfoot>
<?php endif ?>
</table>
<?php echo form::close() ?>