<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UtilisateurModele;
class ForgotPasswordController extends Controller
{
	public function index()
	{
		helper(['form']);
		return view('forgot_password');
	}

	public function sendResetLink()
	{
		$email = $this->request->getPost('email');
		$userModel = new UtilisateurModele();
		$user = $userModel->where('email', $email)->first();
		// Dans la méthode sendResetLink du contrôleur ForgotPasswordController
		$email = $this->request->getPost('email');

		$email = $this->request->getPost('email');
		$userModel = new UtilisateurModele();
		$user = $userModel->where('email', $email)->first();
		var_dump($user); // Ajoutez ceci pour voir le résultat de la requête
		if ($user) {
			echo 'Utilisateur trouvé :';
			var_dump($user);
		} else {
			echo 'Utilisateur introuvable pour l\'e-mail : ' . $email;
		}

		echo 'Adresse e-mail soumise : ' . $email;
		if ($user) {
			// Générer un jeton de réinitialisation de MDP et enregistrer-le dans BD
			$token = bin2hex(random_bytes(16));
			$expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));
			$userModel->set('reset_token', $token)
				->set('reset_token_expiration', $expiration)
				->update($user['id']);
			// Envoyer l'e-mail avec le lien de réinitialisation
			$resetLink = site_url("reset-password/$token");
			$message = "Cliquez sur le lien suivant pour réinitialiser MDP: $resetLink";
			// Utilisez la classe Email de CodeIgniter pour envoyer l'e-mail
			$emailService = \Config\Services::email();
			//paramètres du mail
			$from = 'mailingtestIUT@gmail.com';

			$to = $this->request->getPost('to');
			$subject = $this->request->getPost('subject');
			//envoi du mail
			$emailService->setTo($email);
			$emailService->setFrom($from);
			$emailService->setSubject('Réinitialisation de mot de passe');
			$emailService->setMessage($message);
			if ($emailService->send()) {
				echo 'E-mail envoyé avec succès.';
			} else {
				echo $emailService->printDebugger();
			}
		} else {
			echo 'Adresse e-mail non valide.';
		}
	}
}