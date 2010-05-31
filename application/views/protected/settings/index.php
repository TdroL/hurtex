<?php defined('SYSPATH') or die('No direct script access.'); ?>

				<?php echo form::open() ?>
					<fieldset>
						
						<table>
							<caption>Ustawienia</caption>
							
							<?php echo html::error_messages($errors) ?>

<?php if($success): ?>
							<tr class="success">
								<td colspan="2">
									<div>Dane edytowano poprawnie.</div>
								</td>
							</tr>
							
							<script>
								$('.success div').autohide();
							</script>
<?php endif ?>

							<tr>
								<td><?php echo form::label('name', $fields->name) ?></td>
								<td>
									<?php echo form::input('name', $form->name) ?>
								</td>
							</tr>

							<tr>
								<td><?php echo form::label('account', $fields->account) ?></td>
								<td>
									<?php echo form::input('account', $form->account) ?>
								</td>
							</tr>

							<tr>
								<td><?php echo form::label('address', $fields->address) ?></td>
								<td>
									<?php echo form::textarea('address', $form->address) ?>
								</td>
							</tr>

							<tr>
								<td><?php echo form::label('nip', $fields->nip) ?></td>
								<td>
									<?php echo form::input('nip', $form->nip) ?>
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