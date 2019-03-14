<?php //file : src/Templates/Quotes/view.ctp 

?>
<h1>Un film</h1>
<p>
	<?php echo $film->title; ?>
</p>
<p>
	<?php echo $film->poster; ?>
</p>
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

<p><?php echo ' '.$this->Html->link('Edit', ['action' => 'edit', $film->id]); ?></p>

<p><?= $this->Form->postLink('Supprimer', ['action' => 'delete', $film->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer ce film ?']); ?></p>