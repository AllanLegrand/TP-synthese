<?php
namespace App\Models;
use CodeIgniter\Model;
class GroupeModele extends Model
{
	protected $table = 'groupe';
    protected $primaryKey = ['idutil', 'idprojet'];
    protected $allowedFields = ['idutil', 'idprojet'];


	public function ajouterUtilisateurAuProjet(int $idUtil, int $idProjet)
    {
        return $this->insert([
            'idutil' => $idUtil,
            'idprojet' => $idProjet
        ]);
    }

/**
     * Ajoute un nouveau groupe.
     *
     * @param array $data Données du groupe à ajouter (doit inclure idutil et idprojet)
     * @return bool|int Retourne l'ID du groupe ajouté ou false en cas d'échec
     */
    public function ajouterGroupe(array $data)
    {
        return $this->insert($data); // Insère les données, doit inclure 'idutil' et 'idprojet'
    }

    /**
     * Met à jour un groupe existant.
     *
     * @param array $data Données mises à jour
     * @param int $idUtil ID de l'utilisateur
     * @param int $idProjet ID du projet
     * @return bool True en cas de succès, false en cas d'échec
     */
    public function modifGroupe(array $data, int $idUtil, int $idProjet): bool
    {
        // Mise à jour avec les deux clés primaires 'idutil' et 'idprojet'
        return $this->update(
            ['idutil' => $idUtil, 'idprojet' => $idProjet], // Conditions pour la clé primaire composite
            $data // Données à mettre à jour
        );
    }

    /**
     * Supprime un groupe.
     *
     * @param int $idUtil ID de l'utilisateur
     * @param int $idProjet ID du projet
     * @return bool True en cas de succès, false en cas d'échec
     */
    public function supprGroupe(int $idUtil, int $idProjet): bool
    {
        // Suppression avec les deux clés primaires
        return $this->delete(['idutil' => $idUtil, 'idprojet' => $idProjet]);
    }
}