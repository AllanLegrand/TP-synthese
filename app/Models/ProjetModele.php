<?php
namespace App\Models;
use CodeIgniter\Model;
class ProjetModele extends Model
{
	protected $table = 'Projet';
	protected $primaryKey = 'idProjet';
	protected $allowedFields = [
		'titreProjet',
		'descriptionProjet'
	];
}
