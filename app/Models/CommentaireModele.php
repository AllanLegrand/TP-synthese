<?php
namespace App\Models;
use CodeIgniter\Model;
class CommentaireModele extends Model
{
	protected $table = 'commentaire';
	protected $primaryKey = 'idcom';
	protected $allowedFields = [
		'contenu',
		'datecom',
		'idutil',
		'idtache'
	];

	/**
	 * Ajoute un nouveau Commentaire.
	 *
	 * @param array $data Données du Commentaire à ajouter
	 * @return bool|int Retourne l'ID du Commentaire ajoutée ou false en cas d'échec
	 */

	public function ajouterCommentaire(array $data): bool|int|string
	{
		return $this->insert($data);
	}

	/**
	 * Met à jour un Commentaire existante.
	 *
	 * @param int $idCom ID du Commentaire à modifier
	 * @param array $data Données mises à jour
	 * @return bool True en cas de succès, false en cas d'échec
	 */
	public function modifCommentaire(int $idCom, array $data): bool
	{
		return $this->update($idCom, $data);
	}

	/**
	 * Supprime un Commentaire.
	 *
	 * @param int $idCom ID du Commentaire à supprimer
	 * @return bool True en cas de succès, false en cas d'échec
	 */
	public function supprCommentaire(int $idCom): bool
	{
		return $this->delete($idCom);
	}

	public function getCommentaireByProject(int $idProjet): array
	{
		return $this->select('commentaire.*, utilisateur.prenom, utilisateur.nom')->join('tache', 'commentaire.idtache = tache.idtache')
			->join('utilisateur', 'utilisateur.idutil = commentaire.idutil')
			->where('idprojet', $idProjet)
			->findAll();
	}
}
