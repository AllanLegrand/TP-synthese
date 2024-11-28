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
		echo view('header', ['title' => 'Taches']);
		echo view('liste_tache', [
			'projet' => $projets[$index],
			'taches' => $taches
		]);
		echo view('footer');
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

	public function supprimerTache($idtache)
	{
		$tacheModel = new TacheModel();

		// Supprimer la tâche en utilisant son ID
		if ($tacheModel->delete($idtache)) {
			return redirect()->back()->with('message', 'Tâche supprimée avec succès.');
		} else {
			return redirect()->back()->with('error', 'Erreur lors de la suppression de la tâche.');
		}
	}


	public function findProjectIndexById($array, $id)
	{
		foreach ($array as $index => $projet) {
			if ($projet["idprojet"] == $id) {
				return $index;
			}
		}
		return -1; // Si non trouvé
	}

	public function ajouterTache()
	{
		$tacheModel = new TacheModel();

		// Données provenant du formulaire
		$data = [
			'titre' => $this->request->getPost('titre'),
			'statut' => $this->request->getPost('statut'),
			'echeance' => $this->request->getPost('echeance'),
			'idprojet' => $this->request->getPost('idprojet'), // ID du projet associé
		];

		// Insérer la tâche dans la base de données
		if ($tacheModel->insert($data)) {
			return redirect()->back()->with('message', 'Tâche ajoutée avec succès.');
		} else {
			return redirect()->back()->with('error', 'Erreur lors de l\'ajout de la tâche.');
		}
	}


}
