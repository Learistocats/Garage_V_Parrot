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

###Installation du site 

-Dans un navigateur, taper dans la barre d'url "localhost/GarageVParrot"
-Dans l'interface qui s'affiche, entrer un nom d'utilisateur et un mot de passe, il servira d'accès admin au back-office
-Le site devrait être fonctionnel

-Supprimer le fichier setup.php dans le répertoire htdocs dnas le répertoire d'installation de xampp

-Dans le cas ou vous ayiez des erreurs d'accès à la base de données, le fichier texte de configuration est dans GarageVParrot/private/config.php