<?php
$pageTitle = "Expérience & Formation — Roukayath Gazaliou";
$pageDesc  = "Parcours professionnel et académique de Roukayath Gazaliou : stage SolDigit, Licence SIL, formations OpenClassrooms.";
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
    .exp-hero {
      background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 60%, var(--navy-light) 100%);
      padding: 10rem 0 5rem;
      position: relative;
      overflow: hidden;
    }
    .exp-hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
      background-size: 60px 60px;
    }
    .exp-hero-inner { position: relative; z-index: 1; }
    .exp-breadcrumb {
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      letter-spacing: 0.1em;
      color: rgba(255,255,255,.4);
      margin-bottom: 1.5rem;
    }
    .exp-breadcrumb a { color: rgba(255,255,255,.4); transition: var(--transition); }
    .exp-breadcrumb a:hover { color: var(--gold); }
    .exp-hero-title {
      font-family: var(--font-display);
      font-size: clamp(2.5rem, 6vw, 4rem);
      font-weight: 700;
      color: var(--white);
      line-height: 1.1;
      margin-bottom: 1rem;
    }
    .exp-hero-title span { color: var(--gold); font-style: italic; }
    .exp-hero-sub {
      font-size: var(--text-lg);
      color: rgba(255,255,255,.6);
      max-width: 520px;
    }

    /* ── Layout principal ── */
    .exp-main {
      padding: var(--section-py) 0;
      background: var(--white);
    }

    .exp-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 5rem;
    }

    /* ── Titre colonne ── */
    .exp-col-header {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 3rem;
      padding-bottom: 1.5rem;
      border-bottom: 2px solid var(--gray-200);
    }
    .exp-col-icon {
      width: 52px;
      height: 52px;
      border-radius: var(--radius-md);
      background: var(--navy);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      flex-shrink: 0;
    }
    .exp-col-title {
      font-family: var(--font-display);
      font-size: var(--text-2xl);
      font-weight: 700;
      color: var(--navy);
    }
    .exp-col-sub {
      font-size: var(--text-sm);
      color: var(--gray-400);
      margin-top: 0.15rem;
    }

    /* ── Timeline custom ── */
    .exp-timeline {
      position: relative;
      padding-left: 2.5rem;
    }
    .exp-timeline::before {
      content: '';
      position: absolute;
      left: 10px;
      top: 6px;
      bottom: 6px;
      width: 2px;
      background: linear-gradient(to bottom, var(--accent), rgba(37,99,235,.1));
      border-radius: 2px;
    }

    .exp-item {
      position: relative;
      padding-bottom: 2.75rem;
      opacity: 0;
      transform: translateX(-20px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
    .exp-item.visible {
      opacity: 1;
      transform: translateX(0);
    }
    .exp-item:last-child { padding-bottom: 0; }

    /* Dot timeline */
    .exp-item::before {
      content: '';
      position: absolute;
      left: -2.1rem;
      top: 7px;
      width: 14px;
      height: 14px;
      border-radius: 50%;
      background: var(--white);
      border: 3px solid var(--accent);
      box-shadow: 0 0 0 3px rgba(37,99,235,.15);
      transition: var(--transition);
      z-index: 1;
    }
    .exp-item:hover::before {
      background: var(--accent);
      box-shadow: 0 0 0 5px rgba(37,99,235,.2);
    }

    /* Carte expérience */
    .exp-card {
      background: var(--off-white);
      border: 1.5px solid var(--gray-200);
      border-radius: var(--radius-lg);
      padding: 1.75rem;
      transition: var(--transition);
      position: relative;
      overflow: hidden;
    }
    .exp-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; bottom: 0;
      width: 3px;
      background: linear-gradient(to bottom, var(--accent), var(--gold));
      border-radius: 2px 0 0 2px;
      transform: scaleY(0);
      transform-origin: top;
      transition: transform 0.4s ease;
    }
    .exp-card:hover {
      border-color: var(--accent);
      box-shadow: var(--shadow-lg);
      transform: translateX(4px);
    }
    .exp-card:hover::before {
      transform: scaleY(1);
    }

    .exp-card-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 1rem;
      margin-bottom: 0.75rem;
    }

    .exp-date-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      padding: 0.3rem 0.85rem;
      background: var(--accent-soft);
      color: var(--accent);
      border-radius: 50px;
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      font-weight: 700;
      letter-spacing: 0.06em;
      white-space: nowrap;
      flex-shrink: 0;
    }
    .exp-date-badge.badge-current {
      background: #dcfce7;
      color: #16a34a;
    }
    .exp-date-badge.badge-gold {
      background: rgba(201,168,76,.15);
      color: var(--gold);
    }

    .exp-role {
      font-family: var(--font-display);
      font-size: var(--text-xl);
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 0.3rem;
      line-height: 1.2;
    }
    .exp-org {
      font-size: var(--text-base);
      font-weight: 600;
      color: var(--accent);
      margin-bottom: 0.25rem;
    }
    .exp-location {
      font-size: var(--text-xs);
      color: var(--gray-400);
      font-family: var(--font-mono);
      letter-spacing: 0.05em;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.3rem;
    }

    .exp-desc {
      font-size: var(--text-sm);
      color: var(--gray-600);
      line-height: 1.75;
      margin-bottom: 1rem;
    }

    /* Liste missions */
    .exp-missions {
      display: flex;
      flex-direction: column;
      gap: 0.4rem;
    }
    .exp-mission {
      display: flex;
      align-items: flex-start;
      gap: 0.6rem;
      font-size: var(--text-sm);
      color: var(--gray-600);
      line-height: 1.6;
    }
    .exp-mission::before {
      content: '▸';
      color: var(--accent);
      font-size: 0.65rem;
      margin-top: 0.3rem;
      flex-shrink: 0;
    }

    /* Tags techno dans la carte */
    .exp-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 0.4rem;
      margin-top: 1.25rem;
      padding-top: 1.25rem;
      border-top: 1px solid var(--gray-200);
    }

    /* ── Section compétences acquises ── */
    .skills-acquired {
      padding: var(--section-py) 0;
      background: var(--off-white);
    }

    .acquired-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1.5rem;
      margin-top: 3rem;
    }

    .acquired-card {
      background: var(--white);
      border: 1px solid var(--gray-200);
      border-radius: var(--radius-lg);
      padding: 1.75rem 1.5rem;
      text-align: center;
      transition: var(--transition);
    }
    .acquired-card:hover {
      border-color: var(--accent);
      box-shadow: var(--shadow-md);
      transform: translateY(-4px);
    }
    .acquired-emoji {
      font-size: 2.2rem;
      margin-bottom: 0.875rem;
      display: block;
    }
    .acquired-title {
      font-weight: 700;
      font-size: var(--text-base);
      color: var(--navy);
      margin-bottom: 0.4rem;
    }
    .acquired-desc {
      font-size: var(--text-sm);
      color: var(--gray-600);
      line-height: 1.65;
    }

    /* ── Section certifications / formations courtes ── */
    .certs-section {
      padding: var(--section-py) 0;
      background: var(--white);
    }

    .certs-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
      margin-top: 3rem;
    }

    .cert-card {
      border: 1.5px solid var(--gray-200);
      border-radius: var(--radius-lg);
      padding: 1.75rem;
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
      transition: var(--transition);
      background: var(--white);
      position: relative;
      overflow: hidden;
    }
    .cert-card::after {
      content: '';
      position: absolute;
      top: 0; right: 0;
      width: 60px;
      height: 60px;
      background: var(--accent-soft);
      border-radius: 0 var(--radius-lg) 0 60px;
      opacity: 0;
      transition: var(--transition);
    }
    .cert-card:hover {
      border-color: var(--accent);
      box-shadow: var(--shadow-md);
      transform: translateY(-3px);
    }
    .cert-card:hover::after { opacity: 1; }

    .cert-platform {
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      color: var(--accent);
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }
    .cert-title {
      font-weight: 700;
      font-size: var(--text-base);
      color: var(--navy);
      line-height: 1.3;
    }
    .cert-year {
      font-size: var(--text-xs);
      color: var(--gray-400);
      font-family: var(--font-mono);
    }
    .cert-icon {
      font-size: 1.75rem;
      margin-bottom: 0.25rem;
    }

    /* ── Section réalisations clés ── */
    .key-achievements {
      padding: var(--section-py) 0;
      background: var(--navy);
      position: relative;
      overflow: hidden;
    }
    .key-achievements::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
      background-size: 50px 50px;
    }
    .key-achievements-inner { position: relative; z-index: 1; }

    .achievements-list {
      display: flex;
      flex-direction: column;
      gap: 1.25rem;
      margin-top: 3rem;
      max-width: 760px;
      margin-left: auto;
      margin-right: auto;
    }
    .achievement-row {
      display: flex;
      align-items: flex-start;
      gap: 1.5rem;
      padding: 1.5rem 2rem;
      background: rgba(255,255,255,.05);
      border: 1px solid rgba(255,255,255,.1);
      border-radius: var(--radius-lg);
      transition: var(--transition);
    }
    .achievement-row:hover {
      background: rgba(37,99,235,.12);
      border-color: rgba(37,99,235,.4);
      transform: translateX(6px);
    }
    .achievement-row-num {
      font-family: var(--font-display);
      font-size: var(--text-3xl);
      font-weight: 700;
      color: rgba(255,255,255,.1);
      line-height: 1;
      flex-shrink: 0;
      width: 48px;
    }
    .achievement-row-title {
      font-weight: 700;
      font-size: var(--text-base);
      color: var(--white);
      margin-bottom: 0.3rem;
    }
    .achievement-row-desc {
      font-size: var(--text-sm);
      color: rgba(255,255,255,.55);
      line-height: 1.7;
    }

    /* ── CTA ── */
    .exp-cta {
      padding: 5rem 0;
      text-align: center;
      background: var(--off-white);
      border-top: 1px solid var(--gray-200);
    }

    /* ── Responsive ── */
    @media (max-width: 1024px) {
      .exp-grid { grid-template-columns: 1fr; gap: 4rem; }
      .acquired-grid { grid-template-columns: repeat(2, 1fr); }
      .certs-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
      .acquired-grid { grid-template-columns: repeat(2, 1fr); }
      .certs-grid { grid-template-columns: 1fr; }
      .achievement-row { flex-direction: column; gap: 0.75rem; }
    }
    @media (max-width: 480px) {
      .exp-hero { padding: 8rem 0 3.5rem; }
      .acquired-grid { grid-template-columns: 1fr; }
      .exp-card { padding: 1.25rem; }
    }
  </style>
