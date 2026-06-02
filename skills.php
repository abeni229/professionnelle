<?php
$pageTitle = "Compétences — Roukayath Gazaliou";
$pageDesc  = "Découvrez les compétences techniques et outils maîtrisés par Roukayath Gazaliou : PHP, Laravel, JavaScript, MySQL, Figma, Bootstrap, Git.";
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
    .skills-hero {
      background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 60%, var(--navy-light) 100%);
      padding: 10rem 0 5rem;
      position: relative;
      overflow: hidden;
    }
    .skills-hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
      background-size: 60px 60px;
    }
    .skills-hero-inner { position: relative; z-index: 1; }
    .skills-hero-breadcrumb {
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      letter-spacing: 0.1em;
      color: rgba(255,255,255,.4);
      margin-bottom: 1.5rem;
    }
    .skills-hero-breadcrumb a { color: rgba(255,255,255,.4); transition: var(--transition); }
    .skills-hero-breadcrumb a:hover { color: var(--gold); }
    .skills-hero-title {
      font-family: var(--font-display);
      font-size: clamp(2.5rem, 6vw, 4rem);
      font-weight: 700;
      color: var(--white);
      line-height: 1.1;
      margin-bottom: 1rem;
    }
    .skills-hero-title span { color: var(--gold); font-style: italic; }
    .skills-hero-sub {
      font-size: var(--text-lg);
      color: rgba(255,255,255,.6);
      max-width: 520px;
    }

    /* ── Filtres catégories ── */
    .skills-filter {
      padding: 3rem 0 0;
      background: var(--off-white);
      border-bottom: 1px solid var(--gray-200);
    }
    .filter-tabs {
      display: flex;
      gap: 0.75rem;
      flex-wrap: wrap;
      padding-bottom: 0;
    }
    .filter-tab {
      padding: 0.55rem 1.4rem;
      border-radius: 50px;
      font-size: var(--text-sm);
      font-weight: 600;
      cursor: pointer;
      border: 2px solid var(--gray-200);
      color: var(--gray-600);
      background: var(--white);
      transition: var(--transition);
      letter-spacing: 0.02em;
    }
    .filter-tab:hover {
      border-color: var(--accent);
      color: var(--accent);
    }
    .filter-tab.active {
      background: var(--accent);
      border-color: var(--accent);
      color: var(--white);
      box-shadow: 0 4px 14px rgba(37,99,235,.3);
    }

    /* ── Section principale compétences ── */
    .skills-main {
      padding: var(--section-py) 0;
      background: var(--off-white);
    }

    /* Catégorie titre */
    .skills-category {
      margin-bottom: 4rem;
    }
    .skills-category:last-child { margin-bottom: 0; }

    .category-header {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 2rem;
    }
    .category-icon {
      width: 48px;
      height: 48px;
      border-radius: var(--radius-md);
      background: var(--navy);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.4rem;
      flex-shrink: 0;
    }
    .category-title {
      font-family: var(--font-display);
      font-size: var(--text-2xl);
      font-weight: 700;
      color: var(--navy);
    }
    .category-count {
      margin-left: auto;
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      color: var(--gray-400);
      letter-spacing: 0.08em;
    }

    /* ── Card compétence ── */
    .skill-item-card {
      background: var(--white);
      border: 1.5px solid var(--gray-200);
      border-radius: var(--radius-lg);
      padding: 1.75rem;
      display: flex;
      flex-direction: column;
      gap: 1.25rem;
      transition: var(--transition);
      cursor: default;
      position: relative;
      overflow: hidden;
    }
    .skill-item-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--accent), var(--navy-light));
      transform: scaleX(0);
      transform-origin: left;
      transition: transform var(--transition);
      border-radius: 2px 2px 0 0;
    }
    .skill-item-card:hover {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px var(--accent-soft), var(--shadow-lg);
      transform: translateY(-5px);
    }
    .skill-item-card:hover::before {
      transform: scaleX(1);
    }

    .skill-item-top {
      display: flex;
      align-items: center;
      gap: 1rem;
    }
    .skill-item-icon {
      width: 52px;
      height: 52px;
      border-radius: var(--radius-md);
      background: var(--accent-soft);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.6rem;
      flex-shrink: 0;
      transition: var(--transition);
    }
    .skill-item-card:hover .skill-item-icon {
      background: var(--accent);
      transform: scale(1.1) rotate(-6deg);
    }
    .skill-item-name {
      font-weight: 700;
      font-size: var(--text-base);
      color: var(--navy);
      margin-bottom: 0.2rem;
    }
    .skill-item-level-label {
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      color: var(--gray-400);
      letter-spacing: 0.06em;
    }

    /* Badge niveau */
    .skill-badge {
      margin-left: auto;
      padding: 0.25rem 0.75rem;
      border-radius: 50px;
      font-size: var(--text-xs);
      font-weight: 700;
      letter-spacing: 0.04em;
      flex-shrink: 0;
    }
    .badge-expert    { background: #dbeafe; color: #1d4ed8; }
    .badge-avance    { background: #d1fae5; color: #065f46; }
    .badge-intermediaire { background: #fef9c3; color: #854d0e; }
    .badge-notions   { background: var(--gray-100); color: var(--gray-600); }

    /* Barre de progression */
    .skill-progress-wrap {
      width: 100%;
      height: 6px;
      background: var(--gray-100);
      border-radius: 4px;
      overflow: hidden;
    }
    .skill-progress-bar {
      height: 100%;
      border-radius: 4px;
      background: linear-gradient(90deg, var(--accent), var(--navy-light));
      width: 0;
      transition: width 1.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .skill-item-desc {
      font-size: var(--text-sm);
      color: var(--gray-600);
      line-height: 1.65;
    }

    /* ── Grille des catégories ── */
    .skills-grid-2 {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1.5rem;
    }
    .skills-grid-3 {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
    }
    .skills-grid-4 {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1.25rem;
    }

    /* ── Soft skills ── */
    .softskills-section {
      padding: var(--section-py) 0;
      background: var(--white);
    }
    .softskill-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
      margin-top: 3rem;
    }
    .softskill-card {
      padding: 2rem;
      border: 1px solid var(--gray-200);
      border-radius: var(--radius-lg);
      text-align: center;
      transition: var(--transition);
      background: var(--off-white);
    }
    .softskill-card:hover {
      border-color: var(--accent);
      background: var(--accent-soft);
      transform: translateY(-4px);
      box-shadow: var(--shadow-md);
    }
    .softskill-emoji {
      font-size: 2.5rem;
      margin-bottom: 0.75rem;
      display: block;
    }
    .softskill-name {
      font-weight: 700;
      font-size: var(--text-base);
      color: var(--navy);
      margin-bottom: 0.4rem;
    }
    .softskill-desc {
      font-size: var(--text-sm);
      color: var(--gray-600);
      line-height: 1.65;
    }

    /* ── Outils section ── */
    .tools-section {
      padding: var(--section-py) 0;
      background: var(--navy);
      position: relative;
      overflow: hidden;
    }
    .tools-section::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
      background-size: 50px 50px;
    }
    .tools-inner { position: relative; z-index: 1; }
    .tools-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      margin-top: 2.5rem;
      justify-content: center;
    }
    .tool-pill {
      display: inline-flex;
      align-items: center;
      gap: 0.6rem;
      padding: 0.65rem 1.4rem;
      background: rgba(255,255,255,.07);
      border: 1px solid rgba(255,255,255,.12);
      border-radius: 50px;
      color: rgba(255,255,255,.8);
      font-size: var(--text-sm);
      font-weight: 500;
      transition: var(--transition);
      cursor: default;
    }
    .tool-pill:hover {
      background: rgba(37,99,235,.25);
      border-color: rgba(37,99,235,.5);
      color: var(--white);
      transform: translateY(-2px);
    }
    .tool-pill-icon { font-size: 1.1rem; }

    /* ── CTA ── */
    .skills-cta {
      padding: 5rem 0;
      text-align: center;
      background: var(--off-white);
      border-top: 1px solid var(--gray-200);
    }

    /* ── Responsive ── */
    @media (max-width: 1024px) {
      .skills-grid-4 { grid-template-columns: repeat(2, 1fr); }
      .skills-grid-3 { grid-template-columns: repeat(2, 1fr); }
      .softskill-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
      .skills-grid-2,
      .skills-grid-3,
      .skills-grid-4 { grid-template-columns: 1fr; }
      .softskill-grid { grid-template-columns: 1fr 1fr; }
      .filter-tabs { gap: 0.5rem; }
    }
    @media (max-width: 480px) {
      .softskill-grid { grid-template-columns: 1fr; }
      .skills-hero { padding: 8rem 0 3.5rem; }
    }
  </style>
</head>
<body>

<?php include 'includes/nav.php'; ?>

<!-- =====================================================
     HERO
===================================================== -->
<section class="skills-hero">
  <div class="container skills-hero-inner">
    <div class="skills-hero-breadcrumb">
      <a href="index.php">Accueil</a> / Compétences
    </div>
    <h1 class="skills-hero-title anim-fade-up">
      Mon <span>stack</span><br/>technique
    </h1>
    <p class="skills-hero-sub anim-fade-up delay-2">
      Les technologies et outils que je maîtrise, acquis en formation,
      en stage et en autodidacte.
    </p>
  </div>
</section>


<!-- =====================================================
     FILTRES
===================================================== -->
<div class="skills-filter">
  <div class="container">
    <div class="filter-tabs" id="filterTabs">
      <button class="filter-tab active" data-filter="all">Tout voir</button>
      <button class="filter-tab" data-filter="backend">Backend</button>
      <button class="filter-tab" data-filter="frontend">Frontend</button>
      <button class="filter-tab" data-filter="database">Base de données</button>
      <button class="filter-tab" data-filter="design">Design & Outils</button>
    </div>
  </div>
</div>


<!-- =====================================================
     COMPÉTENCES PRINCIPALES
===================================================== -->
<section class="skills-main" id="skillsMain">
  <div class="container">

    <!-- ── BACKEND ── -->
    <div class="skills-category" data-category="backend">
      <div class="category-header anim-fade-up">
        <div class="category-icon">⚙️</div>
        <div>
          <div class="category-title">Backend</div>
        </div>
        <span class="category-count">2 technos</span>
      </div>

      <div class="skills-grid-2 anim-cascade">

        <div class="skill-item-card">
          <div class="skill-item-top">
            <div class="skill-item-icon">🐘</div>
            <div>
              <div class="skill-item-name">PHP</div>
              <div class="skill-item-level-label">Niveau · Expert</div>
            </div>
            <span class="skill-badge badge-expert">Expert</span>
          </div>
          <div class="skill-progress-wrap">
            <div class="skill-progress-bar skill-bar" data-level="90"></div>
          </div>
          <p class="skill-item-desc">
            PHP orienté objet, architecture MVC, gestion de sessions,
            formulaires sécurisés, APIs REST. Utilisé en formation et en stage.
          </p>
        </div>

        <div class="skill-item-card">
          <div class="skill-item-top">
            <div class="skill-item-icon">🔥</div>
            <div>
              <div class="skill-item-name">Laravel</div>
              <div class="skill-item-level-label">Niveau · Avancé</div>
            </div>
            <span class="skill-badge badge-avance">Avancé</span>
          </div>
          <div class="skill-progress-wrap">
            <div class="skill-progress-bar skill-bar" data-level="82"></div>
          </div>
          <p class="skill-item-desc">
            Eloquent ORM, Blade templating, Auth, Migrations, Seeders,
            Routes, Middleware, Artisan. Maîtrisé en autonomie lors du stage Sacom Digital Agency.
          </p>
        </div>

      </div>
    </div>


    <!-- ── FRONTEND ── -->
    <div class="skills-category" data-category="frontend">
      <div class="category-header anim-fade-up">
        <div class="category-icon">🎨</div>
        <div>
          <div class="category-title">Frontend</div>
        </div>
        <span class="category-count">4 technos</span>
      </div>

      <div class="skills-grid-3 anim-cascade">

        <div class="skill-item-card">
          <div class="skill-item-top">
            <div class="skill-item-icon">🌐</div>
            <div>
              <div class="skill-item-name">HTML5 / CSS3</div>
              <div class="skill-item-level-label">Niveau · Expert</div>
            </div>
            <span class="skill-badge badge-expert">Expert</span>
          </div>
          <div class="skill-progress-wrap">
            <div class="skill-progress-bar skill-bar" data-level="92"></div>
          </div>
          <p class="skill-item-desc">
            Sémantique HTML5, CSS3 avancé, Flexbox, Grid, animations CSS,
            responsive design, variables CSS, media queries.
          </p>
        </div>

        <div class="skill-item-card">
          <div class="skill-item-top">
            <div class="skill-item-icon">⚡</div>
            <div>
              <div class="skill-item-name">JavaScript</div>
              <div class="skill-item-level-label">Niveau · Avancé</div>
            </div>
            <span class="skill-badge badge-avance">Avancé</span>
          </div>
          <div class="skill-progress-wrap">
            <div class="skill-progress-bar skill-bar" data-level="78"></div>
          </div>
          <p class="skill-item-desc">
            ES6+, manipulation du DOM, fetch API, événements,
            animations JS, IntersectionObserver, formulaires interactifs.
          </p>
        </div>

        <div class="skill-item-card">
          <div class="skill-item-top">
            <div class="skill-item-icon">🅱️</div>
            <div>
              <div class="skill-item-name">Bootstrap</div>
              <div class="skill-item-level-label">Niveau · Expert</div>
            </div>
            <span class="skill-badge badge-expert">Expert</span>
          </div>
          <div class="skill-progress-wrap">
            <div class="skill-progress-bar skill-bar" data-level="88"></div>
          </div>
          <p class="skill-item-desc">
            Grille Bootstrap 5, composants, utilitaires,
            personnalisation avec variables SASS, responsive mobile-first.
          </p>
        </div>

        <div class="skill-item-card">
          <div class="skill-item-top">
            <div class="skill-item-icon">⚛️</div>
            <div>
              <div class="skill-item-name">React</div>
              <div class="skill-item-level-label">Niveau · Intermédiaire</div>
            </div>
            <span class=\"skill-badge badge-intermediaire\">Intermédiaire</span>
          </div>
          <div class="skill-progress-wrap">
            <div class="skill-progress-bar skill-bar" data-level="72"></div>
          </div>
          <p class="skill-item-desc">
            Composants React, hooks, state management, JSX,
            props et événements, intégration d'API, responsive design.
          </p>
        </div>

      </div>
    </div>


    <!-- ── BASE DE DONNÉES ── -->
    <div class="skills-category" data-category="database">
      <div class="category-header anim-fade-up">
        <div class="category-icon">🗄️</div>
        <div>
          <div class="category-title">Base de données</div>
        </div>
        <span class="category-count">2 technos</span>
      </div>

      <div class="skills-grid-2 anim-cascade">

        <div class="skill-item-card">
          <div class="skill-item-top">
            <div class="skill-item-icon">🐬</div>
            <div>
              <div class="skill-item-name">MySQL</div>
              <div class="skill-item-level-label">Niveau · Avancé</div>
            </div>
            <span class="skill-badge badge-avance">Avancé</span>
          </div>
          <div class="skill-progress-wrap">
            <div class="skill-progress-bar skill-bar" data-level="80"></div>
          </div>
          <p class="skill-item-desc">
            Modélisation relationnelle, requêtes SQL avancées, jointures,
            indexation, transactions, procédures stockées.
          </p>
        </div>

        <div class="skill-item-card">
          <div class="skill-item-top">
            <div class="skill-item-icon">🛠️</div>
            <div>
              <div class="skill-item-name">PHPMyAdmin</div>
              <div class="skill-item-level-label">Niveau · Expert</div>
            </div>
            <span class="skill-badge badge-expert">Expert</span>
          </div>
          <div class="skill-progress-wrap">
            <div class="skill-progress-bar skill-bar" data-level="90"></div>
          </div>
          <p class="skill-item-desc">
            Administration de bases de données, import/export,
            gestion des utilisateurs et des droits, optimisation des tables.
          </p>
        </div>

      </div>
    </div>


    <!-- ── DESIGN & OUTILS ── -->
    <div class="skills-category" data-category="design">
      <div class="category-header anim-fade-up">
        <div class="category-icon">🖌️</div>
        <div>
          <div class="category-title">Design & Outils</div>
        </div>
        <span class="category-count">3 outils</span>
      </div>

      <div class="skills-grid-3 anim-cascade">

        <div class="skill-item-card">
          <div class="skill-item-top">
            <div class="skill-item-icon">🎯</div>
            <div>
              <div class="skill-item-name">Figma</div>
              <div class="skill-item-level-label">Niveau · Avancé</div>
            </div>
            <span class="skill-badge badge-avance">Avancé</span>
          </div>
          <div class="skill-progress-wrap">
            <div class="skill-progress-bar skill-bar" data-level="80"></div>
          </div>
          <p class="skill-item-desc">
            Maquettes UI/UX, prototypage interactif, composants,
            design system, auto-layout, collaboration en équipe.
          </p>
        </div>

        <div class="skill-item-card">
          <div class="skill-item-top">
            <div class="skill-item-icon">🌿</div>
            <div>
              <div class="skill-item-name">Git</div>
              <div class="skill-item-level-label">Niveau · Avancé</div>
            </div>
            <span class="skill-badge badge-avance">Avancé</span>
          </div>
          <div class="skill-progress-wrap">
            <div class="skill-progress-bar skill-bar" data-level="75"></div>
          </div>
          <p class="skill-item-desc">
            Versionning, branches, merge, rebase, GitHub,
            résolution de conflits, pull requests, workflow collaboratif.
          </p>
        </div>

        <div class="skill-item-card">
          <div class="skill-item-top">
            <div class="skill-item-icon">🔵</div>
            <div>
              <div class="skill-item-name">WordPress</div>
              <div class="skill-item-level-label">Niveau · Intermédiaire</div>
            </div>
            <span class="skill-badge badge-intermediaire">Interméd.</span>
          </div>
          <div class="skill-progress-wrap">
            <div class="skill-progress-bar skill-bar" data-level="60"></div>
          </div>
          <p class="skill-item-desc">
            Installation, thèmes, plugins, personnalisation de templates,
            gestion de contenu, WooCommerce basique.
          </p>
        </div>

      </div>
    </div>

  </div>
</section>


<!-- =====================================================
     SOFT SKILLS
===================================================== -->
<section class="softskills-section">
  <div class="container">

    <div class="anim-fade-up" style="text-align:center;">
      <div class="section-label" style="justify-content:center;">Savoir-être</div>
      <h2 class="section-title" style="text-align:center;">
        Mes <span>soft skills</span>
      </h2>
      <p class="section-subtitle" style="margin:0 auto 0;text-align:center;">
        Les qualités humaines qui font la différence dans un projet.
      </p>
    </div>

    <div class="softskill-grid anim-cascade">
      <div class="softskill-card">
        <span class="softskill-emoji">⚡</span>
        <div class="softskill-name">Autonomie</div>
        <div class="softskill-desc">Je prends des initiatives et avance sans supervision constante.</div>
      </div>
      <div class="softskill-card">
        <span class="softskill-emoji">🔬</span>
        <div class="softskill-name">Rigueur</div>
        <div class="softskill-desc">Code testé, documenté, propre. Je ne livre pas l'à-peu-près.</div>
      </div>
      <div class="softskill-card">
        <span class="softskill-emoji">🧩</span>
        <div class="softskill-name">Esprit critique</div>
        <div class="softskill-desc">J'analyse les problèmes avant de proposer des solutions.</div>
      </div>
      <div class="softskill-card">
        <span class="softskill-emoji">📚</span>
        <div class="softskill-name">Autodidacte</div>
        <div class="softskill-desc">Laravel appris seule en stage. J'apprends vite et bien.</div>
      </div>
      <div class="softskill-card">
        <span class="softskill-emoji">🔄</span>
        <div class="softskill-name">Adaptabilité</div>
        <div class="softskill-desc">Nouvelle équipe, nouvelle techno — je m'intègre facilement.</div>
      </div>
      <div class="softskill-card">
        <span class="softskill-emoji">💡</span>
        <div class="softskill-name">Curiosité</div>
        <div class="softskill-desc">Toujours en veille sur les nouvelles pratiques du web.</div>
      </div>
    </div>

  </div>
</section>


<!-- =====================================================
     OUTILS & ENVIRONNEMENT
===================================================== -->
<section class="tools-section">
  <div class="container tools-inner">

    <div class="anim-fade-up" style="text-align:center;">
      <div class="section-label" style="justify-content:center;color:var(--gold);">Environnement</div>
      <h2 class="section-title" style="color:var(--white);text-align:center;">
        Outils du <span style="color:var(--gold);">quotidien</span>
      </h2>
    </div>

    <div class="tools-grid anim-cascade">
      <div class="tool-pill"><span class="tool-pill-icon">🐘</span> PHP 8</div>
      <div class="tool-pill"><span class="tool-pill-icon">🔥</span> Laravel 10</div>
      <div class="tool-pill"><span class="tool-pill-icon">🅱️</span> Bootstrap 5</div>
      <div class="tool-pill"><span class="tool-pill-icon">⚡</span> JavaScript ES6+</div>
      <div class="tool-pill"><span class="tool-pill-icon">🐬</span> MySQL 8</div>
      <div class="tool-pill"><span class="tool-pill-icon">🎯</span> Figma</div>
      <div class="tool-pill"><span class="tool-pill-icon">🌿</span> Git & GitHub</div>
      <div class="tool-pill"><span class="tool-pill-icon">🛠️</span> PHPMyAdmin</div>
      <div class="tool-pill"><span class="tool-pill-icon">🔵</span> WordPress</div>
      <div class="tool-pill"><span class="tool-pill-icon">📊</span> Excel</div>
      <div class="tool-pill"><span class="tool-pill-icon">💻</span> VS Code</div>
      <div class="tool-pill"><span class="tool-pill-icon">🖥️</span> Laragon / XAMPP</div>
      <div class="tool-pill"><span class="tool-pill-icon">🐳</span> Docker (bases)</div>
      <div class="tool-pill"><span class="tool-pill-icon">⚛️</span> React</div>
    </div>

  </div>
</section>


<!-- =====================================================
     CTA
===================================================== -->
<div class="skills-cta anim-fade-up">
  <div class="container">
    <div class="section-label" style="justify-content:center;">Prochaine étape</div>
    <h2 class="section-title" style="text-align:center;margin-bottom:0.75rem;">
      Voir mes <span>projets concrets</span>
    </h2>
    <p style="color:var(--gray-600);font-size:var(--text-lg);margin-bottom:2rem;max-width:460px;margin-left:auto;margin-right:auto;text-align:center;">
      Ces compétences mises en pratique dans de vraies applications.
    </p>
    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
      <a href="projects.php" class="btn-primary btn-ripple">Voir mes projets</a>
      <a href="contact.php" class="btn-outline btn-ripple">Me contacter</a>
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
        <a href="https://www.facebook.com/roukayath.gazaliou" target="_blank" rel="noopener" class="social-link" aria-label="Facebook">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
        </a>
        <a href="https://www.linkedin.com/in/roukayath-gazaliou" target="_blank" rel="noopener" class="social-link" aria-label="LinkedIn">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.225 0z"/></svg>
        </a>
        <a href="mailto:Gazaliouroukayath@gmail.com" class="social-link" aria-label="Email">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        </a>
      </div>
    </div>
  </div>
</footer>


<!-- =====================================================
     SCRIPT FILTRES
===================================================== -->
<script>
(function () {

  /* ── Filtres catégories ── */
  const tabs       = document.querySelectorAll('.filter-tab');
  const categories = document.querySelectorAll('.skills-category');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');

      const filter = tab.dataset.filter;

      categories.forEach(cat => {
        if (filter === 'all' || cat.dataset.category === filter) {
          cat.style.display = 'block';
          cat.style.animation = 'fadeInUp 0.4s ease both';
        } else {
          cat.style.display = 'none';
        }
      });
    });
  });

})();
</script>

</body>
</html>