<?php
namespace App\Models;
use CodeIgniter\Model;
class GroupeModele extends Model
{
	protected $table = 'Groupe';
	protected $primaryKey = [
		'idUtil',
		'idProjet'
	];
}
