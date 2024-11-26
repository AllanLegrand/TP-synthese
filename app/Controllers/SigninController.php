<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UtilisateurModele;
class SigninController extends BaseController
{
	public function index()
	{
		helper(['form']);
		echo view('signin');
	}
	public function loginAuth()
	{
		$session = session();
		$UtilisateurModele = new UtilisateurModele();
		$email = $this->request->getVar('email');
		$password = $this->request->getVar('password');
		$data = $UtilisateurModele->where('mail', $email)->first();
		if ($data) {
			$pass = $data['mdp'];
			$authenticatePassword = password_verify($password, $pass);
			if ($authenticatePassword) {
				$ses_data = [
					'id' => $data['idutil'],
					'name' => $data['nom'],
					'email' => $data['mail'],
					'isLoggedIn' => TRUE
				];
				$session->set($ses_data);
				return redirect()->to('/profile');
			} else {
				$session->setFlashdata('msg', 'Password incorrect.');
				return redirect()->to('/signin');
			}
		} else {
			$session->setFlashdata('msg', 'Email exite pas.');
			return redirect()->to('/signin');
		}
	}
}