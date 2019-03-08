<?php
//src/Model/Entity/Movie.php

//A quel espace de logique au quel il appartient. Donc juste son espace logique
namespace App\Model\Entity;

//Va charger des element en memoire pour qu'on puisse les utiliser, comme un import
use Cake\ORM\Entity;

// Objet special des entite : objet des quote
class Movie extends Entity
{
	// methode qu'on donne pour savoir qu'est-ce qu'on protege dans la table
	protected $_accessible = [
		'*' => true, 
		'id' => false
	];
}
