<?php
require_once 'includes/functions.php';

$pageTitle = "Projets — Roukayath Gazaliou";
$pageDesc  = "Découvrez les projets web réalisés par Roukayath Gazaliou : applications PHP/Laravel, design Figma, interfaces modernes.";

// Données des projets (statique — pas besoin de BDD)
$projects = [
  [
    'id'          => 'restaurant',
    'titre'       => 'Délices du Bénin',
    'sous_titre'  => 'Restaurant gastronomique — Cotonou',
    'description' => 'Application web complète pour un restaurant gastronomique béninois. Interface élégante avec réservation en ligne, carte du menu, espace client et panneau d\'administration. Design premium inspiré de la cuisine traditionnelle revisitée.',
    'image'       => 'assets/img/restaurant.jpg',
    'tags'        => ['Laravel', 'MySQL', 'Bootstrap', 'Figma', 'PHP'],
    'categorie'   => 'Restaurant & E-commerce',
    'github'      => 'https://github.com/abeni229',
    'demo'        => '#',
    'features'    => [
      'Réservation de table en ligne',
      'Carte du menu dynamique',
      'Espace client avec historique',
      'Panneau d\'administration',
      'Design UI/UX sur Figma',
    ],
    'couleur'     => '#1a1a0e',
    'accent'      => '#c9a84c',
  ],
  [
    'id'          => 'rouklegal',
    'titre'       => 'RoukLegal',
    'sous_titre'  => 'Plateforme juridique certifiée',
    'description' => 'Plateforme de consultations juridiques professionnelles permettant aux utilisateurs de poser des questions à des avocats qualifiés et de prendre rendez-vous en ligne. Interface claire, sobre et rassurante.',
    'image'       => 'assets/img/RoukLegal.jpg',
    'tags'        => ['Laravel', 'Bootstrap', 'JavaScript', 'MySQL', 'Figma'],
    'categorie'   => 'Plateforme de services',
    'github'      => 'https://github.com/abeni229',
    'demo'        => '#',
    'features'    => [
      'Prise de rendez-vous en ligne',
      'Espace avocat & client',
      'Messagerie intégrée',
      'Authentification sécurisée',
      'Design professionnel Figma',
    ],
    'couleur'     => '#f5f0e8',
    'accent'      => '#c45c00',
  ],
  [
    'id'          => 'pmebenin',
    'titre'       => 'PME Bénin',
    'sous_titre'  => 'Marketplace béninoise',
    'description' => 'Marketplace dédiée aux PME béninoises pour vendre et acheter des produits locaux (artisanat, textile, agroalimentaire) avec confiance. Design premium, navigation simple et expérience utilisateur soignée.',
    'image'       => 'assets/img/pmebenin.jpg',
    'tags'        => ['Laravel', 'MySQL', 'Bootstrap', 'Figma', 'JavaScript'],
    'categorie'   => 'Marketplace',
    'github'      => 'https://github.com/abeni229',
    'demo'        => '#',
    'features'    => [
      'Catalogue produits dynamique',
      'Espace vendeur & acheteur',
      'Système de commandes',
      'Gestion des stocks',
      'Interface mobile-first',
    ],
    'couleur'     => '#1a2e1a',
    'accent'      => '#4a9e3f',
  ],
  [
    'id'          => 'vitecom',
    'titre'       => 'ViteCom',
    'sous_titre'  => 'Boutique de précommande premium',
    'description' => 'Application de gestion de précommandes pour les marques qui veulent vendre mieux et plus vite. Interface douce et engageante, taux de conversion optimisé, mise en ligne en moins de 10 minutes.',
    'image'       => 'assets/img/vitecom.jpg',
    'tags'        => ['PHP', 'JavaScript', 'Bootstrap', 'MySQL', 'CSS3'],
    'categorie'   => 'E-commerce',
    'github'      => 'https://github.com/abeni229/ViteCom',
    'demo'        => '#',
    'features'    => [
      'Gestion de précommandes',
      'Dashboard statistiques',
      'Pages produits personnalisables',
      'Suivi des commandes',
      'UX optimisée conversion',
    ],
    'couleur'     => '#fff8f0',
    'accent'      => '#e07b2a',
  ],
  [
    'id'          => 'bookease',
    'titre'       => 'BookEase',
    'sous_titre'  => 'Planification de rendez-vous automatique',
    'description' => 'Application SaaS de prise de rendez-vous qui élimine les échanges interminables sur WhatsApp. Le client partage son lien, ses clients réservent en 30 secondes. Interface épurée et intuitive.',
    'image'       => 'assets/img/bookease.jpg',
    'tags'        => ['Laravel', 'MySQL', 'JavaScript', 'Bootstrap', 'Figma'],
    'categorie'   => 'SaaS · Productivité',
    'github'      => 'https://github.com/abeni229',
    'demo'        => '#',
    'features'    => [
      'Calendrier de disponibilités',
      'Réservation en 30 secondes',
      'Rappels automatiques',
      'Dashboard professionnel',
      'Lien de réservation unique',
    ],
    'couleur'     => '#0f1f3d',
    'accent'      => '#2563eb',
  ],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="<?= $pageDesc ?>"/>
  <title><?= $pageTitle ?></title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/animations.css" />

  <style>

    /* ── Hero ── */
    .projects-hero {
      background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 60%, var(--navy-light) 100%);
      padding: 10rem 0 5rem;
      position: relative;
      overflow: hidden;
    }
    .projects-hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
      background-size: 60px 60px;
    }
    .projects-hero-inner { position: relative; z-index: 1; }
    .projects-breadcrumb {
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      letter-spacing: 0.1em;
      color: rgba(255,255,255,.4);
      margin-bottom: 1.5rem;
    }
    .projects-breadcrumb a { color: rgba(255,255,255,.4); transition: var(--transition); }
    .projects-breadcrumb a:hover { color: var(--gold); }
    .projects-hero-title {
      font-family: var(--font-display);
      font-size: clamp(2.5rem, 6vw, 4rem);
      font-weight: 700;
      color: var(--white);
      line-height: 1.1;
      margin-bottom: 1rem;
    }
    .projects-hero-title span { color: var(--gold); font-style: italic; }
    .projects-hero-sub {
      font-size: var(--text-lg);
      color: rgba(255,255,255,.6);
      max-width: 520px;
    }

    /* Compteur projets hero */
    .projects-hero-count {
      display: flex;
      gap: 3rem;
      margin-top: 2.5rem;
      padding-top: 2rem;
      border-top: 1px solid rgba(255,255,255,.1);
    }
    .hero-count-num {
      font-family: var(--font-display);
      font-size: var(--text-3xl);
      font-weight: 700;
      color: var(--gold);
    }
    .hero-count-label {
      font-size: var(--text-sm);
      color: rgba(255,255,255,.5);
      margin-top: 0.2rem;
    }

    /* ── Filtres ── */
    .projects-filter {
      padding: 2.5rem 0;
      background: var(--off-white);
      border-bottom: 1px solid var(--gray-200);
      position: sticky;
      top: 70px;
      z-index: 100;
    }
    .filter-wrap {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
      flex-wrap: wrap;
    }
    .filter-tabs {
      display: flex;
      gap: 0.6rem;
      flex-wrap: wrap;
    }
    .filter-tab {
      padding: 0.5rem 1.25rem;
      border-radius: 50px;
      font-size: var(--text-sm);
      font-weight: 600;
      cursor: pointer;
      border: 2px solid var(--gray-200);
      color: var(--gray-600);
      background: var(--white);
      transition: var(--transition);
    }
    .filter-tab:hover { border-color: var(--accent); color: var(--accent); }
    .filter-tab.active {
      background: var(--accent);
      border-color: var(--accent);
      color: var(--white);
      box-shadow: 0 4px 14px rgba(37,99,235,.3);
    }
    .filter-count {
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      color: var(--gray-400);
      letter-spacing: 0.08em;
    }

    /* ── Liste projets ── */
    .projects-list {
      padding: var(--section-py) 0;
      background: var(--white);
    }

    /* Carte projet grande */
    .project-item {
      display: grid;
      grid-template-columns: 1.1fr 1fr;
      gap: 4rem;
      align-items: center;
      margin-bottom: 6rem;
      opacity: 1;
      transform: translateY(0);
      transition: opacity 0.7s ease, transform 0.7s ease;
    }
    .project-item.visible {
      opacity: 1;
      transform: translateY(0);
    }
    .project-item:last-child { margin-bottom: 0; }

    /* Alterner gauche/droite */
    .project-item:nth-child(even) {
      direction: rtl;
    }
    .project-item:nth-child(even) > * {
      direction: ltr;
    }

    /* Séparateur entre projets */
    .project-separator {
      width: 100%;
      height: 1px;
      background: linear-gradient(90deg, transparent, var(--gray-200), transparent);
      margin-bottom: 6rem;
    }

    /* Visuel projet */
    .project-visual {
      position: relative;
    }
    .project-img-wrap {
      border-radius: var(--radius-xl);
      overflow: hidden;
      box-shadow: var(--shadow-xl);
      position: relative;
      aspect-ratio: 16/10;
      background: var(--gray-100);
    }
    .project-img-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .project-img-wrap:hover img {
      transform: scale(1.04);
    }

    /* Overlay au hover */
    .project-img-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, rgba(15,31,61,.7) 0%, transparent 50%);
      opacity: 0;
      transition: opacity var(--transition);
      display: flex;
      align-items: flex-end;
      padding: 1.75rem;
      gap: 0.75rem;
    }
    .project-img-wrap:hover .project-img-overlay {
      opacity: 1;
    }
    .project-overlay-btn {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      padding: 0.6rem 1.2rem;
      border-radius: var(--radius-sm);
      font-size: var(--text-sm);
      font-weight: 600;
      transition: var(--transition);
      backdrop-filter: blur(8px);
    }
    .overlay-btn-demo {
      background: var(--white);
      color: var(--navy);
    }
    .overlay-btn-demo:hover {
      background: var(--accent);
      color: var(--white);
    }
    .overlay-btn-code {
      background: rgba(255,255,255,.15);
      color: var(--white);
      border: 1px solid rgba(255,255,255,.3);
    }
    .overlay-btn-code:hover {
      background: rgba(255,255,255,.25);
    }

    /* Badge numéro projet */
    .project-num-badge {
      position: absolute;
      top: -16px;
      left: -16px;
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: var(--navy);
      border: 3px solid var(--white);
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: var(--font-display);
      font-size: var(--text-lg);
      font-weight: 700;
      color: var(--gold);
      box-shadow: var(--shadow-md);
      z-index: 2;
    }

    /* Placeholder image */
    .project-img-placeholder {
      width: 100%;
      height: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 0.75rem;
      font-size: 3rem;
      color: var(--gray-400);
      background: var(--gray-100);
    }
    .project-img-placeholder span {
      font-size: var(--text-sm);
      font-family: var(--font-mono);
      letter-spacing: 0.06em;
    }

    /* Contenu texte projet */
    .project-content {}

    .project-meta {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1rem;
    }
    .project-categorie {
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      letter-spacing: 0.1em;
      color: var(--accent);
      text-transform: uppercase;
      font-weight: 700;
    }
    .project-num {
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      color: var(--gray-400);
    }

    .project-title {
      font-family: var(--font-display);
      font-size: clamp(1.75rem, 3.5vw, 2.5rem);
      font-weight: 700;
      color: var(--navy);
      line-height: 1.15;
      margin-bottom: 0.4rem;
    }
    .project-subtitle {
      font-size: var(--text-base);
      color: var(--gray-400);
      font-style: italic;
      margin-bottom: 1.25rem;
    }
    .project-desc {
      font-size: var(--text-base);
      color: var(--gray-600);
      line-height: 1.85;
      margin-bottom: 1.75rem;
    }

    /* Features liste */
    .project-features {
      margin-bottom: 2rem;
    }
    .project-features-title {
      font-size: var(--text-sm);
      font-weight: 700;
      color: var(--navy);
      letter-spacing: 0.05em;
      text-transform: uppercase;
      margin-bottom: 0.75rem;
      font-family: var(--font-mono);
    }
    .project-features-list {
      display: flex;
      flex-direction: column;
      gap: 0.4rem;
    }
    .feature-item {
      display: flex;
      align-items: center;
      gap: 0.6rem;
      font-size: var(--text-sm);
      color: var(--gray-600);
    }
    .feature-item::before {
      content: '';
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: var(--accent);
      flex-shrink: 0;
    }

    /* Tags */
    .project-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      margin-bottom: 2rem;
    }

    /* Boutons projet */
    .project-btns {
      display: flex;
      gap: 0.875rem;
      flex-wrap: wrap;
    }

    /* ── Section mini-cards (vue grille) ── */
    .projects-grid-section {
      padding: var(--section-py) 0;
      background: var(--off-white);
    }

    /* ── CTA ── */
    .projects-cta {
      padding: 5rem 0;
      text-align: center;
      background: var(--navy);
      position: relative;
      overflow: hidden;
    }
    .projects-cta::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
      background-size: 50px 50px;
    }
    .projects-cta-inner { position: relative; z-index: 1; }

    /* ── Responsive ── */
    @media (max-width: 1024px) {
      .project-item {
        grid-template-columns: 1fr;
        gap: 2.5rem;
        margin-bottom: 4rem;
      }
      .project-item:nth-child(even) { direction: ltr; }
      .project-separator { margin-bottom: 4rem; }
    }

    @media (max-width: 768px) {
      .projects-filter { top: 62px; }
      .filter-wrap { flex-direction: column; align-items: flex-start; }
      .project-num-badge { width: 38px; height: 38px; font-size: var(--text-base); }
      .projects-hero { padding: 8rem 0 3.5rem; }
      .projects-hero-count { gap: 1.5rem; flex-wrap: wrap; }
    }

    @media (max-width: 480px) {
      .project-btns { flex-direction: column; }
      .project-btns a { justify-content: center; }
    }
  </style>
