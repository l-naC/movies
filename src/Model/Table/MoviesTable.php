<?php
//src/Model/Table/MoviesTable.php

//A quel espace de logique au quel il appartient. Donc juste son espace logique
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class MoviesTable extends Table
{
	public function initialize(array $config)
    {
    	//demande a Cake de gerer tous seul le created et modified
    	$this->addBehavior('Timestamp');
    }

    //ennonce les regles de validations pour ce type de data
    public function validationDefault(Validator $v)
    {
        $v->notEmpty('title')
        ->maxLength('poster', 40)
        ->allowEmpty('poster');
        return $v;
    }
}
