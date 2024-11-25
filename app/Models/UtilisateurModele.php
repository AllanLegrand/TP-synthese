<?php
namespace App\Models;
use CodeIgniter\Model;
class UserModelB extends Model
{
	protected $table = 'Utilisateur';
	protected $primaryKey = 'idUtil';
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
}
