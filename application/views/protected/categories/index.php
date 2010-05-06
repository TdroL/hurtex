<?php defined('SYSPATH') or die('No direct script access.'); ?>


<table>
<caption><?php echo html::anchor('admin/categories/create', 'Dodaj nową kategorię') ?></caption>
<thead>
	<tr>
		<td>Tytuł</td>
		<td>Kategoria nadrzędna</td>
		<td>Operacje</td>
	</tr>
</thead>
<tbody>
<?php foreach($categories as $category): ?>
<?php if($category->id == 0) continue ?>
	<tr>
		<td><?php echo $category->title ?></td>
		<td><?php echo $category->category->title ?></td>
		<td>
			<?php echo html::anchor('admin/categories/update.'.$category->id, 'Edytuj') ?>
			<?php echo html::anchor('admin/categories/delete.'.$category->id, 'Usuń') ?>
		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>