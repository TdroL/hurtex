<?php defined('SYSPATH') or die('No direct script access.'); ?>


<table>
<caption><?php echo html::anchor('admin/products/create', 'Dodaj nowy produkt') ?></caption>
<thead>
	<tr>
		<td>Nazwa</td>
		<td>Kategoria</td>
		<td>Ilość</td>
		<td>Cena</td>
		<td>Vat</td>
		<td>Operacje</td>
	</tr>
</thead>
<tbody>
<?php foreach($products as $product): ?>
	<tr>
		<td><?php echo $product->name ?></td>
		<td><?php echo $product->category->title ?></td>
		<td><?php echo $product->quantity ?> <?php echo $product->unit->name ?></td>
		<td><?php echo number_format($product->price->value, 2) ?> zł</td>
		<td><?php echo $product->price->vat->name ?></td>
		<td>
			<?php echo html::anchor('admin/products/update.'.$product->id, 'Edytuj') ?>
			<?php echo html::anchor('admin/products/delete.'.$product->id, 'Usuń', array('class' => 'unsafe')) ?>
		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>