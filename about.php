<?php
$pageTitle = "À propos — Roukayath Gazaliou";
$pageDesc  = "Découvrez le parcours, la formation et la personnalité de Roukayath Gazaliou, développeuse web fullstack PHP & Laravel basée à Cotonou, Bénin.";
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
    /* ── Styles spécifiques About ── */

    .about-hero {
      background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 60%, var(--navy-light) 100%);
      padding: 10rem 0 5rem;
      position: relative;
      overflow: hidden;
    }

    .about-hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
      background-size: 60px 60px;
      pointer-events: none;
    }

    .about-hero-inner {
      position: relative;
      z-index: 1;
    }

    .about-hero-breadcrumb {
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      letter-spacing: 0.1em;
      color: rgba(255,255,255,.4);
      margin-bottom: 1.5rem;
    }

    .about-hero-breadcrumb a {
      color: rgba(255,255,255,.4);
      transition: var(--transition);
    }

    .about-hero-breadcrumb a:hover {
      color: var(--gold);
    }

    .about-hero-title {
      font-family: var(--font-display);
      font-size: clamp(2.5rem, 6vw, 4rem);
      font-weight: 700;
      color: var(--white);
      line-height: 1.1;
      margin-bottom: 1rem;
    }

    .about-hero-title span {
      color: var(--gold);
      font-style: italic;
    }

    .about-hero-sub {
      font-size: var(--text-lg);
      color: rgba(255,255,255,.6);
      max-width: 540px;
    }

    /* ── Section principale about ── */
    .about-main {
      padding: var(--section-py) 0;
    }

    .about-grid {
      display: grid;
      grid-template-columns: 1fr 1.4fr;
      gap: 5rem;
      align-items: start;
    }

    /* Colonne photo + infos */
    .about-left {
      position: sticky;
      top: 100px;
    }

    .about-photo-wrap {
      position: relative;
      margin-bottom: 2rem;
    }

    .about-photo-frame {
      width: 100%;
      aspect-ratio: 3/4;
      border-radius: var(--radius-xl);
      overflow: hidden;
      box-shadow: var(--shadow-xl);
      border: 3px solid var(--gray-200);
    }

    .about-photo-frame img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: top center;
    }

    .about-photo-placeholder {
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, var(--navy), var(--navy-light));
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 1rem;
      color: rgba(255,255,255,.35);
      padding: 2rem;
      text-align: center;
    }

    .about-photo-placeholder svg {
      width: 80px;
      height: 80px;
      opacity: .4;
    }

    .about-photo-placeholder p {
      font-size: var(--text-sm);
      font-family: var(--font-mono);
      letter-spacing: 0.06em;
    }

    /* Deco accent coin photo */
    .about-photo-deco-line {
      position: absolute;
      bottom: -16px;
      left: -16px;
      width: 80px;
      height: 80px;
      border-left: 3px solid var(--gold);
      border-bottom: 3px solid var(--gold);
      border-radius: 0 0 0 var(--radius-sm);
    }

    .about-photo-deco-dot {
      position: absolute;
      top: -12px;
      right: -12px;
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: var(--accent-soft);
      border: 3px solid var(--accent);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
    }

    /* Infos rapides sous la photo */
    .about-quick-info {
      background: var(--off-white);
      border: 1px solid var(--gray-200);
      border-radius: var(--radius-md);
      padding: 1.5rem;
    }

    .about-info-row {
      display: flex;
      align-items: center;
      gap: 0.875rem;
      padding: 0.6rem 0;
      border-bottom: 1px solid var(--gray-200);
      font-size: var(--text-sm);
    }

    .about-info-row:last-child {
      border-bottom: none;
    }

    .about-info-icon {
      width: 32px;
      height: 32px;
      border-radius: var(--radius-sm);
      background: var(--accent-soft);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.95rem;
      flex-shrink: 0;
    }

    .about-info-label {
      font-size: var(--text-xs);
      color: var(--gray-400);
      font-family: var(--font-mono);
      letter-spacing: 0.05em;
      display: block;
    }

    .about-info-value {
      font-weight: 600;
      color: var(--navy);
    }

    /* Bouton télécharger CV */
    .btn-download-cv {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.6rem;
      width: 100%;
      padding: 0.875rem;
      background: var(--navy);
      color: var(--white);
      border-radius: var(--radius-sm);
      font-size: var(--text-sm);
      font-weight: 600;
      margin-top: 1.25rem;
      transition: var(--transition);
      letter-spacing: 0.03em;
    }

    .btn-download-cv:hover {
      background: var(--accent);
      transform: translateY(-2px);
      box-shadow: var(--shadow-md);
    }

    /* Colonne droite — texte */
    .about-right {}

    .about-intro {
      font-size: var(--text-xl);
      font-family: var(--font-display);
      font-style: italic;
      color: var(--navy);
      line-height: 1.65;
      border-left: 3px solid var(--gold);
      padding-left: 1.5rem;
      margin-bottom: 2rem;
    }

    .about-text {
      font-size: var(--text-base);
      color: var(--gray-600);
      line-height: 1.9;
      margin-bottom: 1.25rem;
    }

    .about-text strong {
      color: var(--navy);
      font-weight: 600;
    }

    /* Traits de caractère */
    .about-traits {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
      margin: 2.5rem 0;
    }

    .trait-card {
      display: flex;
      align-items: flex-start;
      gap: 0.875rem;
      padding: 1.25rem;
      background: var(--off-white);
      border: 1px solid var(--gray-200);
      border-radius: var(--radius-md);
      transition: var(--transition);
    }

    .trait-card:hover {
      border-color: var(--accent);
      background: var(--accent-soft);
      transform: translateY(-2px);
    }

    .trait-emoji {
      font-size: 1.5rem;
      line-height: 1;
      margin-top: 0.1rem;
    }

    .trait-title {
      font-weight: 700;
      font-size: var(--text-sm);
      color: var(--navy);
      margin-bottom: 0.2rem;
    }

    .trait-desc {
      font-size: var(--text-xs);
      color: var(--gray-600);
      line-height: 1.6;
    }

    /* Langues */
    .about-languages {
      margin-top: 2.5rem;
    }

    .lang-row {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1rem;
    }

    .lang-name {
      font-size: var(--text-sm);
      font-weight: 600;
      color: var(--navy);
      width: 90px;
      flex-shrink: 0;
    }

    .lang-bar-wrap {
      flex: 1;
      height: 6px;
      background: var(--gray-200);
      border-radius: 4px;
      overflow: hidden;
    }

    .lang-bar {
      height: 100%;
      border-radius: 4px;
      background: linear-gradient(90deg, var(--accent), var(--navy-light));
      width: 0;
      transition: width 1.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .lang-level {
      font-size: var(--text-xs);
      color: var(--gray-400);
      font-family: var(--font-mono);
      width: 60px;
      text-align: right;
    }

    /* Section valeurs / ce que j'apporte */
    .about-values {
      padding: var(--section-py) 0;
      background: var(--navy);
      position: relative;
      overflow: hidden;
    }

    .about-values::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
      background-size: 50px 50px;
    }

    .about-values-inner {
      position: relative;
      z-index: 1;
    }

    .values-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2rem;
      margin-top: 3rem;
    }

    .value-card {
      padding: 2rem;
      border: 1px solid rgba(255,255,255,.1);
      border-radius: var(--radius-lg);
      background: rgba(255,255,255,.04);
      backdrop-filter: blur(8px);
      transition: var(--transition);
    }

    .value-card:hover {
      border-color: rgba(37,99,235,.5);
      background: rgba(37,99,235,.08);
      transform: translateY(-4px);
    }

    .value-number {
      font-family: var(--font-display);
      font-size: 3rem;
      font-weight: 700;
      color: rgba(255,255,255,.08);
      line-height: 1;
      margin-bottom: 0.75rem;
    }

    .value-title {
      font-size: var(--text-lg);
      font-weight: 700;
      color: var(--white);
      margin-bottom: 0.6rem;
    }

    .value-desc {
      font-size: var(--text-sm);
      color: rgba(255,255,255,.55);
      line-height: 1.75;
    }

    /* Réalisations clés */
    .about-achievements {
      padding: var(--section-py) 0;
    }

    .achievements-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
      margin-top: 3rem;
    }

    .achievement-card {
      padding: 2rem;
      background: var(--white);
      border: 1px solid var(--gray-200);
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow-sm);
      transition: var(--transition);
      position: relative;
      overflow: hidden;
    }

    .achievement-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--accent), var(--gold));
    }

    .achievement-card:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-lg);
    }

    .achievement-num {
      font-family: var(--font-display);
      font-size: var(--text-4xl);
      font-weight: 700;
      color: var(--accent);
      line-height: 1;
      margin-bottom: 0.5rem;
    }

    .achievement-title {
      font-weight: 700;
      font-size: var(--text-base);
      color: var(--navy);
      margin-bottom: 0.4rem;
    }

    .achievement-desc {
      font-size: var(--text-sm);
      color: var(--gray-600);
      line-height: 1.65;
    }

    /* CTA vers contact */
    .about-cta {
      background: var(--off-white);
      padding: 5rem 0;
      text-align: center;
      border-top: 1px solid var(--gray-200);
    }

    /* ── Responsive ── */
    @media (max-width: 1024px) {
      .about-grid {
        grid-template-columns: 1fr;
        gap: 3rem;
      }

      .about-left {
        position: static;
        max-width: 380px;
        margin: 0 auto;
      }

      .values-grid,
      .achievements-grid {
        grid-template-columns: 1fr 1fr;
      }
    }

    @media (max-width: 768px) {
      .about-traits {
        grid-template-columns: 1fr;
      }

      .values-grid {
        grid-template-columns: 1fr;
      }

      .achievements-grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 480px) {
      .about-hero {
        padding: 8rem 0 3.5rem;
      }

      .about-traits {
        grid-template-columns: 1fr;
      }

      .about-intro {
        font-size: var(--text-lg);
      }
    }
  </style>
