<?php defined('SYSPATH') or die('No direct script access.'); ?>
<h4>Lista produktów w tej kategorii:</h4>
<table class="art-article">
<thead>
	<tr>
		<td class="thumbnails"></td>
		<td>Nazwa produktu</td>
		<td class="quantity_width">Ilość</td>
		<td class="price_width">Cena netto</td>
		<td class="basket_width">Koszyk</td>
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
			<a class="product_name" href="<?php echo url::site('products/details.'.$v->id) ?>" title="Szczegóły"><b><?php echo $v->name ?></b></a>
			<p class="description"><?php echo text::limit_words($v->description, 10) ?></p>
		</td>
		<td><p class="product_name"><?php echo ($v->unit->type == 'integer') ? (int) $v->quantity : number_format($v->quantity, 2) ?> <?php echo $v->unit->name ?></p></td>
		<td><p class="product_name"><?php echo number_format($v->price->value, 2) ?> zł</p></td>
		<td><p class="product_name" title="Dodaj do koszyka"><?php echo html::anchor('cart/add.'.$v->id, 'Dodaj') ?></p></td>
	</tr>
<?php endforeach ?>
<?php endif ?>
</tbody>
</table>