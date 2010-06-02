<?php defined('SYSPATH') or die('No direct script access.'); ?>


<table>
<caption><?php echo html::anchor('admin/users/create', 'Dodaj nowego użytkownika') ?></caption>
<thead>
	<tr>
		<td>Login</td>
		<td>Ostatnio zalogowany</td>
		<td>Operacje</td>
	</tr>
</thead>
<tbody>
<?php foreach($users as $user): ?>
	<tr>
		<td><?php echo $user->username ?></td>
		<td><?php echo date('Y-m-d H:i:s', $user->last_login) ?></td>
		<td>
			<?php echo html::anchor('admin/users/update.'.$user->id, 'Edytuj') ?>
			<?php echo html::anchor('admin/users/delete.'.$user->id, 'Usuń', array('class' => 'unsafe')) ?>
		</td>
	</tr>
<?php endforeach ?>
</tbody>
</table>

<?php if(!empty($paginate)): ?>
	<div class="paginate">
		<?php echo $paginate ?>
	</div>
<?php endif ?>