<?php
session_start();
require_once 'includes/functions.php';

// Récupération du slug
$slug = isset($_GET['slug']) ? clean($_GET['slug']) : '';

if (empty($slug)) {
  header('Location: blog.php');
  exit;
}

// Récupération de l'article
$article = getArticleBySlug($slug);

if (!$article) {
  header('HTTP/1.0 404 Not Found');
  $pageTitle = "Article non trouvé — Roukayath Gazaliou";
  $pageDesc  = "L'article que vous recherchez n'existe pas ou a été supprimé.";
} else {
  // Incrémenter les vues
  incrementVues($article['id']);
  
  $pageTitle = $article['titre'] . " — Roukayath Gazaliou";
  $pageDesc  = $article['extrait'];
}
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
    .article-hero {
      background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 60%, var(--navy-light) 100%);
      padding: 8rem 0 4rem;
      position: relative;
      overflow: hidden;
    }
    .article-hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
      background-size: 60px 60px;
    }
    .article-hero-inner { position: relative; z-index: 1; }
    
    .article-breadcrumb {
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      letter-spacing: 0.1em;
      color: rgba(255,255,255,.4);
      margin-bottom: 1.5rem;
    }
    .article-breadcrumb a { color: rgba(255,255,255,.4); transition: var(--transition); }
    .article-breadcrumb a:hover { color: var(--gold); }
    
    .article-hero-title {
      font-family: var(--font-display);
      font-size: clamp(2rem, 5vw, 3.5rem);
      font-weight: 700;
      color: var(--white);
      line-height: 1.2;
      margin-bottom: 1.5rem;
      max-width: 800px;
    }
    
    .article-hero-meta {
      display: flex;
      align-items: center;
      gap: 2rem;
      flex-wrap: wrap;
      padding-top: 1.5rem;
      border-top: 1px solid rgba(255,255,255,.1);
    }
    .article-hero-meta-item {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: var(--text-sm);
      color: rgba(255,255,255,.6);
    }
    .article-hero-meta-item strong {
      color: var(--gold);
      font-weight: 700;
    }
    
    .article-cat-badge-hero {
      display: inline-block;
      padding: 0.35rem 0.95rem;
      background: rgba(201,168,76,.2);
      color: var(--gold);
      border-radius: 50px;
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    /* ── Contenu principal ── */
    .article-main {
      padding: 5rem 0;
      background: var(--white);
    }
    
    .article-layout {
      display: grid;
      grid-template-columns: 1fr 280px;
      gap: 3rem;
      max-width: 1100px;
      margin: 0 auto;
    }

    /* ── Contenu article ── */
    .article-content {
      font-size: var(--text-base);
      line-height: 2;
      color: var(--gray-700);
    }
    
    .article-content h2 {
      font-family: var(--font-display);
      font-size: var(--text-2xl);
      font-weight: 700;
      color: var(--navy);
      margin: 2.5rem 0 1.25rem;
      line-height: 1.3;
    }
    
    .article-content h3 {
      font-family: var(--font-display);
      font-size: var(--text-xl);
      font-weight: 700;
      color: var(--navy);
      margin: 2rem 0 1rem;
    }
    
    .article-content p {
      margin-bottom: 1.5rem;
    }
    
    .article-content ul,
    .article-content ol {
      margin: 1.5rem 0 1.5rem 2rem;
    }
    
    .article-content li {
      margin-bottom: 0.75rem;
    }
    
    .article-content strong {
      font-weight: 700;
      color: var(--navy);
    }
    
    .article-content em {
      font-style: italic;
      color: var(--gray-700);
    }
    
    .article-content a {
      color: var(--accent);
      text-decoration: underline;
      transition: var(--transition);
    }
    
    .article-content a:hover {
      color: var(--gold);
    }
    
    .article-content blockquote {
      margin: 2rem 0;
      padding: 1.5rem;
      border-left: 4px solid var(--accent);
      background: var(--off-white);
      border-radius: var(--radius-sm);
      font-style: italic;
      color: var(--gray-600);
    }
    
    .article-content code {
      background: var(--off-white);
      padding: 0.2rem 0.5rem;
      border-radius: 3px;
      font-family: var(--font-mono);
      font-size: 0.95em;
      color: var(--accent);
    }
    
    .article-content pre {
      background: var(--navy);
      color: var(--white);
      padding: 1.5rem;
      border-radius: var(--radius-md);
      overflow-x: auto;
      margin: 1.5rem 0;
      font-family: var(--font-mono);
      font-size: 0.9rem;
      line-height: 1.5;
    }
    
    .article-content pre code {
      background: none;
      padding: 0;
      color: inherit;
    }
    
    .article-content img {
      max-width: 100%;
      height: auto;
      border-radius: var(--radius-lg);
      margin: 2rem 0;
      box-shadow: var(--shadow-md);
    }

    /* ── Image hero article ── */
    .article-hero-img {
      width: 100%;
      max-height: 450px;
      object-fit: cover;
      border-radius: var(--radius-lg);
      margin: 3rem 0 2rem;
      box-shadow: var(--shadow-xl);
    }

    /* ── Tags ── */
    .article-tags-full {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      margin: 2rem 0;
      padding-top: 2rem;
      border-top: 1px solid var(--gray-200);
    }
    
    .article-tag-full {
      display: inline-block;
      padding: 0.35rem 0.875rem;
      background: var(--accent-soft);
      color: var(--accent);
      border-radius: 50px;
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      font-weight: 700;
      letter-spacing: 0.04em;
    }

    /* ── Partage ── */
    .article-share {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-top: 2rem;
      padding-top: 2rem;
      border-top: 1px solid var(--gray-200);
    }
    
    .article-share-label {
      font-weight: 700;
      color: var(--navy);
      font-size: var(--text-sm);
    }
    
    .article-share-btn {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: var(--gray-100);
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--gray-600);
      transition: var(--transition);
    }
    
    .article-share-btn:hover {
      background: var(--accent);
      color: var(--white);
      transform: translateY(-3px);
    }

    /* ── Sidebar ── */
    .article-sidebar {
      position: sticky;
      top: 100px;
      height: fit-content;
    }

    .sidebar-widget-article {
      background: var(--off-white);
      border: 1.5px solid var(--gray-200);
      border-radius: var(--radius-lg);
      padding: 1.5rem;
    }

    .sidebar-widget-article h3 {
      font-family: var(--font-display);
      font-size: var(--text-lg);
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 1rem;
      padding-bottom: 0.75rem;
      border-bottom: 2px solid var(--gray-200);
    }

    .article-toc {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .article-toc-link {
      font-size: var(--text-sm);
      color: var(--gray-600);
      text-decoration: none;
      padding: 0.4rem 0.6rem;
      border-left: 2px solid transparent;
      transition: var(--transition);
    }

    .article-toc-link:hover {
      color: var(--accent);
      border-left-color: var(--accent);
      padding-left: 0.9rem;
    }

    .article-info {
      font-size: var(--text-sm);
      color: var(--gray-600);
      line-height: 1.8;
    }

    .article-info strong {
      color: var(--navy);
    }

    /* ── CTA Suivant ── */
    .article-nav {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
      margin-top: 4rem;
      padding-top: 3rem;
      border-top: 2px solid var(--gray-200);
    }

    .article-nav-item {
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
      padding: 1.5rem;
      background: var(--off-white);
      border-radius: var(--radius-lg);
      text-decoration: none;
      color: inherit;
      transition: var(--transition);
    }

    .article-nav-item:hover {
      transform: translateX(4px);
      background: var(--accent-soft);
    }

    .article-nav-label {
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      color: var(--gray-400);
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .article-nav-title {
      font-family: var(--font-display);
      font-weight: 700;
      font-size: var(--text-base);
      color: var(--navy);
    }

    /* ── Responsive ── */
    @media (max-width: 1024px) {
      .article-layout {
        grid-template-columns: 1fr;
      }
      .article-sidebar {
        position: static;
      }
    }
    
    @media (max-width: 768px) {
      .article-hero {
        padding: 6rem 0 2rem;
      }
      .article-hero-title {
        font-size: clamp(1.5rem, 4vw, 2.5rem);
      }
      .article-nav {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

<?php include 'includes/nav.php'; ?>

<?php if (!$article): ?>
  <!-- Erreur 404 -->
  <section class="article-hero">
    <div class="container article-hero-inner" style="text-align:center;padding:10rem 2rem;">
      <div style="font-size:4rem;margin-bottom:1rem;">🔍</div>
      <h1 style="color:var(--white);font-family:var(--font-display);font-size:2.5rem;margin-bottom:1rem;">
        Article non trouvé
      </h1>
      <p style="color:rgba(255,255,255,.6);font-size:var(--text-lg);margin-bottom:2rem;">
        L'article que vous recherchez n'existe pas ou a été supprimé.
      </p>
      <a href="blog.php" class="btn-primary btn-ripple">Retour au blog</a>
    </div>
  </section>

<?php else: ?>

  <!-- =====================================================
       HERO ARTICLE
  ===================================================== -->
  <section class="article-hero">
    <div class="container article-hero-inner">
      <div class="article-breadcrumb anim-fade-up">
        <a href="index.php">Accueil</a> / 
        <a href="blog.php">Blog</a> / 
        <span><?= e($article['titre']) ?></span>
      </div>
      
      <h1 class="article-hero-title anim-fade-up delay-1">
        <?= e($article['titre']) ?>
      </h1>

      <div class="article-hero-meta anim-fade-up delay-2">
        <span class="article-cat-badge-hero"><?= e($article['categorie']) ?></span>
        <div class="article-hero-meta-item">
          📅 <strong><?= formatDate($article['cree_le']) ?></strong>
        </div>
        <div class="article-hero-meta-item">
          👁 <strong><?= number_format($article['vues']) ?></strong> vue<?= $article['vues'] > 1 ? 's' : '' ?>
        </div>
      </div>
    </div>
  </section>

  <!-- =====================================================
       CONTENU ARTICLE
  ===================================================== -->
  <section class="article-main">
    <div class="container">
      <div class="article-layout">

        <!-- Contenu principal -->
        <main>

          <!-- Image hero (si existe) -->
          <?php if (!empty($article['image']) && file_exists($article['image'])): ?>
            <img
              src="<?= e($article['image']) ?>"
              alt="<?= e($article['titre']) ?>"
              class="article-hero-img"
              loading="eager"
            />
          <?php endif; ?>

          <!-- Corps article -->
          <div class="article-content anim-fade-up">
            <?= $article['contenu'] ?>
          </div>

          <!-- Tags -->
          <?php
            $tags = array_filter(array_map('trim', explode(',', $article['tags'] ?? '')));
          ?>
          <?php if (!empty($tags)): ?>
            <div class="article-tags-full">
              <?php foreach ($tags as $tag): ?>
                <span class="article-tag-full"><?= e($tag) ?></span>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <!-- Partage -->
          <div class="article-share">
            <span class="article-share-label">Partager :</span>
            <button class="article-share-btn" onclick="navigator.share({title:'<?= e($article['titre']) ?>',url:window.location.href})" title="Partager">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
            </button>
            <a href="https://twitter.com/intent/tweet?text=<?= urlencode($article['titre']) ?>&url=<?= urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>" class="article-share-btn" target="_blank" rel="noopener" title="Partager sur Twitter">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2s9 5 20 5a9.5 9.5 0 00-9-5.5c4.75 2.25 7-7 7-7a10.6 10.6 0 01-3 1"/></svg>
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>" class="article-share-btn" target="_blank" rel="noopener" title="Partager sur LinkedIn">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
            </a>
          </div>

          <!-- Navigation articles -->
          <div class="article-nav">
            <a href="blog.php" class="article-nav-item">
              <span class="article-nav-label">← Retour</span>
              <span class="article-nav-title">Tous les articles</span>
            </a>
            <a href="contact.php" class="article-nav-item">
              <span class="article-nav-label">Contact →</span>
              <span class="article-nav-title">Me poser une question</span>
            </a>
          </div>

        </main>

        <!-- Sidebar -->
        <aside class="article-sidebar anim-fade-right">

          <!-- Info article -->
          <div class="sidebar-widget-article">
            <h3>À propos</h3>
            <div class="article-info">
              <p>
                <strong>Catégorie :</strong><br/>
                <?= e($article['categorie']) ?>
              </p>
              <p style="margin-top:1rem;">
                <strong>Publié :</strong><br/>
                <?= formatDate($article['cree_le']) ?>
              </p>
              <p style="margin-top:1rem;">
                <strong>Vues :</strong><br/>
                <?= number_format($article['vues']) ?>
              </p>
            </div>
          </div>

          <!-- Auteure -->
          <div class="sidebar-widget-article">
            <h3>L'auteure</h3>
            <div style="text-align:center;">
              <div style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,var(--navy),var(--navy-light));margin:0 auto 1rem;display:flex;align-items:center;justify-content:center;font-size:2rem;border:3px solid var(--accent-soft);overflow:hidden;">
                <?php if (file_exists('assets/img/photo.jpg') || file_exists('assets/img/photo.png')): ?>
                  <img
                    src="assets/img/photo<?= file_exists('assets/img/photo.jpg') ? '.jpg' : '.png' ?>"
                    alt="Roukayath Gazaliou"
                    style="width:100%;height:100%;object-fit:cover;object-position:top;"
                  />
                <?php else: ?>
                  👩‍💻
                <?php endif; ?>
              </div>
              <div style="font-weight:700;font-size:var(--text-base);color:var(--navy);margin-bottom:0.25rem;">
                Roukayath Gazaliou
              </div>
              <div style="font-size:var(--text-sm);color:var(--gray-400);margin-bottom:1rem;">
                Développeuse Fullstack
              </div>
              <p style="font-size:var(--text-sm);color:var(--gray-600);line-height:1.7;margin-bottom:1rem;">
                Je partage mes expériences en développement web, avec un focus sur PHP, Laravel et Figma.
              </p>
              <a href="about.php" class="btn-outline btn-ripple" style="font-size:var(--text-sm);padding:0.6rem 1.25rem;">
                En savoir plus
              </a>
            </div>
          </div>

          <!-- CTA -->
          <div class="sidebar-widget-article" style="background:var(--navy);border:none;">
            <h3 style="color:var(--white);border-color:rgba(255,255,255,.1);">
              Discutons
            </h3>
            <p style="font-size:var(--text-sm);color:rgba(255,255,255,.6);line-height:1.7;margin-bottom:1.25rem;">
              Vous avez une question sur cet article ou d'autres sujets de développement ?
            </p>
            <a href="contact.php" class="btn-primary btn-ripple" style="width:100%;text-align:center;display:block;">
              Contactez-moi
            </a>
          </div>

        </aside>

      </div>
    </div>
  </section>

<?php endif; ?>

<!-- =====================================================
     FOOTER
===================================================== -->
<footer class="footer">
  <div class="container">
    <div class="footer-inner">
      <div>
        <div class="footer-brand">Roukayath<span>.</span></div>
        <p class="footer-tagline">Développeuse web fullstack · Cotonou, Bénin<br/>PHP · Laravel · JavaScript · React · Figma</p>
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

</body>
</html>
