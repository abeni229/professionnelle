<?php
session_start();
require_once 'includes/functions.php';

$pageTitle = "Blog — Roukayath Gazaliou";
$pageDesc  = "Articles sur le développement web PHP, Laravel, Figma et les retours d'expérience de Roukayath Gazaliou.";

// Catégorie filtrée
$categorieActive = isset($_GET['categorie']) ? clean($_GET['categorie']) : '';

// Récupération articles
$articles    = getArticles(0, $categorieActive);
$categories  = getCategories();
$totalArt    = count(getArticles());
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
    .blog-hero {
      background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 60%, var(--navy-light) 100%);
      padding: 10rem 0 5rem;
      position: relative;
      overflow: hidden;
    }
    .blog-hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
      background-size: 60px 60px;
    }
    .blog-hero-inner { position: relative; z-index: 1; }
    .blog-breadcrumb {
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      letter-spacing: 0.1em;
      color: rgba(255,255,255,.4);
      margin-bottom: 1.5rem;
    }
    .blog-breadcrumb a { color: rgba(255,255,255,.4); transition: var(--transition); }
    .blog-breadcrumb a:hover { color: var(--gold); }
    .blog-hero-title {
      font-family: var(--font-display);
      font-size: clamp(2.5rem, 6vw, 4rem);
      font-weight: 700;
      color: var(--white);
      line-height: 1.1;
      margin-bottom: 1rem;
    }
    .blog-hero-title span { color: var(--gold); font-style: italic; }
    .blog-hero-sub {
      font-size: var(--text-lg);
      color: rgba(255,255,255,.6);
      max-width: 520px;
      margin-bottom: 2rem;
    }

    /* Stats blog hero */
    .blog-hero-stats {
      display: flex;
      gap: 2.5rem;
      padding-top: 2rem;
      border-top: 1px solid rgba(255,255,255,.1);
    }
    .blog-stat-num {
      font-family: var(--font-display);
      font-size: var(--text-3xl);
      font-weight: 700;
      color: var(--gold);
      line-height: 1;
    }
    .blog-stat-label {
      font-size: var(--text-sm);
      color: rgba(255,255,255,.5);
      margin-top: 0.2rem;
    }

    /* ── Layout principal ── */
    .blog-main {
      padding: var(--section-py) 0;
      background: var(--off-white);
    }
    .blog-layout {
      display: grid;
      grid-template-columns: 1fr 320px;
      gap: 3.5rem;
      align-items: start;
    }

    /* ── Filtres catégories ── */
    .blog-filter-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
      margin-bottom: 2.5rem;
      flex-wrap: wrap;
    }
    .blog-filter-tabs {
      display: flex;
      gap: 0.5rem;
      flex-wrap: wrap;
    }
    .blog-filter-tab {
      padding: 0.45rem 1.1rem;
      border-radius: 50px;
      font-size: var(--text-sm);
      font-weight: 600;
      cursor: pointer;
      border: 2px solid var(--gray-200);
      color: var(--gray-600);
      background: var(--white);
      transition: var(--transition);
      text-decoration: none;
      display: inline-block;
    }
    .blog-filter-tab:hover { border-color: var(--accent); color: var(--accent); }
    .blog-filter-tab.active {
      background: var(--accent);
      border-color: var(--accent);
      color: var(--white);
      box-shadow: 0 4px 14px rgba(37,99,235,.3);
    }
    .blog-result-count {
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      color: var(--gray-400);
      letter-spacing: 0.08em;
    }

    /* ── Article card ── */
    .article-card {
      background: var(--white);
      border: 1.5px solid var(--gray-200);
      border-radius: var(--radius-xl);
      overflow: hidden;
      transition: var(--transition);
      display: flex;
      flex-direction: column;
      text-decoration: none;
      color: inherit;
    }
    .article-card:hover {
      border-color: var(--accent);
      box-shadow: var(--shadow-xl);
      transform: translateY(-5px);
    }

    /* Image article */
    .article-card-img {
      width: 100%;
      aspect-ratio: 16/9;
      object-fit: cover;
      transition: transform 0.6s cubic-bezier(0.4,0,0.2,1);
      display: block;
    }
    .article-card-img-wrap {
      overflow: hidden;
      position: relative;
    }
    .article-card:hover .article-card-img {
      transform: scale(1.05);
    }

    /* Placeholder image article */
    .article-img-placeholder {
      width: 100%;
      aspect-ratio: 16/9;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 3rem;
    }

    /* Catégorie badge sur image */
    .article-cat-badge {
      position: absolute;
      top: 1rem;
      left: 1rem;
      padding: 0.3rem 0.875rem;
      background: var(--navy);
      color: var(--white);
      border-radius: 50px;
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      font-weight: 700;
      letter-spacing: 0.06em;
      backdrop-filter: blur(8px);
    }

    /* Corps article card */
    .article-card-body {
      padding: 1.75rem;
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .article-card-meta {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 0.875rem;
    }
    .article-meta-item {
      display: flex;
      align-items: center;
      gap: 0.35rem;
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      color: var(--gray-400);
    }
    .article-card-title {
      font-family: var(--font-display);
      font-size: var(--text-xl);
      font-weight: 700;
      color: var(--navy);
      line-height: 1.3;
      margin-bottom: 0.75rem;
      transition: color var(--transition);
    }
    .article-card:hover .article-card-title {
      color: var(--accent);
    }
    .article-card-excerpt {
      font-size: var(--text-sm);
      color: var(--gray-600);
      line-height: 1.75;
      flex: 1;
      margin-bottom: 1.5rem;
    }

    /* Tags article */
    .article-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 0.4rem;
      margin-bottom: 1.25rem;
    }
    .article-tag {
      padding: 0.2rem 0.65rem;
      background: var(--gray-100);
      color: var(--gray-600);
      border-radius: 50px;
      font-size: 0.7rem;
      font-weight: 600;
      letter-spacing: 0.04em;
    }

    /* Lien lire la suite */
    .article-read-more {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      font-size: var(--text-sm);
      font-weight: 700;
      color: var(--accent);
      transition: var(--transition);
      margin-top: auto;
    }
    .article-card:hover .article-read-more {
      gap: 0.7rem;
      color: var(--navy);
    }

    /* Grille articles */
    .articles-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 2rem;
    }

    /* Article featured (premier) */
    .article-card.featured {
      grid-column: 1;
    }
    .article-card.featured .article-card-img-wrap {
      aspect-ratio: 16/8;
    }
    .article-card.featured .article-card-title {
      font-size: var(--text-2xl);
    }

    /* Message vide */
    .blog-empty {
      text-align: center;
      padding: 4rem 2rem;
      color: var(--gray-400);
    }
    .blog-empty-icon { font-size: 3rem; margin-bottom: 1rem; }
    .blog-empty-title {
      font-family: var(--font-display);
      font-size: var(--text-xl);
      color: var(--navy);
      margin-bottom: 0.5rem;
    }

    /* ── Sidebar ── */
    .blog-sidebar {
      position: sticky;
      top: 100px;
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    .sidebar-widget {
      background: var(--white);
      border: 1.5px solid var(--gray-200);
      border-radius: var(--radius-lg);
      padding: 1.75rem;
    }
    .sidebar-widget-title {
      font-family: var(--font-display);
      font-size: var(--text-lg);
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 1.25rem;
      padding-bottom: 0.875rem;
      border-bottom: 2px solid var(--gray-200);
    }

    /* Widget à propos */
    .sidebar-about {
      text-align: center;
    }
    .sidebar-avatar {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--navy), var(--navy-light));
      margin: 0 auto 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      border: 3px solid var(--accent-soft);
      overflow: hidden;
    }
    .sidebar-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: top;
    }
    .sidebar-name {
      font-weight: 700;
      font-size: var(--text-base);
      color: var(--navy);
      margin-bottom: 0.25rem;
    }
    .sidebar-role {
      font-size: var(--text-sm);
      color: var(--gray-400);
      margin-bottom: 1rem;
    }
    .sidebar-about-desc {
      font-size: var(--text-sm);
      color: var(--gray-600);
      line-height: 1.7;
      margin-bottom: 1.25rem;
    }

    /* Widget catégories */
    .sidebar-cats {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }
    .sidebar-cat-link {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0.55rem 0.75rem;
      border-radius: var(--radius-sm);
      font-size: var(--text-sm);
      font-weight: 500;
      color: var(--gray-600);
      transition: var(--transition);
      text-decoration: none;
    }
    .sidebar-cat-link:hover,
    .sidebar-cat-link.active {
      background: var(--accent-soft);
      color: var(--accent);
      padding-left: 1rem;
    }
    .sidebar-cat-count {
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      background: var(--gray-100);
      color: var(--gray-400);
      padding: 0.15rem 0.5rem;
      border-radius: 50px;
    }

    /* Widget newsletter */
    .sidebar-newsletter {
      background: var(--navy);
      border: none;
    }
    .sidebar-newsletter .sidebar-widget-title {
      color: var(--white);
      border-color: rgba(255,255,255,.1);
    }
    .sidebar-nl-desc {
      font-size: var(--text-sm);
      color: rgba(255,255,255,.6);
      line-height: 1.7;
      margin-bottom: 1.25rem;
    }
    .sidebar-nl-input {
      width: 100%;
      padding: 0.75rem 1rem;
      border: 1.5px solid rgba(255,255,255,.15);
      border-radius: var(--radius-sm);
      background: rgba(255,255,255,.08);
      color: var(--white);
      font-family: var(--font-body);
      font-size: var(--text-sm);
      margin-bottom: 0.75rem;
      transition: var(--transition);
      outline: none;
    }
    .sidebar-nl-input::placeholder { color: rgba(255,255,255,.35); }
    .sidebar-nl-input:focus {
      border-color: var(--accent);
      background: rgba(37,99,235,.1);
    }
    .sidebar-nl-btn {
      width: 100%;
      padding: 0.75rem;
      background: var(--accent);
      color: var(--white);
      border: none;
      border-radius: var(--radius-sm);
      font-family: var(--font-body);
      font-size: var(--text-sm);
      font-weight: 700;
      cursor: pointer;
      transition: var(--transition);
    }
    .sidebar-nl-btn:hover {
      background: var(--gold);
      color: var(--navy);
    }

    /* ── CTA ── */
    .blog-cta {
      padding: 5rem 0;
      text-align: center;
      background: var(--white);
      border-top: 1px solid var(--gray-200);
    }

    /* ── Responsive ── */
    @media (max-width: 1024px) {
      .blog-layout {
        grid-template-columns: 1fr;
      }
      .blog-sidebar {
        position: static;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
      }
    }
    @media (max-width: 768px) {
      .blog-sidebar { grid-template-columns: 1fr; }
      .blog-hero { padding: 8rem 0 3.5rem; }
      .blog-hero-stats { gap: 1.5rem; flex-wrap: wrap; }
    }
    @media (max-width: 480px) {
      .blog-filter-bar { flex-direction: column; align-items: flex-start; }
    }
  </style>
