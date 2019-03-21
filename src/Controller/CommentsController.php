<?php
//src/Controller/CommentsController.php

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;

class CommentsController extends AppController
{
    public function view()
    {

    }

    public function add()
    {
        $comm = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            $comm = $this->Comments->patchEntity($comm, $this->request->getData());

            //USER : c'est l'id de celui qui est connecté
            $comm->user_id = $this->Auth->user('id');

            if ($this->Comments->save($comm)) {
                $this->Flash->success('Le commentaire a été sauvegarder');

                return $this->redirect(['controller' => 'movies', 'action' => 'view', $comm->movie_id]);
            }
            $this->Flash->error('Planté');
        }
    }
}