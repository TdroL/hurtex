<?php defined('SYSPATH') or die('No direct script access.'); ?>

<table>
<thead>
	<tr>
		<td>Nazwa<br />
			<?php echo html::anchor('admin/warehouse/index/sort-by-name-asc', '&and;') ?>
			<?php echo html::anchor('admin/warehouse/index/sort-by-name-desc', '&or;') ?>
		</td>
		<td>Ilość<br />
			<?php echo html::anchor('admin/warehouse/index/sort-by-quantity-asc', '&and;') ?>
			<?php echo html::anchor('admin/warehouse/index/sort-by-quantity-desc', '&or;') ?>
		</td>
		<td>Ilość&nbsp;minimalna<br />
			<?php echo html::anchor('admin/warehouse/index/sort-by-minimal_quantity-asc', '&and;') ?>
			<?php echo html::anchor('admin/warehouse/index/sort-by-minimal_quantity-desc', '&or;') ?>
		</td>
		<td>J.m.</td>
		<td>Operacje</td>
	</tr>
</thead>
<tbody>
<?php foreach($products as $product): ?>
	<tr>
		<td><?php echo html::anchor('admin/products/details.'.$product->id, $product->name) ?></td>
		<td><?php echo $product->quantity ?></td>
		<td><?php echo $product->minimal_quantity ?></td>
		<td><?php echo $product->unit->name ?></td>
		<td>
			<?php echo html::anchor('admin/warehouse/update.'.$product->id, 'Edytuj') ?>
<?php if($product->count_active_supplies()): ?>
			Zgłoszony
<?php else: ?>
			<?php echo html::anchor('admin/supplies/create.'.$product->id, 'Zgłoś', array('title' => 'Zgłoś zapotrzebowanie')) ?>
<?php endif ?>
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