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
        $this->addBehavior('Image');

        //un film a plusieurs commentaire (lies par movie_id)
        $this->hasMany('Comments', [
            'foreignKey' => 'movie_id'
        ]);
    }

    //ennonce les regles de validations pour ce type de data
    public function validationDefault(Validator $v)
    {
        $v->notEmpty('title')
        ->maxLength('title', 300)
        //allowEmpty = autorise le champs à être vide
        ->allowEmpty('director')
        ->maxLength('director', 300)
        ->allowEmpty('poster')
        ->allowEmpty('duration')
        ->allowEmpty('releasedate')
        ->allowEmpty('synopsis');
        return $v;
    }
}
