<?php defined('SYSPATH') or die('No direct script access.'); ?>

				<?php echo form::open('admin/rolesgroups/delete.'.$form->id) ?>
					<fieldset>

						<table>
							<caption>Usuń grupę</caption>

							<?php echo html::error_messages($errors) ?>

							<tr>
								<td><?php echo $form->label('name') ?></td>
								<td>
									<?php echo $form->name ?>
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


