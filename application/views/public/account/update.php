<?php defined('SYSPATH') or die('No direct script access.'); ?>
	
	<h1>Dane klienta</h1>
		
	<div>
		<small>* pola wymagane</small><br /><br />
	</div>
		
	<?php echo form::open('account/update') ?>
	<?php echo html::error_messages($errors) ?>
		<fieldset>
			<legend><?php echo $client->label('first_name') ?>*</legend>
			<?php echo $client->input('first_name') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $client->label('second_name') ?>*</legend>
			<?php echo $client->input('second_name') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $client->label('email') ?>*</legend>
			<?php echo $client->input('email') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $client->label('email_confirm') ?>*</legend>
			<?php echo $client->input('email_confirm') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $client->label('password') ?>*</legend>
			<?php echo $client->input('password') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $client->label('password_confirm') ?>*</legend>
			<?php echo $client->input('password_confirm') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $client->label('address') ?>*</legend>
			<?php echo $client->input('address') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $client->label('phone_number') ?>*</legend>
			<?php echo $client->input('phone_number') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $client->label('company_name') ?></legend>
			<?php echo $client->input('company_name') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $client->label('nip') ?></legend>
			<?php echo $client->input('nip') ?>
		</fieldset>
		
		<?php echo form::submit('send', 'Zarejestruj') ?>
		<?php echo form::hidden('seed', md5($request->uri().time())) ?>
	<?php echo form::close() ?>