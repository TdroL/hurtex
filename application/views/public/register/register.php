<?php defined('SYSPATH') or die('No direct script access.'); ?>
	<?php echo form::open('register/register') ?>
	<?php echo html::error_messages($errors) ?>
		<fieldset>
			<legend><?php echo $clients->label('first_name') ?></legend>
			<?php echo $clients->input('first_name') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $clients->label('second_name') ?></legend>
			<?php echo $clients->input('second_name') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $clients->label('email') ?></legend>
			<?php echo $clients->input('email') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $clients->label('password') ?></legend>
			<?php echo $clients->input('password') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $clients->label('address') ?></legend>
			<?php echo $clients->input('address') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $clients->label('company_name') ?></legend>
			<?php echo $clients->input('company_name') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $clients->label('nip') ?></legend>
			<?php echo $clients->input('nip') ?>
		</fieldset>
		
		
		
		<?php echo form::submit('send', 'Zarejestruj') ?>
	<?php echo form::close() ?>