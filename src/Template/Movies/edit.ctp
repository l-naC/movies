<?php //file : src/Templates/Movies/edit.ctp  ?>

<?= $this->Form->create($film) ?>
	<h1>Modifier un film</h1>
	<?= $this->Form->control('title', ['label' => 'Titre']) ?>
	<?= $this->Form->control('director', ['label' => 'Réalisateur']) ?>
	<?= $this->Form->control('duration', ['label' => 'Durée (en minutes)']) ?>
	<?= $this->Form->control('synopsis', ['label' => 'Résumé']) ?>
	<div class="input date">
		<label>Date de sortie</label>
		<?= $this->Form->text('releasedate', ['label'=> 'Date de sortie', 'type' => 'date', 'value' => (!empty($film->releasedate)) ? $film->releasedate->i18nFormat('yyyy-MM-dd') : '']) ?>
	</div>
	<?= $this->Form->control('poster', ['type' => 'file', 'label' => 'Affiche']) ?>
<?= $this->Form->button('Modifier') ?>
<?= $this->Form->end() ?>