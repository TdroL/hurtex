<?php defined('SYSPATH') or die('No direct script access.'); ?>

<?php foreach($wpisy as $wpis): ?>
<p>
	<b><?php echo $wpis->autor ?></b><br />
	<?php echo $wpis->tresc ?>
</p><hr />
<?php endforeach ?>

<p>Plik wyglądu main/index</p>
<pre>Kawałek kodu w tagach &lt;pre /&gt;</pre>