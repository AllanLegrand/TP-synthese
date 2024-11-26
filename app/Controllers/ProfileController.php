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

        $userId = $session->get('id');
        $utilisateurModel = new UtilisateurModele();
        $user = $utilisateurModel->find($userId);

        if (!$user) {
            return redirect()->to('/signin')->with('msg', 'Utilisateur introuvable.');
        }

        // Charger la vue du profil avec les données utilisateur
        return view('profile', ['user' => $user]);
    }

	public function logout()
    {
        $session = session();
        $session->destroy(); // Détruire toutes les données de session

        return redirect()->to('/signin')->with('msg', 'Vous êtes maintenant déconnecté.');
    }
}
