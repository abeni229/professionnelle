<?php
$pageTitle = "Roukayath Gazaliou — Développeuse Web Fullstack";
$pageDesc  = "Portfolio de Gazaliou Roukayath, développeuse web fullstack PHP & Laravel basée à Cotonou, Bénin.";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="<?= $pageDesc ?>"/>
  <title><?= $pageTitle ?></title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet" />

  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/animations.css" />

  <style>
    /* ── Styles spécifiques Hero ── */

    /* Particules décoratives */
    .hero-particles {
      position: absolute;
      inset: 0;
      overflow: hidden;
      pointer-events: none;
      z-index: 0;
    }

    .particle {
      position: absolute;
      border-radius: 50%;
      background: rgba(255,255,255,.06);
      animation: float var(--dur, 6s) ease-in-out var(--delay, 0s) infinite;
    }

    /* Ligne décorative dorée sous le nom */
    .hero-name-line {
      display: block;
      width: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--gold), transparent);
      border-radius: 2px;
      margin-top: 0.4rem;
      animation: lineExpand 1s ease 1.2s forwards;
    }

    /* Tags tech stack hero */
    .hero-tech-stack {
      display: flex;
      flex-wrap: wrap;
      gap: 0.6rem;
      margin-bottom: 2rem;
      animation: fadeInUp 0.7s ease 0.75s both;
    }

    .hero-tech-tag {
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
      padding: 0.3rem 0.85rem;
      background: rgba(255,255,255,.07);
      border: 1px solid rgba(255,255,255,.14);
      border-radius: 50px;
      font-family: var(--font-mono);
      font-size: 0.7rem;
      letter-spacing: 0.06em;
      color: rgba(255,255,255,.75);
      backdrop-filter: blur(6px);
      transition: var(--transition);
    }

    .hero-tech-tag:hover {
      background: rgba(37,99,235,.25);
      border-color: rgba(37,99,235,.5);
      color: var(--white);
    }

    .hero-tech-tag .dot {
      width: 5px;
      height: 5px;
      border-radius: 50%;
      background: var(--gold);
      flex-shrink: 0;
    }

    /* Photo placeholder (avant upload) */
    .hero-photo-placeholder {
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, var(--navy-mid), var(--navy-light));
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 1rem;
      color: rgba(255,255,255,.4);
    }

    .hero-photo-placeholder svg {
      width: 80px;
      height: 80px;
      opacity: .4;
    }

    .hero-photo-placeholder p {
      font-size: 0.75rem;
      font-family: var(--font-mono);
      letter-spacing: 0.08em;
      text-align: center;
    }

    /* Section aperçu projets (teaser) */
    .hero-preview {
      padding: 5rem 0;
      background: var(--off-white);
      position: relative;
      overflow: hidden;
    }

    .hero-preview::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, var(--accent), transparent);
    }

    .preview-header {
      text-align: center;
      margin-bottom: 3rem;
    }

    .preview-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
    }

    @media (max-width: 900px) {
      .preview-grid { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 580px) {
      .preview-grid { grid-template-columns: 1fr; }
    }

    .preview-card {
      position: relative;
      border-radius: var(--radius-md);
      overflow: hidden;
      aspect-ratio: 16/9;
      background: var(--gray-200);
      cursor: pointer;
      group: true;
    }

    .preview-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .preview-card:hover img {
      transform: scale(1.06);
    }

    .preview-card-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, rgba(15,31,61,.85) 0%, transparent 55%);
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 1.25rem;
      opacity: 0;
      transition: opacity 0.35s ease;
    }

    .preview-card:hover .preview-card-overlay {
      opacity: 1;
    }

    .preview-card-name {
      font-family: var(--font-display);
      font-size: var(--text-lg);
      font-weight: 700;
      color: var(--white);
    }

    .preview-card-tech {
      font-size: var(--text-xs);
      color: var(--gold);
      font-family: var(--font-mono);
      letter-spacing: 0.06em;
      margin-top: 0.2rem;
    }

    /* Section CTA bas de hero */
    .hero-cta-band {
      background: var(--navy);
      padding: 4rem 0;
      text-align: center;
    }

    .hero-cta-band h2 {
      font-family: var(--font-display);
      font-size: clamp(1.5rem, 4vw, 2.5rem);
      color: var(--white);
      margin-bottom: 0.75rem;
    }

    .hero-cta-band h2 span {
      color: var(--gold);
      font-style: italic;
    }

    .hero-cta-band p {
      color: rgba(255,255,255,.55);
      font-size: var(--text-lg);
      margin-bottom: 2rem;
    }

    .hero-cta-band .btn-primary {
      font-size: var(--text-lg);
      padding: 1rem 2.5rem;
    }
  </style>