</head>
<body>

<?php include 'includes/nav.php'; ?>

<!-- =====================================================
     HERO
===================================================== -->
<section class="projects-hero">
  <div class="container projects-hero-inner">
    <div class="projects-breadcrumb anim-fade-up">
      <a href="index.php">Accueil</a> / Projets
    </div>
    <h1 class="projects-hero-title anim-fade-up delay-1">
      Mes <span>projets</span><br/>réalisés
    </h1>
    <p class="projects-hero-sub anim-fade-up delay-2">
      Applications web conçues de A à Z — du design Figma
      jusqu'au déploiement final.
    </p>
    <div class="projects-hero-count anim-fade-up delay-3">
      <div>
        <div class="hero-count-num"><?= count($projects) ?></div>
        <div class="hero-count-label">Projets fullstack</div>
      </div>
      <div>
        <div class="hero-count-num">4</div>
        <div class="hero-count-label">Avec Laravel</div>
      </div>
      <div>
        <div class="hero-count-num">5</div>
        <div class="hero-count-label">Maquettes Figma</div>
      </div>
    </div>
  </div>
</section>


<!-- =====================================================
     FILTRES
===================================================== -->
<div class="projects-filter">
  <div class="container">
    <div class="filter-wrap">
      <div class="filter-tabs" id="projectFilterTabs">
        <button class="filter-tab active" data-filter="all">Tous (<?= count($projects) ?>)</button>
        <button class="filter-tab" data-filter="laravel">Laravel</button>
        <button class="filter-tab" data-filter="php">PHP</button>
        <button class="filter-tab" data-filter="figma">Figma</button>
      </div>
      <span class="filter-count" id="filterCount"><?= count($projects) ?> projets</span>
    </div>
  </div>
