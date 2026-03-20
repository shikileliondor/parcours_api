import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

import '../data/mock_data.dart';
import '../design_system.dart';

class TapScale extends StatefulWidget {
  const TapScale({super.key, required this.child, this.onTap});

  final Widget child;
  final VoidCallback? onTap;

  @override
  State<TapScale> createState() => _TapScaleState();
}

class _TapScaleState extends State<TapScale> {
  bool _pressed = false;

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTapDown: (_) => setState(() => _pressed = true),
      onTapUp: (_) {
        setState(() => _pressed = false);
        widget.onTap?.call();
      },
      onTapCancel: () => setState(() => _pressed = false),
      child: AnimatedScale(
        scale: _pressed ? 0.98 : 1,
        duration: const Duration(milliseconds: 150),
        child: widget.child,
      ),
    );
  }
}

class StaggerItem extends StatelessWidget {
  const StaggerItem({super.key, required this.index, required this.child});

  final int index;
  final Widget child;

  @override
  Widget build(BuildContext context) {
    return TweenAnimationBuilder<double>(
      duration: Duration(milliseconds: 400 + (index * 50)),
      curve: Curves.easeOut,
      tween: Tween(begin: 0, end: 1),
      builder: (_, value, __) => Opacity(
        opacity: value,
        child: Transform.translate(
          offset: Offset(0, (1 - value) * 16),
          child: child,
        ),
      ),
    );
  }
}

class HeroCard extends StatelessWidget {
  const HeroCard({super.key});

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.symmetric(horizontal: ParcoursSpacing.lg),
      padding: const EdgeInsets.all(ParcoursSpacing.x2l),
      constraints: const BoxConstraints(minHeight: 130),
      decoration: BoxDecoration(
        color: ParcoursColors.accentGreen,
        borderRadius: BorderRadius.circular(ParcoursRadius.x2l),
      ),
      child: Stack(
        children: [
          Positioned(
            right: -30,
            top: -30,
            child: Container(
              width: 120,
              height: 120,
              decoration: const BoxDecoration(
                color: Color.fromRGBO(255, 255, 255, 0.06),
                shape: BoxShape.circle,
              ),
            ),
          ),
          Positioned(
            right: 30,
            bottom: -40,
            child: Container(
              width: 90,
              height: 90,
              decoration: const BoxDecoration(
                color: Color.fromRGBO(255, 255, 255, 0.04),
                shape: BoxShape.circle,
              ),
            ),
          ),
          Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Row(
                children: [
                  Text('Bonjour 👋', style: GoogleFonts.dmSans(color: Colors.white.withValues(alpha: .55), fontSize: 12)),
                  const Spacer(),
                  Container(
                    width: 40,
                    height: 40,
                    decoration: BoxDecoration(
                      color: Colors.white.withValues(alpha: .12),
                      borderRadius: BorderRadius.circular(12),
                      border: Border.all(color: Colors.white.withValues(alpha: .15)),
                    ),
                    alignment: Alignment.center,
                    child: const Text('✦', style: TextStyle(color: Colors.white)),
                  ),
                ],
              ),
              const SizedBox(height: 10),
              Text('Camille', style: GoogleFonts.dmSerifDisplay(fontSize: 26, color: Colors.white)),
              const SizedBox(height: 4),
              Text(
                'Explore des parcours adaptés à ton avenir',
                style: GoogleFonts.dmSans(
                  fontSize: 13,
                  fontWeight: FontWeight.w300,
                  color: Colors.white.withValues(alpha: .6),
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }
}

class StatCard extends StatelessWidget {
  const StatCard({super.key, required this.emoji, required this.number, required this.label});

  final String emoji;
  final String number;
  final String label;

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.symmetric(vertical: 14, horizontal: 10),
      decoration: BoxDecoration(
        color: ParcoursColors.surfaceWhite,
        borderRadius: BorderRadius.circular(ParcoursRadius.sm),
        border: Border.all(color: ParcoursColors.borderDefault),
      ),
      child: Column(
        children: [
          Text(emoji, style: const TextStyle(fontSize: 16)),
          Text(number, style: ParcoursText.statNum),
          const SizedBox(height: 4),
          Text(label, style: ParcoursText.label, textAlign: TextAlign.center),
        ],
      ),
    );
  }
}

class SearchBarCard extends StatelessWidget {
  const SearchBarCard({super.key});

