# Listing des tables V1 (avant implémentation)

Ce document liste les tables proposées pour une V1 **simple mais complète** de Parcours, ciblée Côte d'Ivoire, avec nommage en français.

## 1) Référentiels

1. `pays`
2. `villes`
3. `types_etablissements`
4. `domaines_etudes`
5. `niveaux_etudes`
6. `types_ressources`

## 2) Métiers et compétences

7. `metiers`
8. `competences`
9. `metiers_competences`
10. `metiers_domaines`

## 3) Parcours d'apprentissage (roadmap)

11. `parcours_metiers`
12. `etapes_parcours`
13. `ressources_etapes`
14. `etapes_competences`

## 4) Établissements et formations

15. `etablissements`
16. `formations`
17. `formations_metiers`
18. `etablissements_domaines`

## 5) Utilisateurs et progression

19. `utilisateurs`
20. `profils_utilisateurs`
21. `favoris_metiers`
22. `favoris_etablissements`
23. `progressions_parcours`
24. `progressions_etapes`

## 6) Contenu transverse

25. `medias`
26. `tags`
27. `metiers_tags`
28. `etablissements_tags`
29. `parametres_application`
30. `journaux_audit`

---

## Notes de cadrage

- V1 garde **un seul parcours actif par métier**.
- Les coûts de formation sont inclus dans `formations` (ex: `cout_min`, `cout_max`, `devise`).
- Les contacts sont inclus dans `etablissements` (ex: `email`, `telephone`, `site_web`, `adresse`).
- Les tables de liaison (`*_metiers`, `*_domaines`, etc.) sont prévues pour les relations N-N.
