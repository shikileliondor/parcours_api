import 'package:flutter/material.dart';

import '../models/metier.dart';
import '../services/metier_api_service.dart';

class MetiersPage extends StatefulWidget {
  const MetiersPage({super.key});

  @override
  State<MetiersPage> createState() => _MetiersPageState();
}

class _MetiersPageState extends State<MetiersPage> {
  late Future<List<Metier>> _metiersFuture;
  final MetierApiService _apiService = MetierApiService();

  @override
  void initState() {
    super.initState();
    _metiersFuture = _apiService.fetchMetiers();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Métiers')),
      body: FutureBuilder<List<Metier>>(
        future: _metiersFuture,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const Center(child: CircularProgressIndicator());
          }

          if (snapshot.hasError) {
            return Center(
              child: Padding(
                padding: const EdgeInsets.all(16),
                child: Text('Impossible de charger les métiers: ${snapshot.error}'),
              ),
            );
          }

          final metiers = snapshot.data ?? <Metier>[];

          if (metiers.isEmpty) {
            return const Center(child: Text('Aucun métier trouvé.'));
          }

          return ListView.separated(
            itemCount: metiers.length,
            separatorBuilder: (_, __) => const Divider(height: 1),
            itemBuilder: (context, index) {
              final metier = metiers[index];
              return ListTile(
                title: Text(metier.nom),
                subtitle: Text(metier.description),
                trailing: Text('${metier.salaireMoyen} €'),
              );
            },
          );
        },
      ),
    );
  }
}
