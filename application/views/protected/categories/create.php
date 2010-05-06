<?php defined('SYSPATH') or die('No direct script access.'); ?>

				<?php echo form::open('admin/categories/create') ?>
					<fieldset>
						
						<table>
							<caption>Dodaj nową kategorię</caption>
							
							<?php echo html::error_messages($errors) ?>

							<tr>
								<td><?php echo $form->label('title') ?></td>
								<td>
									<?php echo $form->input('title') ?>
								</td>
							</tr>
							
							<tr>
								<td><?php echo $form->label('category') ?></td>
								<td>
									<?php echo $form->input('category') ?>
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


