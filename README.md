# Planifast : Service de Gestion de Tâche

## Réalisée par

- CHAMPVILLARD Sébastien  
- Trystan BAILLOBAY  
- Allan LEGRAND  
- Lorenzo DE MACEDO  

## Une application simple et efficace

Cette application a pour but de facilement gérer des projets et leurs tâches en collaboration avec plusieurs personnes.

## Prérequis

Cette application est réalisée à l'aide de PHP, JavaScript et PostgreSQL. Cela implique quelques prérequis avant d'utiliser l'application :

- Il faut avoir installé et configuré PostgreSQL.  
- Il faut accéder au fichier `app/config/Database.php` et configurer ce fichier si vous êtes hors de l'IUT.  
- Il faudra accéder au dossier `app/Database` dans une console PostgreSQL et lancer les scripts suivants :  
  - `create.sql`  
  - `scripts/supprProjetsOrphelins.sql`  
- Il faut accéder au fichier `app/config/Email.php` et configurer ce fichier si vous voulez définir une adresse mail que vous contrôlez.  
- Il faut avoir installé PHP.

Une fois cela fait, accédez à la racine du projet (`TP-Synthese/`) dans une console et lancez la commande suivante :  

```bash
php spark serve
```
Pour accéder au site, ouvrez votre navigateur et rendez-vous à l'adresse suivante : http://localhost:8080/.
