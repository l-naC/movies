<?php //file : src/Templates/Movies/index.ctp ?>
<p>Il y a <?= $movies->count(); ?> movie(s)</p>
<p><?= $this->Html->link('Ajouter un film', ['action' => 'add']); ?></p>

<table>
	<tr>
		<th>Titre</th>
		<th>Réalisateur</th>
		<th>Sortie</th>
	</tr>
	<?php foreach ($movies as $uneLigne) : ?>
	<tr>
		<td><?= $this->Html->link($uneLigne->title, ['action' => 'view', $uneLigne->id]); ?></td>
		<td><?= (!empty($uneLigne->director)) ? $uneLigne->director : 'Anonyme' ?></td>
		<td><?= (!empty($film->releasedate)) ? $film->releasedate->i18nFormat('dd/MM/yyyy') : '' ; ?></td>
	</tr>
	<?php endforeach; ?>
</table>