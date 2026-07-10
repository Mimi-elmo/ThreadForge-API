# ThreadForge API

API de repurposing de contenu technique en posts X/Twitter, propulsée par Laravel AI + Groq.

## Prérequis

- PHP ^8.3
- Composer
- Node.js & npm
- MySQL (ou SQLite en dev)
- Une clé API [Groq](https://console.groq.com)

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

## Configuration

Renseignez votre clé Groq dans `.env` :

```
GROQ_API_KEY=votre_clé_ici
```

## Lancement

```bash
composer run dev
```

Lance le serveur (`php artisan serve`), la queue (`php artisan queue:listen`) et Vite simultanément.

## Tests

```bash
composer run test
```

Équivalent à :

```bash
php artisan config:clear
php artisan test
```

Les tests utilisent **Pest** et une base SQLite en mémoire. Aucune vraie API IA n'est appelée — la queue est faked avec `Queue::fake()`.

### Structure des tests

| Fichier | Ce qu'il teste |
|---------|----------------|
| `tests/Feature/AuthTest.php` | Login (200 avec token, 401 avec mauvais password) |
| `tests/Feature/BlueprintAuthTest.php` | Route protégée (401 sans token, 200 + structure avec token) |
| `tests/Feature/BlueprintValidationTest.php` | Validation (422 sur champ obligatoire manquant) |
| `tests/Feature/RawContentTest.php` | Génération asynchrone (202 + dispatch du Job) |

## API

Toutes les routes sont préfixées par `/api`.

### Authentification

| Méthode | Route | Description |
|---------|-------|-------------|
| POST | `/api/register` | Créer un compte |
| POST | `/api/login` | Se connecter (reçoit un token Sanctum) |
| POST | `/api/logout` | Révoquer le token (auth requis) |

### Blueprints

| Méthode | Route | Description |
|---------|-------|-------------|
| GET | `/api/blueprints` | Lister les blueprints (auth requis) |
| POST | `/api/blueprints` | Créer un blueprint (auth requis) |
| GET | `/api/blueprints/{id}` | Voir un blueprint (auth requis) |
| PUT/PATCH | `/api/blueprints/{id}` | Modifier un blueprint (auth requis) |
| DELETE | `/api/blueprints/{id}` | Supprimer un blueprint (auth requis) |

### Posts

| Méthode | Route | Description |
|---------|-------|-------------|
| GET | `/api/posts` | Lister les posts (auth requis) |
| POST | `/api/posts` | Créer un post (auth requis) |
| GET | `/api/posts/{id}` | Voir un post (auth requis) |
| PUT/PATCH | `/api/posts/{id}` | Modifier un post (auth requis) |
| DELETE | `/api/posts/{id}` | Supprimer un post (auth requis) |

### Content

| Méthode | Route | Description |
|---------|-------|-------------|
| POST | `/api/content/repurpose` | Envoyer du contenu brut → génération asynchrone (auth requis) |

## Déploiement

> ⚠️ **Non déployé** — API disponible uniquement en local.

<!-- Si déployé : remplacer par l'URL réelle
**URL de l'API :** `https://votre-domaine.com/api`
-->