</head>
<body>

<?php include 'includes/nav.php'; ?>

<!-- =====================================================
     HERO SECTION
===================================================== -->
<section class="hero" id="hero">

  <!-- Fond décoratif -->
  <div class="hero-grid"></div>

  <!-- Particules -->
  <div class="hero-particles" id="heroParticles"></div>

  <div class="hero-inner container">

    <!-- ── Contenu texte ── -->
    <div class="hero-content">


      <!-- Titre -->
      <h1 class="hero-title">
        Bonjour, je suis
        <span class="hero-title-name">Roukayath<em class="hero-name-line"></em></span>
      </h1>

      <!-- Typing effect -->
      <p class="hero-subtitle">
        <span id="typingText"></span><span class="typing-cursor"></span>
      </p>

      <!-- Stack tech -->
      <div class="hero-tech-stack">
        <span class="hero-tech-tag"><span class="dot"></span>PHP</span>
        <span class="hero-tech-tag"><span class="dot"></span>Laravel</span>
        <span class="hero-tech-tag"><span class="dot"></span>JavaScript</span>
        <span class="hero-tech-tag"><span class="dot"></span>React</span>
        <span class="hero-tech-tag"><span class="dot"></span>MySQL</span>
        <span class="hero-tech-tag"><span class="dot"></span>Figma</span>
        <span class="hero-tech-tag"><span class="dot"></span>Bootstrap</span>
      </div>

      <!-- Description -->
      <p class="hero-description">
        Développeuse web fullstack passionnée, formée en Sciences Informatiques
        au Bénin. Je conçois des interfaces soignées et des backends robustes,
        du design Figma jusqu'au déploiement.
      </p>

      <!-- Boutons CTA -->
      <div class="hero-actions">
        <a href="projects.php" class="btn-primary btn-ripple">
          Voir mes projets
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
        <a href="contact.php" class="btn-secondary btn-ripple">
          Me contacter
        </a>
      </div>

      <!-- Stats rapides -->
      <div class="hero-stats">
        <div>
          <div class="hero-stat-number" data-count="5">0</div>
          <div class="hero-stat-label">Projets réalisés</div>
        </div>
        <div>
          <div class="hero-stat-number" data-count="2">0</div>
          <div class="hero-stat-label">An d'expérience</div>
        </div>
        <div>
          <div class="hero-stat-number" data-count="7">0</div>
          <div class="hero-stat-label">Technologies</div>
        </div>
      </div>

    </div><!-- /hero-content -->

    <!-- ── Photo ── -->
    <div class="hero-visual">
      <div class="hero-photo-deco"></div>
      <div class="hero-photo-wrap">

       

        <!-- Photo principale -->
        <div class="hero-photo-frame">
          <?php if (file_exists('assets/img/photo.jpg') || file_exists('assets/img/photo.png')): ?>
            <img
              src="assets/img/photo<?= file_exists('assets/img/photo.jpg') ? '.jpg' : '.png' ?>"
              alt="Photo de Roukayath Gazaliou"
              loading="eager"
            />
          <?php else: ?>
            <div class="hero-photo-placeholder">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
              <p>Ajouter photo.jpg<br/>dans assets/img/</p>
            </div>
          <?php endif; ?>
        </div>

       

      </div>
    </div><!-- /hero-visual -->

  </div><!-- /hero-inner -->

  <!-- Scroll indicator -->
  <div class="hero-scroll">
    <div class="hero-scroll-line"></div>
    <span>DÉFILER</span>
  </div>

