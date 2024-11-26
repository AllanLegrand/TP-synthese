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
	public function getTachesByProject(int $idProjet): array
	{
		return $this->db->table('tache')->where('idprojet', $idProjet)
			->orderBy('datecreation', 'ASC') // Facultatif : trie les tâches par date de création
			->get()
			->getResultArray();
	}
}
