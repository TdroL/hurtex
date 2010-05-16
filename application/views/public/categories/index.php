<?php if(!empty($tree[$parent])): ?>
<ul>
<?php foreach($tree[$parent] as $v): ?>
<?php if($v->id == 0) continue ?>
	<li>
		<?php echo html::anchor('products/category.'.$v->id, $v->title) ?>
<?php if(!empty($tree[$v->id])): ?>
		<?php echo View::factory('public/categories/index')
						->set(array(
							'tree' => $tree,
							'parent' => $v->id,
						)) ?>
<?php endif ?>
	</li>
<?php endforeach ?>
</ul>
<?php endif ?>
