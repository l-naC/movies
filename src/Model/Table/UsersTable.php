<?php
//src/Model/Table/UsersTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
	public function initialize(array $config)
    {
    	$this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $v)
    {
        $v->notEmpty('pseudo')
        ->maxLength('pseudo', 5)
        ->notEmpty('password')
        ->maxLength('password', 200);
        return $v;
    }
}
