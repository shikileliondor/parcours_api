import 'dart:convert';

import 'package:http/http.dart' as http;

import '../models/metier.dart';

class MetierApiService {
  static const String _baseUrl = 'http://10.0.2.2:8000/api/metiers';

  Future<List<Metier>> fetchMetiers() async {
    final response = await http.get(Uri.parse(_baseUrl));

    if (response.statusCode != 200) {
      throw Exception('Erreur API: ${response.statusCode}');
    }

    final List<dynamic> decoded = jsonDecode(response.body) as List<dynamic>;

    return decoded
        .map((item) => Metier.fromJson(item as Map<String, dynamic>))
        .toList();
  }
}
