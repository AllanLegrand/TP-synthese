<?php

namespace App\Controllers;

use App\Models\ProjetModel;
use App\Models\GroupeModele;

class CreerProjetController extends BaseController
{
    public function ajouter()
    {
        $idUtil = session()->get('idutil');

        $data = [
            'titreprojet' => $this->request->getPost('titreprojet'),
            'descriptionprojet' => $this->request->getPost('descriptionprojet'),
        ];

        if (empty($data['titreprojet']) || empty($data['descriptionprojet'])) {
            return redirect()->back()->with('error', 'Veuillez remplir tous les champs');
        }

        $projetModel = new ProjetModel();
        $idProjet = $projetModel->ajouterProjet($data);

        if ($idProjet) {
            // Si le projet a bien été créé, associer l'utilisateur au projet
            $groupeModel = new GroupeModele();
            $groupeModel->ajouterUtilisateurAuProjet($idUtil, $idProjet); // Ajoute l'utilisateur au projet

            // Rediriger vers la page des projets
            return redirect()->to('/projets/' . $idProjet);
        } else {
            // Gestion d'erreur si le projet n'a pas été créé
            return redirect()->back()->with('error', 'Erreur lors de la création du projet.');
        }
    }
}
