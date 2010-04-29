<?php defined('SYSPATH') or die('No direct script access.'); ?>

				<?php echo form::open('admin/clients/update.'.$form->id) ?>
					<fieldset>

						<table>
							<caption>Edytuj klienta</caption>

							<?php echo html::error_messages($errors) ?>

							<tr>
								<td><?php echo $form->label('first_name') ?></td>
								<td>
									<?php echo $form->input('first_name') ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('second_name') ?></td>
								<td>
									<?php echo $form->input('second_name') ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('address') ?></td>
								<td>
									<?php echo $form->input('address') ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('phone_number') ?></td>
								<td>
									<?php echo $form->input('phone_number') ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('company_name') ?></td>
								<td>
									<?php echo $form->input('company_name') ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('nip') ?></td>
								<td>
									<?php echo $form->input('nip') ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('email') ?></td>
								<td>
									<?php echo $form->input('email') ?>
								</td>
							</tr>

							<tr>
							<td></td>
							<td><small>Jeśli nie chcesz zmieniać e-maila, pozostaw poniższe pole puste.</small></td>
							</tr>

							<tr>
								<td><?php echo $form->label('email_confirm') ?></td>
								<td>
									<?php echo $form->input('email_confirm') ?>
								</td>
							</tr>

							<tr>
								<td>
									<?php echo $form->label('password') ?>
								</td>
								<td>
									<?php echo $form->input('password') ?>
								</td>
							</tr>

							<tr>
							<td></td>
							<td><small>Jeśli nie chcesz zmieniać hasła, pozostaw poniższe pole puste.</small></td>
							</tr>

							<tr>
								<td><?php echo $form->label('password_confirm') ?></td>
								<td>
									<?php echo $form->input('password_confirm') ?>
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


