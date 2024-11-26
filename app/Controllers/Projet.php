<?php

namespace App\Controllers;

use App\Models\UtilisateurModele;

class ListeProjet extends BaseController
{
	private $utilisateurModele;
	public function __construct()
	{
		helper(['form']);
		$this->utilisateurModele = new UtilisateurModele();
	}
	public function index(): string
	{
		// Afficher tous les projets de l'utilisateur
		$session = session();
		$utilisateur = $this->utilisateurModele->getUserByEmail($session->get('mail'));
		$projets = $utilisateur->projets;
		$data = [
			'projets' => $projets
		];
		return view('listeProjet', $data);
	}
}
