<?php defined('SYSPATH') or die('No direct script access.'); ?>

				<?php echo form::open('admin/orders/update.'.$form->id) ?>
					<fieldset>
						
						<table>
							<caption>Edytuj zamówienie</caption>
							
							<?php echo html::error_messages($errors) ?>

							<tr>
								<td><?php echo $form->label('paragon_number') ?></td>
								<td>
									<?php echo $form->paragon_number ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $form->label('invoice') ?></td>
								<td>
									<?php echo $form->input('invoice') ?>
								</td>
							</tr>
	
							<tr>
								<td><?php echo $form->label('date') ?></td>
								<td>
									<?php echo $form->input('date') ?>
								</td>
							</tr>
							
							<tr>
								<td><?php echo $form->label('address') ?></td>
								<td>
									<?php echo $form->input('address') ?>
								</td>
							</tr>
							
							<tr>
								<td><?php echo $form->label('status') ?></td>
								<td>
<?php if(in_array($form->status, array('canceled', 'added', 'accepted'))): ?>
									<?php echo $form->input('status') ?>
<?php else: ?>
									<?php echo $form->meta()->fields('status')->choices[$form->status] ?>
<?php endif ?>
								</td>
							</tr>
							
							<tr>
								<td><?php echo $form->label('sendform') ?></td>
								<td>
									<?php echo $form->input('sendform') ?>
								</td>
							</tr>
							
							<tr>
								<td><?php echo $form->label('orderproducts') ?></td>
								<td>
									<ul>
<?php foreach($form->orderproducts as $v): ?>
										<li>
											<div><b><?php echo $v->product->name ?></b></div>
											<div>Sztuk: <?php echo $v->quantity ?></div>
											<div>Netto (<?php echo $v->product->unit->name ?>): <?php echo $v->price->value ?> zł</div>
											<div>Brutto (VAT <?php echo $v->price->vat->name ?>): <?php echo number_format($v->price->value * (1 + $v->price->vat->value), 2) ?> zł</div>
										</li>
<?php endforeach ?>
									</ul>
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


