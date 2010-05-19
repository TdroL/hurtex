<?php defined('SYSPATH') or die('No direct script access.'); ?>
	
	<h1>Dane klienta</h1>
		
	<div>
		<small>* pola wymagane</small><br /><br />
	</div>
		
	<?php echo form::open('account/update') ?>
	<?php echo html::error_messages($errors) ?>
		<table>
		<tr><td><legend><?php echo $form->label('first_name') ?>*</legend></td>
			<td><?php echo $form->input('first_name') ?></td>
		</tr>
		<tr><td><legend><?php echo $form->label('second_name') ?>*</legend></td>
			<td><?php echo $form->input('second_name') ?><td>
		</tr>
		<tr><td><legend><?php echo $form->label('email') ?>*</legend></td>
			<td><?php echo $form->email ?></td>
		</tr>
		<tr><td><legend><?php echo $form->label('password') ?>*</legend></td>
			<td><?php echo $form->input('password') ?></td>
		</tr>
		<tr><td><legend><?php echo $form->label('password_confirm') ?>*</legend></td>
			<td><?php echo $form->input('password_confirm') ?></td>
		</tr>
		<tr><td><legend><?php echo $form->label('address') ?>*</legend></td>
			<td><?php echo $form->input('address') ?></td>
		</tr>
		<tr><td><legend><?php echo $form->label('phone_number') ?>*</legend></td>
			<td><?php echo $form->input('phone_number') ?></td>
		</tr>
		<tr><td><legend><?php echo $form->label('company_name') ?></legend></td>
			<td><?php echo $form->input('company_name') ?></td>
		</tr>
		<tr><td><legend><?php echo $form->label('nip') ?></legend></td>
			<td><?php echo $form->input('nip') ?></td>
		</tr>
		</table>
		<?php echo form::submit('send', 'Zapisz') ?>
		<?php echo form::hidden('seed', md5($request->uri().time())) ?>
	<?php echo form::close() ?>