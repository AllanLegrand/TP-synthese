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

		$utilisateurs = $projetModel->getUsersByProject($projet);


		// Charger une vue pour afficher les projets de l'utilisateur
		echo view('header', ['title' => 'Taches']);
		echo view('liste_tache', [
			'projet' => $projets[$index],
			'taches' => $taches,
			'utilisateurs' => $utilisateurs
		]);
		echo view('footer');
	}

	public function modifierTache()
	{
		$tacheModel = new TacheModel();

		$data = [
			'titre' => $this->request->getPost('titre'),
			'description' => $this->request->getPost('description'),
			'echeance' => $this->request->getPost('echeance'),
			'priorite' => $this->request->getPost('priorite'),
			'statut' => $this->request->getPost('statut'),
		];
		$idtache = $this->request->getPost('idtache');

		// Mise à jour de la tâche dans la base de données
		if ($tacheModel->update($idtache, $data)) {
			return redirect()->back()->with('message', 'Tâche modifiée avec succès.');
		} else {
			return redirect()->back()->with('error', 'Erreur lors de la modification de la tâche.');
		}
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

		$data = [
			'titre' => $this->request->getPost('titre'),
			'description' => $this->request->getPost('description'),
			'echeance' => $this->request->getPost('echeance'),
			'priorite' => $this->request->getPost('priorite'),
			'statut' => $this->request->getPost('statut'),
			'datecreation' => date('Y-m-d H:i:s', time()),
			'idprojet' => $this->request->getPost('idprojet')
		];

		// Insertion dans la base de données
		if ($tacheModel->insert($data)) {
			return redirect()->back()->with('message', 'Tâche ajoutée avec succès.');
		} else {
			return redirect()->back()->with('error', 'Erreur lors de l\'ajout de la tâche.');
		}
	}

	public function partagerProjet()
	{
		$idProjet = $this->request->getPost('idprojet');
		$mailUser = $this->request->getPost('mailUser');

		$userModel = new \App\Models\UtilisateurModele();
		$projetModel = new \App\Models\ProjetModel();

		$utilisateur = $userModel->where('mail', $mailUser)->first();
		if (!$utilisateur) {
			return redirect()->back()->with('error', 'Utilisateur introuvable.');
		}

		$projetModel->addUserToProject($idProjet, $utilisateur['idutil']);
		return redirect()->back()->with('message', 'Utilisateur ajouté avec succès.');
	}
}
