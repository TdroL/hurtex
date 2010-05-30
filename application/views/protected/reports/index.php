<?php defined('SYSPATH') or die('No direct script access.'); ?>

<?php echo form::open() ?>
<h1>Raporty sprzedarzy</h1>
<dl>
<?php if(!empty($errors)): ?>
	<table>
		<?php echo html::error_messages($errors) ?>
	</table>
<?php endif ?>
	<dt>Od</dt>
	<dd><?php echo form::input('date_start', $_POST['date_start']) ?></dd>
	
	<dt>Do</dt>
	<dd><?php echo form::input('date_end', $_POST['date_end']) ?></dd>
	
	<dd><?php echo form::submit('show', 'Wyświetl') ?></dd>
</dl>
<?php echo form::close() ?>

<table>
	<caption>
		Raport sprzedarzy od
		<?php echo $_POST['date_start'] ?>
		do
		<?php echo $_POST['date_end'] ?>
	</caption>
<thead>
	<tr>
		<td>Produkt</td>
		<td>Il.</td>
		<td>J.m.</td>
		<td>Netto</td>
	</tr>
</thead>
<tbody>
<?php foreach($products as $product_price): ?>
	<?php foreach($product_price as $product): ?>
	<tr>
		<td><?php echo $product->product->name ?></td>
		<td><?php echo $product->quantity ?></td>
		<td><?php echo $product->product->unit->name ?></td>
		<td>
			<?php echo number_format($product->product->price->value * $product->quantity, 2) ?>
			zł
		</td>
	</tr>
	<?php endforeach ?>
<?php endforeach ?>
</tbody>
<tfoot>
	<tr>
		<td colspan="3" class="align-right">Suma</td>
		<td><?php echo number_format($sum_netto, 2) ?> zł</td>
	</tr>
</tfoot>
</table>