</head>
<body>

<?php include 'includes/nav.php'; ?>

<!-- =====================================================
     HERO ABOUT
===================================================== -->
<section class="about-hero">
  <div class="container about-hero-inner">
    <div class="about-hero-breadcrumb">
      <a href="index.php">Accueil</a> / À propos
    </div>
    <h1 class="about-hero-title anim-fade-up">
      Mon <span>parcours</span>,<br/>ma passion
    </h1>
    <p class="about-hero-sub anim-fade-up delay-2">
      Développeuse web fullstack formée au Bénin, je construis des solutions
      web robustes avec soin et précision.
    </p>
  </div>
</section>


<!-- =====================================================
     SECTION PRINCIPALE — Photo + Texte
===================================================== -->
<section class="about-main">
  <div class="container">
    <div class="about-grid">

      <!-- ── Colonne gauche : photo + infos ── -->
      <div class="about-left anim-fade-left">

        <div class="about-photo-wrap">
          <div class="about-photo-frame about-img-wrap">
            <?php if (file_exists('assets/img/photo.jpg') || file_exists('assets/img/photo.png')): ?>
              <img
                src="assets/img/photo<?= file_exists('assets/img/photo.jpg') ? '.jpg' : '.png' ?>"
                alt="Roukayath Gazaliou"
                loading="lazy"
              />
            <?php else: ?>
              <div class="about-photo-placeholder">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                  <circle cx="12" cy="7" r="4"/>
                </svg>
                <p>photo.jpg<br/>dans assets/img/</p>
              </div>
            <?php endif; ?>
          </div>

          <!-- Décorations -->
          <div class="about-photo-deco-line"></div>
          <div class="about-photo-deco-dot">💻</div>
        </div>

        <!-- Infos rapides -->
        <div class="about-quick-info">

          <div class="about-info-row">
            <div class="about-info-icon">📍</div>
            <div>
              <span class="about-info-label">Localisation</span>
              <span class="about-info-value">Calavi / Zogbadjè, Bénin</span>
            </div>
          </div>

          <div class="about-info-row">
            <div class="about-info-icon">🎓</div>
            <div>
              <span class="about-info-label">Formation</span>
              <span class="about-info-value">Licence SIL — 2025</span>
            </div>
          </div>

          <div class="about-info-row">
            <div class="about-info-icon">💼</div>
            <div>
              <span class="about-info-label">Expérience</span>
              <span class="about-info-value">Stage SolDigit (2024–2025)</span>
            </div>
          </div>

          <div class="about-info-row">
            <div class="about-info-icon">📧</div>
            <div>
              <span class="about-info-label">Email</span>
              <a href="mailto:Gazaliouroukayath@gmail.com" class="about-info-value" style="color:var(--accent);">
                Gazaliouroukayath@gmail.com
              </a>
            </div>
          </div>

          <div class="about-info-row">
            <div class="about-info-icon">📱</div>
            <div>
              <span class="about-info-label">Téléphone</span>
              <span class="about-info-value">(+229) 0150434710</span>
            </div>
          </div>

          <div class="about-info-row">
            <div class="about-info-icon">🌐</div>
            <div>
              <span class="about-info-label">GitHub</span>
              <a href="https://github.com/abeni229" target="_blank" rel="noopener" class="about-info-value" style="color:var(--accent);">
                github.com/abeni229
              </a>
            </div>
          </div>

          <div class="about-info-row">
            <div class="about-info-icon">✅</div>
            <div>
              <span class="about-info-label">Disponibilité</span>
              <span class="about-info-value" style="color:#16a34a;">Disponible maintenant</span>
            </div>
          </div>

        </div>

        <!-- Bouton CV -->
        <a href="assets/CV-Rouky.pdf" download class="btn-download-cv btn-ripple">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          Télécharger mon CV
        </a>

      </div><!-- /about-left -->


      <!-- ── Colonne droite : texte ── -->
      <div class="about-right">

        <div class="anim-fade-right">
          <div class="section-label">À propos de moi</div>
          <h2 class="section-title">
            Développeuse web<br/><span>passionnée & rigoureuse</span>
          </h2>
          <div class="divider"></div>
        </div>

        <p class="about-intro anim-fade-up delay-2">
          "Je conjugue maîtrise technique et esprit scientifique pour concevoir
          des solutions web robustes et centrées utilisateur."
        </p>

        <div class="anim-fade-up delay-3">
          <p class="about-text">
            Titulaire d'une <strong>Licence en Sciences Informatiques (SIL)</strong> validée
            par examen d'État en 2025, j'ai construit une expertise solide en développement
            web fullstack à travers ma formation, mon stage professionnel chez
            <strong>Sacim Digital Agency</strong> et mes projets personnels.
          </p>

          <p class="about-text">
            Ce qui me distingue ? Un profil résolument <strong>pluridisciplinaire</strong> :
            je  forge en moi une rigueur analytique rare. Je suis <strong>autonome, autodidacte</strong>
            et j'ai acquis Laravel de façon autonome directement en contexte professionnel.
          </p>

          <p class="about-text">
            De la conception de maquettes sur <strong>Figma</strong> jusqu'au déploiement
            final, j'accompagne mes projets de bout en bout. J'accorde une attention
            particulière à l'<strong>expérience utilisateur</strong> et à la qualité du code.
          </p>
        </div>

        <!-- Traits de caractère -->
        <div class="about-traits anim-cascade">

          <div class="trait-card">
       
            <div>
              <div class="trait-title">Autonomie</div>
              <div class="trait-desc">Capable d'apprendre et de livrer sans supervision constante.</div>
            </div>
          </div>

          <div class="trait-card">
            
            <div>
              <div class="trait-title">Rigueur</div>
              <div class="trait-desc">Esprit scientifique hérité de ma double formation.</div>
            </div>
          </div>

          <div class="trait-card">
            
            <div>
              <div class="trait-title">Esprit critique</div>
              <div class="trait-desc">J'analyse avant d'agir, je questionne les solutions.</div>
            </div>
          </div>

          <div class="trait-card">
          
            <div>
              <div class="trait-title">Autodidacte</div>
              <div class="trait-desc">Laravel, Figma, Git — appris par moi-même en contexte réel.</div>
            </div>
          </div>

          <div class="trait-card">
            
            <div>
              <div class="trait-title">Adaptabilité</div>
              <div class="trait-desc">Je m'intègre vite à une équipe et à ses méthodologies.</div>
            </div>
          </div>

          <div class="trait-card">
            
            <div>
              <div class="trait-title">Curiosité</div>
              <div class="trait-desc">Toujours à l'affût des nouvelles pratiques et technologies.</div>
            </div>
          </div>

        </div>

        <!-- Langues -->
        <div class="about-languages anim-fade-up">
          <h3 style="font-family:var(--font-display);font-size:var(--text-xl);color:var(--navy);margin-bottom:1.25rem;">Langues</h3>

          <div class="lang-row">
            <span class="lang-name">Français</span>
            <div class="lang-bar-wrap">
              <div class="lang-bar skill-bar" data-level="100"></div>
            </div>
            <span class="lang-level">Natif</span>
          </div>

          <div class="lang-row">
            <span class="lang-name">Anglais</span>
            <div class="lang-bar-wrap">
              <div class="lang-bar skill-bar" data-level="65"></div>
            </div>
            <span class="lang-level">Interméd.</span>
          </div>

        </div>

      </div><!-- /about-right -->

    </div><!-- /about-grid -->
  </div>