</div>


<!-- =====================================================
     LISTE DES PROJETS
===================================================== -->
<section class="projects-list" id="projectsList">
  <div class="container">

    <?php foreach ($projects as $i => $p): ?>

      <?php if ($i > 0): ?>
        <div class="project-separator"></div>
      <?php endif; ?>

      <!-- Ancre pour navigation depuis index -->
      <div id="<?= $p['id'] ?>"></div>

      <div
        class="project-item"
        data-tags="<?= strtolower(implode(',', $p['tags'])) ?>"
      >

        <!-- ── Visuel ── -->
        <div class="project-visual">
          <div class="project-num-badge"><?= str_pad($i+1, 2, '0', STR_PAD_LEFT) ?></div>

          <div class="project-img-wrap">
            <?php if (file_exists(__DIR__ . '/' . $p['image'])): ?>
              <img
                src="<?= e($p['image']) ?>"
                alt="Interface <?= e($p['titre']) ?>"
                loading="lazy"
              />
            <?php else: ?>
              <?php
                $bgColors = [
                  'linear-gradient(135deg,#1a1a0e,#3d2b00)',
                  'linear-gradient(135deg,#f5f0e8,#c4a882)',
                  'linear-gradient(135deg,#1a2e1a,#2d5a27)',
                  'linear-gradient(135deg,#fff8f0,#e8a87c)',
                  'linear-gradient(135deg,#0f1f3d,#1a4fa8)',
                ];
              ?>
              <div class="project-img-placeholder" style="background:<?= $bgColors[$i] ?>;">
                <span style="font-size:1rem;font-family:var(--font-mono);letter-spacing:0.08em;color:rgba(255,255,255,.85);text-transform:uppercase;">Image manquante</span>
                <span style="color:rgba(255,255,255,.65);font-size:0.85rem;">Ajouter assets/img/<?= $p['id'] ?>.jpg</span>
              </div>
            <?php endif; ?>

            <!-- Overlay hover -->
            <div class="project-img-overlay">
              <?php if ($p['demo'] !== '#'): ?>
                <a href="<?= e($p['demo']) ?>" target="_blank" rel="noopener" class="project-overlay-btn overlay-btn-demo">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                  Voir la démo
                </a>
              <?php endif; ?>
              <a href="<?= e($p['github']) ?>" target="_blank" rel="noopener" class="project-overlay-btn overlay-btn-code">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.17 6.839 9.49.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.604-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.464-1.11-1.464-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0 1 12 6.836c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.167 22 16.418 22 12c0-5.523-4.477-10-10-10z"/></svg>
                Code source
              </a>
            </div>
          </div>
        </div>

        <!-- ── Contenu ── -->
        <div class="project-content">

          <div class="project-meta">
            <span class="project-categorie"><?= e($p['categorie']) ?></span>
            <span class="project-num"><?= str_pad($i+1, 2, '0', STR_PAD_LEFT) ?> / <?= str_pad(count($projects), 2, '0', STR_PAD_LEFT) ?></span>
          </div>

          <h2 class="project-title"><?= e($p['titre']) ?></h2>
          <p class="project-subtitle"><?= e($p['sous_titre']) ?></p>
          <p class="project-desc"><?= e($p['description']) ?></p>

          <!-- Features -->
          <div class="project-features">
            <div class="project-features-title">Fonctionnalités clés</div>
            <div class="project-features-list">
              <?php foreach ($p['features'] as $feature): ?>
                <div class="feature-item"><?= e($feature) ?></div>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- Tags tech -->
          <div class="project-tags">
            <?php foreach ($p['tags'] as $tag): ?>
              <span class="tag"><?= e($tag) ?></span>
            <?php endforeach; ?>
          </div>

          <!-- Boutons -->
          <div class="project-btns">
            <a href="<?= e($p['github']) ?>" target="_blank" rel="noopener" class="btn-primary btn-ripple">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.17 6.839 9.49.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.604-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.464-1.11-1.464-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0 1 12 6.836c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.167 22 16.418 22 12c0-5.523-4.477-10-10-10z"/></svg>
              Voir le code
            </a>
            <?php if ($p['demo'] !== '#'): ?>
              <a href="<?= e($p['demo']) ?>" target="_blank" rel="noopener" class="btn-outline btn-ripple">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                Voir la démo
              </a>
            <?php endif; ?>
          </div>

        </div>
      </div>

    <?php endforeach; ?>

  </div>
