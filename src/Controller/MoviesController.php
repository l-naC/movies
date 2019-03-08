<?php
//src/Controller/MoviesController.php

//A quel espace de logique au quel il appartient. Donc juste son espace logique
namespace App\Controller;

class MoviesController extends AppController
{
	public function index()
    {
    	$movies = $this->Movies->find();
        $this->set(compact('movies'));
    }

    public function view($id)
    {
        //recupere l'element qui a l'id chercher
        $one = $this->Movies->get($id);
        //Transmet la variable $one  à la vue en changeant le nom par citation
        $this->set('film', $one);
    }

    public function add()
    {
        //On créer une nouvelle identité vide. Objet de type Quotes qui est vide
        $new = $this->Movies->newEntity();
        // si on arrive sur cette action en methode POST
        if ($this->request->is('post')) {
            // on met les données de l'utilisateur dans l'objet $new
            $new = $this->Movies->patchEntity($new, $this->request->getData());
            //si la sauvegard fonctionne, on confirme et on redirige vers la liste globale des citations
            if ($this->Movies->save($new)) {
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