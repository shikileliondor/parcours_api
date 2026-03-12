# Parcours API (Laravel)

API REST pour alimenter l'application mobile **Parcours**.

## Ressources couvertes

- Métier (données générales + salaire + durée estimée)
- Compétences requises
- Parcours d'étude
- Écoles recommandées
- Roadmap (étapes guidées)

## Endpoints API

- `GET /api/metiers` : liste des métiers
- `GET /api/metiers/{id}` : détail brut d'un métier
- `GET /api/metiers/{id}/fiche` : payload complet pour l'écran détail mobile
- `GET /api/metiers/{id}/competences` : compétences liées au métier
- `GET /api/metiers/{id}/parcours-etudes` : parcours d'étude liés au métier
- `GET /api/metiers/{id}/ecoles` : écoles liées au métier
  - filtres optionnels : `?ville=Dakar&pays=Sénégal`

## Exemple de réponse (`GET /api/metiers/{id}/fiche`)

```json
{
  "id": 4,
  "nom": "Chef de projet",
  "description": "Gère les projets et coordonne les équipes",
  "salaire": {
    "min": 25000,
    "moyen": 40000,
    "max": 70000,
    "devise": "FCFA"
  },
  "duree_estimee": "3 à 5 ans",
  "competences": [],
  "parcours_etudes": [],
  "ecoles_recommandees": [],
  "roadmap": [
    {
      "ordre": 1,
      "titre": "Diplôme requis"
    }
  ]
}
```

## Fichiers principaux

- Modèles : `app/Models/*.php`
- Contrôleur API : `app/Http/Controllers/Api/MetierController.php`
- Migrations : `database/migrations/*metier*`
- Routes : `routes/api.php`
- Seeders : `database/seeders/MetierSeeder.php`
