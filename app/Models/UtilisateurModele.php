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

	public function ajouter() {
		
	}

	public function modifier() {
		
	}

	public function supprimer() {
	
	}
}
