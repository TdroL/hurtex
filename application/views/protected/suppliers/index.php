<?php defined('SYSPATH') or die('No direct script access.'); ?>


<table>
<caption><?php echo html::anchor('admin/suppliers/create', 'Dodaj nowego dostawcę') ?></caption>
<thead>
	<tr>
		<td>Nazwa</td>
		<td>Adres</td>
		<td>Operacje</td>
	</tr>
</thead>
<tbody>
<?php foreach($suppliers as $supplier): ?>
	<tr>
		<td><?php echo $supplier->name ?></td>
		<td><?php echo $supplier->address ?></td>
		<td>
			<?php echo html::anchor('admin/suppliers/update.'.$supplier->id, 'Edytuj') ?>
			<?php echo html::anchor('admin/suppliers/delete.'.$supplier->id, 'Usuń') ?>
		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>