<?php defined('SYSPATH') or die('No direct script access.'); ?>

<?php if($auth->has_role('warehouse')): ?>
	<h1>Braki produktów</h1>
	<?php echo Request::load('admin/warehouse/deficient') ?>
<?php endif ?>

<?php if($auth->has_role('orders')): ?>
	<h1>Nowe zamówienia</h1>
	<?php echo Request::load('admin/orders/added') ?>
<?php endif ?>