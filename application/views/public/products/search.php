<?php if(!empty($products) and !$products->is_empty()): ?>
	<h3>Wyniki wyszukiwania:</h3>
<?php echo View::factory('public/products/index')
				->set('products', $products) ?>
<?php else: ?>
	<h3>Brak wyników</h3>
	<h5>Brak wyników w zapytaniu "<?php echo html::chars($query) ?>".</h5>
<?php endif ?>