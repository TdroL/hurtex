<?php defined('SYSPATH') or die('No direct script access.'); ?>

<table>
<thead>
	<tr>
		<td>Nazwa</td>
		<td>Ilość</td>
		<td>Ilość minimalna</td>
		<td>J.m.</td>
		<td>Operacje</td>
	</tr>
</thead>
<tbody>
<?php foreach($products as $product): ?>
	<tr>
		<td><?php echo $product->name ?></td>
		<td><?php echo $product->quantity ?></td>
		<td><?php echo $product->minimal_quantity ?></td>
		<td><?php echo $product->unit->name ?></td>
		<td>
			<?php echo html::anchor('admin/warehouse/order.'.$product->id, 'Zgłoś') ?>
		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>