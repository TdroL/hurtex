<?php defined('SYSPATH') or die('No direct script access.'); ?>
<table class="art-article">
<thead>
	<tr>
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
		<td>
			<a class="product_name" href="<?php echo url::site('products/details.'.$v->id) ?>" title="Szczegóły"><b><?php echo $v->name ?></b></a>
			<p class="description"><?php echo text::limit_words($v->description, 10) ?></p>
<?php if($v->category->loaded()): ?>
			<small>Kategoria: <?php echo html::anchor('products/category.'.$v->category->id, $v->category->title) ?></small>
<?php endif ?>
		</td>
		<td><p class="product_name"><?php echo ($v->unit->type == 'integer') ? (int) $v->quantity : number_format($v->quantity, 2)?> <?php echo $v->unit->name ?></p></td>
		<td><p class="product_name"><?php echo number_format($v->price->value, 2) ?> zł</p></td>
		<td><p class="product_name" title="Dodaj do koszyka"><?php echo html::anchor('cart/add.'.$v->id, 'Dodaj', array('class' => 'ajax')) ?></p></td>
	</tr>
<?php endforeach ?>
<?php endif ?>
</tbody>
</table>
<?php if (!empty($pagination)): ?>
<p class="align-center">
	<?php echo $pagination ?>
</p>	
<?php endif ?>