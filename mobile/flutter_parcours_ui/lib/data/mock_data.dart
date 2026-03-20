import 'package:flutter/material.dart';

import '../design_system.dart';

class MetierItem {
  const MetierItem({
    required this.emoji,
    required this.title,
    required this.level,
    required this.tags,
    required this.iconBg,
  });

  final String emoji;
  final String title;
  final String level;
  final List<String> tags;
  final Color iconBg;
}

class EcoleItem {
  const EcoleItem({
    required this.name,
    required this.type,
    required this.location,
    required this.filieres,
    required this.domaines,
    required this.about,
  });

  final String name;
  final String type;
  final String location;
  final int filieres;
  final List<String> domaines;
  final String about;
}

class RoadmapItem {
  const RoadmapItem({
    required this.title,
    required this.description,
    required this.duration,
    required this.bg,
    required this.text,
  });

  final String title;
  final String description;
  final String duration;
  final Color bg;
  final Color text;
}

const categories = ['Tous', 'Tech', 'Santé', 'Design', 'Finance', 'Soft skills'];

const metiers = <MetierItem>[
  MetierItem(
    emoji: '💻',
    title: 'Développeur mobile',
    level: 'Bac+3 à Bac+5',
    tags: ['Tech/Web', 'Soft skills'],
    iconBg: ParcoursColors.tagBlueBg,
  ),
  MetierItem(
    emoji: '⚕️',
    title: 'Infirmier spécialisé',
    level: 'Bac+3',
    tags: ['Santé', 'Général'],
    iconBg: ParcoursColors.tagRedBg,
  ),
  MetierItem(
    emoji: '✦',
    title: 'UX Designer',
    level: 'Bac+2 à Bac+5',
    tags: ['Design', 'Soft skills'],
    iconBg: ParcoursColors.tagGoldBg,
  ),
  MetierItem(
    emoji: '▲',
    title: 'Analyste financier',
    level: 'Bac+5',
    tags: ['Finance', 'Général'],
    iconBg: ParcoursColors.tagAmberBg,
  ),
];

const ecoles = <EcoleItem>[
  EcoleItem(
    name: 'ESATIC',
    type: 'Institut',
    location: 'Abidjan',
    filieres: 4,
    domaines: ['Informatique', 'Réseaux', 'Cybersécurité'],
    about: 'École spécialisée dans les technologies de l’information.',
  ),
  EcoleItem(
    name: 'Université Félix Houphouët-Boigny',
    type: 'Université',
    location: 'Abidjan',
    filieres: 12,
    domaines: ['Santé', 'Droit', 'Sciences'],
    about: 'Grande université pluridisciplinaire de référence en Côte d’Ivoire.',
  ),
  EcoleItem(
    name: 'Institut Supérieur de Commerce',
    type: 'Commerce',
    location: 'Yamoussoukro',
    filieres: 6,
    domaines: ['Management', 'Finance', 'Marketing'],
    about: 'Formations professionnalisantes orientées entreprise.',
  ),
];

const skills = [
  'Communication claire',
  'Résolution de problèmes',
  'Travail d’équipe',
  'Bases techniques solides',
];

const roadmap = [
  RoadmapItem(
    title: 'Acquérir les fondamentaux',
    description: 'Apprends les bases et découvre les outils du métier.',
    duration: '3 mois',
    bg: ParcoursColors.accentGreenLight,
    text: ParcoursColors.accentGreen,
  ),
  RoadmapItem(
    title: 'Construire des projets',
    description: 'Réalise 2 à 3 projets concrets pour ton portfolio.',
    duration: '4 mois',
    bg: ParcoursColors.tagBlueBg,
    text: ParcoursColors.tagBlueText,
  ),
  RoadmapItem(
    title: 'Se spécialiser',
    description: 'Choisis une spécialité alignée avec tes objectifs.',
    duration: '5 mois',
    bg: ParcoursColors.tagAmberBg,
    text: ParcoursColors.tagAmberText,
  ),
  RoadmapItem(
    title: 'Préparer l’insertion',
    description: 'Optimise ton CV et prépare les entretiens.',
    duration: '2 mois',
    bg: ParcoursColors.tagGreenBg,
    text: ParcoursColors.tagGreenText,
  ),
];
