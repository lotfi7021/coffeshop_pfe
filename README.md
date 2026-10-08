# CoffeShop — Plateforme B2B de vente de Café & Machines à Café

> Projet de Fin d'Études (PFE) — Licence
> Plateforme B2B de gestion des commandes et de vente de **café** et de **machines à café**, développée avec **Laravel 10**.

---

## 📖 Description

**CoffeShop** est une plateforme B2B (Front-office + Back-office) permettant la vente et la gestion
de **café** et de **machines à café** auprès de **fournisseurs / sociétés** (clients professionnels).

L'application couvre l'ensemble du cycle commercial :

- présentation du catalogue (café et machines à café),
- gestion des produits, catégories, marques et modèles,
- gestion du stock et des mouvements de stock,
- prise et suivi des commandes (café et machines),
- facturation (avec TVA) et livraison,
- gestion des clients (sociétés) et des livreurs,
- service après-vente (SAV / tickets de support).

Le projet a été réalisé dans le cadre d'un stage de fin d'études de Licence.

---

## ✨ Fonctionnalités

### 🛒 Front-office (partie publique)
- Page d'accueil avec bannière (hero slider)
- Catalogue de **café** et de **machines à café**
- Fiche produit détaillée
- **Recherche** (par marque, fourchette de prix) + filtre des modèles en **AJAX** (`/getModels/{id}`)
- Page **FAQ** (FAQ et politique de vente)
- Formulaire de **contact**
- Authentification (login)

### 🔐 Back-office (espace professionnel — 3 rôles)
Rôles : **Administrateur**, **Client** (société), **Livreur**.

- Authentification dédiée (`/admin`)
- **Tableau de bord** (statistiques : ventes café, ventes machines, support)
- **Gestion Produit** : produits (café), catégories, marques
- **Gestion Machine** : machines à café, marques de machines, modèles
- **Stock** : mouvements de stock café et mouvements de stock machines
- **Gestion des commandes** : commandes café **et** commandes machines
  (référence, client, prix, TVA, date de livraison, livreur, état, paiement)
- **Facturation** (facture + aperçu) pour les commandes café et machines
- **Gestion Client** (sociétés : nom de la société, code TVA, adresse, téléphone…)
- **Gestion Livreur**
- **SAV / Supports** (tickets)
- **Création des comptes**
- **FAQ**, **Bannières**, **Contact**

### 👤 Portail client
- Consultation des listes de produits (café) et de machines
- Passage de commandes (café et machines)
- Ouverture d'un ticket **SAV**

---

## 🛠️ Technologies utilisées

| Catégorie        | Technologie                                        |
|------------------|----------------------------------------------------|
| Framework        | Laravel 10 (PHP >= 8.1)                            |
| Base de données  | MySQL                                              |
| Front-end        | Blade, Bootstrap 5, Sass, HTML5, CSS3, JavaScript  |
| Build / Bundler  | Vite (`laravel-vite-plugin`)                       |
| Authentification | Laravel UI, Laravel Sanctum, guard admin dédié    |
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
│   └── Models/             # Modèles Eloquent
│                           #  Produit, Categorie, Marque        (catalogue café)
│                           #  Gestion_machine, MarqueMachine,
│                           #  Model_machine                     (catalogue machines)
│                           #  Commande, Detail_commande         (commandes café)
│                           #  Commande_M, Detail_commandeM      (commandes machines)
│                           #  Stock, stock_machine, Client, Livreur,
│                           #  Support, Contact, Faq, Banner, Settings
├── database/
│   ├── migrations/         # Schéma de la base de données
│   └── seeders/            # Données de test (marques, catégories, comptes)
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

# 7. Exécuter les migrations (+ données de test)
php artisan migrate --seed

# 8. Compiler les assets
npm run dev        # ou : npm run build

# 9. Lancer le serveur
php artisan serve
```

L'application sera accessible sur : `http://localhost:8000`
L'espace professionnel (back-office) sur : `http://localhost:8000/admin`

---

## 🗄️ Base de données (principales tables)

`users`, `admins`, `clients`, `marques`, `categories`, `produits` (café),
`marque_machines`, `model_machines`, `gestion_machines` (machines à café),
`commandes`, `detail_commandes` (commandes café),
`commande__m_s`, `detail_commande_m_s` (commandes machines),
`stocks`, `stock_machines`, `gestion_pris` (tarifs), `livreurs`,
`supports`, `faqs`, `banners`, `contacts`, `settings`.

---

## 👤 Auteur

**Lotfi**
Projet de Fin d'Études — Licence
Dépôt : [https://github.com/lotfi7021/selectcars_pfe](https://github.com/lotfi7021/selectcars_pfe)

---

## 📄 Licence

Projet académique réalisé dans un cadre pédagogique (PFE Licence).