</section>


<!-- =====================================================
     APERÇU PROJETS (teaser)
===================================================== -->
<section class="hero-preview">
  <div class="container">

    <div class="preview-header anim-fade-up">
      <div class="section-label">Réalisations</div>
      <h2 class="section-title">Quelques projets <span>récents</span></h2>
      <p class="section-subtitle" style="margin: 0 auto;">
        Des applications web conçues de A à Z — du design Figma au code final.
      </p>
    </div>

    <div class="preview-grid anim-cascade">

      <!-- Projet 1 — Restaurant -->
      <a href="projects.php#restaurant" class="preview-card">
        <?php if (file_exists('assets/img/restaurant.jpg')): ?>
          <img src="assets/img/restaurant.jpg" alt="Délices du Bénin" />
        <?php else: ?>
          <div style="width:100%;height:100%;background:linear-gradient(135deg,#1a1a0e,#3d2b00);display:flex;align-items:center;justify-content:center;font-size:2.5rem;">🍽️</div>
        <?php endif; ?>
        <div class="preview-card-overlay">
          <div class="preview-card-name">Délices du Bénin</div>
          <div class="preview-card-tech">Laravel · MySQL · Figma</div>
        </div>
      </a>

      <!-- Projet 2 — RoukLegal -->
      <a href="projects.php#rouklegal" class="preview-card">
        <?php if (file_exists('assets/img/rouklegal.jpg')): ?>
          <img src="assets/img/rouklegal.jpg" alt="RoukLegal" />
        <?php else: ?>
          <div style="width:100%;height:100%;background:linear-gradient(135deg,#f5f0e8,#c4a882);display:flex;align-items:center;justify-content:center;font-size:2.5rem;">⚖️</div>
        <?php endif; ?>
        <div class="preview-card-overlay">
          <div class="preview-card-name">RoukLegal</div>
          <div class="preview-card-tech">Laravel · Bootstrap · JS</div>
        </div>
      </a>

      <!-- Projet 3 — PME Bénin -->
      <a href="projects.php#pmebenin" class="preview-card">
        <?php if (file_exists('assets/img/pmebenin.jpg')): ?>
          <img src="assets/img/pmebenin.jpg" alt="PME Bénin" />
        <?php else: ?>
          <div style="width:100%;height:100%;background:linear-gradient(135deg,#1a2e1a,#2d5a27);display:flex;align-items:center;justify-content:center;font-size:2.5rem;">🌿</div>
        <?php endif; ?>
        <div class="preview-card-overlay">
          <div class="preview-card-name">PME Bénin</div>
          <div class="preview-card-tech">Laravel · MySQL · Figma</div>
        </div>
      </a>

      <!-- Projet 4 — ViteCom -->
      <a href="projects.php#vitecom" class="preview-card">
        <?php if (file_exists('assets/img/vitecom.jpg')): ?>
          <img src="assets/img/vitecom.jpg" alt="ViteCom" />
        <?php else: ?>
          <div style="width:100%;height:100%;background:linear-gradient(135deg,#fff8f0,#e8a87c);display:flex;align-items:center;justify-content:center;font-size:2.5rem;">🛍️</div>
        <?php endif; ?>
        <div class="preview-card-overlay">
          <div class="preview-card-name">ViteCom</div>
          <div class="preview-card-tech">PHP · JS · Bootstrap</div>
        </div>
      </a>

      <!-- Projet 5 — BookEase -->
      <a href="projects.php#bookease" class="preview-card">
        <?php if (file_exists('assets/img/bookease.jpg')): ?>
          <img src="assets/img/bookease.jpg" alt="BookEase" />
        <?php else: ?>
          <div style="width:100%;height:100%;background:linear-gradient(135deg,#0f1f3d,#1a4fa8);display:flex;align-items:center;justify-content:center;font-size:2.5rem;">📅</div>
        <?php endif; ?>
        <div class="preview-card-overlay">
          <div class="preview-card-name">BookEase</div>
          <div class="preview-card-tech">Laravel · MySQL · JS</div>
        </div>
      </a>

      <!-- Card "Voir tous" -->
      <a href="projects.php" class="preview-card" style="background:var(--navy);display:flex;align-items:center;justify-content:center;flex-direction:column;gap:1rem;color:var(--white);text-decoration:none;">
        <div style="font-size:2rem;">→</div>
        <div style="font-family:var(--font-display);font-size:var(--text-lg);font-weight:700;">Voir tous<br/>les projets</div>
      </a>

    </div><!-- /preview-grid -->

  </div>
