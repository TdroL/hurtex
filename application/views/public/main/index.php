<?php defined('SYSPATH') or die('No direct script access.'); ?>

<?php foreach($products as $v): ?>
<p>
	<b><?php echo $v->title ?></b><br />
	<?php echo $v->description ?>
</p><hr />
<?php endforeach ?>

<?php echo form::open('#') ?>
<fieldset>
	<dl>
		<dt><?php echo $form->label('name') ?></dt>
		<dd><?php echo $form->input('name') ?></dd>
		
		<dt><?php echo $form->label('description') ?></dt>
		<dd><?php echo $form->input('description') ?></dd>
		
		<dt><?php echo $form->label('category') ?></dt>
		<dd><?php echo $form->input('category') ?></dd>
		
		<dt><?php echo $form->label('unit') ?></dt>
		<dd><?php echo $form->input('unit') ?></dd>
		
		<dt><?php echo $form->label('quantity') ?></dt>
		<dd><?php echo $form->input('quantity') ?></dd>
		
		<dt><?php echo $form->label('minimal_quantity') ?></dt>
		<dd><?php echo $form->input('minimal_quantity') ?></dd>
		
		<dt><?php echo $form->label('price') ?></dt>
		<dd><?php echo $form->input('price') ?></dd>
		
		<?php echo form::submit('send', 'Send') ?>
	</dl>
</fieldset>
<?php echo form::close() ?>