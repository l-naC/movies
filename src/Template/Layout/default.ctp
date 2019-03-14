<?php
$cakeDescription = 'Gestionnaire de films';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?> - 
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('reset.css') ?>
    <?= $this->Html->css('main.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>
        <h1><?= $this->Html->link('Movies !', ['controller' => 'movies', 'action' => 'index']) ?></h1>
        <nav>
            <?= $this->Html->link('Liste des films', ['controller' => 'movies', 'action' => 'index'], [ 'class' => ($this->templatePath == 'Movies' && $this->template == 'index') ? 'active' : '']) ?>
            <?= $this->Html->link('Ajouter un film', ['controller' => 'movies', 'action' => 'add'], [ 'class' => ($this->templatePath == 'Movies' && $this->template == 'add') ? 'active' : '']) ?>
            <?= $this->Html->link('Film random', ['controller' => 'movies', 'action' => 'random'], [ 'class' => ($this->templatePath == 'Movies' && $this->template == 'random') ? 'active' : '']) ?>
        </nav>
    </header>
    <main>
        <!-- Affiche les messaegs pour l'utilisateur (et les vide de la memoire) -->
        <?= $this->Flash->render() ?>
        <!-- Affiche le contenu de cette page -->
        <?= $this->fetch('content') ?>
    </main>
</body>
</html>
