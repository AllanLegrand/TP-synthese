<?php
namespace App\Models;
use CodeIgniter\Model;

class UtilisateurModele extends Model
{
	protected $table = 'utilisateur';
	protected $primaryKey = 'idutil';
	protected $allowedFields = [
		'mail',
		'nom',
		'prenom',
		'created_at',
		'mdp',
		'resettoken',
		'resettokenexpiration'
	];

	public function getUserByEmail($mail)
	{
		return $this->where('mail', $mail)->first();
	}

	public function projets()
	{
		return $this->hasMany(ProjetModel::class, 'idutil');
	}
	
	/**
	 * Ajoute un nouveau Utilisateur.
	 *
	 * @param array $data Données du Utilisateur à ajouter
	 * @return bool|int Retourne l'ID du Utilisateur ajoutée ou false en cas d'échec
	 */

	public function ajouterUtilisateur(array $data): bool|int|string
	{
		return $this->insert($data);
	}

	/**
	 * Met à jour un Utilisateur existante.
	 *
	 * @param int $idUtil ID du Utilisateur à modifier
	 * @param array $data Données mises à jour
	 * @return bool True en cas de succès, false en cas d'échec
	 */
	public function modifUtilisateur(int $idUtil, array $data): bool
	{
		return $this->update($idUtil, $data);
	}

	/**
	 * Supprime un Utilisateur.
	 *
	 * @param int $idUtil ID du Utilisateur à supprimer
	 * @return bool True en cas de succès, false en cas d'échec
	 */
	public function supprUtilisateur(int $idUtil): bool
	{
		return $this->delete($idUtil);
	}
}
