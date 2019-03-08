<?php //file : src/Templates/Movies/add.ctp ?>

<?= $this->Form->create($new) ?>
<h1>Ajouter un film</h1>
<?= $this->Form->control('title', ['label' => 'Titre']) ?>
<?= $this->Form->control('director', ['label' => 'Réalisateur']) ?>
<?= $this->Form->control('duration', ['label' => 'Durée (en minutes)']) ?>
<?= $this->Form->control('synopsis', ['label' => 'Résumé']) ?>
<?= $this->Form->control('releasedate', array('label'=> false, 'div' => false, 'class'=>'form-control', 'type' => 'text')) ?>
<?= $this->Form->button('Ajouter') ?>
<?= $this->Form->end() ?>