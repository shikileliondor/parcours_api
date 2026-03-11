# Parcours API (Laravel)

API REST minimale pour tester la communication entre Flutter (application mobile **Parcours**) et un backend Laravel.

## Ressource principale

Table unique : `metiers`

Champs :
- `nom`
- `description`
- `salaire_min`
- `salaire_moyen`
- `salaire_max`

## Endpoints API

- `GET /api/metiers` : retourne la liste des métiers
- `GET /api/metiers/{id}` : retourne le détail d'un métier

## Exemple de réponse JSON

```json
[
  {
    "id": 1,
    "nom": "Développeur Web",
    "description": "Crée des applications web",
    "salaire_min": 20000,
    "salaire_moyen": 35000,
    "salaire_max": 60000
  }
]
```

## Connexion Flutter ↔ Laravel (émulateur Android)

Le dossier `flutter_example/` contient un exemple complet minimal qui :

1. appelle l'API Laravel,
2. transforme le JSON en objets `Metier`,
3. affiche les métiers dans une liste Flutter.

### Point important pour Android Emulator

Depuis l'émulateur Android, `127.0.0.1` pointe vers l'émulateur lui-même, pas vers la machine hôte.
Il faut donc utiliser :

- `http://10.0.2.2:8000/api/metiers`

Cette URL est déjà configurée dans :
`flutter_example/lib/services/metier_api_service.dart`.

### Fichiers Flutter d'exemple

- `flutter_example/lib/models/metier.dart`
- `flutter_example/lib/services/metier_api_service.dart`
- `flutter_example/lib/pages/metiers_page.dart`
- `flutter_example/lib/main.dart`
- `flutter_example/pubspec.yaml`

## Fichiers ajoutés

- Modèle : `app/Models/Metier.php`
- Contrôleur API : `app/Http/Controllers/Api/MetierController.php`
- Migration : `database/migrations/2026_03_11_000000_create_metiers_table.php`
- Routes : `routes/api.php`
- Seeders : `database/seeders/MetierSeeder.php` et `database/seeders/DatabaseSeeder.php`

## Notes

Ce dépôt ne contient pas encore l'intégralité du squelette Laravel (artisan, composer.json, bootstrap, etc.).
Le code livré ici correspond aux éléments métier/API demandés, prêts à être intégrés dans un projet Laravel standard.
