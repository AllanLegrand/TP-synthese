<?php
namespace App\Controllers;
use App\Models\UtilisateurModele;
use CodeIgniter\Controller;
class ResetPasswordController extends Controller
{
	public function index($token)
	{
		helper(['form']);
		$userModel = new UtilisateurModele();
		$user = $userModel->where('resettoken', $token)
			->where('resettokenexpiration >', date('Y-m-d H:i:s'))
			->first();
		if ($user) {
			return view('reset_password', ['token' => $token]);
		} else {
			return 'Lien de réinitialisation non valide.';
		}
	}

	public function updatePassword()
	{
		$token = $this->request->getPost('token');
		$password = $this->request->getPost('password');
		$confirmPassword = $this->request->getPost('confirm_password');
		// Valider et traiter les données du formulaire
		$userModel = new UtilisateurModele();
		$user = $userModel->where('resettoken', $token)
			->where('resettokenexpiration >', date('Y-m-d H:i:s'))
			->first();
		if ($user && $password === $confirmPassword) {
			// Mettre à jour le mot de passe et réinitialiser le jeton
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			$userModel->set('mdp', $hashedPassword)
				->set('resettoken', null)
				->set('resettokenexpiration', null)
				->update($user['idutil']);
			return redirect()->to('/signin');
		} else {
			return 'Erreur lors de la réinitialisation du mot de passe.';
		}
	}
}