<?php defined('SYSPATH') or die('No direct script access.'); ?>
<h4>Lista zamówień:</h4>
<table class="art-article">
<thead>
	<tr>
		<td>Lp.</td>
		<td class="quantity_width">Data</td>
		<td>Produktów</td>
		<td class="basket_width">Status</td>
	</tr>
</thead>
<tbody>
<?php if($orders->is_empty()): ?>
	<tr>
		<td colspan="4">Brak zamówień</td>
	</tr>
<?php else: ?>
<?php $i = 1; ?>
<?php foreach($orders as $v):  ?>
	<tr id="order_<?php echo !empty($v->id) ? $v->id : uniqid() ?>">
		<td><?php echo $i++ ?></td>
		<td><?php echo date($v->meta()->fields('date')->pretty_format, $v->date) ?></td>
		<td><a class="product_name" href="<?php echo url::site('account/order.'.$v->id) ?>" title="Szczegóły zamówienia"><?php echo $v->get('count_products') ?></a></td>
		<td><p class="product_name"><?php echo $v->meta()->fields('status')->choices[$v->status] ?></p></td>
	</tr>
<?php endforeach ?>
<?php endif ?>
</tbody>
</table>