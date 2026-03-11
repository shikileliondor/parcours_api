class Metier {
  final int id;
  final String nom;
  final String description;
  final int salaireMin;
  final int salaireMoyen;
  final int salaireMax;

  const Metier({
    required this.id,
    required this.nom,
    required this.description,
    required this.salaireMin,
    required this.salaireMoyen,
    required this.salaireMax,
  });

  factory Metier.fromJson(Map<String, dynamic> json) {
    return Metier(
      id: json['id'] as int,
      nom: json['nom'] as String,
      description: json['description'] as String,
      salaireMin: json['salaire_min'] as int,
      salaireMoyen: json['salaire_moyen'] as int,
      salaireMax: json['salaire_max'] as int,
    );
  }
}
