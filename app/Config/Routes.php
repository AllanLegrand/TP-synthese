<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Authentification
$routes->get('/', 'SignupController::index'); // Page d'accueil ou formulaire d'inscription
$routes->get('/signup', 'SignupController::index'); // Formulaire d'inscription
$routes->match(['get', 'post'], '/signup/store', 'SignupController::store'); // Stocker les données de l'inscription

$routes->get('/signin', 'SigninController::index'); // Formulaire de connexion
$routes->match(['get', 'post'], '/SigninController/loginAuth', 'SigninController::loginAuth'); // Traitement de l'authentification

$routes->get('/profile', 'ProfileController::index', ['filter' => 'authGuard']); // Page de profil protégée par un filtre
$routes->get('/profile/logout', 'ProfileController::logout');

$routes->get('/forgot-password', 'ForgotPasswordController::index'); // Formulaire pour demander un lien de réinitialisation
$routes->post('/forgot-password/sendResetLink', 'ForgotPasswordController::sendResetLink'); // Envoi du lien par e-mail

$routes->get('/reset-password/(:any)', 'ResetPasswordController::index/$1'); // Formulaire pour définir un nouveau mot de passe
$routes->post('/reset-password/updatePassword', 'ResetPasswordController::updatePassword'); // Mise à jour du mot de passe

$routes-> get('/Accueil','Accueil::index');

$routes->get('/Projets','ProjetController::index', ['filter' => 'authGuard']);
$routes->get('/projets', 'ProjetController::index', ['filter' => 'authGuard']); // Page de profil protégée par un filtre
$routes->get('/projets/(:any)', 'ProjetController::tache/$1', ['filter' => 'authGuard']); // Page de profil protégée par un filtre

$routes->post('/modifierTache', 'ProjetController::modifierTache');

