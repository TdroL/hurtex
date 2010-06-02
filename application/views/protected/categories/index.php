<?php defined('SYSPATH') or die('No direct script access.'); ?>


<table>
<caption><?php echo html::anchor('admin/categories/create', 'Dodaj nową kategorię') ?></caption>
<thead>
	<tr>
		<td>Tytuł<br />
			<?php echo html::anchor('admin/categories/index/sort-by-title-asc', '&and;') ?>
			<?php echo html::anchor('admin/categories/index/sort-by-title-desc', '&or;') ?>
		</td>
		<td>Kategoria nadrzędna<br />
			<?php echo html::anchor('admin/categories/index/sort-by-category-asc', '&and;') ?>
			<?php echo html::anchor('admin/categories/index/sort-by-category-desc', '&or;') ?>
		</td>
		<td>Operacje</td>
	</tr>
</thead>
<tbody>
<?php foreach($categories as $category): ?>
<?php if(!$category->category->loaded()) continue ?>
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

<?php if(!empty($paginate)): ?>
	<div class="paginate">
		<?php echo $paginate ?>
	</div>
<?php endif ?>