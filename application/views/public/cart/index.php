<?php defined('SYSPATH') or die('No direct script access.'); ?>
<h4>Koszyk</h4>
<?php echo form::open('cart') ?>
<table class="art-article">
<thead>
	<tr>
		<td class="thumbnails"></td>
		<td>Nazwa produktu</td>
		<td>Ilość</td>
		<td class="price_width">Cena</td>
		<td>Opcje</td>
	</tr>
</thead>
<tbody>
<?php if($products->is_empty()): ?>
	<tr>
		<td colspan="5">Brak produktów</td>
	</tr>
<?php else: ?>
<?php foreach($products as $v):  ?>
	<tr id="product_<?php echo !empty($v->id) ? $v->id : uniqid() ?>">
		<td><?php echo html::image('media/images/products/'.$v->image, array('title' => $v->name, 'width' => 100)) ?></td>
		<td>
			<a class="product_name" href="<?php echo url::site('products/details.'.$v->id) ?>"><b><?php echo $v->name ?></b></a>
			<p class="description"><?php echo text::limit_words($v->description, 10) ?></p>
		</td>
		<td>
			<p class="product_name">
				<?php echo form::input('product['.$v->id.']', ($v->unit->type == 'integer') ? (int) $quantity[$v->id] : number_format($quantity[$v->id], 2), array('class' => 'input_width')) ?>
				<?php echo $v->unit->name ?>
			</p>
		</td>
		<td><p class="product_name"><?php echo number_format($v->price->value*$quantity[$v->id], 2) ?> zł</p></td>
		<td><div class="art-button" title="Usuń z koszyka"><?php echo html::anchor_confirm('cart/remove.'.$v->id, 'Usuń', 'Czy chcesz usunąć ten produkt z koszyka?') ?></div></td>
	</tr>
<?php endforeach ?>
<?php endif ?>
</tbody>
<tfoot>
	<tr>
	<td>Wybór opcji zapłaty: <?php echo $order->input("payment") ?>
	</td>
	
	</tr>
	<tr>
		<td colspan="3">
			<?php echo form::submit('recount', 'Przelicz', array('class' => 'art-button')) ?>
		</td>
		<td colspan="2" class="align-center">
			<?php echo form::submit('order', 'Zamów', array('class' => 'art-button')) ?>
		</td>
	</tr>
</tfoot>
</table>
<?php echo form::close() ?>