<?php defined('SYSPATH') or die('No direct script access.'); ?>

<table>
<caption><?php echo html::anchor('admin/warehouse/supply', 'Zapotrzebowanie') ?></caption>
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
			<?php echo html::anchor('admin/products/update.'.$product->id, 'Edytuj').PHP_EOL ?>
			<?php echo html::anchor('admin/products/delete.'.$product->id, 'Usuń', array('class' => 'unsafe')).PHP_EOL ?>
		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>