# SelectCars — Plateforme E-commerce de Vente de Voitures

> Projet de Fin d'Études (PFE) — Licence
> Application web de gestion et de vente en ligne de voitures (et de machines), développée avec **Laravel 10**.

---

## 📖 Description

**SelectCars** est une application web complète (Front-office + Back-office) permettant à un
concessionnaire / showroom automobile de :

- présenter son catalogue de véhicules aux visiteurs,
- gérer ses marques, catégories, modèles et stocks,
- gérer les commandes, les clients et les livraisons,
- administrer l'ensemble du contenu depuis un tableau de bord sécurisé.

Le projet a été réalisé dans le cadre d'un stage de fin d'études de Licence.

---

## ✨ Fonctionnalités

### 🛒 Front-office (partie publique / client)
- Page d'accueil avec bannière (hero slider)
- Catalogue de voitures par **marque** et **catégorie**
- Fiche détaillée d'un produit (voiture)
- Barre de **recherche** avec chargement des modèles en **AJAX** (`/getModels/{id}`)
- Page **FAQ**
- Formulaire de **contact** (`contact-US`)
- Espace client (inscription / connexion / mot de passe oublié)
- Gestion du panier et passage de **commande**

### 🔐 Back-office (partie administration)
- Authentification administrateur dédiée (`/admin`)
- **Tableau de bord** (statistiques)
- Gestion des **marques** et **catégories**
- Gestion des **produits** (voitures) et des **machines**
- Gestion des **stocks** (voitures et machines)
- Gestion des **commandes** et de leur **détail** (lignes de commande)
- Gestion des **machines** : marques, modèles, prix, stock
- Gestion des **clients**
- Gestion des **livreurs**
- Gestion du **support**, de la **FAQ**, des **bannières** et des **paramètres** du site

---

## 🛠️ Technologies utilisées

| Catégorie        | Technologie                                        |
|------------------|----------------------------------------------------|
| Framework        | Laravel 10 (PHP >= 8.1)                            |
| Base de données  | MySQL                                              |
| Front-end        | Blade, Bootstrap 5, Sass, HTML5, CSS3, JavaScript  |
| Build / Bundler  | Vite (`laravel-vite-plugin`)                       |
| Authentification | Laravel UI, Laravel Sanctum                        |
| Tableaux         | Yajra Laravel DataTables                           |
| HTTP Client      | Guzzle                                             |
| Outils           | Composer, NPM, Artisan, Tinker                     |

---

## 📂 Structure du projet

```
selectcars_pfe/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Contrôleurs back-office (admin)
│   │   ├── Auth/           # Authentification (Laravel UI)
│   │   └── Front/          # Contrôleurs front-office
│   └── Models/             # Modèles Eloquent (Produit, Marque, Commande...)
├── database/
│   ├── migrations/         # Schéma de la base de données
│   └── seeders/            # Données de test
├── resources/
│   └── views/
│       ├── back/           # Vues du back-office
│       ├── front/          # Vues du front-office
│       └── layouts/        # Layouts (front & back)
├── routes/
│   ├── web.php             # Routes de l'application
│   └── api.php
├── public/                 # Point d'entrée + assets
├── composer.json           # Dépendances PHP
└── package.json            # Dépendances JS
```

---

## ⚙️ Prérequis

- **PHP** >= 8.1
- **Composer**
- **Node.js** & **npm**
- **MySQL**

---

## 🚀 Installation

> ⚠️ Les commandes ci-dessous ne sont **pas** exécutées automatiquement — à lancer manuellement.

```bash
# 1. Cloner le dépôt
git clone https://github.com/lotfi7021/selectcars_pfe.git
cd selectcars_pfe

# 2. Installer les dépendances PHP
composer install

# 3. Installer les dépendances JS
npm install

# 4. Copier le fichier d'environnement
cp .env.example .env

# 5. Générer la clé d'application
php artisan key:generate

# 6. Configurer la base de données dans .env (DB_DATABASE=selectcars, ...)

# 7. Exécuter les migrations (+ données de test si disponible)
php artisan migrate --seed

# 8. Compiler les assets
npm run dev        # ou : npm run build

# 9. Lancer le serveur
php artisan serve
```

L'application sera accessible sur : `http://localhost:8000`
L'administration sur : `http://localhost:8000/admin`

---

## 🗄️ Base de données

Le projet contient notamment les tables :
`users`, `admins`, `clients`, `marques`, `categories`, `produits`,
`commandes`, `detail_commandes`, `commande__m_s` (machines),
`gestion_machines`, `marque_machines`, `model_machines`,
`stocks`, `stock_machines`, `livreurs`, `supports`, `faqs`, `banners`, `contacts`, `settings`.

---

## 👤 Auteur

**Lotfi**
Projet de Fin d'Études — Licence
Dépôt : [https://github.com/lotfi7021/selectcars_pfe](https://github.com/lotfi7021/selectcars_pfe)

---

## 📄 Licence

Projet académique réalisé dans un cadre pédagogique (PFE Licence).
