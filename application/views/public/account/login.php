						<?php echo form::open('account/login'.$from) ?>
<?php if(isset($error)): ?>
							<dl>
								<dt>Błąd</dt>
								<dd>Niepoprawny login lub hasło</dd>
							</dl>
<?php endif ?>
							<dl>
								<dt><label for="field-header-email">Email:</label></dt>
								<dd><input type="text" name="email" id="field-header-email" /></dd>
							</dl>
							
							<dl>
								<dt><label for="field-header-password">Hasło:</label></dt>
								<dd><input type="password" name="password" id="field-header-password" /></dd>
							</dl>
							
							<dl>
								<dd>
									<input class="art-button" type="submit" name="send" value="Zaloguj" />
								</dd>
								<dd>
									<div>
										<?php echo html::anchor('account/create', 'Zarejestruj')?>
									</div>
									<div>
										<?php echo html::anchor('account/recover', 'Przypomnij hasło') ?>
									</div>
								</dd>
							</dl>
						<?php echo form::close() ?>