</section>


<!-- =====================================================
     VALEURS / CE QUE J'APPORTE
===================================================== -->
<section class="about-values">
  <div class="container about-values-inner">

    <div class="anim-fade-up" style="text-align:center;margin-bottom:1rem;">
      <div class="section-label" style="justify-content:center;color:var(--gold);">
        Ce que j'apporte
      </div>
      <h2 class="section-title" style="color:var(--white);text-align:center;">
        Pourquoi travailler <span style="color:var(--gold);">avec moi</span>
      </h2>
    </div>

    <div class="values-grid anim-cascade">

      <div class="value-card">
        <div class="value-number">01</div>
        <div class="value-title">Code propre & maintenable</div>
        <div class="value-desc">
          J'écris un code structuré, documenté et évolutif.
          Architecture MVC avec Laravel, séparation des responsabilités,
          conventions de nommage respectées.
        </div>
      </div>

      <div class="value-card">
        <div class="value-number">02</div>
        <div class="value-title">Design → Code</div>
        <div class="value-desc">
          Je conçois d'abord la maquette sur Figma, puis je la transforme
          fidèlement en code. Pas de friction entre design et développement.
        </div>
      </div>

      <div class="value-card">
        <div class="value-number">03</div>
        <div class="value-title">Livraison autonome</div>
        <div class="value-desc">
          De la base de données à l'interface finale, je gère l'ensemble
          du cycle de développement sans dépendance excessive.
        </div>
      </div>

    </div>
  </div>
