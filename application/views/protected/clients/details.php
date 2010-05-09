<?php defined('SYSPATH') or die('No direct script access.'); ?>

						<table>
							<caption>Szczegóły klienta</caption>

							<?php echo html::error_messages($errors) ?>

							<tr>
								<td><?php echo "Imię: " ?></td>
								<td>
									<?php echo $client->first_name ?>
								</td>
							</tr>
							
							<tr>
								<td><?php echo "Nazwisko: " ?></td>
								<td>
									<?php echo $client->second_name ?>
								</td>
							</tr>
							
							<tr>
								<td><?php echo "E-mail: " ?></td>
								<td>
									<?php echo $client->email ?>
								</td>
							</tr>
							
							<tr>
								<td><?php echo "Adres: " ?></td>
								<td>
									<?php echo $client->address ?>
								</td>
							</tr>
							
							<tr>
								<td><?php echo "Numer telefonu: " ?></td>
								<td>
									<?php echo $client->phone_number ?>
								</td>
							</tr>
							
							<tr>
								<td><?php echo "Nazwa firmy: " ?></td>
								<td>
									<?php echo $client->company_name ?>
								</td>
							</tr>
							
							<tr>
								<td><?php echo "Numer NIP: " ?></td>
								<td>
									<?php echo $client->nip ?>
								</td>
							</tr>
						</table>
