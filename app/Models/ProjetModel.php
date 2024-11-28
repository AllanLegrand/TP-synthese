<?php
namespace App\Models;

use CodeIgniter\Model;

class ProjetModel extends Model
{
	protected $table = 'projet';
	protected $primaryKey = 'idprojet';
	protected $allowedFields = ['titreprojet', 'descriptionprojet'];

	/**
	 * Récupère les projets d'un utilisateur donné.
	 *
	 * @param int $idUtil ID de l'utilisateur
	 * @return array Liste des projets associés à cet utilisateur
	 */
	public function getProjectsByUser(int $idUtil): array
	{
		return $this->db->table('projet')->select('projet.*, COUNT(tache.idtache) AS totalTaches, SUM(CASE WHEN tache.statut = \'Terminée\' THEN 1 ELSE 0 END) AS totalTachesTerminees')
			->join('groupe', 'groupe.idprojet = projet.idprojet')
			->join('tache', 'tache.idprojet = projet.idprojet', 'left')
			->where('groupe.idutil', $idUtil)
			->groupBy('projet.idprojet')->get()->getResultArray();
	}

	/**
     * Récupère les projets d'un utilisateur donné a partir d'un titre donné.
     *
     * @param int $idUtil ID de l'utilisateur
	 * @param string $title Titre du projet
     * @return array Liste des projets associés à cet utilisateur et au titre donné
     */
	public function getProjectsByTitle(int $idUtil, string $title): array
	{
		return $this->db->table('projet')->select('projet.*')
			->join('groupe', 'groupe.idprojet = projet.idprojet')
			->join('tache', 'tache.idprojet = projet.idprojet', 'left')
			->where('groupe.idutil', $idUtil)
			->like('LOWER(titreprojet)', strtolower($title)) // Utilisez 'ILIKE' dans PostgreSQL ou ici 'LIKE' avec insensibilité à la casse
			->groupBy('projet.idprojet')
			->get()
			->getResultArray();
	}
	

	/**
	 * Ajoute un nouveau projet.
	 *
	 * @param array $data Données du projet à ajouter
	 * @return bool|int Retourne l'ID du projet ajoutée ou false en cas d'échec
	 */

	public function ajouterProjet(array $data): bool|int|string
	{
		return $this->insert($data);
	}

	/**
	 * Met à jour un projet existante.
	 *
	 * @param int $idProjet ID du projet à modifier
	 * @param array $data Données mises à jour
	 * @return bool True en cas de succès, false en cas d'échec
	 */
	public function modifProjet(int $idProjet, array $data): bool
	{
		return $this->update($idProjet, $data);
	}

	/**
	 * Supprime un projet.
	 *
	 * @param int $idProjet ID du projet à supprimer
	 * @return bool True en cas de succès, false en cas d'échec
	 */
	public function supprProjet(int $idProjet): bool
	{
		return $this->delete($idProjet);
	}
}
