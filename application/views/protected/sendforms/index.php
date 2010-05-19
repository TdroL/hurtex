<?php defined('SYSPATH') or die('No direct script access.'); ?>


<table>
<caption><?php echo html::anchor('admin/sendforms/create', 'Dodaj nową formę wysyłki') ?></caption>
<thead>
	<tr>
		<td>Nazwa</td>
		<td>Wartość</td>
		<td>Operacje</td>
	</tr>
</thead>
<tbody>
<?php foreach($sendforms as $sendform): ?>
	<tr>
		<td><?php echo $sendform->name ?></td>
		<td><?php echo $sendform->value ?> zł</td>
		<td>
			<?php echo html::anchor('admin/sendforms/update.'.$sendform->id, 'Edytuj') ?>
			<?php echo html::anchor('admin/sendforms/delete.'.$sendform->id, 'Usuń', array('class' => 'unsafe')) ?>
		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>