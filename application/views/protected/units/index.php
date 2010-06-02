<?php defined('SYSPATH') or die('No direct script access.'); ?>


<table>
<caption><?php echo html::anchor('admin/units/create', 'Dodaj nową jednostkę') ?></caption>
<thead>
	<tr>
		<td>Nazwa</td>
		<td>Typ</td>
		<td>Operacje</td>
	</tr>
</thead>
<tbody>
<?php foreach($units as $unit): ?>
	<tr>
		<td><?php echo $unit->name ?></td>
		<td><?php echo $unit->meta()->fields('type')->choices[$unit->type] ?></td>
		<td>
			<?php echo html::anchor('admin/units/update.'.$unit->id, 'Edytuj') ?>
			<?php echo html::anchor('admin/units/delete.'.$unit->id, 'Usuń') ?>
		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>

<?php if(!empty($paginate)): ?>
	<div class="paginate">
		<?php echo $paginate ?>
	</div>
<?php endif ?>