<?php defined('SYSPATH') or die('No direct script access.'); ?>

				<?php echo form::open('admin/supplies/update.'.$form->id) ?>
					<fieldset>
						
						<table>
							<caption>Edytuj zapotrzebowanie</caption>
							
							<?php echo html::error_messages($errors) ?>

							<tr>
								<td><?php echo $form->label('product') ?></td>
								<td>
									<?php echo $form->product->name ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('status') ?></td>
<?php if(!in_array($form->status, array('done'))): ?>
								<td>
									<?php echo $form->input('status') ?>
								</td>
<?php else: ?>
								<td>
									<?php echo $form->meta()->fields('status')->choices[$form->status] ?>
								</td>
<?php endif ?>

							</tr>

							<tr>
								<td><?php echo $form->label('quantity') ?></td>
<?php if(in_array($form->status, array('added'))): ?>
								<td>
									<?php echo $form->input('quantity') ?>
								</td>
<?php else: ?>
								<td>
									<?php echo number_format($form->quantity, $form->product->unit->type == 'integer' ? 0 : 2) ?>
								</td>
<?php endif ?>
							</tr>

							<tr>
								<td><?php echo $form->label('supplier') ?></td>
<?php if(in_array($form->status, array('added'))): ?>
								<td>
									<?php echo $form->input('supplier') ?>
								</td>
<?php else: ?>
								<td>
									<?php echo $form->supplier->name ?>
								</td>
<?php endif ?>
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


