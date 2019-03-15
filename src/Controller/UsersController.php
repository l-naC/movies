<?php
//src/Controller/UsersController.php

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;

class UsersController extends AppController
{
	public function index()
    {
    	$users = $this->Users->find();
        $this->set(compact('users'));
    }

    public function add()
    {
        //On créer une nouvelle identité vide. Objet de type Movies qui est vide
        $new = $this->Users->newEntity();
        // si on arrive sur cette action en methode POST
        if ($this->request->is('post')) {
            // on met les données de l'utilisateur dans l'objet $new
            $new = $this->Users->patchEntity($new, $this->request->getData());

            //si la sauvegard fonctionne, on confirme et on redirige vers la liste globale des citations
            if ($this->Users->save($new)) {
                $this->Flash->success('Ok');

               return $this->redirect(['action' => 'index']);
            }
            //si ca a planté on queule sur l'internaute
            $this->Flash->error('Planté');
        }
        //Envoie la variable dans la vue
        $this->set(compact('new'));
    }
}