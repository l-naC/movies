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
        //recupere les infos du film qui a l'$id, avec en plus ses commentaires associé (et les infos de l'auteur du commentaire)
        $film = $this->Movies->get($id, [
            'contain' => ['Comments.Users']
        ]);
        //On cree une entite vide pour un commentaire
        $c= $this->Movies->Comments->newEntity();

        $query = $this->Movies->Comments->find();
        $query
        ->select([
            'avg' => $query->func()->avg('grade')
        ])
        ->where(['movie_id' => $id]);

        $result = $query->first();

        $this->set(compact('film', 'c', 'result'));
    }

    public function add()
    {
        //On créer une nouvelle identité vide. Objet de type Movies qui est vide
        $new = $this->Movies->newEntity();
        // si on arrive sur cette action en methode POST
        if ($this->request->is('post')) {
            // on met les données de l'utilisateur dans l'objet $new
            $new = $this->Movies->patchEntity($new, $this->request->getData());

            //si le ficheir correspond a l'un des types autorisés
            if (in_array($this->request->getData()['poster']['type'], ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])) {

                //recupere l'extension qui était utilisé
                $ext = pathinfo($this->request->getData()['poster']['name'], PATHINFO_EXTENSION);

                //creation du nouveau nom
                $name = 'a-'.rand(0,3000).'-'.time().'.'.$ext;

                //reconstitution du chemin globale du fichier
                //constane de webroot = WWW_ROOT
                $address = WWW_ROOT.'data/posters/'.$name;

                //valeur a enregistrer dans la base
                $new->poster = $name;

                //on le deplace de la memoire temporaire vers l'emplacement souhaité
                move_uploaded_file($this->request->getData('poster')['tmp_name'], $address);

            }else{
                $new->poster = null;
                $this->Flash->error('Ce format de fichier n\'est pas autorisé');
            }

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

    public function editImage($id)
    {
        //On recupere les donnée du film
        $film = $this->Movies->get($id);

        $old_poster = $film->poster;
        $old = WWW_ROOT.'data/posters/'.$film->poster;

        if ($this->request->is(['post', 'put'])) {

            // si on passe le patchEntity sans le mettre dans une variable, seul les champs modifié seront envoyés dans la requete
            $this->Movies->patchEntity($film, $this->request->getData());

            if (in_array($this->request->getData()['poster']['type'], ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])) {

                //recupere l'extension qui était utilisé
                $ext = pathinfo($this->request->getData()['poster']['name'], PATHINFO_EXTENSION);

                //creation du nouveau nom
                $name = 'a-'.rand(0,3000).'-'.time().'.'.$ext;

                //reconstitution du chemin globale du fichier
                //constane de webroot = WWW_ROOT
                $address = WWW_ROOT.'data/posters/'.$name;

                //valeur a enregistrer dans la base
                $film->poster = $name;

                //on le deplace de la memoire temporaire vers l'emplacement souhaité
                move_uploaded_file($this->request->getData('poster')['tmp_name'], $address);

                //si la sauvegard fonctionne, on confirme et on redirige vers la liste globale des films
                if ($this->Movies->save($film)) {

                    if (!empty($old_poster) && file_exists($old)){
                        unlink($old);
                    }

                    $this->Flash->success('Image modifiée');
                    //return vers la page de ce film

                    return $this->redirect(['action' => 'view', $film->id]);

                }else{
                    //si ca a planté on queule sur l'internaute
                    $this->Flash->error('Image non modifiée');
                }

            }else{
                $film->poster = $old_poster;
                $this->Flash->error('Ce format de fichier n\'est pas autorisé');
            }
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

    public function deleteImage($id)
    {
        //si on est en post ou en delete, on fait l'action
        if($this->request->is(['post'])){
            //On recupere les donnée du film
            $movie = $this->Movies->get($id);
            $old_poster= $movie->poster;
            $old = WWW_ROOT.'data/posters/'.$movie->poster;
            if (!empty($old_poster) && file_exists($old)){
                unlink($old);
            }
            $movie->poster = null;
            //si la sauvegard fonctionne, on confirme et on redirige vers la liste globale des films
            $this->Movies->save($movie);
            $this->Flash->success('Image supprimée');
            return $this->redirect(['action' => 'view', $movie->id]);
            
        }else{
            //sinon on declenche une erreur personnalisé
            throw new NotFoundException('Access denied, try again');   
        }
        
    }

    public function random(){
        $result = $this->Movies->find('all')
        ->order('rand()')
        ->firstOrFail();

        $this->redirect(['action' => 'view', $result->id]);
    }
}