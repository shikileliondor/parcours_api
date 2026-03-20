import 'package:flutter/material.dart';

import 'components/parcours_widgets.dart';
import 'data/mock_data.dart';
import 'design_system.dart';

void main() {
  runApp(const ParcoursApp());
}

class ParcoursApp extends StatelessWidget {
  const ParcoursApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      theme: parcoursTheme(),
      home: const RootScreen(),
    );
  }
}

class RootScreen extends StatefulWidget {
  const RootScreen({super.key});

  @override
  State<RootScreen> createState() => _RootScreenState();
}

class _RootScreenState extends State<RootScreen> {
  int _navIndex = 0;
  int _homeCategory = 0;
  int _metierCategory = 0;
  int _ecoleCategory = 0;

  @override
  Widget build(BuildContext context) {
    final body = switch (_navIndex) {
      0 => _homeScreen(),
      1 => _metiersScreen(),
      2 => _ecolesScreen(),
      _ => _emptyState('Aucun résultat'),
    };

    return Scaffold(
      backgroundColor: ParcoursColors.primaryBg,
      body: SafeArea(child: body),
      bottomNavigationBar: ParcoursBottomNav(
        current: _navIndex,
        onChanged: (index) {
          if (index == 3) return;
          setState(() => _navIndex = index);
        },
      ),
    );
  }

  Widget _homeScreen() {
    return ListView(
      padding: const EdgeInsets.symmetric(vertical: 16),
      children: [
        const HeroCard(),
        const SizedBox(height: 12),
        Padding(
          padding: const EdgeInsets.symmetric(horizontal: 16),
          child: Row(
            children: const [
              Expanded(child: StatCard(emoji: '🎯', number: '84', label: 'Métiers')),
              SizedBox(width: 8),
              Expanded(child: StatCard(emoji: '🏫', number: '120', label: 'Écoles')),
              SizedBox(width: 8),
              Expanded(child: StatCard(emoji: '🛤', number: '36', label: 'Roadmaps')),
            ],
          ),
        ),
        const SizedBox(height: 12),
        const Padding(padding: EdgeInsets.symmetric(horizontal: 16), child: SearchBarCard()),
        const SizedBox(height: 12),
        SizedBox(
          height: 34,
          child: ListView.separated(
            scrollDirection: Axis.horizontal,
            padding: const EdgeInsets.symmetric(horizontal: 16),
            itemBuilder: (_, i) => CategoryChip(
              label: categories[i],
              active: i == _homeCategory,
              onTap: () => setState(() => _homeCategory = i),
            ),
            separatorBuilder: (_, __) => const SizedBox(width: 8),
            itemCount: categories.length,
          ),
        ),
        const SizedBox(height: 16),
        Padding(
          padding: const EdgeInsets.symmetric(horizontal: 16),
          child: Text('Parcours recommandés', style: ParcoursText.h2),
        ),
        Padding(
          padding: const EdgeInsets.symmetric(horizontal: 16),
          child: Text('Sélection personnalisée pour toi', style: ParcoursText.bodySmall),
        ),
        const SizedBox(height: 10),
        ...metiers.asMap().entries.map(
              (e) => Padding(
                padding: const EdgeInsets.fromLTRB(16, 0, 16, 8),
                child: StaggerItem(
                  index: e.key,
                  child: MetierCard(
                    item: e.value,
                    onTap: () => Navigator.of(context).push(MaterialPageRoute(builder: (_) => const MetierDetailScreen())),
                  ),
                ),
              ),
            ),
      ],
    );
  }

  Widget _metiersScreen() {
    return ListView(
      padding: const EdgeInsets.all(16),
      children: [
        Text('Métiers', style: ParcoursText.h1),
        const SizedBox(height: 12),
        const SearchBarCard(),
        const SizedBox(height: 12),
        SizedBox(
          height: 34,
          child: ListView.separated(
            scrollDirection: Axis.horizontal,
            itemBuilder: (_, i) => CategoryChip(
              label: categories[i],
              active: i == _metierCategory,
              onTap: () => setState(() => _metierCategory = i),
            ),
            separatorBuilder: (_, __) => const SizedBox(width: 8),
            itemCount: categories.length,
          ),
        ),
        const SizedBox(height: 12),
        ...metiers.asMap().entries.map(
              (e) => Padding(
                padding: const EdgeInsets.only(bottom: 8),
                child: StaggerItem(
                  index: e.key,
                  child: MetierCard(
                    item: e.value,
                    onTap: () => Navigator.of(context).push(MaterialPageRoute(builder: (_) => const MetierDetailScreen())),
                  ),
                ),
              ),
            ),
      ],
    );
  }

