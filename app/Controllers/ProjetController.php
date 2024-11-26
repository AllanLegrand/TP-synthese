<?php
namespace App\Controllers;

use App\Models\ProjetModel;

class ProjetController extends BaseController
{
	public function index()
	{
		$idUtil = session()->get('idutil');
		$projetModel = new ProjetModel();

		// Récupérer les projets pour un utilisateur donné
		$projets = $projetModel->getProjectsByUser($idUtil);

		// Charger une vue pour afficher les projets de l'utilisateur
		return view('listeProjet', [
			'projets' => $projets,
			'idutil' => $idUtil
		]);
	}
}
