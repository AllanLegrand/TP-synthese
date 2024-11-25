<?php
namespace App\Controllers;
use App\Models\UserModelB;
use CodeIgniter\Controller;
class ResetPasswordController extends Controller
{
	public function index($token)
	{
		helper(['form']);
		$userModel = new UserModelB();
		$user = $userModel->where('reset_token', $token)
			->where('reset_token_expiration >', date('Y-m-d H:i:s'))
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
		$userModel = new UserModelB();
		$user = $userModel->where('reset_token', $token)
			->where('reset_token_expiration >', date('Y-m-d H:i:s'))
			->first();
		if ($user && $password === $confirmPassword) {
			// Mettre à jour le mot de passe et réinitialiser le jeton
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			$userModel->set('password', $hashedPassword)
				->set('reset_token', null)
				->set('reset_token_expiration', null)
				->update($user['id']);
			return 'Mot de passe réinitialisé avec succès.';
		} else {
			return 'Erreur lors de la réinitialisation du mot de passe.';
		}
	}
}