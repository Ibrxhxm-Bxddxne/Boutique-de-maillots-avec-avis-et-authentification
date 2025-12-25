<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 👕 Boutique de Maillots Laravel

Une application e-commerce moderne pour la vente de maillots de football (Clubs et Sélections), incluant une gestion complète des avis clients et un panel d'administration.

## 🌟 Fonctionnalités

* **Authentification complète** : Inscription, connexion et déconnexion sécurisées.
* **Catalogue Dynamique** : Filtrage des maillots par catégorie (Club/Pays) et par prix.
* **Système d'Avis** : Les utilisateurs connectés peuvent noter (étoiles) et commenter les produits.
* **Modération** : L'administrateur et l'auteur de l'avis peuvent supprimer les commentaires.
* **Panel Admin** : Gestion du stock, ajout de nouveaux maillots et statistiques.
* **Responsive Design** : Interface optimisée pour mobile et tablette avec Tailwind CSS.

## 🚀 Installation locale

1. **Cloner le projet**
   ```bash
   git clone [https://github.com/Ibrxhxm-Bxddxne/Boutique-de-maillots-avec-avis-et-authentification.git](https://github.com/Ibrxhxm-Bxddxne/Boutique-de-maillots-avec-avis-et-authentification.git)
   cd Boutique-de-maillots-avec-avis-et-authentification
2. **Installer les dépendances PHP & JS** :
  * ** composer install **
  * ** npm install && npm run build **
3. **Configuration de l'environnemen** :
  * ** Copiez le fichier d'exemple : cp .env.example .env **
  * ** Configurez les accès à la base de données dans votre fichier .env. **
4. **Initialisation de l'application** :
  * ** php artisan key:generate **
  * **php artisan migrate --seed **
  * **php artisan storage:link **
5. **Lancer le serveur** :
   * ** php artisan serve **
   
