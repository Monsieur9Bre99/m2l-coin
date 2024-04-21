
<p align="center">
  <img src="https://breroot.fr/projects/m2l-coin/logo.png">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Version-1.2.4-blue?style=for-the-badge">
  <img src="https://img.shields.io/github/stars/Monsieur9Bre99/m2l-coin?style=for-the-badge">
  <img src="https://img.shields.io/github/issues/Monsieur9Bre99/m2l-coin?color=rouge&style=for-the-badge">
  <img src="https://img.shields.io/github/forks/Monsieur9Bre99/m2l-coin?color=sarcelle&style=for-the-badge">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Auteur-breroot-bleu?style=flat-square">
  <img src="https://img.shields.io/badge/Open%20Source-Oui-darkgreen?style=flat-square">
  <img src="https://img.shields.io/badge/Maintenu-Oui-lightblue?style=flat-square">
  <img src="https://img.shields.io/badge/Ecrit%20en-PHP-darkcyan?style=flat-square">
  <img src="https://hits.seeyoufarm.com/api/count/incr/badge.svg?url=https%3A%2F%2Fgithub.com%2Fbreroot%2Fm2L-coin&title=Visitors&edge_flat=false"/>
</p>

<hr>

## Description :

M2L-COIN est une application web développée pour la Maison des Ligues de Lorraine (M2L). Elle sert de plateforme de gestion des petites annonces, similaire au site [Leboncoin](https://www.leboncoin.fr/)

Réalisée en utilisant PHP pour le côté serveur, HTML et CSS pour le côté client, JavaScript pour améliorer l'expérience de l'utilisateur et MySQL pour la base de données. M2L-COIN permet aux utilisateurs de s'inscrire et de se connecter à leurs comptes, de gérer leurs annonces, de consulter d'autres annonces et de contacter d'autres utilisateurs par l'intermédiaire de leurs annonces.

## Demo :

Vous pouvez voir une démo de l'application à l'adresse suivante : [M2L-COIN Demo](https://breroot.fr/projects/m2l-coin/)

## Prérequis / Conseils / Exigences :

Pour faire fonctionner M2L-COIN, vous aurez besoin des logiciels et technologies suivants :

- Docker : Utilisé pour créer un environnement de développement isolé.
- PHP (version 7.0 ou supérieure) : Langage de programmation utilisé pour le côté serveur.
- Base de données MySQL / Base de données PostgreSQL (à venir) : Utilisé pour stocker les données de l'application.
- Serveur web (Apache) : Utilisé pour servir l'application.
- Éditeur de code (par exemple: VSCode, Microsoft VS, Atom, Sublime Text, Notepad++,Vim,..) : Utilisé pour écrire et modifier le code.
- HTML, CSS, JavaScript, Bootstrap : Utilisés pour créer l'interface utilisateur de l'application.

## Fonctionnalités :

M2L-COIN comprend les caractéristiques suivantes :

1. Enregistrement d’un utilisateur :
   - Les utilisateurs peuvent créer un compte en fournissant leurs données personnelles (nom, prénom, adresse e-mail et numéro de téléphone) et en choisissant un mot de passe.

2. Authentification de l'utilisateur :
   - Les utilisateurs enregistrés peuvent se connecter en toute sécurité à leurs comptes à l'aide de leurs informations d'identification (Email & Mot de passe).

3. Gestion des annonces :
   - Les utilisateurs peuvent parcourir les annonces disponibles.
   - Les annonces peuvent être filtrées par catégorie ou recherchées à l'aide de mots-clés.
   - Des informations détaillées sur chaque annonce peuvent être consultées, y compris les coordonnées du vendeur.
   - Les utilisateurs peuvent créer de nouvelles annonces, modifier les annonces existantes et supprimer leurs propres annonces.
   - Chaque annonce contient des informations telles que le titre, la description, le prix, la catégorie et les coordonnées.

4. Messagerie:
   - Les utilisateurs peuvent contacter d'autres utilisateurs en envoyant des messages par l'intermédiaire d’une annonce sur l’Application.
   - Les messages sont échangés en privé entre les utilisateurs au sujet d'annonces spécifiques.

## Installation avec Docker :

Pour installer M2L-COIN dans votre environnement de développement local avec Docker, suivez les étapes suivantes :

1. Installation de Docker :
- **Windows :** [Télécharger Docker Desktop](https://desktop.docker.com/win/main/amd64/Docker%20Desktop%20Installer.exe)
- **Mac :** [Installer Docker Desktop pour Mac](https://docs.docker.com/desktop/install/mac-install/)
- **Linux :**
  ```bash
  sudo apt-get update
  sudo apt-get install docker-ce docker-ce-cli containerd.io
     ```

2. Installation du projet:
   1. Clonez le dépôt : `git clone https://github.com/Monsieur9Bre99/m2l-coin.git`
   2. Naviguez vers le répertoire du projet (ex: `cd m2l-coin`)
   3. Créez et démarrez les services avec la commande `docker compose up -d`.
        - Arrêt des services :  
            - Pour simplement arrêter les conteneurs, exécutez `docker compose stop` Vous pouvez redémarrer les conteneurs avec `docker compose start` .
            - Pour arrêter et supprimer les conteneurs, exécutez `docker compose down`

   4. Mettez à jour les paramètres de connexion à la base de données dans le fichier de configuration (`Model.php`) avec les informations d'identification de votre base de données.
   5. Importez le fichier `m2l-coin.db.sql` qui se trouve dans `Data/` dans votre base de données.

## Arborescence : 

#M2L-COIN/
|-- server/
    |-- 000-default.conf
    |-- apache2.conf
    |-- php.ini
|-- site/
    |-- Dockerfile
|-- www/
    |-- .env
    |-- .env.example
    |-- Assets/
        |-- css/
        |-- img/
        |-- jss/
        |-- lib/
        |-- scss/
    |-- Controllers/
        |--AccountController.php
        |--AnnonceController.php
        |--FavorisController.php
        |--LandingController.php
        |--MessageController.php
        |--SearchController.php
    |-- Models/
        |-- Model.php
    |-- Template/
        |-- site-template
            |-- css/
            |-- js/
            |-- lib/
            |-- scss/
                |-- 404.html
                |-- about.html
                |-- contact.html
                |-- index.html
                |-- LICENSE.txt
                |-- property-agent.html
                |-- property-list.html
                |-- property-type.html
                |-- READ-ME.txt
                |-- site-template.jpg
                |-- testimonial.html
    |-- vendor/
        |--composer/
        |--phpmailer/
        |--autoload.php
    |-- Views/
        |-- commons/
            |-- header.php
            |-- footer.php  
        |-- account.php         
        |-- favoris.php      
        |--mes-annonces.php  
        |--algo.php          
        |--connexion.php      
        |--home.php         
        |--messages.php      
        |--annonce-form.php  
        |--detail-annonce.php  
        |--inscription.php  
        |--modifAnnonce.php
        |--mon-profil.php
        |--resultsearch.php
    |-- Index.php
    |-- .gitignore
    |-- docker.compose.yml
    |-- m2l-coin.db.sql
    |-- README.md
    
## Installation avec WAMP :

Pour installer M2L-COIN dans votre environnement de développement local avec WAMP, suivez les étapes suivantes :

 1. **Télécharger WAMP Server :**   [Cliquer ici](https://www.wampserver.com/)

2. **Installation du projet :**
   1. Clonez le dépôt : `git clone https://github.com/Monsieur9Bre99/m2l-coin.git`
   2. Copiez le répertoire du projet dans le répertoire `www` de WAMP (ex: `C:\\wamp\\www\\`) et Démarrez WAMP.
   3. Mettez à jour les paramètres de connexion à la base de données dans le fichier de configuration (`Model.php`) avec les informations d'identification de votre base de données.
   4. Importez le fichier `m2l-coin.db.sql` qui se trouve dans `Data/` dans votre base de données via via phpMyAdmin.
   5. Accédez à votre projet via `localhost/m2l-coin` dans votre navigateur

## Contributions

Les contributions à ce projet sont les bienvenues ! Si vous trouvez des bugs ou souhaitez suggérer de nouvelles fonctionnalités, veuillez soumettre un problème ou créer une demande d'extension sur le dépôt GitHub tout en respectant le style de code du projet et les conventions décrites dans les directives de contribution.

### Contributeurs

<table>
  <tr align="center">
    <td>
        <a href="https://github.com/hamidadj13">
        <img src="https://avatars.githubusercontent.com/u/79259452?s=100" />
        <br/>
        <sub><b>Hamid O.</b></sub></a>
    </td>
    <td>
        <a href="https://github.com/herrduden">
        <img src="https://avatars.githubusercontent.com/u/78962948?s=100" />
        <br/>
        <sub><b>Mohammed B.</b></sub></a>
    </td>
<table>

### Superviseur

<table>
  <tr align="center">
    <td>
        <a href="https://github.com/ESSAMAMI">
        <img src="https://avatars.githubusercontent.com/u/29731343?s=100" />
        <br/>
        <sub><b>Hamza E.</b></sub></a>
    </td>
 </tr>
<table>

## Remerciements

Je souhaite exprimer ma gratitude et ma reconnaissance à tous les contributeurs de ce projet, en particulier à Hamza E. pour son implication et ses précieux conseils, Hamid O. pour sa contribution exceptionnelle tout au long du développement de M2L-COIN, son implication et son engagement exemplaires et aussi pour avoir été un partenaire incroyable tout au long de l'année. Aussi, à tous les autres contributeurs, vos avis, vos commentaires et vos conseils techniques ont été inestimables pour faire de M2L-COIN une plateforme réussie et conviviale pour la gestion des petites annonces.

THANKS.

## Contact

- [Mon LinkedIn](https://fr.linkedin.com/in/bre-sanctifi%C3%A9-36b3a822b)
- [LinkedIn de Hamid O.](https://www.linkedin.com/in/hamid-oketokoun-114090237/)

##

<h3><p align="center">M2L-COIN - Leboncoin de la M2L - @breroot</p></h3>
