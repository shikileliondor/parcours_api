# Prompt prêt à l'emploi pour générer un client Flutter des APIs métiers

Copie/colle ce prompt dans ton assistant IA préféré pour qu'il te génère l'intégration Flutter complète.

```text
Tu es un expert Flutter/Dart.
Génère le code complet (production-ready) pour consommer une API Laravel de métiers.

## Contexte API
Base URL: http://10.0.2.2:8000/api (Android Emulator) avec possibilité de remplacer via configuration.

Endpoints:
- GET /metiers
- GET /metiers/{id}
- GET /metiers/{id}/fiche
- GET /metiers/{id}/competences
- GET /metiers/{id}/parcours-etudes
- GET /metiers/{id}/ecoles?ville={ville}&pays={pays}

Exemple JSON /metiers/{id}/fiche:
{
  "id": 4,
  "nom": "Chef de projet",
  "description": "Gère les projets et coordonne les équipes",
  "salaire": { "min": 25000, "moyen": 40000, "max": 70000, "devise": "FCFA" },
  "duree_estimee": "3 à 5 ans",
  "competences": [{"id": 1, "nom": "Programmation", "description": "..."}],
  "parcours_etudes": [{"id": 1, "nom": "Licence", "niveau": "Bac +3", "description": "..."}],
  "ecoles_recommandees": [{"id": 1, "nom": "ESATIC", "ville": "Abidjan", "pays": "Côte d'Ivoire", "site_web": "https://..."}],
  "roadmap": [{"id": 1, "ordre": 1, "titre": "Diplôme requis", "description": "..."}]
}

## Ce que je veux
1) Crée une architecture claire:
   - data/models
   - data/services (API client)
   - data/repositories
   - presentation (Provider/Riverpod au choix, mais explique ton choix)

2) Utilise Dio (ou http) avec:
   - timeout
   - gestion d'erreurs réseau/API
   - parsing JSON robuste
   - logs en debug

3) Crée les modèles Dart sérialisables:
   - Metier
   - MetierFiche
   - Salaire
   - Competence
   - ParcoursEtude
   - Ecole
   - RoadmapEtape
   - wrappers des endpoints (ex: MetierCompetencesResponse)

4) Fournis un service `MetierApiService` avec méthodes:
   - Future<List<Metier>> getMetiers()
   - Future<Metier> getMetierById(int id)
   - Future<MetierFiche> getMetierFiche(int id)
   - Future<List<Competence>> getMetierCompetences(int id)
   - Future<List<ParcoursEtude>> getMetierParcoursEtudes(int id)
   - Future<List<Ecole>> getMetierEcoles(int id, {String? ville, String? pays})

5) Ajoute un repository `MetierRepository` qui encapsule le service.

6) Donne un exemple d'écran Flutter:
   - liste des métiers
   - navigation vers détail fiche
   - affichage des compétences/parcours/écoles
   - état loading/error/empty

7) Génère aussi:
   - pubspec.yaml (dépendances nécessaires)
   - fichier de configuration `api_config.dart` pour changer facilement la base URL selon plateforme.

8) Tests:
   - un test unitaire de parsing JSON
   - un test mock API pour le repository

Contraintes:
- Code null-safe
- Compatible Flutter stable
- Commentaires courts mais utiles
- Réponse finale organisée par fichiers, avec le contenu complet de chaque fichier.
```
