<?php defined('SYSPATH') or die('No direct script access.'); ?>

<h1>Braki produktów</h1>
<?php echo Request::load('admin/warehouse/deficient') ?>

<h1>Nowe zamówienia</h1>
<?php echo Request::load('admin/orders/added') ?>