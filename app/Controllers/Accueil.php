<?php

namespace App\Controllers;

class Accueil extends BaseController
{
    public function index()
    {
        if (session()->has('idutil')) {
            // Si l'utilisateur est connecté, redirection vers la page "projets"
            return redirect()->to('/projets');
        }
        echo view('header', ['title' => 'Accueil']);
        echo view('accueil'); // Contenu de la page principale
        echo view('footer');
    }
}
