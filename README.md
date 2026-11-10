# CoffeShop — Plateforme B2B de vente de café & machines à café

Projet de Fin d'Études (PFE) — Licence

Plateforme **B2B** (front-office + back-office) de vente et de gestion de **café** et de **machines à café** à destination des **sociétés / fournisseurs** (clients professionnels), développée avec **Laravel 10**.

> Remarque : le dossier local et le remote Git s'appellent encore `selectcars_pfe` (nom historique du projet). Le dépôt peut également être accessible via `coffeshop_pfe`.

---

## Sommaire

- [Présentation](#présentation)
- [Fonctionnalités](#fonctionnalités)
- [Business Intelligence](#business-intelligence)
- [Stack technique](#stack-technique)
- [Structure du projet](#structure-du-projet)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Comptes de démonstration](#comptes-de-démonstration)
- [Base de données](#base-de-données)
- [Routes principales](#routes-principales)
- [Commandes utiles](#commandes-utiles)
- [Tests](#tests)
- [Auteur et licence](#auteur-et-licence)

---

## Présentation

L'application couvre l'ensemble du cycle commercial :

- présentation du catalogue (café et machines à café) ;
- gestion des produits, catégories, marques et modèles ;
- gestion du stock et des mouvements de stock ;
- prise et suivi des commandes (café et machines) ;
- facturation (avec TVA) et livraison ;
- gestion des clients (sociétés) et des livreurs ;
- service après-vente (SAV / tickets de support) ;
- tableaux de bord décisionnels (KPI + rapports BI Metabase).

Le projet a été réalisé dans le cadre d'un stage de fin d'études de Licence.

---

## Fonctionnalités

### Front-office (partie publique)

- Page d'accueil avec bannière (hero slider) pilotée depuis le back-office.
- Catalogue de **café** et de **machines à café**.
- Fiche produit détaillée.
- **Recherche** par marque et fourchette de prix, avec filtre des modèles en **AJAX** (`GET /getModels/{id}`).
- Pages **FAQ** et politique de vente.
- Formulaire de **contact**.
- Authentification.

### Back-office (espace professionnel)

Trois rôles : **Administrateur**, **Client** (société) et **Livreur**, avec un guard d'authentification dédié (`admin`) et un middleware de revalidation du cache navigateur.

- Connexion dédiée sur `/admin`.
- **Tableau de bord** : indicateurs clés (KPI), rapports **BI Metabase** et calendrier des commandes/livraisons (FullCalendar).
- **Gestion produit** : produits (café), catégories, marques.
- **Gestion machine** : machines à café, marques de machines, modèles.
- **Stock** : mouvements de stock café et machines.
- **Commandes** : commandes café et commandes machines (référence, client, prix, TVA, date de livraison, livreur, état, paiement).
- **Facturation** : facture et aperçu, pour les commandes café et machines.
- **Clients** : sociétés (nom, code TVA, adresse, téléphone, etc.).
- **Livreurs** : comptes et affectation aux commandes.
- **SAV / Support** : tickets.
- **Comptes** : création et gestion des comptes administrateur, client et livreur.
- **Contenu** : FAQ, bannières, messages de contact.

### Portail client

- Consultation des listes de produits (café) et de machines.
- Passage de commandes (café et machines).
- Suivi des commandes.
- Ouverture d'un ticket **SAV**.

---

## Business Intelligence

Le back-office intègre des **rapports d'analyse décisionnelle** fournis par **Metabase** (serveur BI, par défaut sur `http://localhost:3000`) et affichés via des `iframe` :

| Rapport | Vue Blade |
|---|---|
| Rapport café | `resources/views/back/Dashboard/produit.blade.php` |
| Rapport machines | `resources/views/back/Dashboard/machine.blade.php` |
| Rapport support / SAV | `resources/views/back/Dashboard/support.blade.php` |
| Tableaux de bord principaux | `resources/views/back/dashboard.blade.php` |

En complément, le tableau de bord affiche des **indicateurs clés (KPI)** (nombre d'articles café, nombre d'articles machines) et un **calendrier** des commandes et livraisons.

Les URLs des dashboards sont codées en dur dans les vues : adaptez-les à votre instance Metabase si nécessaire.

---

## Stack technique

| Catégorie | Technologie |
|---|---|
| Framework | Laravel 10 (PHP >= 8.1) |
| Base de données | MySQL |
| Front-end | Blade, Bootstrap 5, Sass, HTML5, CSS3, JavaScript |
| Build / bundler | Vite (`laravel-vite-plugin`) |
| Authentification | Laravel UI, Laravel Sanctum, guard `admin` dédié |
| Tableaux | Yajra Laravel DataTables |
| Client HTTP | Guzzle |
| Business Intelligence | Metabase |
| Outils | Composer, npm, Artisan, Tinker |

---

## Structure du projet

```text
selectcars_pfe/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Back-office (comptes, dashboard)
│   │   │   ├── Auth/           # Authentification Laravel UI
│   │   │   └── Front/          # Front-office (accueil, catalogue, FAQ…)
│   │   └── Middleware/         # Guard admin, revalidation du cache
│   └── Models/                 # Modèles Eloquent
│                               #  Café     : Produit, Categorie, Marque, Stock
│                               #  Machines : Gestion_machine, MarqueMachine,
│                               #             Model_machine, stock_machine
│                               #  Commandes: Commande, Detail_commande,
│                               #             Commande_M, Detail_commandeM
│                               #  Autres   : Client, Livreur, Support,
│                               #             Contact, Faq, Banner, Settings
├── database/
│   ├── migrations/             # Schéma de la base de données
│   └── seeders/                # Catégories, marques et comptes de démonstration
├── resources/
│   ├── sass/                   # Feuilles de styles (Bootstrap personnalisé)
│   ├── js/                     # JavaScript (bootstrap.js, app.js)
│   └── views/
│       ├── back/               # Vues du back-office
│       ├── front/              # Vues du front-office
│       └── layouts/            # Layouts (front et back)
├── routes/
│   ├── web.php                 # Routes de l'application
│   └── api.php
├── public/                     # Point d'entrée + assets
├── composer.json               # Dépendances PHP
└── package.json                # Dépendances JS
```

---

## Prérequis

- **PHP** >= 8.1 (extensions habituelles de Laravel : `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, etc.)
- **Composer**
- **Node.js** et **npm**
- **MySQL**
- *(Optionnel)* une instance **Metabase** locale pour les rapports BI

---

## Installation

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

# 6. Configurer la base de données dans .env
#    DB_CONNECTION=mysql
#    DB_HOST=127.0.0.1
#    DB_PORT=3306
#    DB_DATABASE=coffeshop
#    DB_USERNAME=root
#    DB_PASSWORD=

# 7. Exécuter les migrations et les seeders
php artisan migrate --seed

# 8. Compiler les assets
npm run dev        # mode développement
# ou
npm run build      # build de production

# 9. Lancer le serveur
php artisan serve
```

Application : `http://localhost:8000`
Back-office : `http://localhost:8000/admin`

### Configuration optionnelle

- **Nom de l'application** : `APP_NAME="CoffeShop"` est déjà défini dans `.env.example`.
- **Base de données** : créez une base MySQL nommée `coffeshop` (ou adaptez `DB_DATABASE`).
- **Metabase** : lancez une instance sur `http://localhost:3000` et remplacez les URLs des `iframe` dans `resources/views/back/` si votre instance diffère.

---

## Comptes de démonstration

Créés par `database/seeders/adminSeeder.php` (mot de passe commun : `password`) :

| Login | Rôle |
|---|---|
| `admin` | Administrateur |
| `user` | Client (société) |
| `livreur` | Livreur |

Ces identifiants sont destinés au développement. Modifiez-les avant tout déploiement.

Les seeders `CategoriesSeeder` et `MarquesSeeder` insèrent également des catégories et des marques de café de démonstration.

---

## Base de données

Principales tables :

- **Comptes** : `admins`, `users`, `clients`, `livreurs`
- **Catalogue café** : `categories`, `marques`, `produit`, `stocks`
- **Catalogue machines** : `marque_machines`, `model_machines`, `gestion_machines`, `stock_machines`
- **Commandes** : `commandes`, `detail_commandes` (café) ; `commande__m_s`, `detail_commande_m_s` (machines)
- **Tarifs** : `gestion_pris`
- **Contenu et support** : `supports`, `faqs`, `banners`, `contacts`, `settings`
- **Divers** : `demande_visites`, `etudiants`, `failed_jobs`, `personal_access_tokens`

---

## Routes principales

| Méthode | URI | Description |
|---|---|---|
| GET | `/` | Accueil front-office |
| GET | `/produit`, `/produit/{reference}` | Catalogue et fiche produit (café) |
| GET | `/machine` | Catalogue machines |
| GET | `/marques`, `/marques/{slug}` | Marques |
| GET | `/search` | Recherche |
| GET | `/getModels/{id}` | Modèles en AJAX |
| GET | `/FAQ` | FAQ |
| GET/POST | `/contact-US` | Contact |
| GET | `/admin` | Connexion back-office |
| GET | `/admin/dashboard` | Tableau de bord |
| GET | `/admin/list_produit` | Gestion des produits |
| GET | `/admin/list_machine` | Gestion des machines |
| GET | `/admin/list_commande`, `/admin/list_commandeM` | Commandes café et machines |
| GET | `/admin/list_client`, `/admin/list_livreurs` | Clients et livreurs |
| GET | `/admin/list_stock`, `/admin/list_stock/machine` | Stocks |
| GET | `/admin/support` | SAV |
| GET | `/admin/list_faq`, `/admin/list_banners` | Contenu |

La liste exhaustive se trouve dans `routes/web.php`.

---

## Commandes utiles

```bash
# Vider les caches
php artisan optimize:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Rejouer les seeders
php artisan db:seed

# Créer un lien symbolique pour les uploads (si nécessaire)
php artisan storage:link

# Mode maintenance
php artisan down
php artisan up
```

---

## Tests

```bash
php artisan test
# ou
./vendor/bin/phpunit
```

Le projet contient les tests d'exemple générés par Laravel dans `tests/Unit` et `tests/Feature`.

---

## Auteur et licence

**Lotfi** — Projet de Fin d'Études (Licence)

Dépôt : [https://github.com/lotfi7021/selectcars_pfe](https://github.com/lotfi7021/selectcars_pfe)

Projet académique réalisé dans un cadre pédagogique (PFE Licence).
