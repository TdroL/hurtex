<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php echo View::factory('protected/orders/index') 
				->set('orders', $orders)?>			