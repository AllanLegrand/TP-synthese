<?php

namespace App\Controllers;

use App\Models\UtilisateurModele;

class ProfileController extends BaseController
{
    public function index()
    {
        $session = session();

        // Vérifier si l'utilisateur est connecté
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/signin')->with('msg', 'Vous devez être connecté pour accéder à votre profil.');
        }

        $userId = $session->get('idutil');
        $utilisateurModel = new UtilisateurModele();
        $user = $utilisateurModel->find($userId);

        if (!$user) {
            return redirect()->to('/signin')->with('msg', 'Utilisateur introuvable.');
        }

		echo view ('header', ['title' => 'profile']);
        echo view('footer');
        // Charger la vue du profil avec les données utilisateur
        return view('profile', ['user' => $user]);
    }

	public function logout()
    {
        $session = session();
        $session->destroy(); // Détruire toutes les données de session

        return redirect()->to('/signin')->with('msg', 'Vous êtes maintenant déconnecté.');
    }

	public function updateInfo()
    {
        $session = session();
        $userId = $session->get('idutil');

        // Récupérer les données soumises
        $prenom = $this->request->getPost('prenom');
        $nom = $this->request->getPost('nom');

        // Mettre à jour les informations de l'utilisateur
        $UtilisateurModele = new UtilisateurModele();
        $UtilisateurModele->modifUtilisateur($userId, [
            'prenom' => $prenom,
            'nom' => $nom,
        ]);

        // Rediriger vers la page de profil avec un message de succès
        $session->setFlashdata('success', 'Vos informations ont été mises à jour avec succès.');
        return redirect()->to('/profile');
    }
}
