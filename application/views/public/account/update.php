<?php defined('SYSPATH') or die('No direct script access.'); ?>
	
	<h1>Dane klienta</h1>
		
	<div>
		<small>* pola wymagane</small><br /><br />
	</div>
		
	<?php echo form::open('account/update') ?>
	<?php echo html::error_messages($errors) ?>
		<fieldset>
			<legend><?php echo $form->label('first_name') ?>*</legend>
			<?php echo $form->input('first_name') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $form->label('second_name') ?>*</legend>
			<?php echo $form->input('second_name') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $form->label('email') ?>*</legend>
			<?php echo $form->input('email') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $form->label('email_confirm') ?>*</legend>
			<?php echo $form->input('email_confirm') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $form->label('password') ?>*</legend>
			<?php echo $form->input('password') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $form->label('password_confirm') ?>*</legend>
			<?php echo $form->input('password_confirm') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $form->label('address') ?>*</legend>
			<?php echo $form->input('address') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $form->label('phone_number') ?>*</legend>
			<?php echo $form->input('phone_number') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $form->label('company_name') ?></legend>
			<?php echo $form->input('company_name') ?>
		</fieldset>
		<fieldset>
			<legend><?php echo $form->label('nip') ?></legend>
			<?php echo $form->input('nip') ?>
		</fieldset>
		
		<?php echo form::submit('send', 'Zarejestruj') ?>
		<?php echo form::hidden('seed', md5($request->uri().time())) ?>
	<?php echo form::close() ?>