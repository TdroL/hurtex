<?php defined('SYSPATH') or die('No direct script access.'); ?>

				<?php echo form::open('admin/suppliers/update.'.$form->id) ?>
					<fieldset>

						<table>
							<caption>Edytuj dostawcę</caption>

							<?php echo html::error_messages($errors) ?>

							<tr>
								<td><?php echo $form->label('name') ?></td>
								<td>
									<?php echo $form->input('name') ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('address') ?></td>
								<td>
									<?php echo $form->input('address') ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('products') ?></td>
								<td>
									<?php echo $form->input('products') ?>
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


