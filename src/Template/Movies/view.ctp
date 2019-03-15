<?php //file : src/Templates/Quotes/view.ctp 

?>
<h1>Un film</h1>
<p>
	<?php echo $film->title; ?>
</p>

<figure>
	<?php if (!empty($film->poster)) { ?>
		<?= $this->Html->image('../data/posters/'.$film->poster, ['alt' => 'Affiche de :'.$film->title]) ?>
	<?php }else{ ?>
		<?= $this->Html->image('default.jpg', ['alt' => 'Visuel non disponible']) ?>
	<?php } ?>
	<figcaption>
		Affiche de : <?= $film->title ?>
		<?= $this->Html->link('Edit Image', ['action' => 'edit_image', $film->id]); ?>
		<?= $this->Form->postLink('Supprimer', ['action' => 'delete_image', $film->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer ce film ?']); ?>
	</figcaption>
</figure>
<p>
	<span class="label">Réalisateur :</span>
	<?php  if (!empty($film->director)) { echo $film->director; }else{ echo '<span style="font-style:italic;">Anonyme</span>'; } ?>
</p>
<p>
	<span class="label">Sorie :</span>
	<?php if(!empty($film->releasedate)) { echo $film->releasedate->i18nFormat('dd/MM/yyyy'); }else{ echo ''; }  ?>
</p>
<p>
	<span class="label">Durée :</span>
	<?php echo $film->duration; ?><?= (!empty($film->duration)) ? 'minutes' : '' ?>
</p>
<p>
	<span class="label">Résumé :</span>
	<?php echo $film->synopsis; ?>
</p>
<p>
	<span class="label">Fiche créée le :</span>
	<?php echo $film->created->i18nFormat('dd/MM/yyyy HH:mm:ss'); ?>
</p>
<p>
	<span class="label">Fiche modifiée le :</span>
	<?php echo $film->modified->i18nFormat('dd/MM/yyyy HH:mm:ss'); ?>
</p>

<div class="row text-center">
	<?= $this->Html->link('Edit', ['action' => 'edit', $film->id], ['class' => 'col-3 link']); ?>

	<?= $this->Form->postLink('Supprimer', ['action' => 'delete', $film->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer ce film ?', 'class' => 'col-3 link']); ?>
</div>
