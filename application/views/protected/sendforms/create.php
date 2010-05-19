<?php defined('SYSPATH') or die('No direct script access.'); ?>

				<?php echo form::open('admin/sendforms/create') ?>
					<fieldset>
						
						<table>
							<caption>Dodaj formę wysyłki</caption>
							
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
									<?php echo $form->input('value', array('class' => 'small align-right')) ?>
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


