<?php //file : src/Templates/Movies/add.ctp ?>

<?= $this->Form->create($new, ['enctype' => 'multipart/form-data']) ?>
	<h1>Ajouter un film</h1>
	<?= $this->Form->control('pseudo', ['label' => 'Pseudo']) ?>
	<?= $this->Form->control('password', ['label' => 'Password', 'type' => 'password']) ?>
	<?= $this->Form->button('Ajouter') ?>
<?= $this->Form->end() ?>