<h4>Lista produktów w tej kategorii:</h4>
<?php defined('SYSPATH') or die('No direct script access.'); ?>
<table class="art-article">
<thead>
	<tr>
		<td></td>
		<td>Nazwa produktu</td>
		<td>Ilość</td>
		<td>Cena</td>
		<td></td>
	</tr>
</thead>
<tbody>
<?php foreach($products as $v):  ?>
		<tr>
			<td> <img src ="<?php echo url::site('media/images/products/$v->image') ?>"/></td>
			<td><b><?php echo $v->name ?></b><br />
			<p class="description"><?php echo $v->description ?></p>
			</td>
			<td><p><?php echo $v->quantity ?> <?php echo $v->unit->name ?></p></td>
			<td><p><?php echo $v->price->value ?> zł</p></td>
			<td><div class="art-button">Dodaj</div></td>
		</tr>
<?php endforeach ?>
</tbody>
</table>