  @override
  Widget build(BuildContext context) {
    return Container(
      height: 48,
      decoration: BoxDecoration(
        color: ParcoursColors.surfaceWhite,
        borderRadius: BorderRadius.circular(ParcoursRadius.sm),
        border: Border.all(color: ParcoursColors.borderDefault),
        boxShadow: ParcoursShadows.cardShadow,
      ),
      child: Stack(
        children: [
          const Positioned(left: 13, top: 14, child: Opacity(opacity: .35, child: Text('🔍', style: TextStyle(fontSize: 15)))),
          Positioned.fill(
            child: Padding(
              padding: const EdgeInsets.fromLTRB(40, 12, 44, 12),
              child: Align(
                alignment: Alignment.centerLeft,
                child: Text('Métier, filière, école...', style: ParcoursText.bodySmall.copyWith(color: ParcoursColors.textTertiary)),
              ),
            ),
          ),
          Positioned(
            right: 6,
            top: 4,
            child: Container(
              width: 40,
              height: 40,
              decoration: BoxDecoration(
                color: ParcoursColors.accentGreen,
                borderRadius: BorderRadius.circular(8),
              ),
              alignment: Alignment.center,
              child: const Text('⚙', style: TextStyle(color: Colors.white)),
            ),
          ),
        ],
      ),
    );
  }
}

class CategoryChip extends StatelessWidget {
  const CategoryChip({super.key, required this.label, required this.active, required this.onTap});

  final String label;
  final bool active;
  final VoidCallback onTap;

  @override
  Widget build(BuildContext context) {
    return TapScale(
      onTap: onTap,
      child: AnimatedContainer(
        duration: const Duration(milliseconds: 150),
        curve: Curves.easeOut,
        padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 7),
        decoration: BoxDecoration(
          color: active ? ParcoursColors.accentGreen : ParcoursColors.surfaceWhite,
          borderRadius: BorderRadius.circular(ParcoursRadius.full),
          border: Border.all(color: active ? ParcoursColors.accentGreen : ParcoursColors.borderDefault),
        ),
        child: Text(
          label,
          style: GoogleFonts.dmSans(
            fontSize: 12,
            fontWeight: FontWeight.w500,
            color: active ? Colors.white : ParcoursColors.textSecondary,
          ),
        ),
      ),
    );
  }
}

class TagBadge extends StatelessWidget {
  const TagBadge({super.key, required this.text});

  final String text;

  (Color, Color) _colors(String tag) {
    return switch (tag) {
      'Tech/Web' => (ParcoursColors.tagBlueBg, ParcoursColors.tagBlueText),
      'Design' => (ParcoursColors.tagGoldBg, ParcoursColors.tagGoldText),
      'Santé' => (ParcoursColors.tagRedBg, ParcoursColors.tagRedText),
      'Finance' => (ParcoursColors.tagAmberBg, ParcoursColors.tagAmberText),
      'Soft skills' => (ParcoursColors.tagPinkBg, ParcoursColors.tagPinkText),
      _ => (ParcoursColors.tagGreenBg, ParcoursColors.tagGreenText),
    };
  }

  @override
  Widget build(BuildContext context) {
    final colors = _colors(text);
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 9, vertical: 3),
      decoration: BoxDecoration(
        color: colors.$1,
        borderRadius: BorderRadius.circular(6),
      ),
      child: Text(text, style: GoogleFonts.dmSans(fontSize: 10, fontWeight: FontWeight.w500, color: colors.$2)),
    );
  }
}

class MetierCard extends StatelessWidget {
  const MetierCard({super.key, required this.item, this.onTap});

