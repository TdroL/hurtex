<?php defined('SYSPATH') or die('No direct script access.'); ?>


<table>
<thead>
	<tr>
		<td>Nr paragonu</td>
		<td>Faktura</td>
		<td>Data</td>
		<td>Klient</td>
		<td>Adres</td>
		<td>Status</td>
		<td>Operacje</td>
	</tr>
</thead>
<tbody>
<?php foreach($orders as $order): ?>
	<tr>
		<td><?php echo $order->paragon_number ?></td>
		<td><?php echo $order->invoice ?: 'Brak' ?><?php if(!empty($order->invoice)): ?><br /><p title="Wersja do wydruku"><?php echo html::anchor('admin/orders/invoice.'.$order->id, 'Faktura') ?></p><?php endif ?></td>
		<td><?php echo date($order->meta()->fields('date')->pretty_format, $order->date) ?></td>
		<td><?php echo html::anchor('admin/clients/details.'.$order->client->id, $order->client->second_name.' '.$order->client->first_name) ?></td>
		<td><?php echo nl2br(html::chars($order->address)) ?></td>
		<td><?php echo $order->meta()->fields('status')->choices[$order->status] ?></td>
		<td>
			<?php echo html::anchor('admin/orders/details.'.$order->id, 'Szczegóły')?>
			<br />
			<?php echo html::anchor('admin/orders/update.'.$order->id, 'Edytuj') ?>
			<?php // echo html::anchor('admin/orders/delete.'.$order->id, 'Usuń', array('class' => 'unsafe')) ?>
		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>