<?php //file : src/Templates/Movies/index.ctp ?>
<p>Il y a <?= $movies->count(); ?> movie(s)</p>

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
		<td><?php if(!empty($uneLigne->releasedate)) { echo $uneLigne->releasedate->i18nFormat('dd/MM/yyyy'); }else{ echo ''; } ?></td>
	</tr>
	<?php endforeach; ?>
</table>