</section>


<!-- =====================================================
     BANDE CTA
===================================================== -->
<div class="hero-cta-band anim-fade-up">
  <div class="container">
    <h2>Vous avez un projet en tête ?<br/><span>Parlons-en.</span></h2>
    <p>Je suis disponible pour des missions freelance ou des opportunités en CDI/CDD.</p>
    <a href="contact.php" class="btn-primary btn-ripple" style="font-size:1.1rem;padding:1rem 2.5rem;">
      Démarrer une conversation
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
    </a>
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
        <p class="footer-tagline">
          Développeuse web fullstack basée à Cotonou, Bénin.<br/>
          PHP · Laravel · JavaScript · React · Figma
        </p>
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
          <li><a href="tel:+22901504347100">(+229) 0150434710</a></li>
          <li><a href="https://github.com/abeni229" target="_blank" rel="noopener">GitHub</a></li>
          <li><a href="contact.php">Formulaire de contact</a></li>
        </ul>
      </div>

    </div><!-- /footer-inner -->

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
     SCRIPTS PAGE
===================================================== -->
<script>
(function () {

  /* ── 1. TYPING EFFECT ── */
  const typingEl = document.getElementById('typingText');
  const phrases  = [
    'Développeuse Web Fullstack',
    'PHP & Laravel Developer',
    'UI/UX avec Figma',
    'Passionnée par le code',
    'Basée à Cotonou, Bénin',
  ];
  let phraseIdx = 0, charIdx = 0, isDeleting = false;

  function type() {
    const current = phrases[phraseIdx];

    if (!isDeleting) {
      typingEl.textContent = current.slice(0, ++charIdx);
      if (charIdx === current.length) {
        isDeleting = true;
        setTimeout(type, 1800);
        return;
      }
    } else {
      typingEl.textContent = current.slice(0, --charIdx);
      if (charIdx === 0) {
        isDeleting = false;
        phraseIdx  = (phraseIdx + 1) % phrases.length;
      }
    }
    setTimeout(type, isDeleting ? 55 : 90);
  }

  // Démarrer après l'animation hero
  setTimeout(type, 1200);


  /* ── 2. COMPTEUR STATS ── */
  const counters = document.querySelectorAll('[data-count]');

  const countObs = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const el    = entry.target;
      const target = +el.dataset.count;
      let current  = 0;
      const step   = Math.ceil(target / 30);
      const timer  = setInterval(() => {
        current = Math.min(current + step, target);
        el.textContent = current + (target > 9 ? '+' : '');
        if (current >= target) clearInterval(timer);
      }, 40);
      countObs.unobserve(el);
    });
  }, { threshold: 0.5 });

  counters.forEach(c => countObs.observe(c));


  /* ── 3. PARTICULES HERO ── */
  const container = document.getElementById('heroParticles');
  if (container) {
    for (let i = 0; i < 18; i++) {
      const p = document.createElement('div');
      p.classList.add('particle');
      const size  = Math.random() * 60 + 20;
      p.style.cssText = `
        width:${size}px;
        height:${size}px;
        top:${Math.random() * 100}%;
        left:${Math.random() * 100}%;
        --dur:${(Math.random() * 6 + 5).toFixed(1)}s;
        --delay:-${(Math.random() * 6).toFixed(1)}s;
        opacity:${(Math.random() * 0.06 + 0.02).toFixed(2)};
      `;
      container.appendChild(p);
    }
  }

})();
</script>

</body>
</html>