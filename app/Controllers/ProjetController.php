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

		$index = $this->findProjectIndexById($projets, strval($projet));


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

	public function modifierTache()
	{
		$tacheModel = new TacheModel();

		$data = [
			'titre' => $this->request->getPost('titre'),
			'statut' => $this->request->getPost('statut'),
			'echeance' => $this->request->getPost('echeance')
		];
		$idtache = $this->request->getPost('idtache');

		$tacheModel->update($idtache, $data);

		return redirect()->back()->with('message', 'Tâche modifiée avec succès.');
	}

	public function findProjectIndexById($array, $id) {
		foreach ($array as $index => $projet) {
			if ($projet["idprojet"] == $id) {
				return $index;
			}
		}
		return -1; // Si non trouvé
	}

}
