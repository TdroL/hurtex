<?php defined('SYSPATH') or die('No direct script access.'); ?>

				<?php echo form::open('admin/products/update.'.$form->id) ?>
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
								<td><?php echo $form->label('category') ?></td>
								<td>
									<?php echo $form->input('category') ?>
								</td>
							</tr>
	
							<tr>
								<td><?php echo $form->label('description') ?></td>
								<td>
									<?php echo $form->input('description') ?>
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
									<?php echo $form->input('quantity') ?>
								</td>
							</tr>
							
							<tr>
								<td><?php echo $form->label('minimal_quantity') ?></td>
								<td>
									<?php echo $form->input('minimal_quantity') ?>
								</td>
							</tr>
							
							<tr>
								<td><?php echo $form->price->label('value') ?></td>
								<td>
									<?php echo $form->price->input('value') ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->price->label('vat') ?></td>
								<td>
									<?php echo $form->price->input('vat') ?>
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


