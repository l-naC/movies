<?php
//src/Controller/UsersController.php

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;

class UsersController extends AppController
{
    public function initialize(){
        parent::initialize();
        //Ajoute l'action 'add' de ce controller a la liste des actions autorisées sans être connecté
        $this->Auth->allow(['add']);
    }

	public function index()
    {
    	$users = $this->Users->find()->order('pseudo');
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

    public function login(){
        if ($this->request->is('post')) {
            //essaye de matcher avec un utilisateur de la base
            $user = $this->Auth->identify();
            //si on trouve quelqu'un qui match
            if ($user) {
                //on le memorise en session
                $this->Auth->setUser($user);
                //on redirige vers la page d'avant
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Votre pseudo ou mot de passe est incorrect.');
        }
    }

    public function logout()
    {
        $this->Flash->success('À bientôt');
        $this->Auth->logout();
        return $this->redirect(['controller' => 'Movies', 'action' => 'index']);

    }
}