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

## Décisions produit/BDD V1 (discussion)

Suite à la discussion de cadrage, les décisions V1 retenues sont :

1. **Comptes utilisateurs dès la V1 (recommandation)**
   - garder `utilisateurs` dès maintenant pour activer les favoris, la progression roadmap et la personnalisation basique ;
   - démarrer simple (email, mot de passe, rôle, timestamps), puis enrichir le profil en V2.
2. **Contacts établissements en V1**
   - inclure directement les champs de contact (email, téléphone, site web, adresse).
3. **Coût des formations en V1**
   - stocker un coût indicatif pour aider la décision (montant min/max + devise si possible).
4. **Un seul parcours par métier en V1**
   - simplifie l'expérience et l'administration de contenu ;
   - la multi-version roadmap pourra être ajoutée en V2.

### Recommandation détaillée pour le point 1 ("tu proposes quoi ?")

Je recommande de **garder les utilisateurs dès la V1**, en version légère :

- `utilisateurs` (authentification + rôle)
- `favoris_metiers`
- `favoris_etablissements`
- `progressions_parcours`

Cela apporte une vraie valeur produit immédiate sans alourdir fortement le modèle.
