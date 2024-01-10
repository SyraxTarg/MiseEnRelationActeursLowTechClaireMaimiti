# Site de mise en relation d'acteurs Low-Tech Bordeaux

Projet de conception de site web pour Low-Tech Bordeaux dans le cadre de la matière Challenge Web à Efrei en B2 DWA.

Ce projet a été réalisé par Maimiti Saint-Marc et Claire Sbaffe en B2 Développement web & application à Efrei.

Ce site est un site de mise en relation d'acteurs dans le cadre d'un chantier participatif de tiny house par Low-Tech Bordeaux.

## Sommaire

- [Architecture](#architecture)
- [Dépendances](#dépendances)
- [Installation](#installation)
- [Usage](#usage)

## Architecture

Ce site a été développé avec HTML, CSS, JavaScript pour le front-end et PHP, PostgreSQL pour le back-end.

## Dépendances

Pour faire tourner ce site, vous avez besoin d'un serveur web permettant d'utiliser PHP et d'une base de données PostgreSQL.

Le plus simple est  d'utiliser un serveur WAMP sur Windows ou MAMP sur MacOS. Cette méthode met en place tout ce qui est requis pour faire tourner ce site.

Il important de placer le dossier contenant le site dans le répertoire `C:\wamp64\www` sur Windows ou `Applications\MAMP\htdocs` sur MacOS afin qu'il puisse être utilisable par le serveur.

Au lancement du serveur WAMP ou MAMP, vous retrouverez le site sur http://localhost/Mise_en_relation_acteurs_lowtech sur Windows avec WAMP ou http://localhost:8888/Mise_en_relation_acteurs_lowtech sur MacOS avec MAMP.

## Installation

### Configurer la base de données

Exécutez les requêtes SQL initiales qui se trouvent dans le fichier `db.sql`.

Vous pouvez ouvrir le terminal de requêtes de PostgreSQL et coller le contenu du fichier.

## Usage

Pour voir des exemples d'utilisation du site, vous pouvez exécuter les requêtes SQL d'exemples contenues dans le fichier `examples.sql`.

Le site de mise en relation d'acteurs a pour but d'être un réseau d'échange entre les représentants du projet participatif de tiny house et les particuliers ayant envie d'y participer.

Les représentants, ayant le rôle de modérateur sur le site, peuvent poster des annonces, soit d'avancées sur la tiny house, soit de recherche de services ou de dons parmi les particuliers.

Les particuliers peuvent poster des annonces de disponibilité, dans lesquelles ils peuvent proposer leurs services ou leurs dons pour la tiny house. Ces annonces peuvent aussi servir aux particuliers à demander à apprendre une nouvelle compétence par l'intermédiaire du chantier participatif de la tiny house.

Toutes ces annonces se retrouvent dans le mur d'annonces. Chacun peut, tant qu'il est connecté, répondre à une annonce.

Les administrateurs sont ceux qui gèrent les utilisateurs. Ils ne gèrent aucunement les annonces. Un administrateur peut gérer les droits de tous ceux qui ne sont pas administrateurs.