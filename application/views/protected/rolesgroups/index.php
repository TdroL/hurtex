<?php defined('SYSPATH') or die('No direct script access.'); ?>


<table>
<caption><?php echo html::anchor('admin/rolesgroups/create', 'Dodaj nową grupę') ?></caption>
<thead>
	<tr>
		<td>Nazwa</td>
		<td>Operacje</td>
	</tr>
</thead>
<tbody>
<?php foreach($rolesgroups as $rolesgroup): ?>
	<tr>
		<td><?php echo $rolesgroup->name ?></td>
		<td>
			<?php echo html::anchor('admin/rolesgroups/update.'.$rolesgroup->id, 'Edytuj') ?>
			<?php echo html::anchor('admin/rolesgroups/delete.'.$rolesgroup->id, 'Usuń', array('class' => 'unsafe')) ?>
		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>