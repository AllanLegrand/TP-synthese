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

	public function getTachesByProject(int $idProjet): array
	{
		return $this->db->table('tache')->where('idprojet', $idProjet)
			->orderBy('datecreation', 'ASC') // Facultatif : trie les tâches par date de création
			->get()
			->getResultArray();
	}

	public function getTaches(int $idProjet, string $triColonne = 'datecreation', string $ordre = 'ASC', string $priorite = 'Toutes'): array
	{
		$validColumns = ['titre', 'datecreation', 'priorite']; // Colonnes autorisées pour le tri
		$validOrder = ['ASC', 'DESC']; // Ordres autorisés
		$validPriorites = ['Faible', 'Moyenne', 'Forte'];

		// Valider les entrées pour éviter les injections SQL
		if (!in_array($triColonne, $validColumns)) {
			$triColonne = 'datecreation';
		}
		if (!in_array($ordre, $validOrder)) {
			$ordre = 'ASC';
		}
		if (!in_array($priorite, $validPriorites) && $priorite != 'Toutes') {
			$priorite = 'Toutes';
		}

		// Commencer la requête avec l'id du projet
		$query = $this->where('idprojet', $idProjet);

		// Appliquer le filtre par priorité si nécessaire
		if ($priorite != 'Toutes') {
			$query = $query->where('priorite', $priorite);
		}

		// Appliquer le tri
		return $query->orderBy($triColonne, $ordre)
					->findAll();
	}

	public function getTachesByStatut(int $idProjet, string $statut, string $triColonne = 'datecreation', string $ordre = 'ASC', string $priorite = 'Toutes'): array
	{
		$validColumns = ['titre', 'datecreation', 'priorite']; // Colonnes autorisées pour le tri
		$validOrder = ['ASC', 'DESC']; // Ordres autorisés
		$validPriorites = ['Faible', 'Moyenne', 'Forte'];

		// Valider les entrées pour éviter les injections SQL
		if (!in_array($triColonne, $validColumns)) {
			$triColonne = 'datecreation';
		}
		if (!in_array($ordre, $validOrder)) {
			$ordre = 'ASC';
		}
		if (!in_array($priorite, $validPriorites) && $priorite != 'Toutes') {
			$priorite = 'Toutes';
		}

		// Commencer la requête avec l'id du projet et le statut
		$query = $this->where('idprojet', $idProjet)
					->where('statut', $statut);

		// Appliquer le filtre par priorité si nécessaire
		if ($priorite != 'Toutes') {
			$query = $query->where('priorite', $priorite);
		}

		// Appliquer le tri
		return $query->orderBy($triColonne, $ordre)
					->findAll();
	}

	// Méthode pour compter le nombre de tâches par statut
	public function countTachesByStatut(int $idProjet, string $statut): int
	{
		return $this->where('idprojet', $idProjet)
					->where('statut', $statut)
					->countAllResults();
	}
}
