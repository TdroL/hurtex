<?php defined('SYSPATH') or die('No direct script access.'); ?>

<table>
<caption><?php echo html::anchor('admin/products/create', 'Dodaj nowy produkt') ?></caption>
<thead>
	<tr>
		<td>Nazwa<br />
			<?php echo html::anchor('admin/products/index/sort-by-name-asc', '&and;') ?>
			<?php echo html::anchor('admin/products/index/sort-by-name-desc', '&or;') ?>
		</td>
		<td>Kategoria<br />
			<?php echo html::anchor('admin/products/index/sort-by-category-asc', '&and;') ?>
			<?php echo html::anchor('admin/products/index/sort-by-category-desc', '&or;') ?>
		</td>
		<td>Ilość<br />
			<?php echo html::anchor('admin/products/index/sort-by-quantity-asc', '&and;') ?>
			<?php echo html::anchor('admin/products/index/sort-by-quantity-desc', '&or;') ?>
		</td>
		<td class ="price_width">Cena netto<br />
			<?php echo html::anchor('admin/products/index/sort-by-price-asc', '&and;') ?>
			<?php echo html::anchor('admin/products/index/sort-by-price-desc', '&or;') ?>
		</td>
		<td>Vat</td>
		<td>Operacje</td>
	</tr>
</thead>
<tbody>
<?php foreach($products as $product): ?>
	<tr>
		<td><?php echo $product->name ?></td>
		<td><?php echo $product->category->title ?></td>
		<td><?php echo $product->quantity ?> <?php echo $product->unit->name ?></td>
		<td><?php echo number_format($product->price->value, 2) ?> zł</td>
		<td><?php echo $product->price->vat->name ?></td>
		<td>
			<?php echo html::anchor('admin/products/update.'.$product->id, 'Edytuj') ?>
			<?php echo html::anchor('admin/products/delete.'.$product->id, 'Usuń', array('class' => 'unsafe')) ?>
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