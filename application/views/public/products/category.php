<?php echo View::factory('public/products/index')
				->set('products', $products)
				->set('pagination', $pagination) ?>