<?php
namespace App\Models;

use CodeIgniter\Model;

class TacheModel extends Model
{
    protected $table = 'Tache';
    protected $primaryKey = 'idTache';
    protected $allowedFields = [
        'titre', 
        'description', 
        'echeance', 
        'priorite', 
        'statut', 
        'dateCreation', 
        'idProjet'
    ];

    /**
     * Récupère toutes les tâches associées à un projet donné.
     *
     * @param int $idProjet ID du projet
     * @return array Liste des tâches associées
     */
    public function getTacheByProject(int $idProjet): array
    {
        return $this->where('idProjet', $idProjet)
            ->orderBy('dateCreation', 'ASC') // Facultatif : trie les tâches par date de création
            ->findAll();
    }
}
