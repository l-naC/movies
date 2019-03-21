<?php
//src/Model/Table/CommentsTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CommentsTable extends Table
{
	public function initialize(array $config)
    {
    	//demande a Cake de gerer tous seul le created et modified
    	$this->addBehavior('Timestamp');

        //un commentaire appartient a un efilm (ils sont lié par la colonne movie_id)
        $this->belongsTo('Movie', [
            'foreignKey' => 'movie_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    //ennonce les regles de validations pour ce type de data
    public function validationDefault(Validator $v)
    {
        $v->notEmpty('grade')
        ->allowEmpty('content');
        return $v;
    }
}
