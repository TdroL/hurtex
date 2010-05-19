<?php defined('SYSPATH') or die('No direct script access.'); ?>

				<?php echo form::open('admin/vats/update.'.$form->id) ?>
					<fieldset>
						
						<table>
							<caption>Edytuj stawkę</caption>
							
							<?php echo html::error_messages($errors) ?>

							<tr>
								<td><?php echo $form->label('name') ?></td>
								<td>
									<?php echo $form->input('name') ?>
								</td>
							</tr>
	
							<tr>
								<td><?php echo $form->label('value') ?></td>
								<td>
									<?php echo $form->input('value') ?>
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


