<?php
namespace App\Controllers;

use App\Models\CommentaireModele;
use App\Models\GroupeModele;
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
			'idutil' => $idUtil,
		]);
		echo view('footer');
	}

	public function tache($projet)
	{
		$tri = $this->request->getGet('triColonne') ?? 'datecreation_ASC';
		$filtrePriorite = $this->request->getGet('filtrePriorite') ?? 'Toutes';

		list($triColonne, $ordre) = explode('_', $tri);
    	$ordre = strtoupper($ordre) == 'DESC' ? 'DESC' : 'ASC';

		$idUtil = session()->get('idutil');
		$projetModel = new ProjetModel();

		$projets = $projetModel->getProjectsByUser($idUtil);

		$index = $this->findProjectIndexById($projets, strval($projet));


		if ($index == -1) {
			return view('illegal_access');
		}

		$tacheModel = new TacheModel();

		$taches = $tacheModel->getTaches($projet, $triColonne, $ordre, $filtrePriorite);

		$tachesAFaire = $tacheModel->getTachesByStatut($projet, 'A Faire', $triColonne, $ordre, 0, 10);
    	$tachesEnCours = $tacheModel->getTachesByStatut($projet, 'En cours', $triColonne, $ordre, 0, 10);
    	$tachesTerminees = $tacheModel->getTachesByStatut($projet, 'Terminée', $triColonne, $ordre, 0, 10);

		$utilisateurs = $projetModel->getUsersByProject($projet);
		$commentaireModel = new CommentaireModele();
		$commentaires = $commentaireModel->getCommentaireByProject($projet);


		// Charger la vue avec les tâches triées
		echo view('header', ['title' => 'Taches']);
		echo view('liste_tache', [
			'projet' => $projets[$index],
			'taches' => $taches,
			'triColonne' => $triColonne,
			'tachesAFaire' => $tachesAFaire,
        	'tachesEnCours' => $tachesEnCours,
        	'tachesTerminees' => $tachesTerminees,
			'ordre' => $ordre,
			'filtrePriorite' => $filtrePriorite,
			'commentaires' => $commentaires,
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

	public function ajouterCommentaire()
	{
		$idUtil = session()->get('idutil');

		$data = [
			'contenu' => $this->request->getPost('contenu'),
			'datecom' => date('Y-m-d H:i:s', time()),
			'idutil' => $idUtil,
			'idtache' => $this->request->getPost('idtache'),
		];

		$commentaireModel = new CommentaireModele();

		if ($commentaireModel->insert($data)) {
			return redirect()->back()->with('message', 'Commentaire ajoutée avec succès.');
		} else {
			redirect()->back()->with('error', 'Erreur lors de l\'ajout de la commentaire.');
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

	public function quitterProjet($idProjet)
	{
		// Récupérer l'ID de l'utilisateur depuis la session
		$idUtilisateur = session()->get('idutil');
		// Charger le modèle
		$GroupeModele = new GroupeModele();

		// Supprimer la relation de groupe
		$GroupeModele->supprGroupe($idUtilisateur, $idProjet);

		// Ajouter un message flash pour indiquer la réussite de l'action
		session()->setFlashdata('success', 'Vous avez quitté le projet avec succès.');
		// Rediriger avec un message de succès
		return redirect()->to('/projets');
	}

	public function updateProject()
	{
		// Récupérer les données envoyées en JSON
		$data = $this->request->getJSON(true);
		
		// Journalisation des données reçues
		log_message('debug', 'Données reçues pour la mise à jour : ' . json_encode($data));
		
		// Extraire les informations nécessaires
		$field = $data['field'] ?? null;
		$value = $data['value'] ?? null;
		$idProjet = $data['idprojet'] ?? null;
		
		// Validation des données
		if (!$field || !$value || !$idProjet) {
			log_message('error', 'Données manquantes : ' . json_encode($data));
			return $this->response->setJSON(['success' => false]);
		}
		
		// Charger le modèle
		$ProjetModele = new \App\Models\ProjetModel();
		
		// Préparer les données de mise à jour
		$updateData = [$field => $value];
		
		// Tenter de mettre à jour le projet
		$updated = $ProjetModele->update($idProjet, $updateData);
		
		if ($updated) {
			log_message('debug', "Projet ID $idProjet mis à jour avec succès.");
		} else {
			log_message('error', "Échec de la mise à jour pour le projet ID $idProjet.");
		}
		
		return $this->response->setJSON(['success' => $updated]);
	}

	public function rechercherUtilisateur()
	{
		// Vérifie si la requête contient un paramètre 'query'
		if ($this->request->getGet('query')) {
			$query = $this->request->getGet('query');

			// Charger le modèle
			$userModel = new \App\Models\UtilisateurModele();
			
			// Appelle le modèle pour rechercher les utilisateurs dont l'email correspond au 'LIKE' de la query
			$utilisateurs = $userModel->rechercherParEmail($query);
			
			// Retourne les résultats sous forme JSON
			return $this->response->setJSON($utilisateurs);
		}
		return $this->response->setJSON([]);
	}

}