# Champs des tables V1 (discussion avant implémentation)

> Objectif: valider les colonnes principales de chaque table avant d'écrire les migrations.

## Convention commune

- Clé primaire: `id` (UUID recommandé)
- Horodatage: `cree_le`, `mis_a_jour_le`
- Soft delete (si utile): `supprime_le`

---

## 1) Référentiels

### `pays`
- `id`
- `nom`
- `code_iso2` (unique)
- `code_telephone`
- `est_actif`
- `cree_le`, `mis_a_jour_le`

### `villes`
- `id`
- `pays_id` (FK `pays.id`)
- `nom`
- `slug` (unique)
- `est_actif`
- `cree_le`, `mis_a_jour_le`

### `types_etablissements`
- `id`
- `libelle` (ex: Université, Institut)
- `description`
- `cree_le`, `mis_a_jour_le`

### `domaines_etudes`
- `id`
- `nom`
- `slug` (unique)
- `description`
- `cree_le`, `mis_a_jour_le`

### `niveaux_etudes`
- `id`
- `nom` (ex: BTS, Licence, Master)
- `ordre`
- `description`
- `cree_le`, `mis_a_jour_le`

### `types_ressources`
- `id`
- `libelle` (ex: vidéo, article, cours)
- `cree_le`, `mis_a_jour_le`

---

## 2) Métiers et compétences

### `metiers`
- `id`
- `nom`
- `slug` (unique)
- `description`
- `niveau` (debutant|intermediaire|avance)
- `salaire_min`
- `salaire_max`
- `devise`
- `duree_estimee`
- `est_publie`
- `cree_le`, `mis_a_jour_le`, `supprime_le`

### `competences`
- `id`
- `nom`
- `slug` (unique)
- `description`
- `categorie`
- `cree_le`, `mis_a_jour_le`

### `metiers_competences`
- `id`
- `metier_id` (FK)
- `competence_id` (FK)
- `niveau_requis` (debutant|intermediaire|avance)
- `priorite` (1-5)
- `cree_le`, `mis_a_jour_le`

### `metiers_domaines`
- `id`
- `metier_id` (FK)
- `domaine_etude_id` (FK)
- `cree_le`, `mis_a_jour_le`

---

## 3) Parcours d'apprentissage

### `parcours_metiers`
- `id`
- `metier_id` (FK)
- `titre`
- `description`
- `version` (int)
- `est_actif`
- `cree_le`, `mis_a_jour_le`

### `etapes_parcours`
- `id`
- `parcours_metier_id` (FK)
- `ordre`
- `titre`
- `description`
- `duree_estimee_semaines`
- `cree_le`, `mis_a_jour_le`

### `ressources_etapes`
- `id`
- `etape_parcours_id` (FK)
- `type_ressource_id` (FK)
- `titre`
- `url`
- `source`
- `est_gratuit`
- `cree_le`, `mis_a_jour_le`

### `etapes_competences`
- `id`
- `etape_parcours_id` (FK)
- `competence_id` (FK)
- `niveau_cible`
- `cree_le`, `mis_a_jour_le`

---

## 4) Établissements et formations

### `etablissements`
- `id`
- `nom`
- `slug` (unique)
- `type_etablissement_id` (FK)
- `ville_id` (FK)
- `description`
- `adresse`
- `email`
- `telephone`
- `site_web`
- `est_publie`
- `cree_le`, `mis_a_jour_le`, `supprime_le`

### `formations`
- `id`
- `etablissement_id` (FK)
- `domaine_etude_id` (FK)
- `niveau_etude_id` (FK)
- `titre`
- `slug` (unique)
- `description`
- `duree_mois`
- `cout_min`
- `cout_max`
- `devise`
- `conditions_admission`
- `est_publie`
- `cree_le`, `mis_a_jour_le`, `supprime_le`

### `formations_metiers`
- `id`
- `formation_id` (FK)
- `metier_id` (FK)
- `pertinence` (1-5)
- `cree_le`, `mis_a_jour_le`

### `etablissements_domaines`
- `id`
- `etablissement_id` (FK)
- `domaine_etude_id` (FK)
- `cree_le`, `mis_a_jour_le`

---

## 5) Utilisateurs et progression

### `utilisateurs`
- `id`
- `nom`
- `prenoms`
- `email` (unique)
- `mot_de_passe`
- `role` (etudiant|admin|editeur)
- `est_actif`
- `dernier_login_le`
- `cree_le`, `mis_a_jour_le`, `supprime_le`

### `profils_utilisateurs`
- `id`
- `utilisateur_id` (FK, unique)
- `ville_id` (FK, nullable)
- `niveau_etude_id` (FK, nullable)
- `date_naissance` (nullable)
- `genre` (nullable)
- `bio` (nullable)
- `cree_le`, `mis_a_jour_le`

### `favoris_metiers`
- `id`
- `utilisateur_id` (FK)
- `metier_id` (FK)
- `cree_le`

### `favoris_etablissements`
- `id`
- `utilisateur_id` (FK)
- `etablissement_id` (FK)
- `cree_le`

### `progressions_parcours`
- `id`
- `utilisateur_id` (FK)
- `parcours_metier_id` (FK)
- `statut` (non_commence|en_cours|termine)
- `pourcentage` (0-100)
- `commence_le` (nullable)
- `termine_le` (nullable)
- `cree_le`, `mis_a_jour_le`

### `progressions_etapes`
- `id`
- `progression_parcours_id` (FK)
- `etape_parcours_id` (FK)
- `statut` (non_commence|en_cours|termine)
- `complete_le` (nullable)
- `cree_le`, `mis_a_jour_le`

---

## 6) Transverse

### `medias`
- `id`
- `nom_fichier`
- `url`
- `mime_type`
- `taille_octets`
- `alt`
- `cree_le`, `mis_a_jour_le`

### `tags`
- `id`
- `nom`
- `slug` (unique)
- `cree_le`, `mis_a_jour_le`

### `metiers_tags`
- `id`
- `metier_id` (FK)
- `tag_id` (FK)
- `cree_le`

### `etablissements_tags`
- `id`
- `etablissement_id` (FK)
- `tag_id` (FK)
- `cree_le`

### `parametres_application`
- `id`
- `cle` (unique)
- `valeur`
- `description`
- `cree_le`, `mis_a_jour_le`

### `journaux_audit`
- `id`
- `utilisateur_id` (FK, nullable)
- `action`
- `entite_type`
- `entite_id`
- `avant` (JSON nullable)
- `apres` (JSON nullable)
- `ip`
- `user_agent`
- `cree_le`
