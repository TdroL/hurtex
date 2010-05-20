<?php defined('SYSPATH') or die('No direct script access.'); ?>

				<?php echo form::open('admin/products/delete.'.$form->id) ?>
					<fieldset>

						<table>
							<caption>Usuń produkt</caption>

							<?php echo html::error_messages($errors) ?>

							<tr>
								<td><?php echo $form->label('name') ?></td>
								<td>
									<?php echo $form->name ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('category') ?></td>
								<td>
									<?php echo $form->category->title ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('description') ?></td>
								<td>
									<?php echo $form->description ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('unit') ?></td>
								<td>
									<?php echo $form->unit->name ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('quantity') ?></td>
								<td>
									<?php echo $form->quantity ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('minimal_quantity') ?></td>
								<td>
									<?php echo $form->minimal_quantity ?>
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


