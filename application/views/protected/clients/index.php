<?php defined('SYSPATH') or die('No direct script access.'); ?>


<table>
<caption><?php echo html::anchor('admin/clients/create', 'Dodaj nowego klienta') ?></caption>
<thead>
	<tr>
		<td>Imie<br />
			<?php echo html::anchor('admin/clients/index/sort-by-first_name-asc', '&and;') ?>
			<?php echo html::anchor('admin/clients/index/sort-by-first_name-desc', '&or;') ?>
		</td>
		<td>Nazwisko<br />
			<?php echo html::anchor('admin/clients/index/sort-by-second_name-asc', '&and;') ?>
			<?php echo html::anchor('admin/clients/index/sort-by-second_name-desc', '&or;') ?>
		</td>
		<td>E-mail<br />
			<?php echo html::anchor('admin/clients/index/sort-by-email-asc', '&and;') ?>
			<?php echo html::anchor('admin/clients/index/sort-by-email-desc', '&or;') ?>
		</td>
		<td>Operacje</td>
	</tr>
</thead>
<tbody>
<?php foreach($clients as $client): ?>
	<tr>
		<td><?php echo $client->first_name ?></td>
		<td><?php echo $client->second_name ?></td>
		<td><?php echo $client->email ?></td>
		<td>
			<?php echo html::anchor('admin/clients/details.'.$client->id, 'Szczegóły') ?>
			<?php echo html::anchor('admin/clients/update.'.$client->id, 'Edytuj') ?>
			<?php echo html::anchor('admin/clients/delete.'.$client->id, 'Usuń', array('class' => 'unsafe')) ?>
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