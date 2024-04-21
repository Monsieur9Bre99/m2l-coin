
<p align="center">
  <img src="https://breroot.fr/projects/m2l-coin/logo.png">
</p>

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

## Remerciements

Je souhaite exprimer ma gratitude et ma reconnaissance à tous les contributeurs de ce projet, en particulier à Hamza E. pour son implication et ses précieux conseils, Hamid O. pour sa contribution exceptionnelle tout au long du développement de M2L-COIN, son implication et son engagement exemplaires et aussi pour avoir été un partenaire incroyable tout au long de l'année. Aussi, à tous les autres contributeurs, vos avis, vos commentaires et vos conseils techniques ont été inestimables pour faire de M2L-COIN une plateforme réussie et conviviale pour la gestion des petites annonces.

THANKS.

## Contact

- [Mon LinkedIn](https://fr.linkedin.com/in/bre-sanctifi%C3%A9-36b3a822b)
- [LinkedIn de Hamid O.](https://www.linkedin.com/in/hamid-oketokoun-114090237/)

##

<h3><p align="center">M2L-COIN - Leboncoin de la M2L - @breroot</p></h3>
