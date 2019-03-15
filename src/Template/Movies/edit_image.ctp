<?php //file : src/Templates/Movies/edit_image.ctp  ?>

<?= $this->Form->create($film, ['enctype' => 'multipart/form-data']) ?>
	<h1>Modification de l'affiche : <?= $film->title ?> </h1>
	<?= $this->Form->control('poster', ['type' => 'file', 'label' => 'Affiche']) ?>
	<figure>
		<?php if (!empty($film->poster)) { ?>
			<?= $this->Html->image('../data/posters/'.$film->poster, ['alt' => 'Affiche de :'.$film->title]) ?>
		<?php }else{ ?>
			<?= $this->Html->image('default.jpg', ['alt' => 'Visuel non disponible']) ?>
		<?php } ?>
		<figcaption>
			Image actuelle
		</figcaption>
	</figure>
<?= $this->Form->button('Modifier') ?>
<?= $this->Form->end() ?>