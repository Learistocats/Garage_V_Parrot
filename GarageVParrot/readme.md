#Installation en local du site GarageVParrot

##Pré-requis:

-Logiciel de gestion de serveurs web intégré (comme XAMPP) avec PHP 8 et Mysql 5.1
-Logiciel de traitement de text (notepad, vscode)
-Navigateur web récent

##Marche à suivre

###Installation des fichiers

-Lancer xampp et démarrer les services Apache et MySQL
-Ouvrez le répertoire d'installation de xampp (ou cliquer sur le bouton "explorer" de l'interface)
-Copier le dossier GarageVParrot dans le dossier htdocs
-Dans le répertoire GarageVParrot/private ouvrez le fichier config.php et mettez à jour les informations entre guillemets pour qu'ils correspondent aux identifiants de la base de données mysql dans le fichier my.ini (les informations actuellement rentrées sont celle de base pour xammp, il est donc fort possible que vous n'ayez pas besoin de les changer)

###Installation du site 

-Dans un navigateur, taper dans la barre d'url "localhost/GarageVParrot"
-Dans l'interface qui s'affiche, entrer un nom d'utilisateur et un mot de passe, il servira d'accès admin au back-office
-Le site devrait être fonctionnel