</head>
<body>

<?php include 'includes/nav.php'; ?>

<!-- =====================================================
     HERO
===================================================== -->
<section class="blog-hero">
  <div class="container blog-hero-inner">
    <div class="blog-breadcrumb anim-fade-up">
      <a href="index.php">Accueil</a> / Blog
    </div>
    <h1 class="blog-hero-title anim-fade-up delay-1">
      Articles &<br/><span>Retours d'expérience</span>
    </h1>
    <p class="blog-hero-sub anim-fade-up delay-2">
      Partage de connaissances sur PHP, Laravel, Figma et
      le développement web au quotidien.
    </p>
    <div class="blog-hero-stats anim-fade-up delay-3">
      <div>
        <div class="blog-stat-num"><?= $totalArt ?></div>
        <div class="blog-stat-label">Articles publiés</div>
      </div>
      <div>
        <div class="blog-stat-num"><?= count($categories) ?></div>
        <div class="blog-stat-label">Catégories</div>
      </div>
    </div>
  </div>
</section>


<!-- =====================================================
     CONTENU PRINCIPAL + SIDEBAR
===================================================== -->
<section class="blog-main">
  <div class="container">
    <div class="blog-layout">

      <!-- ── Articles ── -->
      <div>

        <!-- Barre de filtres -->
        <div class="blog-filter-bar anim-fade-up">
          <div class="blog-filter-tabs">
            <a
              href="blog.php"
              class="blog-filter-tab <?= $categorieActive === '' ? 'active' : '' ?>"
            >Tous (<?= $totalArt ?>)</a>

            <?php foreach ($categories as $cat): ?>
              <?php
                $countCat = count(getArticles(0, $cat));
              ?>
              <a
                href="blog.php?categorie=<?= urlencode($cat) ?>"
                class="blog-filter-tab <?= $categorieActive === $cat ? 'active' : '' ?>"
              ><?= e($cat) ?> (<?= $countCat ?>)</a>
            <?php endforeach; ?>
          </div>
          <span class="blog-result-count">
            <?= count($articles) ?> article<?= count($articles) > 1 ? 's' : '' ?>
            <?= $categorieActive ? 'dans "' . e($categorieActive) . '"' : '' ?>
          </span>
        </div>

        <!-- Grille articles -->
        <?php if (empty($articles)): ?>
          <div class="blog-empty anim-fade-up">
            <div class="blog-empty-icon">📝</div>
            <div class="blog-empty-title">Aucun article dans cette catégorie</div>
            <p>Revenez bientôt ou <a href="blog.php" style="color:var(--accent);font-weight:600;">voir tous les articles</a>.</p>
          </div>

        <?php else: ?>
          <div class="articles-grid anim-cascade">
            <?php foreach ($articles as $i => $art): ?>

              <?php
                $tags = array_filter(array_map('trim', explode(',', $art['tags'] ?? '')));
                $bgPlaceholders = [
                  'linear-gradient(135deg,#0f1f3d,#1a3260)',
                  'linear-gradient(135deg,#1a2e1a,#2d5a27)',
                  'linear-gradient(135deg,#1a1a0e,#3d2b00)',
                  'linear-gradient(135deg,#2d1a0e,#7a3500)',
                ];
                $bgPl = $bgPlaceholders[$i % count($bgPlaceholders)];
              ?>

              <a
                href="article.php?slug=<?= urlencode($art['slug']) ?>"
                class="article-card <?= $i === 0 ? 'featured' : '' ?>"
              >
                <!-- Image -->
                <div class="article-card-img-wrap">
                  <?php if (!empty($art['image']) && file_exists($art['image'])): ?>
                    <img
                      src="<?= e($art['image']) ?>"
                      alt="<?= e($art['titre']) ?>"
                      class="article-card-img"
                      loading="<?= $i === 0 ? 'eager' : 'lazy' ?>"
                    />
                  <?php else: ?>
                    <div
                      class="article-img-placeholder"
                      style="background:<?= $bgPl ?>;"
                    >
                      <?php
                        $emojis = ['📖','🎨','⚙️','🚀','💡'];
                        echo $emojis[$i % count($emojis)];
                      ?>
                    </div>
                  <?php endif; ?>

                  <!-- Badge catégorie -->
                  <span class="article-cat-badge"><?= e($art['categorie']) ?></span>
                </div>

                <!-- Corps -->
                <div class="article-card-body">

                  <!-- Méta -->
                  <div class="article-card-meta">
                    <span class="article-meta-item">
                      📅 <?= formatDate($art['cree_le']) ?>
                    </span>
                    <span class="article-meta-item">
                      👁 <?= number_format($art['vues']) ?> vue<?= $art['vues'] > 1 ? 's' : '' ?>
                    </span>
                  </div>

                  <!-- Titre -->
                  <h2 class="article-card-title"><?= e($art['titre']) ?></h2>

                  <!-- Extrait -->
                  <?php if (!empty($art['extrait'])): ?>
                    <p class="article-card-excerpt"><?= e(truncate($art['extrait'], 160)) ?></p>
                  <?php endif; ?>

                  <!-- Tags -->
                  <?php if (!empty($tags)): ?>
                    <div class="article-tags">
                      <?php foreach (array_slice($tags, 0, 4) as $tag): ?>
                        <span class="article-tag"><?= e($tag) ?></span>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>

                  <!-- Lire la suite -->
                  <span class="article-read-more">
                    Lire l'article
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </span>

                </div>
              </a>

            <?php endforeach; ?>
          </div>
        <?php endif; ?>

      </div>


      <!-- ── Sidebar ── -->
      <aside class="blog-sidebar">

        <!-- Widget auteure -->
        <div class="sidebar-widget sidebar-about anim-fade-right">
          <div class="sidebar-widget-title">L'auteure</div>
          <div class="sidebar-avatar">
            <?php if (file_exists('assets/img/photo.jpg') || file_exists('assets/img/photo.png')): ?>
              <img
                src="assets/img/photo<?= file_exists('assets/img/photo.jpg') ? '.jpg' : '.png' ?>"
                alt="Roukayath Gazaliou"
              />
            <?php else: ?>
              👩‍💻
            <?php endif; ?>
          </div>
          <div class="sidebar-name">Roukayath Gazaliou</div>
          <div class="sidebar-role">Développeuse Web Fullstack</div>
          <p class="sidebar-about-desc">
            Je partage mes expériences en PHP, Laravel et Figma.
            Articles basés sur des situations réelles.
          </p>
          <a href="about.php" class="btn-outline btn-ripple" style="font-size:var(--text-sm);padding:0.6rem 1.25rem;">
            En savoir plus
          </a>
        </div>

        <!-- Widget catégories -->
        <?php if (!empty($categories)): ?>
        <div class="sidebar-widget anim-fade-right delay-2">
          <div class="sidebar-widget-title">Catégories</div>
          <div class="sidebar-cats">
            <a
              href="blog.php"
              class="sidebar-cat-link <?= $categorieActive === '' ? 'active' : '' ?>"
            >
              Tous les articles
              <span class="sidebar-cat-count"><?= $totalArt ?></span>
            </a>
            <?php foreach ($categories as $cat): ?>
              <a
                href="blog.php?categorie=<?= urlencode($cat) ?>"
                class="sidebar-cat-link <?= $categorieActive === $cat ? 'active' : '' ?>"
              >
                <?= e($cat) ?>
                <span class="sidebar-cat-count"><?= count(getArticles(0, $cat)) ?></span>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

        <!-- Widget newsletter -->
        <div class="sidebar-widget sidebar-newsletter anim-fade-right delay-3">
          <div class="sidebar-widget-title">Restez informé</div>
          <p class="sidebar-nl-desc">
            Recevez les nouveaux articles directement dans votre boîte mail.
          </p>
          <input
            type="email"
            class="sidebar-nl-input"
            placeholder="votre@email.com"
            id="nlEmail"
          />
          <button class="sidebar-nl-btn" onclick="subscribeNewsletter()">
            S'abonner →
          </button>
        </div>

        <!-- Widget contact rapide -->
        <div class="sidebar-widget anim-fade-right delay-4" style="text-align:center;">
          <div class="sidebar-widget-title">Un projet ?</div>
          <p style="font-size:var(--text-sm);color:var(--gray-600);line-height:1.7;margin-bottom:1.25rem;">
            Disponible pour des missions freelance et opportunités professionnelles.
          </p>
          <a href="contact.php" class="btn-primary btn-ripple" style="font-size:var(--text-sm);padding:0.65rem 1.5rem;width:100%;justify-content:center;">
            Me contacter
          </a>
        </div>

      </aside>

    </div>
  </div>
