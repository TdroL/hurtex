<?php defined('SYSPATH') or die('No direct script access.'); ?>

				<?php echo form::open('admin/users/create') ?>
					<fieldset>
						
						<table>
							<caption>Dodaj użytkownika</caption>
							
							<?php echo html::error_messages($errors) ?>

							<tr>
								<td><?php echo $form->label('username') ?></td>
								<td>
									<?php echo $form->input('username') ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('password') ?></td>
								<td>
									<?php echo $form->input('password') ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('password_confirm') ?></td>
								<td>
									<?php echo $form->input('password_confirm') ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('roles') ?></td>
								<td>
									<?php echo $form->input('roles') ?>
								</td>
							</tr>

							<tr>
								<td></td>
								<td>
									<?php echo form::submit('send', 'Wyślij') ?>
								</td>
							</tr>
						</table>
					<?php echo form::hidden('seed', md5($request->uri().time())) ?>
					</fieldset>
				<?php echo form::close() ?>


