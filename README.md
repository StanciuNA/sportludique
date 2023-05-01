<div align="center" id="top"> 
  <img src="./.github/app.gif" alt="Sportludiquev2" />

  &#xa0;

  <!-- <a href="https://sportludiquev2.netlify.app">Demo</a> -->
</div>

<h1 align="center">Sportludiquev2</h1>

<p align="center">
  <img alt="Github top language" src="https://img.shields.io/github/languages/top/{{YOUR_GITHUB_USERNAME}}/sportludiquev2?color=56BEB8">

  <img alt="Github language count" src="https://img.shields.io/github/languages/count/{{YOUR_GITHUB_USERNAME}}/sportludiquev2?color=56BEB8">

  <img alt="Repository size" src="https://img.shields.io/github/repo-size/{{YOUR_GITHUB_USERNAME}}/sportludiquev2?color=56BEB8">

  <img alt="License" src="https://img.shields.io/github/license/{{YOUR_GITHUB_USERNAME}}/sportludiquev2?color=56BEB8">

  <!-- <img alt="Github issues" src="https://img.shields.io/github/issues/{{YOUR_GITHUB_USERNAME}}/sportludiquev2?color=56BEB8" /> -->

  <!-- <img alt="Github forks" src="https://img.shields.io/github/forks/{{YOUR_GITHUB_USERNAME}}/sportludiquev2?color=56BEB8" /> -->

  <!-- <img alt="Github stars" src="https://img.shields.io/github/stars/{{YOUR_GITHUB_USERNAME}}/sportludiquev2?color=56BEB8" /> -->
</p>

<!-- Status -->

<!-- <h4 align="center"> 
	🚧  Sportludiquev2 🚀 Under construction...  🚧
</h4> 

<hr> -->

<p align="center">
  <a href="#dart-about">About</a> &#xa0; | &#xa0; 
  <a href="#sparkles-features">Features</a> &#xa0; | &#xa0;
  <a href="#rocket-technologies">Technologies</a> &#xa0; | &#xa0;
  <a href="#white_check_mark-requirements">Requirements</a> &#xa0; | &#xa0;
  <a href="#checkered_flag-starting">Starting</a> &#xa0; | &#xa0;
  <a href="#memo-license">License</a> &#xa0; | &#xa0;
  <a href="https://github.com/{{YOUR_GITHUB_USERNAME}}" target="_blank">Author</a>
</p>

<br>

## :dart: Présentation du projet ##

SportLudique est un site e-commerce de vêtements de sport. Les utilisateurs peuvent parcourir tout les produits, rajouter des produits dans leur panier et les acheter.\
L'administrateur peut lui gérer les produits du site.


## :sparkles: Features ##

:heavy_check_mark: Regarder les produits du site;\
:heavy_check_mark: Créer un compte utilisateur et se connecter;\
:heavy_check_mark: Se connecter en tant qu'admin et gérer les produits (ajouter, modifer, supprimer);

## :rocket: Technologies utilisés ##

The following tools were used in this project:

- [Composer]
- [Php]
- [Symfony]
- [Boostrap]



# Installation du projet

## :white_check_mark: Requis pour le fonctionnement du projet ##

- installer php https://www.php.net/downloads
- installer composer https://getcomposer.org/download/

- S'assurer que php figure dans les variable d'environnement.
- Dans le fichier php.ini décocher l'extension pdo_sqlite.
- Dans le fichier .env mettre APP_ENV=prod pour la mise en production.





## Démarage du projet

``` bash
# cloner le projet
cd projet
git clone https://github.com/Sportludique/sportludique.git

# pour avoir le dossier vendor requis pour le fonctionnement du projet
composer install

# lancer le projet 
symfony server:start

# générer la base de données
php bin/console doctrine:database:create

php bin/console make:shema:create

php bin/console doctrine:fixtures:load



```

## :memo: License ##

This project is under license from MIT. For more details, see the [LICENSE](LICENSE.md) file.


Made with by <a href="https://github.com/Daisy0402" target="_blank">Daisy TACITA</a>
<a href="https://github.com/CamillePerier" target="-blank">Camille Perrier</a>
<a href="https://github.com/StanciuNA " target="-blank">Nicu Stanciu</a>


&#xa0;

<a href="#top">Back to top</a>
