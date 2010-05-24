<?php defined('SYSPATH') or die('No direct script access.'); ?>


<table>
<thead>
	<tr>
		<td>Nr paragonu</td>
		<td>Faktura</td>
		<td>Data</td>
		<td>Klient</td>
		<td>Adres</td>
		<td>Operacje</td>
	</tr>
</thead>
<tbody>
<?php foreach($orders as $order): ?>
	<tr>
		<td><?php echo $order->paragon_number ?></td>
		<td><?php echo $order->invoice ?></td>
		<td><?php echo date($order->meta()->fields('date')->pretty_format, $order->date) ?></td>
		<td><?php echo $order->client->second_name ?> <?php echo $order->client->first_name ?></td>
		<td><?php echo nl2br(html::chars($order->address)) ?></td>
		<td>
			<?php echo html::anchor('admin/orders/update.'.$order->id, 'Edytuj') ?>
			<?php echo html::anchor('admin/orders/delete.'.$order->id, 'Usuń', array('class' => 'unsafe')) ?>
		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>