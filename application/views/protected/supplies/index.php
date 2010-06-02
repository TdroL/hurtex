<?php defined('SYSPATH') or die('No direct script access.'); ?>

<table>
<thead>
	<tr>
		<td>Produkt
			<?php echo html::anchor('admin/supplies/index/sort-by-product-asc', '&and;') ?>
			<?php echo html::anchor('admin/supplies/index/sort-by-product-desc', '&or;') ?>
		</td>
		<td>Ilość
			<?php echo html::anchor('admin/supplies/index/sort-by-quantity-asc', '&and;') ?>
			<?php echo html::anchor('admin/supplies/index/sort-by-quantity-desc', '&or;') ?>
		</td>
		<td>J.m.</td>
		<td>Status
			<?php echo html::anchor('admin/supplies/index/sort-by-status-asc', '&and;') ?>
			<?php echo html::anchor('admin/supplies/index/sort-by-status-desc', '&or;') ?>
		</td>
		<td>Operacje</td>
	</tr>
</thead>
<tbody>
<?php foreach($supplies as $supply): ?>
	<tr>
		<td><?php echo html::anchor('admin/supplys/details.'.$supply->product->id, $supply->product->name) ?></td>
		<td><?php echo $supply->quantity ?></td>
		<td><?php echo $supply->product->unit->name ?></td>
		<td><?php echo $supply->meta()->fields('status')->choices[$supply->status] ?></td>
		<td>
			<?php echo html::anchor('admin/supplies/update.'.$supply->id, 'Edytuj') ?>
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