</head>
<body>

<?php include 'includes/nav.php'; ?>

<!-- =====================================================
     HERO
===================================================== -->
<section class="exp-hero">
  <div class="container exp-hero-inner">
    <div class="exp-breadcrumb anim-fade-up">
      <a href="index.php">Accueil</a> / Expérience & Formation
    </div>
    <h1 class="exp-hero-title anim-fade-up delay-1">
      Mon <span>parcours</span><br/>professionnel
    </h1>
    <p class="exp-hero-sub anim-fade-up delay-2">
      Expériences, formations académiques et certifications qui ont
      façonné mon profil de développeuse fullstack.
    </p>
  </div>
</section>


<!-- =====================================================
     EXPÉRIENCE + FORMATION (2 colonnes)
===================================================== -->
<section class="exp-main">
  <div class="container">
    <div class="exp-grid">

      <!-- ══ COLONNE GAUCHE : Expérience ══ -->
      <div class="anim-fade-left">

        <div class="exp-col-header">
          <div class="exp-col-icon">💼</div>
          <div>
            <div class="exp-col-title">Expérience</div>
            <div class="exp-col-sub">Parcours professionnel</div>
          </div>
        </div>

        <div class="exp-timeline">

          <!-- Stage SolDigit -->
          <div class="exp-item">
            <div class="exp-card">
              <div class="exp-card-header">
                <div>
                  <div class="exp-role">Développeuse Web</div>
                  <div class="exp-org">SolDigit</div>
                  <div class="exp-location">
                    📍 Calavi, Bénin · Stage
                  </div>
                </div>
                <span class="exp-date-badge">2024 – 2025</span>
              </div>

              <p class="exp-desc">
                Stage de développement web fullstack dans une entreprise
                spécialisée en solutions numériques. Intégration directe
                dans l'équipe de développement avec prise en charge de
                projets clients réels.
              </p>

              <div class="exp-missions">
                <div class="exp-mission">Développement de sites web avec PHP, JavaScript et Bootstrap</div>
                <div class="exp-mission">Utilisation de Laravel pour structurer et optimiser les projets</div>
                <div class="exp-mission">Conception de maquettes interactives sur Figma avant développement</div>
                <div class="exp-mission">Participation à la conception et réalisation de projets web complets</div>
                <div class="exp-mission">Adaptation autonome aux technologies et méthodologies de l'équipe</div>
              </div>

              <div class="exp-tags">
                <span class="tag">PHP</span>
                <span class="tag">Laravel</span>
                <span class="tag">Bootstrap</span>
                <span class="tag">JavaScript</span>
                <span class="tag">Figma</span>
                <span class="tag">MySQL</span>
                <span class="tag">Git</span>
              </div>
            </div>
          </div>

          <!-- Projets personnels -->
          <div class="exp-item">
            <div class="exp-card">
              <div class="exp-card-header">
                <div>
                  <div class="exp-role">Projets Personnels</div>
                  <div class="exp-org">Freelance / Auto-formation</div>
                  <div class="exp-location">📍 Calavi, Bénin · Personnel</div>
                </div>
                <span class="exp-date-badge badge-current">En cours</span>
              </div>

              <p class="exp-desc">
                Réalisation de 5 applications web fullstack de A à Z ,
                conception Figma, développement PHP/Laravel, base de données
                MySQL, déploiement. Chaque projet simule un contexte client réel.
              </p>

              <div class="exp-missions">
                <div class="exp-mission">Délices du Bénin — Application restaurant avec réservation</div>
                <div class="exp-mission">RoukLegal — Plateforme juridique de consultations</div>
                <div class="exp-mission">PME Bénin — Marketplace de produits béninois</div>
                <div class="exp-mission">ViteCom — Gestion de précommandes e-commerce</div>
                <div class="exp-mission">BookEase — SaaS de planification de rendez-vous</div>
              </div>

              <div class="exp-tags">
                <span class="tag">Laravel</span>
                <span class="tag">PHP</span>
                <span class="tag">Figma</span>
                <span class="tag">MySQL</span>
                <span class="tag">JavaScript</span>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- ══ COLONNE DROITE : Formation ══ -->
      <div class="anim-fade-right">

        <div class="exp-col-header">
          <div class="exp-col-icon">🎓</div>
          <div>
            <div class="exp-col-title">Formation</div>
            <div class="exp-col-sub">Parcours académique</div>
          </div>
        </div>

        <div class="exp-timeline">

          <!-- Licence SIL -->
          <div class="exp-item">
            <div class="exp-card">
              <div class="exp-card-header">
                <div>
                  <div class="exp-role">Licence en Sciences Informatiques</div>
                  <div class="exp-org">SIL — Validée par examen d'État</div>
                  <div class="exp-location">📍 Bénin · Formation initiale</div>
                </div>
                <span class="exp-date-badge badge-gold">2025</span>
              </div>
              <p class="exp-desc">
                Formation universitaire complète en Sciences Informatiques et Logiciels.
                Couvre les fondamentaux de l'informatique, la programmation, les
                bases de données, les réseaux et le développement web.
              </p>
              <div class="exp-missions">
                <div class="exp-mission">Programmation orientée objet (PHP, Java)</div>
                <div class="exp-mission">Conception et gestion de bases de données relationnelles</div>
                <div class="exp-mission">Développement web frontend et backend</div>
                <div class="exp-mission">Algorithmique et structures de données</div>
                <div class="exp-mission">Validée par examen d'État — 2025</div>
              </div>
              <div class="exp-tags">
                <span class="tag">PHP</span>
                <span class="tag">Java</span>
                <span class="tag">MySQL</span>
                <span class="tag">Algorithmique</span>
              </div>
            </div>
          </div>

          <!-- Licence Chimie -->
          <div class="exp-item">
            <div class="exp-card">
              <div class="exp-card-header">
                <div>
                  <div class="exp-role">Licence en Chimie Fondamentale</div>
                  <div class="exp-org">Formation universitaire parallèle</div>
                  <div class="exp-location">📍 Bénin · Double cursus</div>
                </div>
                <span class="exp-date-badge badge-current">En cours</span>
              </div>
              <p class="exp-desc">
                Double licence témoignant d'une capacité de travail et d'une
                curiosité intellectuelle rare. La rigueur scientifique de la chimie
                enrichit mon approche du développement.
              </p>
              <div class="exp-missions">
                <div class="exp-mission">Rigueur scientifique et méthode analytique</div>
                <div class="exp-mission">Gestion de double charge académique en parallèle</div>
                <div class="exp-mission">Profil pluridisciplinaire — atout unique</div>
              </div>
            </div>
          </div>

          <!-- Baccalauréat -->
          <div class="exp-item">
            <div class="exp-card">
              <div class="exp-card-header">
                <div>
                  <div class="exp-role">Baccalauréat Scientifique</div>
                  <div class="exp-org">Série C — Lycée, Bénin</div>
                  <div class="exp-location">📍 Bénin · Formation secondaire</div>
                </div>
                <span class="exp-date-badge badge-gold">2022</span>
              </div>
              <p class="exp-desc">
                Baccalauréat scientifique série C (Mathématiques et Sciences
                Physiques) — base solide pour les études en informatique.
              </p>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>


