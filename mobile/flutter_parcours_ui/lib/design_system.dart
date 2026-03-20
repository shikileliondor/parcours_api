import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class ParcoursColors {
  static const primaryBg = Color(0xFFF7F5F0);
  static const surfaceWhite = Color(0xFFFFFFFF);
  static const surface2 = Color(0xFFF0EDE8);
  static const accentGreen = Color(0xFF1A4C3B);
  static const accentGreenLight = Color(0xFFE8F0EC);

  static const textPrimary = Color(0xFF13120E);
  static const textSecondary = Color(0xFF6B6860);
  static const textTertiary = Color(0xFFA8A59F);

  static const borderDefault = Color(0xFFE8E5DF);

  static const tagBlueBg = Color(0xFFE4EDF8);
  static const tagBlueText = Color(0xFF185FA5);
  static const tagAmberBg = Color(0xFFFAEEDA);
  static const tagAmberText = Color(0xFF854F0B);
  static const tagGreenBg = Color(0xFFEAF3DE);
  static const tagGreenText = Color(0xFF3B6D11);
  static const tagRedBg = Color(0xFFFDE8E4);
  static const tagRedText = Color(0xFFC0412A);
  static const tagPinkBg = Color(0xFFF4C0D1);
  static const tagPinkText = Color(0xFF72243E);
  static const tagGoldBg = Color(0xFFFDF3DC);
  static const tagGoldText = Color(0xFF854F0B);
}

class ParcoursSpacing {
  static const xs = 4.0;
  static const sm = 8.0;
  static const md = 12.0;
  static const lg = 16.0;
  static const xl = 20.0;
  static const x2l = 24.0;
  static const x3l = 32.0;
}

class ParcoursRadius {
  static const sm = 10.0;
  static const md = 14.0;
  static const lg = 16.0;
  static const xl = 20.0;
  static const x2l = 24.0;
  static const full = 999.0;
}

class ParcoursShadows {
  static const cardShadow = [
    BoxShadow(
      color: Color(0x0F000000),
      blurRadius: 12,
      offset: Offset(0, 2),
    ),
  ];

  static const mediumShadow = [
    BoxShadow(
      color: Color(0x1A000000),
      blurRadius: 32,
      offset: Offset(0, 8),
    ),
  ];
}

class ParcoursText {
  static TextStyle heroTitle = GoogleFonts.dmSerifDisplay(
    fontSize: 28,
    color: ParcoursColors.textPrimary,
  );

  static TextStyle h1 = GoogleFonts.dmSans(
    fontSize: 22,
    fontWeight: FontWeight.w600,
    color: ParcoursColors.textPrimary,
  );

  static TextStyle h2 = GoogleFonts.dmSans(
    fontSize: 18,
    fontWeight: FontWeight.w600,
    color: ParcoursColors.textPrimary,
  );

  static TextStyle h3 = GoogleFonts.dmSans(
    fontSize: 16,
    fontWeight: FontWeight.w600,
    color: ParcoursColors.textPrimary,
  );

  static TextStyle h4 = GoogleFonts.dmSans(
    fontSize: 14,
    fontWeight: FontWeight.w600,
    color: ParcoursColors.textPrimary,
  );

  static TextStyle body = GoogleFonts.dmSans(
    fontSize: 14,
    height: 1.6,
    color: ParcoursColors.textSecondary,
  );

  static TextStyle bodySmall = GoogleFonts.dmSans(
    fontSize: 13,
    height: 1.55,
    color: ParcoursColors.textSecondary,
  );

  static TextStyle label = GoogleFonts.dmSans(
    fontSize: 11,
    fontWeight: FontWeight.w500,
    letterSpacing: .4,
    color: ParcoursColors.textTertiary,
  );

  static TextStyle caption = GoogleFonts.dmSans(
    fontSize: 10,
    color: ParcoursColors.textTertiary,
  );

  static TextStyle statNum = GoogleFonts.dmSans(
    fontSize: 22,
    fontWeight: FontWeight.w600,
    color: ParcoursColors.textPrimary,
  );

  static TextStyle price = GoogleFonts.dmSans(
    fontSize: 16,
    fontWeight: FontWeight.w600,
    color: ParcoursColors.accentGreen,
  );
}

ThemeData parcoursTheme() {
  final textTheme = GoogleFonts.dmSansTextTheme();

  return ThemeData(
    useMaterial3: true,
    scaffoldBackgroundColor: ParcoursColors.primaryBg,
    textTheme: textTheme,
    colorScheme: ColorScheme.fromSeed(
      seedColor: ParcoursColors.accentGreen,
      primary: ParcoursColors.accentGreen,
      surface: ParcoursColors.surfaceWhite,
    ),
  );
}
