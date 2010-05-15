
<?php foreach($categories as $v): ?>
<?php if ($v->id==0) continue;?>
	<div>
	<table>
	<a href= ><?php echo $v->title ?></a>
	<table>
	</div>
<?php endforeach ?>