  final MetierItem item;
  final VoidCallback? onTap;

  @override
  Widget build(BuildContext context) {
    return TapScale(
      onTap: onTap,
      child: Container(
        padding: const EdgeInsets.all(16),
        decoration: BoxDecoration(
          color: ParcoursColors.surfaceWhite,
          borderRadius: BorderRadius.circular(16),
          border: Border.all(color: ParcoursColors.borderDefault),
          boxShadow: ParcoursShadows.cardShadow,
        ),
        child: Row(
          children: [
            Container(
              width: 48,
              height: 48,
              decoration: BoxDecoration(color: item.iconBg, borderRadius: BorderRadius.circular(14)),
              alignment: Alignment.center,
              child: Text(item.emoji, style: const TextStyle(fontSize: 22)),
            ),
            const SizedBox(width: 14),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(item.title, style: GoogleFonts.dmSans(fontSize: 15, fontWeight: FontWeight.w600, color: ParcoursColors.textPrimary)),
                  const SizedBox(height: 2),
                  Text(item.level, style: GoogleFonts.dmSans(fontSize: 12, color: ParcoursColors.textTertiary)),
                  const SizedBox(height: 8),
                  Wrap(spacing: 5, runSpacing: 5, children: item.tags.map((tag) => TagBadge(text: tag)).toList()),
                ],
              ),
            ),
            Container(
              width: 30,
              height: 30,
              decoration: BoxDecoration(
                color: ParcoursColors.primaryBg,
                border: Border.all(color: ParcoursColors.borderDefault),
                borderRadius: BorderRadius.circular(8),
              ),
              alignment: Alignment.center,
              child: Text('›', style: GoogleFonts.dmSans(fontSize: 12, color: ParcoursColors.textSecondary)),
            ),
          ],
        ),
      ),
    );
  }
}

class SectionCard extends StatelessWidget {
  const SectionCard({super.key, required this.icon, required this.title, required this.child});

  final String icon;
  final String title;
  final Widget child;

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.only(bottom: 12),
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: ParcoursColors.surfaceWhite,
        border: Border.all(color: ParcoursColors.borderDefault),
        borderRadius: BorderRadius.circular(16),
        boxShadow: ParcoursShadows.cardShadow,
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Container(
                width: 28,
                height: 28,
                decoration: BoxDecoration(
                  color: ParcoursColors.accentGreenLight,
                  borderRadius: BorderRadius.circular(8),
                ),
                alignment: Alignment.center,
                child: Text(icon, style: const TextStyle(fontSize: 13)),
              ),
              const SizedBox(width: 8),
              Text(title, style: ParcoursText.h4),
            ],
          ),
          const SizedBox(height: 12),
          child,
        ],
      ),
    );
  }
}

class SalaryCardContent extends StatelessWidget {
  const SalaryCardContent({super.key});

  @override
  Widget build(BuildContext context) {
    Widget cell(String value, String label, {bool middle = false}) => Column(
          children: [
            Text(value, style: middle ? ParcoursText.price : GoogleFonts.dmSans(fontSize: 14, fontWeight: FontWeight.w600, color: ParcoursColors.textPrimary)),
            const SizedBox(height: 2),
            Text(label, style: ParcoursText.caption),
          ],
        );

    return Column(
      children: [
        Container(
          height: 6,
          margin: const EdgeInsets.symmetric(vertical: 10),
          decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(6),
            gradient: const LinearGradient(colors: [Color(0xFFE8F0EC), Color(0xFF1A4C3B), Color(0xFFB8D4C8)]),
          ),
        ),
        Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            cell('180k', 'Minimum'),
            cell('350k', 'Moyen', middle: true),
            cell('700k', 'Maximum'),
          ],
        ),
      ],
    );
  }
}

class SkillRow extends StatelessWidget {
  const SkillRow({super.key, required this.name});

