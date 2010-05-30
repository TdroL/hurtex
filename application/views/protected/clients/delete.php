<?php defined('SYSPATH') or die('No direct script access.'); ?>

				<?php echo form::open('admin/clients/delete.'.$form->id) ?>
					<fieldset>

						<table>
							<caption>Usuń klienta</caption>

							<?php echo html::error_messages($errors) ?>

							<tr>
								<td><?php echo $form->label('first_name') ?></td>
								<td>
									<?php echo $form->first_name ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('second_name') ?></td>
								<td>
									<?php echo $form->second_name ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('address') ?></td>
								<td>
									<?php echo nl2br(html::chars($form->address)) ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('phone_number') ?></td>
								<td>
									<?php echo $form->phone_number ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('company_name') ?></td>
								<td>
									<?php echo $form->company_name ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('nip') ?></td>
								<td>
									<?php echo $form->nip ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('email') ?></td>
								<td>
									<?php echo $form->email ?>
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


