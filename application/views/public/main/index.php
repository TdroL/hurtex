<?php defined('SYSPATH') or die('No direct script access.'); ?>

<?php foreach($products as $v): ?>
<p>
	<b><?php echo $v->title ?></b><br />
	<?php echo $v->description ?>
</p><hr />
<?php endforeach ?>

<p>Plik wyglądu main/index</p>
<pre>Kawałek kodu w tagach</pre>