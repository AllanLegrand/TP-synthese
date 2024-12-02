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
		$email = $this->request->getPost('mail');
		$userModel = new UtilisateurModele();
		$user = $userModel->where('mail', $email)->first();

/*
		if ($user) {
			echo 'Utilisateur trouvé :';
		} else {
			echo 'Utilisateur introuvable pour l\'e-mail : ' . $email;
		}

		echo 'Adresse e-mail soumise : ' . $email;
*/
		if ($user) {
			// Générer un jeton de réinitialisation de MDP et enregistrer-le dans BD
			$token = bin2hex(random_bytes(16));
			$expiration = date('Y-m-d H:i:s', strtotime('+2 hour'));
			$userModel->set('resettoken', $token)
				->set('resettokenexpiration', $expiration)
				->update($user['idutil']);
			// Envoyer l'e-mail avec le lien de réinitialisation
			$resetLink = site_url("reset-password/$token");
			$message = "Cliquez sur le lien suivant pour réinitialiser MDP: $resetLink";
			// Utilisez la classe Email de CodeIgniter pour envoyer l'e-mail
			$emailService = \Config\Services::email();
			//paramètres du mail
			$from = 'mailingtestIUT@gmail.com';

			$to = $this->request->getPost('to');
			$subject = $this->request->getPost('subject');
			//envoi du mailech
			$emailService->setTo($email);
			$emailService->setFrom($from);
			$emailService->setSubject('Réinitialisation de mot de passe');
			$emailService->setMessage($message);
			if ($emailService->send()) {
				echo view('mail_succes' );
			} else {
				echo $emailService->printDebugger();
			}
		} else {
			echo 'Adresse e-mail non valide.';
		}
	}
}
