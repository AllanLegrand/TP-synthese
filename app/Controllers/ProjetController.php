<?php
namespace App\Controllers;

use App\Models\ProjetModel;
use App\Models\TacheModel;

class ProjetController extends BaseController
{
	public function index()
	{
		$idUtil = session()->get('idutil');
		$projetModel = new ProjetModel();

		// Récupérer les projets pour un utilisateur donné
		$projets = $projetModel->getProjectsByUser($idUtil);

		// Charger une vue pour afficher les projets de l'utilisateur
		echo view('header', ['title' => 'Projets']);
		echo view('listeProjet', [
			'projets' => $projets,
			'idutil' => $idUtil
		]);
		echo view('footer');
	}

	public function tache($projet)
	{
		$idUtil = session()->get('idutil');
		$projetModel = new ProjetModel();

		// Récupérer les projets pour un utilisateur donné
		$projets = $projetModel->getProjectsByUser($idUtil);

		$index = array_search(strval($projet), $projets);


		if ($index == -1) {
			return view('illegal_access');
		}

		$tacheModel = new TacheModel();

		$taches = $tacheModel->getTachesByProject($projet);

		// Charger une vue pour afficher les projets de l'utilisateur
		return view('liste_tache', [
			'projet' => $projets[$index],
			'taches' => $taches
		]);
	}
}
