<?php defined('SYSPATH') or die('No direct script access.'); ?>


<table>
<caption><?php echo html::anchor('admin/vats/create', 'Dodaj nową stawkę') ?></caption>
<thead>
	<tr>
		<td>Nazwa</td>
		<td>Wartość</td>
		<td>Operacje</td>
	</tr>
</thead>
<tbody>
<?php foreach($vats as $vat): ?>
	<tr>
		<td><?php echo $vat->name ?></td>
		<td><?php echo $vat->value*100 ?>%</td>
		<td>
			<?php echo html::anchor('admin/vats/update.'.$vat->id, 'Edytuj') ?>
			<?php echo html::anchor('admin/vats/delete.'.$vat->id, 'Usuń') ?>
		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>