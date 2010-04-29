<?php defined('SYSPATH') or die('No direct script access.'); ?>


<table>
<caption><?php echo html::anchor('admin/clients/create', 'Dodaj nowego klienta') ?></caption>
<thead>
	<tr>
		<td>Imie</td>
		<td>Nazwisko</td>
		<td>E-mail</td>
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
			<?php echo html::anchor('admin/clients/update.'.$client->id, 'Edytuj') ?>
			<?php echo html::anchor('admin/clients/delete.'.$client->id, 'Usuń', array('class' => 'unsafe')) ?>
		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>