<!-- =====================================================
     CERTIFICATIONS OPENCLASSROOMS
===================================================== -->
<section class="certs-section">
  <div class="container">

    <div class="anim-fade-up" style="text-align:center;">
      <div class="section-label" style="justify-content:center;">Auto-formation</div>
      <h2 class="section-title" style="text-align:center;">
        Certifications <span>OpenClassrooms</span>
      </h2>
      <p class="section-subtitle" style="text-align:center;margin:0 auto;">
        Formations en ligne complétées en autodidacte pour renforcer mes compétences.
      </p>
    </div>

    <div class="certs-grid anim-cascade">

      <div class="cert-card">
        <div class="cert-icon">🐘</div>
        <div class="cert-platform">OpenClassrooms</div>
        <div class="cert-title">PHP Orienté Objet (POO)</div>
        <div class="cert-year">2023 – 2024</div>
      </div>

      <div class="cert-card">
        <div class="cert-icon">🗄️</div>
        <div class="cert-platform">OpenClassrooms</div>
        <div class="cert-title">PHP & MySQL — Base de données</div>
        <div class="cert-year">2023 – 2024</div>
      </div>

      <div class="cert-card">
        <div class="cert-icon">🌐</div>
        <div class="cert-platform">OpenClassrooms</div>
        <div class="cert-title">Fondamentaux du Web</div>
        <div class="cert-year">2023 – 2024</div>
      </div>

    </div>
  </div>
