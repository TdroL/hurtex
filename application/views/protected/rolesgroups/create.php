<?php defined('SYSPATH') or die('No direct script access.'); ?>

				<?php echo form::open('admin/rolesgroups/create') ?>
					<fieldset>
						
						<table>
							<caption>Dodaj grupę</caption>
							
							<?php echo html::error_messages($errors) ?>

							<tr>
								<td><?php echo $form->label('name') ?></td>
								<td>
									<?php echo $form->input('name') ?>
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


