<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/date', 'DateControlleur::index');  // Page des dates

//Formulaires
$routes->get('formulaire1', 'FormControleur::index');
$routes->post('/FormControleur/traitement', 'FormControleur::traitement');
$routes->get('formulaire2', 'Produit::index');
$routes->post('/Produit/traitement', 'Produit::save');
//TP MAIL
$routes->get('mail', 'Mail::lemail');

//TP6 partie1
$routes->get('eleve', 'EleveControleur::index');
$routes->get('utilisateur', 'UtilisateurControleur::index');

$routes->get('produit', 'ProduitsControleur::index');
$routes->get('/produit/nouveau', 'ProduitsControleur::nouveau');
$routes->post('/produit/creerTraitement', 'ProduitsControleur::nouveau_produit');
$routes->post('/produit/modif', 'ProduitsControleur::modif_Produit');
$routes->post('/produit/categ', 'ProduitsControleur::filtrage_par_categorie');
$routes->post('/produit/suppress', 'ProduitsControleur::suppression_Produit');

$routes->get('/password', '/passControleur::index');


//TP8
$routes->get('/article', 'Articles::index');
$routes->get('article/(:num)','Articles::index');


//TP10
$routes->get('session/set', 'SessionController::setSession');
$routes->get('session/get', 'SessionController::getSession');
$routes->get('session/check', 'SessionController::checkSessionExpiration');
$routes->get('session/checkck', 'SessionController::checkCookie');
$routes->get('session/logout', 'SessionController::logout');

// Authentification
$routes->get('/', 'SignupController::index'); // Page d'accueil ou formulaire d'inscription
$routes->get('/signup', 'SignupController::index'); // Formulaire d'inscription
$routes->match(['get', 'post'], '/SignupController/store', 'SignupController::store'); // Stocker les données de l'inscription

$routes->get('/signin', 'SigninController::index'); // Formulaire de connexion
$routes->match(['get', 'post'], '/SigninController/loginAuth', 'SigninController::loginAuth'); // Traitement de l'authentification

$routes->get('/profile', 'ProfileController::index', ['filter' => 'authGuard']); // Page de profil protégée par un filtre

$routes->get('/forgot-password', 'ForgotPasswordController::index'); // Formulaire pour demander un lien de réinitialisation
$routes->post('/forgot-password/sendResetLink', 'ForgotPasswordController::sendResetLink'); // Envoi du lien par e-mail

$routes->get('/reset-password/(:any)', 'ResetPasswordController::index/$1'); // Formulaire pour définir un nouveau mot de passe
$routes->post('/reset-password/updatePassword', 'ResetPasswordController::updatePassword'); // Mise à jour du mot de passe

// Assurez-vous que toutes les routes sont testées correctement.
// Assurez-vous que toutes les routes sont testées correctement.