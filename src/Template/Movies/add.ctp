<?php //file : src/Templates/Movies/add.ctp ?>

<?= $this->Form->create($new) ?>
	<h1>Ajouter un film</h1>
	<?= $this->Form->control('title', ['label' => 'Titre']) ?>
	<?= $this->Form->control('director', ['label' => 'Réalisateur']) ?>
	<?= $this->Form->control('duration', ['label' => 'Durée (en minutes)']) ?>
	<?= $this->Form->control('synopsis', ['label' => 'Résumé']) ?>
	<div class="input date">
		<label>Date de sortie</label>
		<?= $this->Form->text('releasedate', ['label'=> 'Date de sortie', 'type' => 'date']) ?>
	</div>
	<?= $this->Form->control('poster', ['type' => 'file', 'label' => 'Affiche']) ?>
	<?= $this->Form->button('Ajouter') ?>
<?= $this->Form->end() ?>