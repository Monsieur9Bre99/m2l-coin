
<h1 align="center" color:"#FF6E14">
  M2L-COIN
</h1>

<p align="center">
  <img src="https://img.shields.io/badge/Version-1.1.2-vert?style=for-the-badge">
  <img src="https://img.shields.io/github/stars/Monsieur9Bre99/m2l-coin?style=for-the-badge">
  <img src="https://img.shields.io/github/issues/Monsieur9Bre99/m2l-coin?color=rouge&style=for-the-badge">
  <img src="https://img.shields.io/github/forks/Monsieur9Bre99/m2l-coin?color=sarcelle&style=for-the-badge">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Auteur-breroot-bleu?style=flat-square">
  <img src="https://img.shields.io/badge/Open%20Source-Oui-darkgreen?style=flat-square">
  <img src="https://img.shields.io/badge/Maintenu-Oui-lightblue?style=flat-square">
  <img src="https://img.shields.io/badge/Ecrit%20en-PHP-darkcyan?style=flat-square">
</p>

<hr>

## Description :

M2L-COIN est une application web développée pour la Maison des Ligues de Lorraine (M2L). Elle sert de plateforme de gestion des petites annonces, similaire au site [Leboncoin](https://www.leboncoin.fr/)

Réalisée en utilisant PHP pour le côté serveur, HTML et CSS pour le côté client, JavaScript pour améliorer l'expérience de l'utilisateur et MySQL pour la base de données. M2L-COIN permet aux utilisateurs de s'inscrire et de se connecter à leurs comptes, de gérer leurs annonces, de consulter d'autres annonces et de contacter d'autres utilisateurs par l'intermédiaire de leurs annonces.

## Demo :

Vous pouvez voir une démo de l'application à l'adresse suivante : [M2L-COIN Demo](https://breroot.fr/projects/m2l-coin/)

## Prérequis / Conseils / Exigences :

Pour faire fonctionner M2L-COIN, vous aurez besoin des logiciels et technologies suivants :

- Éditeur de code (par exemple: VSCode, Microsoft VS, Atom, Sublime Text, Notepad++,Vim,..) : Utilisé pour écrire et modifier le code.
- HTML, CSS, JavaScript, Bootstrap : Utilisés pour créer l'interface utilisateur de l'application.
- Base de données MySQL / Base de données PostgreSQL (à venir) 
- PHP (version 7.0 ou supérieure)
- WAMPSERVER 

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

## Installation avec WAMP :

Pour installer M2L-COIN dans votre environnement de développement local avec WAMP, suivez les étapes suivantes :

 1. **Télécharger WAMP Server :**   [Cliquer ici](https://www.wampserver.com/)

2. **Installation du projet :**
   1. Clonez le dépôt : `git clone https://github.com/Monsieur9Bre99/m2l-coin.git`
   2. Copiez le répertoire du projet dans le répertoire `www` de WAMP (ex: `C:\\wamp\\www\\`) et Démarrez WAMP.
   3. Mettez à jour les paramètres de connexion à la base de données dans le fichier de configuration (`Model.php`) avec les informations d'identification de votre base de données.
   4. Importez le fichier `m2l-coin.db.sql` qui se trouve dans `Data/` dans votre base de données via via phpMyAdmin.
   5. Accédez à votre projet via `localhost/m2l-coin` dans votre navigateur

## Arborescence : 


      ├── README.md
      ├── index.php
      ├── leboncoin.sql
      ├── .htaccess
      ├── Assets/
      │   ├── css/
      │   │   └── style.css
      │   ├── img/
      │   │   └── annonces/
      │   ├── js/
      │   │   └── main.js
      │   ├── lib/
      │   │   ├── animate/
      │   │   ├── easing/
      │   │   ├── owlcarousel/
      │   │   ├── waypoints/
      │   │   └── wow/
      │   └── scss/
      │       ├── bootstrap.scss
      │       └── bootstrap/
      │           └── scss/
      ├── Controllers/
      │   ├── AccountController.php
      │   ├── AnnonceController.php
      │   ├── FavorisController.php
      │   ├── LandingController.php
      │   ├── SearchController.php
      │   └── UpdateController.php
      ├── Models/
      │   ├── Model.php
      │   └── algo.php
      ├── Template/
      │   └── real-estate-html-template/
      │       ├── 404.html
      │       ├── about.html
      │       ├── contact.html
      │       ├── index.html
      │       ├── property-agent.html
      │       ├── property-list.html
      │       ├── property-type.html
      │       ├── testimonial.html
      │       ├── css/
      │       │   └── style.css
      │       ├── js/
      │       │   └── main.js
      │       └── lib/
      └── Data/
          └── m2l-coin.db.sql


## Captures

Quelques images du projet 

1. Page d'accueil
   
    ![Étape 1](https://imgur.com/mj1WweW.jpg?raw=true)
    
2. Page d'Inscription
   
    ![Étape 3](https://imgur.com/vQmnU6v.jpg?raw=true)

3. Page de Connexion
   
    ![Étape 2](https://imgur.com/6vSiLZh.jpg?raw=true)
    
4. Page de messagerie
   
    ![Étape 3](https://imgur.com/80qGCUi.jpg?raw=true)

Autres à decouvrir...

## Schema 

1. MCD
   
    ![Étape 1](https://uml.planttext.com/plantuml/png/VLH1RiCW4BnRyXzGhbK-u5EYf3srLLKbvuh0AgN2O05s4zNzIszLtf6FTN6m0uxLYsN6ixF3i7XX7JMkBcMUvHae9zoHB9NIYW7voZD2xWGFwu88vJmqd_idKWrY3JNidHgFL4OS2i9rlPFWrnmiCw9oGgk2E3XqnTMxTZefuzJ1yaFN3acY13HKLdds7HbQ8MElZRXQ6f2HAIbs86LiAzPve0tMs44bh4SQWc-TaC9YYzeCtp26y1uhFcf6EohkCSWopM4DLRB5Yp1Fq5Zc2Qob-x0zmIqe3d7hLs0WcWYw2AwqSgXm3PU3z3JW6moow9BraQRDjXRCaZ5TApSauR6HU8tGCotJ8zw0JDRt9HKfyaAj_TI69s1ejpBG9RL6N_-vkvxGTcHAwN8qSZ26A3UO9jmwSo01fq-bEofvUbJCUmJ-HYV6iRyORJkVjsqqbWMPKL8hcDrmaW516keHUS7E9y0CbBqjkcGGs9MspbChQf3PJqfWzeMziZYVoFddbXUVUU22QlGHwPEw4tm3vzywiFkBDEMN-giyw8wOaL_cNqoNMPujSEAxdz0V.jpg?raw=true)
    
2. MLD
   
    ![Étape 3](https://imgur.com/fgHrdr8.jpg?raw=true)

3. MPD SQL
   
    ``` sql
      -- Users table
      
      CREATE TABLE Users (
          idU INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          nom VARCHAR(100) NOT NULL,
          prenom VARCHAR(100) NOT NULL,
          adresseEmail VARCHAR(100) NOT NULL,
          telephone VARCHAR(10) NOT NULL,
          mdp VARCHAR(500) NOT NULL,
          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          CONSTRAINT UC_Users_Email UNIQUE (adresseEmail)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

      -- Annonce table
      
      CREATE TABLE Annonce (
          idAnnonce INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          titre VARCHAR(200) NOT NULL,
          prix DOUBLE NOT NULL,
          description TEXT NOT NULL,
          photo VARCHAR(500) NOT NULL,
          dateAjout TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          idCategorie INT UNSIGNED NOT NULL,
          codeLocalisation VARCHAR(3) NOT NULL,
          idUser INT UNSIGNED NOT NULL,
          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          CONSTRAINT FK_Annonce_Categorie FOREIGN KEY (idCategorie)
              REFERENCES Categorie(idCategorie) ON DELETE CASCADE,
          CONSTRAINT FK_Annonce_Localisation FOREIGN KEY (codeLocalisation)
              REFERENCES Localisation(codeDep) ON DELETE CASCADE,
          CONSTRAINT FK_Annonce_User FOREIGN KEY (idUser)
              REFERENCES Users(idU) ON DELETE CASCADE,
          INDEX IDX_Annonce_Categorie (idCategorie),
          INDEX IDX_Annonce_Localisation (codeLocalisation),
          INDEX IDX_Annonce_User (idUser)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

      -- Categorie table
      
      CREATE TABLE Categorie (
          idCategorie INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          libelle VARCHAR(50) NOT NULL,
          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

      -- Favoris table
      
      CREATE TABLE Favoris (
          idFavoris INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          idUtilisateur INT UNSIGNED NOT NULL,
          idA INT UNSIGNED NOT NULL,
          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          CONSTRAINT FK_Favoris_User FOREIGN KEY (idUtilisateur)
              REFERENCES Users(idU) ON DELETE CASCADE,
          CONSTRAINT FK_Favoris_Annonce FOREIGN KEY (idA)
              REFERENCES Annonce(idAnnonce) ON DELETE CASCADE,
          INDEX IDX_Favoris_User (idUtilisateur),
          INDEX IDX_Favoris_Annonce (idA)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

      -- Localisation table
      
      CREATE TABLE Localisation (
          codeDep VARCHAR(3) PRIMARY KEY,
          dep VARCHAR(23) NOT NULL,
          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

      -- Message table
      
      CREATE TABLE Message (
          id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          idsender INT UNSIGNED NOT NULL,
          idReceiver INT UNSIGNED NOT NULL,
          Content TEXT NOT NULL,
          idAnnonce INT UNSIGNED NOT NULL,
          deliveredTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          CONSTRAINT FK_Message_Sender FOREIGN KEY (idsender)
              REFERENCES UserAccount(idUser) ON DELETE CASCADE,
          CONSTRAINT FK_Message_Receiver FOREIGN KEY (idReceiver)
              REFERENCES UserAccount(idUser) ON DELETE CASCADE,
          CONSTRAINT FK_Message_Annonce FOREIGN KEY (idAnnonce)
              REFERENCES Annonce(idAnnonce) ON DELETE CASCADE,
          INDEX IDX_Message_Sender (idsender),
          INDEX IDX_Message_Receiver (idReceiver),
          INDEX IDX_Message_Annonce (idAnnonce)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

      -- UserAccount table
      CREATE TABLE UserAccount (
          idUser INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          userName VARCHAR(50) NOT NULL,
          Tel VARCHAR(10) NOT NULL,
          Email VARCHAR(50) NOT NULL,
          Password VARCHAR(100) NOT NULL,
          AccountCreationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          CONSTRAINT UC_UserAccount_Email UNIQUE (Email)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    
## Contributions

Les contributions à ce projet sont les bienvenues ! Si vous trouvez des bugs ou souhaitez suggérer de nouvelles fonctionnalités, veuillez soumettre un problème ou créer une demande d'extension sur le dépôt GitHub tout en respectant le style de code du projet et les conventions décrites dans les directives de contribution.

### Contributeurs

<table>
  <tr align="center">
    <td>
        <a href="https://github.com/hamidadj13">
        <img src="https://avatars.githubusercontent.com/u/79259452?s=100" width="100" height="100" />
        <br/>
        <sub><b>Hamid O.</b></sub></a>
    </td>
    <td>
        <a href="https://github.com/herrduden">
        <img src="https://avatars.githubusercontent.com/u/78962948?s=100" width="100" height="100" />
        <br/>
        <sub><b>Mohammed B.</b></sub></a>
    </td>
  </tr>
</table>

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

- [BREROOT](https://fr.linkedin.com/in/bre-sanctifi%C3%A9-36b3a822b)
- [HAMID](https://www.linkedin.com/in/hamid-oketokoun-114090237/)

##

<h3><p align="center">M2L-COIN - Leboncoin de la M2L - &copy; 2023</p></h3>
