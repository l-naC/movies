<?php
//src/Controller/MoviesController.php

//A quel espace de logique au quel il appartient. Donc juste son espace logique
namespace App\Controller;

use Cake\Http\Exception\NotFoundException;

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

    public function edit($id)
    {
        //On recupere les donnée du film
        $film = $this->Movies->get($id);

        if ($this->request->is(['post', 'put'])) {
            // si on passe le patchEntity sans le mettre dans une variable, seul les champs modifié seront envoyés dans la requete
            $this->Movies->patchEntity($film, $this->request->getData());
            //si la sauvegard fonctionne, on confirme et on redirige vers la liste globale des films
            if ($this->Movies->save($film)) {
                $this->Flash->success('Modif ok');
                //return vers la page de ce film
                return $this->redirect(['action' => 'view', $film->id]);
            }
            //si ca a planté on queule sur l'internaute
            $this->Flash->error('Modif planté');
        }
        $this->set(compact('film'));
    }

    public function delete($id)
    {
        //si on est en post ou en delete, on fait l'action
        if($this->request->is(['post', 'delete'])){
            //On recupere les donnée du film
            $movie = $this->Movies->get($id);

            if ($this->Movies->delete($movie)) {
                $this->Flash->success('Supprimé');
                //return vers la page de la lists des films
                return $this->redirect(['action' => 'index']);
            }else{
                $this->Flash->error('Supprimession planté');
                //return vers la page de ce film
                return $this->redirect(['action' => 'view', $id]);
            }
        }else{
            //sinon on declenche une erreur personnalisé
            throw new NotFoundException('Methode interdite (c\'est pas beau de tricher)');   
        }
        
    }
}