  final String name;

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.only(bottom: 8),
      padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 10),
      decoration: BoxDecoration(
        color: ParcoursColors.primaryBg,
        borderRadius: BorderRadius.circular(10),
      ),
      child: Row(
        children: [
          Container(
            width: 20,
            height: 20,
            decoration: BoxDecoration(
              color: ParcoursColors.accentGreenLight,
              borderRadius: BorderRadius.circular(6),
            ),
            alignment: Alignment.center,
            child: Text('✓', style: GoogleFonts.dmSans(fontSize: 11, color: ParcoursColors.accentGreen)),
          ),
          const SizedBox(width: 10),
          Text(name, style: GoogleFonts.dmSans(fontSize: 13, color: ParcoursColors.textPrimary)),
        ],
      ),
    );
  }
}

class RoadmapStep extends StatelessWidget {
  const RoadmapStep({super.key, required this.index, required this.item, required this.isLast});

  final int index;
  final RoadmapItem item;
  final bool isLast;

  @override
  Widget build(BuildContext context) {
    final stepLabel = (index + 1).toString().padLeft(2, '0');
    return Row(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        SizedBox(
          width: 32,
          child: Column(
            children: [
              Container(
                width: 32,
                height: 32,
                decoration: BoxDecoration(color: item.bg, borderRadius: BorderRadius.circular(10)),
                alignment: Alignment.center,
                child: Text(stepLabel, style: GoogleFonts.dmSans(fontSize: 12, fontWeight: FontWeight.w600, color: item.text)),
              ),
              if (!isLast)
                Container(
                  width: 1.5,
                  height: 28,
                  margin: const EdgeInsets.symmetric(vertical: 4),
                  color: item.bg,
                ),
            ],
          ),
        ),
        const SizedBox(width: 12),
        Expanded(
          child: Padding(
            padding: const EdgeInsets.only(bottom: 16),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(item.title, style: GoogleFonts.dmSans(fontSize: 13, fontWeight: FontWeight.w600, color: ParcoursColors.textPrimary)),
                const SizedBox(height: 3),
                Text(item.description, style: ParcoursText.bodySmall.copyWith(fontSize: 12)),
                const SizedBox(height: 6),
                Container(
                  padding: const EdgeInsets.symmetric(horizontal: 9, vertical: 3),
                  decoration: BoxDecoration(color: item.bg, borderRadius: BorderRadius.circular(6)),
                  child: Text(item.duration, style: GoogleFonts.dmSans(fontSize: 10, fontWeight: FontWeight.w500, color: item.text)),
                ),
              ],
            ),
          ),
        ),
      ],
    );
  }
}

class EcoleCard extends StatelessWidget {
  const EcoleCard({super.key, required this.item, this.onTap});

  final EcoleItem item;
  final VoidCallback? onTap;

  @override
  Widget build(BuildContext context) {
    return TapScale(
      onTap: onTap,
      child: Container(
        padding: const EdgeInsets.all(16),
        decoration: BoxDecoration(
          color: ParcoursColors.surfaceWhite,
          borderRadius: BorderRadius.circular(16),
          border: Border.all(color: ParcoursColors.borderDefault),
          boxShadow: ParcoursShadows.cardShadow,
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Expanded(child: Text(item.name, style: ParcoursText.h4)),
                const SizedBox(width: 8),
                TagBadge(text: item.type),
              ],
            ),
            const SizedBox(height: 8),
            Text('📍 ${item.location}    📚 ${item.filieres} filières', style: ParcoursText.bodySmall.copyWith(fontSize: 12)),
            const SizedBox(height: 8),
            Wrap(
              spacing: 5,
              runSpacing: 5,
              children: item.domaines
                  .map(
                    (d) => Container(
                      padding: const EdgeInsets.symmetric(horizontal: 9, vertical: 3),
                      decoration: BoxDecoration(
                        color: ParcoursColors.surface2,
                        borderRadius: BorderRadius.circular(8),
                        border: Border.all(color: ParcoursColors.borderDefault),
                      ),
                      child: Text(d, style: GoogleFonts.dmSans(fontSize: 11, color: ParcoursColors.textSecondary)),
                    ),
                  )
                  .toList(),
            ),
          ],
        ),
      ),
    );
  }
}