</section>


<!-- =====================================================
     CTA
===================================================== -->
<div class="projects-cta">
  <div class="container projects-cta-inner anim-fade-up">
    <div class="section-label" style="justify-content:center;color:var(--gold);">Collaboration</div>
    <h2 class="section-title" style="color:var(--white);text-align:center;margin-bottom:0.75rem;">
      Votre projet sera le <span style="color:var(--gold);">prochain</span>
    </h2>
    <p style="color:rgba(255,255,255,.55);font-size:var(--text-lg);margin-bottom:2rem;max-width:460px;margin-left:auto;margin-right:auto;text-align:center;">
      Disponible pour concevoir votre prochaine application web de A à Z.
    </p>
    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
      <a href="contact.php" class="btn-primary btn-ripple">Démarrer un projet</a>
      <a href="about.php" class="btn-secondary btn-ripple">En savoir plus sur moi</a>
    </div>
  </div>
</div>


<!-- =====================================================
     FOOTER
===================================================== -->
<footer class="footer">
  <div class="container">
    <div class="footer-inner">
      <div>
        <div class="footer-brand">Roukayath<span>.</span></div>
        <p class="footer-tagline">Développeuse web fullstack · Cotonou, Bénin<br/>PHP · Laravel · JavaScript · Figma</p>
      </div>
      <div>
        <div class="footer-heading">Navigation</div>
        <ul class="footer-links">
          <li><a href="index.php">Accueil</a></li>
          <li><a href="about.php">À propos</a></li>
          <li><a href="skills.php">Compétences</a></li>
          <li><a href="projects.php">Projets</a></li>
          <li><a href="experience.php">Expérience</a></li>
          <li><a href="blog.php">Blog</a></li>
        </ul>
      </div>
      <div>
        <div class="footer-heading">Contact</div>
        <ul class="footer-links">
          <li><a href="mailto:Gazaliouroukayath@gmail.com">Gazaliouroukayath@gmail.com</a></li>
          <li><a href="tel:+2290150434710">(+229) 0150434710</a></li>
          <li><a href="https://github.com/abeni229" target="_blank" rel="noopener">GitHub</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p class="footer-copy">© <?= date('Y') ?> Roukayath Gazaliou · Tous droits réservés</p>
      <div class="footer-socials">
        <a href="https://github.com/abeni229" target="_blank" rel="noopener" class="social-link" aria-label="GitHub">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.17 6.839 9.49.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.604-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.464-1.11-1.464-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0 1 12 6.836c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.167 22 16.418 22 12c0-5.523-4.477-10-10-10z"/></svg>
        </a>
        <a href="mailto:Gazaliouroukayath@gmail.com" class="social-link" aria-label="Email">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        </a>
      </div>
    </div>
  </div>