</section>


<!-- =====================================================
     CTA
===================================================== -->
<div class="blog-cta anim-fade-up">
  <div class="container">
    <div class="section-label" style="justify-content:center;">Collaborons</div>
    <h2 class="section-title" style="text-align:center;margin-bottom:0.75rem;">
      Vous avez un <span>projet web</span> ?
    </h2>
    <p style="color:var(--gray-600);font-size:var(--text-lg);margin-bottom:2rem;max-width:460px;margin-left:auto;margin-right:auto;text-align:center;">
      Je transforme vos idées en applications web solides et bien conçues.
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
        <a href="mailto:Gazaliouroukayath@gmail.com" class="social-link" aria-label="Email">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        </a>
      </div>
    </div>
  </div>
</footer>


<script>
function subscribeNewsletter() {
  const email = document.getElementById('nlEmail').value.trim();
  if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    document.getElementById('nlEmail').style.borderColor = '#ef4444';
    return;
  }
  document.getElementById('nlEmail').style.borderColor = '#16a34a';
  document.querySelector('.sidebar-nl-btn').textContent = '✅ Inscrit !';
  document.getElementById('nlEmail').value = '';
  setTimeout(() => {
    document.querySelector('.sidebar-nl-btn').textContent = "S'abonner →";
    document.getElementById('nlEmail').style.borderColor = '';
  }, 3000);
}
</script>

</body>
</html>