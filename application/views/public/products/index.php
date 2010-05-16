<?php foreach($products as $v):  ?>
		<div>
			<h3>[<?php echo $v->id ?>] <?php echo $v->name ?></h3>
			<p><?php echo $v->description ?></p>
		</div>
<?php endforeach ?>