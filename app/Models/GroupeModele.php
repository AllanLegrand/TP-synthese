<?php
namespace App\Models;
use CodeIgniter\Model;
class GroupeModele extends Model
{
	protected $table = 'groupe';
    protected $primaryKey = ['idutil', 'idprojet'];
    protected $allowedFields = ['idutil', 'idprojet'];

	/**
	 * Ajoute un nouveau Groupe.
	 *
	 * @param array $data Données du Groupe à ajouter
	 * @return bool|int Retourne l'ID du Groupe ajoutée ou false en cas d'échec
	 */

	public function ajouterGroupe(array $data): bool|int|string
	{
		return $this->insert($data);
	}

	public function ajouterUtilisateurAuProjet(int $idUtil, int $idProjet)
    {
        return $this->insert([
            'idutil' => $idUtil,
            'idprojet' => $idProjet
        ]);
    }

	/**
	 * Met à jour un Groupe existant.
	 *
	 * @param int $idGroupe ID du Groupe à modifier
	 * @param array $data Données mises à jour
	 * @return bool True en cas de succès, false en cas d'échec
	 */
	public function modifGroupe(int $idGroupe, array $data): bool
	{
		return $this->update($idGroupe, $data);
	}

	/**
	 * Supprime un Groupe.
	 *
	 * @param int $idGroupe ID du Groupe à supprimer
	 * @return bool True en cas de succès, false en cas d'échec
	 */
	public function supprGroupe(int $idGroupe): bool
	{
		return $this->delete($idGroupe);
	}
}
