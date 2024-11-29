#Planifast : Service de Gestion de Tache
Réalisée par 

> CHAMPVILLARD Sébastien
> Trystan BAILLOBAY 
> Allan LEGRAND 
> Lorenzo DE MACEDO

##Une application simple et efficace
  Cette application a pour but de facilement gérer des projets et leur taches en collaboration avec plusieurs personnes.
  


##Prérequis
    Cette application est réalisée à l'aide de PHP, JavaScript et Postgresql. Cela implique quelques prérequis avant d'utiliser l'application.

>   Il faut avoir installé et configuré Postgresql.
>   Il faut accèder au fichier app/config/Database.php et configurer ce fichier.
>   Il faut avoir installé PHP.

  Quand tout cela est fini, il faudra accéder dans une console à la racine du projet : "TP-Synthese/" et lancer la commande "php spark serve".
  Pour accéder au site, aller à l'adresse "Localhost:8080/" sur votre navigateur.


##Utilisation

  Pour utiliser le site, il faut s'inscrire et se connecter. 
  Une fois connecté, vous pouvez cliquer sur les boutons "Projets" et "Créer" pour voir les projets qui vous sont associés ou en créer de nouveaux.
  En haut à droite, un bouton en forme de bonhomme est disponible pour accéder à votre profil et modifier ou supprimer votre compte.
  
   ATTENTION : Supprimer son compte est irréversible et supprimera toutes vos données ainsi que tous vos projets et autres participations dans le site.

  Une fois qu'un projet est créé, vous accédez tout de suite à la page correspondante.
  Vous pouvez alors Ajouter, modifier et supprimer des tâches en plus de pouvoir ajouter des commentaires sur celles-ci.
  Pour ajouter de nouvelles personnes au projet, cliquez sur le bouton "partager" et ajoutez les avec leur addresse mail renseignée sur le site. 
    Une personne sans compte ne peut être ajoutée et sera marquée comme non trouvée.

 Vous pouvez quitter à tout moment un projet, mais attention, un projet ne sera supprimé QUE si le projet ne possède aucun participant, même si c'est vous qui l'avez créé.