  Widget _ecolesScreen() {
    const filters = ['Toutes', 'Université', 'Grande école', 'Institut', 'Commerce'];
    return ListView(
      padding: const EdgeInsets.all(16),
      children: [
        Text('Écoles', style: ParcoursText.h1),
        const SizedBox(height: 12),
        const SearchBarCard(),
        const SizedBox(height: 12),
        SizedBox(
          height: 34,
          child: ListView.separated(
            scrollDirection: Axis.horizontal,
            itemBuilder: (_, i) => CategoryChip(
              label: filters[i],
              active: i == _ecoleCategory,
              onTap: () => setState(() => _ecoleCategory = i),
            ),
            separatorBuilder: (_, __) => const SizedBox(width: 8),
            itemCount: filters.length,
          ),
        ),
        const SizedBox(height: 12),
        ...ecoles.asMap().entries.map(
              (e) => Padding(
                padding: const EdgeInsets.only(bottom: 8),
                child: StaggerItem(
                  index: e.key,
                  child: EcoleCard(
                    item: e.value,
                    onTap: () => Navigator.of(context).push(MaterialPageRoute(builder: (_) => EcoleDetailScreen(item: e.value))),
                  ),
                ),
              ),
            ),
      ],
    );
  }

  Widget _emptyState(String text) {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Container(width: 96, height: 96, decoration: BoxDecoration(color: ParcoursColors.surface2, borderRadius: BorderRadius.circular(16))),
          const SizedBox(height: 10),
          Text(text, style: ParcoursText.body.copyWith(color: ParcoursColors.textTertiary)),
        ],
      ),
    );
  }
}

class MetierDetailScreen extends StatelessWidget {
  const MetierDetailScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: ParcoursColors.primaryBg,
      body: Column(
        children: [
          const DetailHero(emoji: '💻', title: 'Développeur mobile', badges: ['Bac+3 à Bac+5', 'Tech/Web']),
          Expanded(
            child: ListView(
              padding: const EdgeInsets.all(16),
              children: [
                SectionCard(
                  icon: '📝',
                  title: 'Description',
                  child: Text('Conçoit et développe des applications mobiles performantes et utiles.', style: ParcoursText.body),
                ),
                const SectionCard(icon: '💰', title: 'Salaire mensuel', child: SalaryCardContent()),
                SectionCard(
                  icon: '✅',
                  title: 'Compétences requises',
                  child: Column(children: skills.map((s) => SkillRow(name: s)).toList()),
                ),
                SectionCard(
                  icon: '🛤',
                  title: 'Roadmap d\'apprentissage',
                  child: Column(
                    children: roadmap.asMap().entries.map((e) => RoadmapStep(index: e.key, item: e.value, isLast: e.key == roadmap.length - 1)).toList(),
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
      bottomNavigationBar: const ParcoursBottomNav(current: 1, onChanged: _noopNav),
    );
  }
}

class EcoleDetailScreen extends StatelessWidget {
  const EcoleDetailScreen({super.key, required this.item});

  final EcoleItem item;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: ParcoursColors.primaryBg,
      body: Column(
        children: [
          DetailHero(emoji: '◫', title: item.name, badges: [item.type, item.location]),
          Expanded(
            child: ListView(
              padding: const EdgeInsets.all(16),
              children: [
                SectionCard(icon: 'ℹ', title: 'À propos', child: Text(item.about, style: ParcoursText.body)),
                SectionCard(icon: '◉', title: 'Domaines', child: Wrap(spacing: 6, runSpacing: 6, children: item.domaines.map((d) => TagBadge(text: d)).toList())),
                SectionCard(
                  icon: '🎓',
                  title: 'Filières proposées',
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: List.generate(item.filieres, (i) => Padding(
                      padding: const EdgeInsets.only(bottom: 8),
                      child: Text('▸ Filière ${i + 1}', style: ParcoursText.body),
                    )),
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
      bottomNavigationBar: const ParcoursBottomNav(current: 2, onChanged: _noopNav),
    );
  }
}

void _noopNav(int _) {}