</section>


<!-- =====================================================
     RÉALISATIONS CLÉS
===================================================== -->
<section class="about-achievements">
  <div class="container">

    <div class="anim-fade-up" style="text-align:center;">
      <div class="section-label" style="justify-content:center;">Chiffres clés</div>
      <h2 class="section-title" style="text-align:center;">
        En <span>résumé</span>
      </h2>
    </div>

    <div class="achievements-grid anim-cascade">

      <div class="achievement-card">
        <div class="achievement-num" data-count="5">0</div>
        <div class="achievement-title">Projets fullstack réalisés</div>
        <div class="achievement-desc">
          Applications web complètes : restaurant, juridique, marketplace,
          e-commerce, réservation.
        </div>
      </div>

      <div class="achievement-card">
        <div class="achievement-num" data-count="2">0</div>
        <div class="achievement-title">2 ans d'expérience professionnelle</div>
        <div class="achievement-desc">
          Stage chez Sacim Digital Agency (mars–juin 2026) avec développement en PHP,
          Laravel et Bootstrap.
        </div>
      </div>

      <div class="achievement-card">
        <div class="achievement-num" data-count="2">0</div>
        <div class="achievement-title">Licences universitaires</div>
        <div class="achievement-desc">
          Sciences Informatiques (validée 2025) et Chimie Fondamentale
          (en cours) — profil pluridisciplinaire rare.
        </div>
      </div>

    </div>
  </div>
