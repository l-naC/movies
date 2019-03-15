<?php //file : src/Templates/Movies/index.ctp ?>
<p>Il y a <?= $users->count(); ?> user(s)</p>

<table>
	<tr>
		<th>Pseudo</th>
		<th>Created</th>
		<th>Modified</th>
	</tr>
	<?php foreach ($users as $uneLigne) : ?>
	<tr>
		<td><?= $uneLigne->pseudo ?></td>
		<td><?= $uneLigne->created->i18nFormat('dd/MM/yyyy') ?></td>
		<td><?= $uneLigne->modified->i18nFormat('dd/MM/yyyy') ?></td>
	</tr>
	<?php endforeach; ?>
</table>
<br>
<?= $this->Html->link('Ajouter un film', ['controller' => 'users', 'action' => 'add'], ['class' => 'col-3 link']) ?>