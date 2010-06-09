<?php defined('SYSPATH') or die('No direct script access.'); ?>


<table>
<thead>
	<tr>
		<td>Nr paragonu<br />
			<?php echo html::anchor('admin/orders/index/sort-by-paragon_number-asc', '&and;') ?>
			<?php echo html::anchor('admin/orders/index/sort-by-paragon_number-desc', '&or;') ?>
		</td>
		<td>Faktura<br />
			<?php echo html::anchor('admin/orders/index/sort-by-invoice-asc', '&and;') ?>
			<?php echo html::anchor('admin/orders/index/sort-by-invoice-desc', '&or;') ?>
		</td>
		<td>Data<br />
			<?php echo html::anchor('admin/orders/index/sort-by-date-asc', '&and;') ?>
			<?php echo html::anchor('admin/orders/index/sort-by-date-desc', '&or;') ?>
		</td>
		<td>Klient<br />
			<?php echo html::anchor('admin/orders/index/sort-by-second_name-asc', '&and;') ?>
			<?php echo html::anchor('admin/orders/index/sort-by-second_name-desc', '&or;') ?>
		</td>
		<td>Status<br />
			<?php echo html::anchor('admin/orders/index/sort-by-status-asc', '&and;') ?>
			<?php echo html::anchor('admin/orders/index/sort-by-status-desc', '&or;') ?>
		</td>
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
		<td><?php echo $order->meta()->fields('status')->choices[$order->status] ?>
			<br />
			<?php if ($order->status == 'accepted' and ($order->printable() or $controller->auth->has_role('admin'))): ?><p title="Wydrukuj pokwitowanie odbioru z magazynu"><?php echo html::anchor('admin/orders/printable.'.$order->id, 'Pokwitowanie')?></p> <?php endif ?>
		</td>
		<td>
			<?php echo html::anchor('admin/orders/details.'.$order->id, 'Szczegóły')?>
			<br />
			<?php echo html::anchor('admin/orders/update.'.$order->id, 'Edytuj') ?>
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