<?php
namespace App\Models;
use CodeIgniter\Model;
class CommentaireModele extends Model
{
	protected $table = 'Commentaire';
	protected $primaryKey = 'idCom';
	protected $allowedFields = [
		'contenu',
		'dateCom',
		'idUtil',
		'idTache'
	];
}
