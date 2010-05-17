<p>Lista produktów w tej kategorii:</p>
<?php defined('SYSPATH') or die('No direct script access.'); ?>
<table>
<thead>
	<tr>
		<td>Nazwa</td>
		<td>Opis</td>
		<td>Iloœæ</td>
		<td>Cena</td>
		<td></td>
	</tr>
</thead>
<tbody>
<?php foreach($products as $v):  ?>
		<tr>
			<td>[<?php echo $v->id ?>] <?php echo $v->name ?></td>
			<td><p><?php echo $v->description ?></p></td>
			<td><p><?php echo $v->quantity ?> <?php echo $v->unit->name ?></p></td>
			<td><p><?php echo $v->price_id ?> z³</p></td>
			
		</tr>
<?php endforeach ?>
</tbody>
</table>