</footer>


<!-- =====================================================
     SCRIPTS
===================================================== -->
<script>
(function () {

  /* ── Scroll reveal projets ── */
  const items = document.querySelectorAll('.project-item');
  const obs = new IntersectionObserver((entries) => {
    entries.forEach((entry, idx) => {
      if (entry.isIntersecting) {
        setTimeout(() => {
          entry.target.classList.add('visible');
        }, idx * 120);
        obs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -60px 0px' });
  items.forEach(item => obs.observe(item));

  // Fallback : afficher les projets si l'observateur ne se déclenche pas
  if (!('IntersectionObserver' in window)) {
    items.forEach(item => item.classList.add('visible'));
  }
  window.addEventListener('load', () => {
    items.forEach(item => item.classList.add('visible'));
  });


  /* ── Filtres par technologie ── */
  const tabs      = document.querySelectorAll('#projectFilterTabs .filter-tab');
  const projects  = document.querySelectorAll('.project-item');
  const countEl   = document.getElementById('filterCount');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');

      const filter = tab.dataset.filter;
      let visible  = 0;

      projects.forEach(proj => {
        const tags = proj.dataset.tags || '';
        const show = filter === 'all' || tags.includes(filter);
        proj.style.display    = show ? 'grid' : 'none';
        proj.previousElementSibling && proj.previousElementSibling.classList.contains('project-separator')
          ? proj.previousElementSibling.style.display = show ? 'block' : 'none'
          : null;
        if (show) {
          visible++;
          setTimeout(() => proj.classList.add('visible'), visible * 100);
        }
      });

      countEl.textContent = visible + ' projet' + (visible > 1 ? 's' : '');
    });
  });

})();
</script>

</body>
</html>