</section>


<!-- =====================================================
     COMPÉTENCES ACQUISES
===================================================== -->
<section class="skills-acquired">
  <div class="container">

    <div class="anim-fade-up" style="text-align:center;">
      <div class="section-label" style="justify-content:center;">Bilan</div>
      <h2 class="section-title" style="text-align:center;">
        Ce que j'ai <span>acquis</span>
      </h2>
    </div>

    <div class="acquired-grid anim-cascade">

      <div class="acquired-card">
        <span class="acquired-emoji">🏗️</span>
        <div class="acquired-title">Architecture MVC</div>
        <div class="acquired-desc">Structuration de projets avec Laravel selon le pattern MVC.</div>
      </div>

      <div class="acquired-card">
        <span class="acquired-emoji">🎨</span>
        <div class="acquired-title">Design → Code</div>
        <div class="acquired-desc">Passage fluide de la maquette Figma au code HTML/CSS/PHP.</div>
      </div>

      <div class="acquired-card">
        <span class="acquired-emoji">🔒</span>
        <div class="acquired-title">Sécurité web</div>
        <div class="acquired-desc">Authentification, CSRF, validation, requêtes préparées PDO.</div>
      </div>

      <div class="acquired-card">
        <span class="acquired-emoji">📱</span>
        <div class="acquired-title">Responsive design</div>
        <div class="acquired-desc">Interfaces adaptées mobile, tablette et desktop avec Bootstrap.</div>
      </div>

    </div>
  </div>
