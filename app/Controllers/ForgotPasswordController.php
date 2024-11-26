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
    $UtilisateurModele = new UtilisateurModele();
    $user = $UtilisateurModele->where('mail', $email)->first();


    if ($user) {
        // Générer un nouveau jeton et une expiration valide
        $token = bin2hex(random_bytes(16));
        $expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));  // 1 heure d'expiration

        // Mettre à jour la table utilisateur avec le nouveau jeton et expiration
        $UtilisateurModele->where('mail', $email)
                          ->set('resettoken', $token)
                          ->set('resettokenexpiration', $expiration)
                          ->update();

        // Préparer et envoyer l'email
        $resetLink = site_url("reset-password/$token");
        $message = "Cliquez sur le lien suivant pour réinitialiser votre mot de passe : $resetLink";
        $emailService = \Config\Services::email();
        
        $emailService->setTo($email);
        $emailService->setFrom('mailingtestIUT@gmail.com');
        $emailService->setSubject('Réinitialisation de mot de passe');
        $emailService->setMessage($message);

        if ($emailService->send()) {
            echo 'E-mail envoyé avec succès.';
        } else {
            echo $emailService->printDebugger();
        }
    } else {
        echo 'Utilisateur introuvable pour l\'e-mail : ' . $email;
    }
}


}
