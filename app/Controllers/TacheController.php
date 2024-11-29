<?php
namespace App\Controllers;

use App\Models\TacheModel;

class TacheController extends BaseController
{
    public function modifier($idtache)
    {
        $tacheModel = new TacheModel();

        // Récupérer les informations de la tâche à modifier
        $tache = $tacheModel->find($idtache);

        if (!$tache) {
            // Si la tâche n'existe pas, retournez une erreur ou redirigez
            return redirect()->to('/projet')->with('error', 'Tâche introuvable.');
        }

        // Charger la vue avec les données de la tâche
        return view('tache', ['tache' => $tache]);
    }

    public function enregistrer()
    {
        $tacheModel = new TacheModel();

        // Récupérer les données POST
        $data = $this->request->getPost();

        // Mettre à jour la tâche
        $tacheModel->update($data['idtache'], [
            'titre' => $data['titre'],
            'description' => $data['description'],
            'statut' => $data['statut'],
            'echeance' => $data['echeance'],
        ]);

        // Rediriger avec un message de succès
        return redirect()->to('/projet')->with('success', 'Tâche modifiée avec succès.');
    }


    // Exemple dans le contrôleur (par exemple ProjetController.php)

}