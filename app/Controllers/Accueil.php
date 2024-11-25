<?php

namespace App\Controllers;

class Accueil extends BaseController
{
    public function index()
    {
        echo view('header', ['title' => 'Accueil']);
        echo view('accueil'); // Contenu de la page principale
        echo view('footer');
    }
}