class ParcoursBottomNav extends StatelessWidget {
  const ParcoursBottomNav({super.key, required this.current, required this.onChanged});

  final int current;
  final ValueChanged<int> onChanged;

  @override
  Widget build(BuildContext context) {
    final items = [('⌂', 'Accueil'), ('≡', 'Métiers'), ('🎓', 'Écoles'), ('◉', 'Profil')];
    return Container(
      padding: const EdgeInsets.fromLTRB(0, 10, 0, 16),
      decoration: const BoxDecoration(
        color: ParcoursColors.surfaceWhite,
        border: Border(top: BorderSide(color: ParcoursColors.borderDefault)),
      ),
      child: Row(
        children: [
          for (int i = 0; i < items.length; i++)
            Expanded(
              child: GestureDetector(
                onTap: () => onChanged(i),
                child: Column(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    Container(
                      width: 32,
                      height: 32,
                      decoration: BoxDecoration(
                        color: i == current ? ParcoursColors.accentGreenLight : Colors.transparent,
                        borderRadius: BorderRadius.circular(10),
                      ),
                      alignment: Alignment.center,
                      child: Text(items[i].$1, style: TextStyle(fontSize: 17, color: i == current ? ParcoursColors.accentGreen : ParcoursColors.textTertiary)),
                    ),
                    const SizedBox(height: 3),
                    Text(
                      items[i].$2,
                      style: GoogleFonts.dmSans(
                        fontSize: 10,
                        color: i == current ? ParcoursColors.accentGreen : ParcoursColors.textTertiary,
                        fontWeight: i == current ? FontWeight.w500 : FontWeight.w400,
                      ),
                    ),
                  ],
                ),
              ),
            ),
        ],
      ),
    );
  }
}

class DetailHero extends StatelessWidget {
  const DetailHero({super.key, required this.emoji, required this.title, required this.badges});

  final String emoji;
  final String title;
  final List<String> badges;

  @override
  Widget build(BuildContext context) {
    return Container(
      width: double.infinity,
      padding: const EdgeInsets.fromLTRB(24, 48, 24, 28),
      decoration: const BoxDecoration(color: ParcoursColors.accentGreen),
      child: Stack(
        children: [
          Positioned(
            right: -60,
            top: -60,
            child: Container(
              width: 180,
              height: 180,
              decoration: const BoxDecoration(color: Color.fromRGBO(255, 255, 255, .05), shape: BoxShape.circle),
            ),
          ),
          Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Container(
                width: 36,
                height: 36,
                margin: const EdgeInsets.only(bottom: 20),
                decoration: BoxDecoration(
                  shape: BoxShape.circle,
                  color: Colors.white12,
                  border: Border.all(color: Colors.white24),
                ),
                alignment: Alignment.center,
                child: const Text('‹', style: TextStyle(color: Colors.white)),
              ),
              Container(
                width: 64,
                height: 64,
                margin: const EdgeInsets.only(bottom: 12),
                decoration: BoxDecoration(color: ParcoursColors.tagBlueBg, borderRadius: BorderRadius.circular(20)),
                alignment: Alignment.center,
                child: Text(emoji, style: const TextStyle(fontSize: 30)),
              ),
              Text(title, style: GoogleFonts.dmSerifDisplay(fontSize: 28, color: Colors.white, height: 1.1)),
              const SizedBox(height: 6),
              Wrap(
                spacing: 8,
                children: badges
                    .map((b) => Container(
                          padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
                          decoration: BoxDecoration(
                            color: Colors.white.withValues(alpha: .15),
                            borderRadius: BorderRadius.circular(8),
                          ),
                          child: Text(b, style: GoogleFonts.dmSans(fontSize: 11, fontWeight: FontWeight.w500, color: Colors.white)),
                        ))
                    .toList(),
              ),
            ],
          ),
        ],
      ),
    );
  }
}
