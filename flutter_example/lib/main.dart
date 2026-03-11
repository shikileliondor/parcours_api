import 'package:flutter/material.dart';

import 'pages/metiers_page.dart';

void main() {
  runApp(const ParcoursApp());
}

class ParcoursApp extends StatelessWidget {
  const ParcoursApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Parcours',
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: Colors.indigo),
        useMaterial3: true,
      ),
      home: const MetiersPage(),
    );
  }
}
