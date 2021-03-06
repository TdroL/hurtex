<?php defined('SYSPATH') or die('No direct script access.'); ?>

				<?php echo form::open('admin/warehouse/update.'.$form->id) ?>
					<fieldset>
						
						<table>
							<caption>Edytuj produkt</caption>
							
							<?php echo html::error_messages($errors) ?>

							<tr>
								<td><?php echo $form->label('name') ?></td>
								<td>
									<?php echo $form->input('name') ?>
								</td>
							</tr>
							
							<tr>
								<td><?php echo $form->label('unit') ?></td>
								<td>
									<?php echo $form->input('unit') ?>
								</td>
							</tr>
							
							<tr>
								<td><?php echo $form->label('quantity') ?></td>
								<td>
									<?php echo number_format($form->quantity, $form->unit->type == 'integer' ? 0 : 2) ?>
								</td>
							</tr>
							
							<tr>
								<td><?php echo $form->label('minimal_quantity') ?></td>
								<td>
									<?php echo $form->input('minimal_quantity') ?>
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


