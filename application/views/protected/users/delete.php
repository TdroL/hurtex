<?php defined('SYSPATH') or die('No direct script access.'); ?>

				<?php echo form::open('admin/users/delete.'.$form->id) ?>
					<fieldset>

						<table>
							<caption>Usuń użytkownika</caption>

							<?php echo html::error_messages($errors) ?>

							<tr>
								<td><?php echo $form->label('username') ?></td>
								<td>
									<?php echo $form->username ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('roles') ?></td>
								<td>
									<br />
									<ul>
									<?php foreach($form->roles as $role): ?>
										<li><?php echo $role->name ?></li>
									<?php endforeach ?>
									</ul>
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


