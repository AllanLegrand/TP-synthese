<?php
namespace App\Models;

use CodeIgniter\Model;

class TacheModel extends Model
{
	protected $table = 'tache';
	protected $primaryKey = 'idtache';
	protected $allowedFields = [
		'titre', 
		'description', 
		'echeance', 
		'priorite', 
		'statut', 
		'datecreation', 
		'idprojet'
	];

	/**
	 * Récupère toutes les tâches associées à un projet donné.
	 *
	 * @param int $idProjet ID du projet
	 * @return array Liste des tâches associées
	 */
	public function getTacheByProject(int $idProjet): array
	{
		return $this->where('idprojet', $idProjet)
			->orderBy('dateCreation', 'ASC') // Facultatif : trie les tâches par date de création
			->findAll();
	}

	/**
	 * Ajoute une nouvelle tâche.
	 *
	 * @param array $data Données de la tâche à ajouter
	 * @return bool|int Retourne l'ID de la tâche ajoutée ou false en cas d'échec
	 */
	public function ajouterTache(array $data)
	{
		return $this->insert($data);
	}

	/**
	 * Met à jour une tâche existante.
	 *
	 * @param int $idTache ID de la tâche à modifier
	 * @param array $data Données mises à jour
	 * @return bool True en cas de succès, false en cas d'échec
	 */
	public function modifTache(int $idTache, array $data): bool
	{
		return $this->update($idTache, $data);
	}

	/**
	 * Supprime une tâche.
	 *
	 * @param int $idTache ID de la tâche à supprimer
	 * @return bool True en cas de succès, false en cas d'échec
	 */
	public function supprTache(int $idTache): bool
	{
		return $this->delete($idTache);
	}


	/* 
	   /////////////////////////////
	   ///EXEMPLE D'UTILISATION : //
	   /////////////////////////////


		  $tacheModel = new \App\Models\TacheModel();

	  // Ajouter une tâche
	  $newTache = [
		  'titre' => 'Nouvelle Tâche',
		  'description' => 'Description de la tâche',
		  'echeance' => '2024-12-31',
		  'priorite' => 'Forte',
		  'statut' => 'A Faire',
		  'idProjet' => 1
	  ];
	  $tacheModel->ajouterTache($newTache);

	  // Modifier une tâche
	  $tacheModel->modifTache(1, ['statut' => 'En cours']);

	  // Supprimer une tâche
	  $tacheModel->supprTache(1);

		  
		  
		  
		  */
	public function getTachesByProject(int $idProjet): array
	{
		return $this->db->table('tache')->where('idprojet', $idProjet)
			->orderBy('datecreation', 'ASC') // Facultatif : trie les tâches par date de création
			->get()
			->getResultArray();
	}
}
