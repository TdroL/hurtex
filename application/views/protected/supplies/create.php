<?php defined('SYSPATH') or die('No direct script access.'); ?>

				<?php echo form::open('admin/supplies/create.'.$form->product->id) ?>
					<fieldset>
						
						<table>
							<caption>Zgłoś zapotrzebowanie</caption>
							
							<?php echo html::error_messages($errors) ?>

							<tr>
								<td><?php echo $form->label('product') ?></td>
								<td>
									<?php echo $form->product->name ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('quantity') ?></td>
								<td>
									<?php echo $form->input('quantity') ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('supplier') ?></td>
								<td>
									<?php echo $form->input('supplier') ?>
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


