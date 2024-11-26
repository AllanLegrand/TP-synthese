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
		'reset_token',
		'reset_token_expiration'
	];

	public function getUserByEmail($mail)
	{
		return $this->where('mail', $mail)->first();
	}

	public function ajouter() {
		
	}

	public function modifier() {
		
	}

	public function supprimer() {
	
	}
}
