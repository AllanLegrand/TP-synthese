<?php
namespace App\Models;
use CodeIgniter\Model;
class TacheModele extends Model
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

	public function ajouter() {
		
	}

	public function modifier() {
		
	}

	public function supprimer() {
	
	}
}
