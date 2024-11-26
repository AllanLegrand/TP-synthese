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
        return $this->db->table('projet')
            ->select('projet.*')
            ->join('groupe', 'groupe.idprojet = projet.idprojet')
            ->where('groupe.idutil', $idUtil)
            ->get()
            ->getResultArray();
    }
}
