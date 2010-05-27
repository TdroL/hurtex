<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo View::factory('protected/warehouse/index')
				->set('products', $products)?>