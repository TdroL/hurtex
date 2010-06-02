<?php defined('SYSPATH') or die('No direct script access.'); ?>


<table>
<caption><?php echo html::anchor('admin/vats/create', 'Dodaj nową stawkę') ?></caption>
<thead>
	<tr>
		<td>Nazwa
			<?php echo html::anchor('admin/vats/index/sort-by-name-asc', '&and;') ?>
			<?php echo html::anchor('admin/vats/index/sort-by-name-desc', '&or;') ?>
		</td>
		<td>Wartość
			<?php echo html::anchor('admin/vats/index/sort-by-value-asc', '&and;') ?>
			<?php echo html::anchor('admin/vats/index/sort-by-value-desc', '&or;') ?>
		</td>
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
			<?php echo html::anchor('admin/vats/delete.'.$vat->id, 'Usuń', array('class' => 'unsafe')) ?>
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