</section>


<!-- =====================================================
     RÉALISATIONS CLÉS
===================================================== -->
<section class="key-achievements">
  <div class="container key-achievements-inner">

    <div class="anim-fade-up" style="text-align:center;">
      <div class="section-label" style="justify-content:center;color:var(--gold);">Points forts</div>
      <h2 class="section-title" style="color:var(--white);text-align:center;">
        Réalisations <span style="color:var(--gold);">clés</span>
      </h2>
    </div>

    <div class="achievements-list anim-cascade">

      <div class="achievement-row">
        <div class="achievement-row-num">01</div>
        <div>
          <div class="achievement-row-title">Laravel maîtrisé en autonomie en contexte professionnel</div>
          <div class="achievement-row-desc">Framework appris seule lors du stage SolDigit sans formation préalable, directement en situation de production.</div>
        </div>
      </div>

      <div class="achievement-row">
        <div class="achievement-row-num">02</div>
        <div>
          <div class="achievement-row-title">Double licence Informatique & Chimie simultanément</div>
          <div class="achievement-row-desc">Profil pluridisciplinaire rare témoignant d'une capacité de travail et d'une curiosité intellectuelle hors du commun.</div>
        </div>
      </div>

      <div class="achievement-row">
        <div class="achievement-row-num">03</div>
        <div>
          <div class="achievement-row-title">5 projets fullstack de Figma au déploiement</div>
          <div class="achievement-row-desc">Applications web complètes réalisées en autonomie — conception UI/UX, développement backend, base de données, responsive.</div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- =====================================================
     CTA
===================================================== -->
<div class="exp-cta anim-fade-up">
  <div class="container">
    <div class="section-label" style="justify-content:center;">Intéressé(e) ?</div>
    <h2 class="section-title" style="text-align:center;margin-bottom:0.75rem;">
      Travaillons <span>ensemble</span>
    </h2>
    <p style="color:var(--gray-600);font-size:var(--text-lg);margin-bottom:2rem;max-width:460px;margin-left:auto;margin-right:auto;text-align:center;">
      Disponible pour des missions freelance ou des opportunités en CDI/CDD.
    </p>
    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
      <a href="contact.php" class="btn-primary btn-ripple">Me contacter</a>
      <a href="assets/CV-Rouky.pdf" download class="btn-outline btn-ripple">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
        Télécharger mon CV
      </a>
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

<script>
(function () {
  /* Scroll reveal timeline items */
  const items = document.querySelectorAll('.exp-item');
  const obs = new IntersectionObserver((entries) => {
    entries.forEach((entry, idx) => {
      if (entry.isIntersecting) {
        setTimeout(() => entry.target.classList.add('visible'), idx * 150);
        obs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });
  items.forEach(item => obs.observe(item));
})();
</script>

</body>
</html>
