# API Parcours V1 - URLs publiques

Base locale (Laravel): `http://127.0.0.1:8000`

## Endpoints utilisateur (sans auth)
- `GET http://127.0.0.1:8000/api/v1/home?name=Camille`
- `GET http://127.0.0.1:8000/api/v1/me?name=Camille%20Martin`

## Métiers
- `GET http://127.0.0.1:8000/api/v1/metiers`
- `GET http://127.0.0.1:8000/api/v1/metiers?q=data&niveau=intermediaire&page=1&per_page=20`
- `GET http://127.0.0.1:8000/api/v1/metiers/{metier_id}`
- `GET http://127.0.0.1:8000/api/v1/metiers/{metier_id}/fiche`
- `GET http://127.0.0.1:8000/api/v1/metiers/{metier_id}/competences`
- `GET http://127.0.0.1:8000/api/v1/metiers/{metier_id}/parcours-etudes`
- `GET http://127.0.0.1:8000/api/v1/metiers/{metier_id}/ecoles`
- `GET http://127.0.0.1:8000/api/v1/metiers/{metier_id}/roadmap`

## Écoles
- `GET http://127.0.0.1:8000/api/v1/ecoles`
- `GET http://127.0.0.1:8000/api/v1/ecoles?search=abidjan&type=Institut&page=1&per_page=20`
- `GET http://127.0.0.1:8000/api/v1/ecoles/filters`
- `GET http://127.0.0.1:8000/api/v1/ecoles/{ecole_id}`
- `GET http://127.0.0.1:8000/api/v1/ecoles/{ecole_id}/formations`

## Référentiels
- `GET http://127.0.0.1:8000/api/v1/domaines`
- `GET http://127.0.0.1:8000/api/v1/niveaux`
- `GET http://127.0.0.1:8000/api/v1/types-etablissements`
- `GET http://127.0.0.1:8000/api/v1/villes`

## Démarrage serveur local
```bash
php artisan serve
```
