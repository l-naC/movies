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
		<?php if (!empty($film->poster)) { ?>
		<?= $this->Form->postLink('Supprimer', ['action' => 'delete_image', $film->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer l\'affiche de ce film ?']); ?>
		<?php } ?>
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

<h2>Commentaires</h2>
<?php 
if (empty($film->comments)) {
	echo "<p>Aucun commentaire</p>";
}else foreach ($film->comments as $comment) { ?>
	<article class="comments">
		<p class="info"><?= $comment->user->pseudo ?>, <?= $comment->created->i18nFormat('dd/MM/yyyy HH:mm:ss') ?> Note :  <?= $comment->grade ?>/5</p>
		<p><?= ($comment->content) ? $comment->content : 'Pas de commentaire' ?></p>
	</article>
<?php } ?>
<?= "<h2>Note globale : ".number_format($result->avg, 2)."/5</h2>" ?>
<?php if($auth->user()) { 
	echo "<h2>Ajouter un commentaire</h2>";
	/*Pour créer le formulaire, on a besoin de l'entité vide ($c) et de lui dire sur quelle action aller pour traiter les données (puisque ce n'est pas le meme fichier). Ici, se sera l'action add du controller comments */
	echo $this->Form->create($c, ['url' => '/comments/add']);
		echo $this->Form->control('content', ['label' => 'Commentaire']);
		echo $this->Form->hidden('movie_id', ['value' => $film->id]);
		echo $this->Form->control('grade', ['label' => 'Note (sur 5)']);
		echo $this->Form->button('Ajouter');
	echo $this->Form->end();
} else{
	echo "<div class='row'>";
	echo "<p class='col-6 text-margin'>Vous devez être connecté pour pouvoir mettre un commentaire.</p>".$this->Html->link('Connectez-vous', ['controller' => 'users', 'action' => 'login'], ['class' => 'col-3 connexion']); 
	echo "</div>";
}
?>

<div class="row text-center">
	<?= $this->Html->link('Edit', ['action' => 'edit', $film->id], ['class' => 'col-3 link']); ?>
	<?= $this->Form->postLink('Supprimer', ['action' => 'delete', $film->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer ce film ?', 'class' => 'col-3 link']); ?>
</div>