</section>


<!-- =====================================================
     CTA
===================================================== -->
<div class="about-cta anim-fade-up">
  <div class="container">
    <div class="section-label" style="justify-content:center;">Prêt à collaborer ?</div>
    <h2 class="section-title" style="text-align:center;margin-bottom:0.75rem;">
      Travaillons <span>ensemble</span>
    </h2>
    <p style="color:var(--gray-600);font-size:var(--text-lg);margin-bottom:2rem;max-width:480px;margin-left:auto;margin-right:auto;text-align:center;">
      Disponible pour des missions freelance ou des opportunités en CDI/CDD.
    </p>
    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
      <a href="contact.php" class="btn-primary btn-ripple">Me contacter</a>
      <a href="projects.php" class="btn-outline btn-ripple">Voir mes projets</a>
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
  /* Compteurs */
  const counters = document.querySelectorAll('[data-count]');
  const obs = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const el = entry.target;
      const target = +el.dataset.count;
      let current = 0;
      const timer = setInterval(() => {
        current = Math.min(current + 1, target);
        el.textContent = current + (target > 2 ? '+' : '');
        if (current >= target) clearInterval(timer);
      }, 60);
      obs.unobserve(el);
    });
  }, { threshold: 0.5 });
  counters.forEach(c => obs.observe(c));
})();
</script>

</body>
</html>