<?php //file : src/Templates/Quotes/view.ctp 

?>
<h1>Un film</h1>
<p><?php echo $film->title; ?></p>
<p>Author : <?php  if (!empty($film->director)) { echo $film->director; }else{ echo '<span style="font-style:italic;">Anonyme</span>'; } ?></p>
<p><?php echo $film->synopsis; ?></p>
<p><?php echo $film->poster; ?></p>
<p><?php echo $film->duration; ?></p>
<p><?php echo $film->releasedate->i18nFormat('dd/MM/yyyy'); ?></p>
<p><?php (!empty($film->releasedate)) ? $film->releasedate->i18nFormat('dd/MM/yyyy') : ''  ?></p>
<p>Created  : <?php echo $film->created; ?></p>
<p>Modified  : <?php echo $film->modified; ?></p>
<p>id # <?php echo $film->id; ?></p>

<p><?php echo ' '.$this->Html->link('Edit', ['action' => 'edit', $film->id]); ?></p>

<p><?= $this->Form->postLink('Supprimer', ['action' => 'delete', $film->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer ce film ?']); ?></p>