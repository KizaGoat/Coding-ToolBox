# 🚀 Coding Tool Box – Guide d'installation

Bienvenue dans **Coding Tool Box**, un outil complet de gestion pédagogique conçu pour la Coding Factory.  
Ce projet Laravel inclut la gestion des groupes, promotions, étudiants, rétro (Kanban), QCM  dynamiques, et bien plus.

---

## 📦 Prérequis

Assurez-vous d’avoir les éléments suivants installés sur votre machine :

- PHP ≥ 8.1
- Composer
- MySQL ou MariaDB
- Node.js + npm (pour les assets frontend si nécessaire)
- Laravel CLI (`composer global require laravel/installer`)

---

## ⚙️ Installation du projet

Exécutez les étapes ci-dessous pour lancer le projet en local :

### 1. Cloner le dépôt

```bash
git clone https://m_thibaud@bitbucket.org/m_thibaud/projet-web-2025.git
cd coding-tool-box
cp .env.example .env
```

### 2. Configuration de l'environnement

```bash
✍️ Ouvrez le fichier .env et configurez les paramètres liés à votre base de données :

DB_DATABASE=nom_de_votre_bdd
DB_USERNAME=utilisateur
DB_PASSWORD=motdepasse
```

### 3. Installation des dépendances PHP

```bash
composer install
```

### 4. Nettoyage et optimisation du cache

```bash
php artisan optimize:clear
```

### 5. Génération de la clé d'application

```bash
php artisan key:generate
```

### 6. Migration de la base de données

```bash
php artisan migrate
```

### 7. Population de la base (Données de test)

```bash
php artisan db:seed
```

---

## 💻 Compilation des assets (si nécessaire)

```bash
npm install
npm run dev
```

---

## 👤 Comptes de test disponibles

| Rôle       | Email                     | Mot de passe                                                        |
|------------|---------------------------|---------------------------------------------------------------------|
| **Admin**  | admin@codingfactory.com   | 12345678                                                            |
| Enseignant | teacher@codingfactory.com | 123456                                                              |
| Étudiant   | student@codingfactory.com | 123456 (a recrée si besoin car supprimer pour teste du bouton delete) |

---

## 🚧 Fonctionnalités principales

- 🔧 Gestion des groupes, promotions, étudiants
- 📅 Vie commune avec système de pointage
- 📊 Bilans semestriels étudiants via QCM générés par IA
- 🧠 Génération automatique de QCM par langage sélectionné
- ✅ Système de Kanban pour les rétrospectives
- 📈 Statistiques d’usage et suivi pédagogique




✅ User Stories – État d'avancement

Tous d'abord j'ai un ptit probleme qui fait que les forms sont visible sur le compte admin et teacher
alors qu'il est censé etre que sur admin pourtant le code est bien present j'ai juste pas activé les can et endcan
pour evité les problemes mais tu peut le voir dans le CohortPolicy.

et puis l'affichage des students dans une promo est en dure aussi 

sinon tous est bon



Story 1 : ✅ Tout est fait.

Story 2 : ⚠️ Presque tout est fait.
L’enseignant ne peut pas encore voir les promotions auxquelles il est lié sur sa page personnelle.

Story 3 : ⚠️ Presque tout est fait.
L’email ne s’envoie pas
pour l'etudiant on peut modifier ou lui mettre une promo seulement il ne s'affichera pas dans la pages correspondante mais il fonctionne en back (dans la bdd)

Story 4 : ✅ Tout est fait.

Story 5 : ✅ Tout est fait.

Story 6 : ⚠️ presque fait.
L’avatar ne s'affiche pas, je ne comprends pas pourquoi, pourtant le code a bien été rédigé. Le reste fonctionne.
