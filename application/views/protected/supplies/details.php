<?php defined('SYSPATH') or die('No direct script access.'); ?>

						<table>
							<caption>Szczegóły zapotrzebowania</caption>

							<tr>
								<td><?php echo $supply->label('product') ?></td>
								<td>
									<?php echo $supply->product->name ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $supply->label('status') ?></td>
								<td>
									<?php echo $supply->meta()->fields('status')->choices[$supply->status] ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $supply->label('quantity') ?></td>
								<td>
									<?php echo number_format($supply->quantity, $supply->product->unit->type == 'integer' ? 0 : 2) ?>
								</td>
							</tr>

							<tr>
								<td><?php echo $supply->label('supplier') ?></td>
								<td>
									<?php echo $supply->supplier->name ?>
								</td>
							</tr>
						</table>


