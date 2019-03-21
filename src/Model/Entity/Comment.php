<?php
//src/Model/Entity/Comment.php

namespace App\Model\Entity;

use Cake\ORM\Entity;

// Objet special des entite : objet des quote
class Movie extends Entity
{
	protected $_accessible = [
		'*' => true, 
		'id' => false
	];
}