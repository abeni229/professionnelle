<?php
session_start();
require_once 'includes/functions.php';

$pageTitle = "Contact — Roukayath Gazaliou";
$pageDesc  = "Contactez Roukayath Gazaliou, développeuse web fullstack PHP & Laravel basée à Cotonou, Bénin.";

// ── Traitement formulaire (POST AJAX) ──
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
  header('Content-Type: application/json');

  // Vérification CSRF
  $token = $_POST['csrf_token'] ?? '';
  if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
    echo json_encode(['success' => false, 'message' => 'Requête invalide.']);
    exit;
  }
  unset($_SESSION['csrf_token']);

  // Récupération & validation
  $nom     = trim($_POST['nom']     ?? '');
  $email   = trim($_POST['email']   ?? '');
  $sujet   = trim($_POST['sujet']   ?? '');
  $message = trim($_POST['message'] ?? '');
  $errors  = [];

  if (mb_strlen($nom) < 2)             $errors[] = 'Le nom doit contenir au moins 2 caractères.';
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Adresse email invalide.';
  if (mb_strlen($sujet) < 3)           $errors[] = 'Le sujet est trop court.';
  if (mb_strlen($message) < 10)        $errors[] = 'Le message doit contenir au moins 10 caractères.';

  if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
  }

  $saved = saveContact($nom, $email, $sujet, $message);

  if ($saved) {
    echo json_encode([
      'success' => true,
      'message' => 'Message envoyé avec succès ! Je vous répondrai dans les plus brefs délais.'
    ]);
  } else {
    echo json_encode([
      'success' => false,
      'message' => 'Une erreur est survenue. Veuillez réessayer ou me contacter directement par email.'
    ]);
  }
  exit;
}

// Générer token CSRF
$csrf = csrfToken();
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
    .contact-hero {
      background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 60%, var(--navy-light) 100%);
      padding: 10rem 0 5rem;
      position: relative;
      overflow: hidden;
    }
    .contact-hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
      background-size: 60px 60px;
    }
    .contact-hero-inner { position: relative; z-index: 1; }
    .contact-breadcrumb {
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      letter-spacing: 0.1em;
      color: rgba(255,255,255,.4);
      margin-bottom: 1.5rem;
    }
    .contact-breadcrumb a { color: rgba(255,255,255,.4); transition: var(--transition); }
    .contact-breadcrumb a:hover { color: var(--gold); }
    .contact-hero-title {
      font-family: var(--font-display);
      font-size: clamp(2.5rem, 6vw, 4rem);
      font-weight: 700;
      color: var(--white);
      line-height: 1.1;
      margin-bottom: 1rem;
    }
    .contact-hero-title span { color: var(--gold); font-style: italic; }
    .contact-hero-sub {
      font-size: var(--text-lg);
      color: rgba(255,255,255,.6);
      max-width: 520px;
    }

    /* ── Section principale ── */
    .contact-main {
      padding: var(--section-py) 0;
      background: var(--white);
    }
    .contact-grid {
      display: grid;
      grid-template-columns: 1fr 1.5fr;
      gap: 5rem;
      align-items: start;
    }

    /* ── Infos contact ── */
    .contact-info { position: sticky; top: 100px; }

    .contact-info-title {
      font-family: var(--font-display);
      font-size: var(--text-2xl);
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 0.75rem;
    }
    .contact-info-desc {
      font-size: var(--text-base);
      color: var(--gray-600);
      line-height: 1.8;
      margin-bottom: 2.5rem;
    }

    /* Cards info */
    .contact-cards {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      margin-bottom: 2.5rem;
    }
    .contact-card {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 1.25rem;
      background: var(--off-white);
      border: 1.5px solid var(--gray-200);
      border-radius: var(--radius-md);
      transition: var(--transition);
      text-decoration: none;
    }
    .contact-card:hover {
      border-color: var(--accent);
      background: var(--accent-soft);
      transform: translateX(4px);
    }
    .contact-card-icon {
      width: 44px;
      height: 44px;
      border-radius: var(--radius-sm);
      background: var(--navy);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      flex-shrink: 0;
      transition: var(--transition);
    }
    .contact-card:hover .contact-card-icon {
      background: var(--accent);
    }
    .contact-card-label {
      font-size: var(--text-xs);
      color: var(--gray-400);
      font-family: var(--font-mono);
      letter-spacing: 0.05em;
      display: block;
      margin-bottom: 0.15rem;
    }
    .contact-card-value {
      font-size: var(--text-sm);
      font-weight: 600;
      color: var(--navy);
    }

    /* Disponibilité */
    .contact-availability {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 1rem 1.25rem;
      background: #f0fdf4;
      border: 1.5px solid #bbf7d0;
      border-radius: var(--radius-md);
      margin-bottom: 2rem;
    }
    .availability-dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: #16a34a;
      box-shadow: 0 0 0 3px rgba(22,163,74,.2);
      animation: pulse-dot 2s ease-in-out infinite;
      flex-shrink: 0;
    }
    .availability-text {
      font-size: var(--text-sm);
      font-weight: 600;
      color: #166534;
    }
    .availability-sub {
      font-size: var(--text-xs);
      color: #15803d;
      margin-top: 0.1rem;
    }

    /* Réseaux sociaux */
    .contact-socials {
      display: flex;
      gap: 0.75rem;
    }
    .contact-social-btn {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.6rem 1.1rem;
      border: 1.5px solid var(--gray-200);
      border-radius: var(--radius-sm);
      font-size: var(--text-sm);
      font-weight: 600;
      color: var(--gray-600);
      transition: var(--transition);
    }
    .contact-social-btn:hover {
      border-color: var(--navy);
      color: var(--navy);
      background: var(--off-white);
      transform: translateY(-2px);
    }

    /* ── Formulaire ── */
    .contact-form-wrap {
      background: var(--off-white);
      border: 1.5px solid var(--gray-200);
      border-radius: var(--radius-xl);
      padding: 3rem;
    }

    .contact-form-title {
      font-family: var(--font-display);
      font-size: var(--text-2xl);
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 0.5rem;
    }
    .contact-form-sub {
      font-size: var(--text-sm);
      color: var(--gray-600);
      margin-bottom: 2rem;
    }

    /* Ligne 2 champs côte à côte */
    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1.25rem;
    }

    /* Sujets prédéfinis */
    .sujet-pills {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      margin-bottom: 0.75rem;
    }
    .sujet-pill {
      padding: 0.3rem 0.875rem;
      border: 1.5px solid var(--gray-200);
      border-radius: 50px;
      font-size: var(--text-xs);
      font-weight: 600;
      color: var(--gray-600);
      cursor: pointer;
      transition: var(--transition);
      background: var(--white);
    }
    .sujet-pill:hover,
    .sujet-pill.selected {
      border-color: var(--accent);
      color: var(--accent);
      background: var(--accent-soft);
    }

    /* Bouton submit */
    .btn-submit {
      width: 100%;
      padding: 1rem;
      background: var(--navy);
      color: var(--white);
      border: none;
      border-radius: var(--radius-sm);
      font-family: var(--font-body);
      font-size: var(--text-base);
      font-weight: 700;
      cursor: pointer;
      transition: var(--transition);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.6rem;
      letter-spacing: 0.03em;
      margin-top: 0.5rem;
    }
    .btn-submit:hover:not(:disabled) {
      background: var(--accent);
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(37,99,235,.35);
    }
    .btn-submit:disabled {
      opacity: 0.7;
      cursor: not-allowed;
    }

    /* Messages feedback */
    .form-feedback {
      display: none;
      align-items: flex-start;
      gap: 0.75rem;
      padding: 1rem 1.25rem;
      border-radius: var(--radius-sm);
      font-size: var(--text-sm);
      font-weight: 500;
      margin-top: 1rem;
      animation: fadeInUp 0.4s ease;
    }
    .form-feedback.visible { display: flex; }
    .form-feedback.success {
      background: #f0fdf4;
      border: 1px solid #bbf7d0;
      color: #166534;
    }
    .form-feedback.error {
      background: #fef2f2;
      border: 1px solid #fecaca;
      color: #991b1b;
    }
    .feedback-icon { font-size: 1.1rem; flex-shrink: 0; margin-top: 0.05rem; }

    /* Caractères restants textarea */
    .char-count {
      font-size: var(--text-xs);
      color: var(--gray-400);
      text-align: right;
      margin-top: 0.3rem;
      font-family: var(--font-mono);
    }
    .char-count.warning { color: #f59e0b; }
    .char-count.danger  { color: #ef4444; }

    /* ── FAQ contact ── */
    .contact-faq {
      padding: var(--section-py) 0;
      background: var(--off-white);
    }
    .faq-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1.5rem;
      margin-top: 3rem;
    }
    .faq-item {
      background: var(--white);
      border: 1px solid var(--gray-200);
      border-radius: var(--radius-md);
      padding: 1.75rem;
      transition: var(--transition);
    }
    .faq-item:hover {
      border-color: var(--accent);
      box-shadow: var(--shadow-md);
    }
    .faq-q {
      font-weight: 700;
      font-size: var(--text-base);
      color: var(--navy);
      margin-bottom: 0.6rem;
      display: flex;
      align-items: flex-start;
      gap: 0.6rem;
    }
    .faq-q::before {
      content: 'Q.';
      font-family: var(--font-mono);
      font-size: var(--text-xs);
      color: var(--accent);
      font-weight: 700;
      margin-top: 0.2rem;
      flex-shrink: 0;
    }
    .faq-a {
      font-size: var(--text-sm);
      color: var(--gray-600);
      line-height: 1.75;
      padding-left: 1.5rem;
    }

    /* ── Responsive ── */
    @media (max-width: 1024px) {
      .contact-grid { grid-template-columns: 1fr; gap: 3rem; }
      .contact-info { position: static; }
    }
    @media (max-width: 768px) {
      .contact-form-wrap { padding: 2rem; }
      .form-row { grid-template-columns: 1fr; }
      .faq-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 480px) {
      .contact-hero { padding: 8rem 0 3.5rem; }
      .contact-form-wrap { padding: 1.5rem; }
      .contact-socials { flex-wrap: wrap; }
    }
  </style>
</head>
<body>

<?php include 'includes/nav.php'; ?>

<!-- =====================================================
     HERO
===================================================== -->
<section class="contact-hero">
  <div class="container contact-hero-inner">
    <div class="contact-breadcrumb anim-fade-up">
      <a href="index.php">Accueil</a> / Contact
    </div>
    <h1 class="contact-hero-title anim-fade-up delay-1">
      Parlons de votre<br/><span>projet</span>
    </h1>
    <p class="contact-hero-sub anim-fade-up delay-2">
      Une idée, une opportunité, une question ? Je suis disponible
      et réponds sous 24h.
    </p>
  </div>
</section>


<!-- =====================================================
     SECTION PRINCIPALE
===================================================== -->
<section class="contact-main">
  <div class="container">
    <div class="contact-grid">

      <!-- ── Informations contact ── -->
      <div class="contact-info anim-fade-left">

        <div class="section-label">Me joindre</div>
        <h2 class="contact-info-title">Restons en contact</h2>
        <p class="contact-info-desc">
          Disponible pour des projets freelance, des opportunités
          en CDI/CDD, ou simplement pour échanger sur le développement web.
        </p>

        <!-- Disponibilité -->
        <div class="contact-availability">
          <div class="availability-dot"></div>
          <div>
            <div class="availability-text">Disponible maintenant</div>
            <div class="availability-sub">Réponse sous 24h · Missions & opportunités</div>
          </div>
        </div>

        <!-- Cards infos -->
        <div class="contact-cards">

          <a href="mailto:Gazaliouroukayath@gmail.com" class="contact-card">
            <div class="contact-card-icon">@</div>
            <div>
              <span class="contact-card-label">Email</span>
              <span class="contact-card-value">Gazaliouroukayath@gmail.com</span>
            </div>
          </a>

          <a href="tel:+2290150434710" class="contact-card">
            <div class="contact-card-icon">T</div>
            <div>
              <span class="contact-card-label">Téléphone</span>
              <span class="contact-card-value">(+229) 0150434710</span>
            </div>
          </a>

          <a href="tel:+2290164256352" class="contact-card">
            <div class="contact-card-icon">T</div>
            <div>
              <span class="contact-card-label">Téléphone 2</span>
              <span class="contact-card-value">(+229) 0164256352</span>
            </div>
          </a>

          <div class="contact-card" style="cursor:default;">
            <div class="contact-card-icon">LOC</div>
            <div>
              <span class="contact-card-label">Localisation</span>
              <span class="contact-card-value">Calavi / Zogbadjè, Bénin</span>
            </div>
          </div>

        </div>

        <!-- Réseaux -->
        <div class="contact-socials">
          <a href="https://github.com/abeni229" target="_blank" rel="noopener" class="contact-social-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.17 6.839 9.49.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.604-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.464-1.11-1.464-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0 1 12 6.836c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.167 22 16.418 22 12c0-5.523-4.477-10-10-10z"/></svg>
            GitHub
          </a>
          <a href="https://www.linkedin.com/in/roukayath-gazaliou" target="_blank" rel="noopener" class="contact-social-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M4.98 3.5C4.98 4.88 3.86 6 2.48 6S0 4.88 0 3.5C0 2.12 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM0 8.99h4.96V24H0V8.99zM8.84 8.99h4.76v2.04h.07c.66-1.26 2.28-2.59 4.7-2.59 5.03 0 5.96 3.31 5.96 7.62V24h-4.96v-7.5c0-1.79-.03-4.09-2.49-4.09-2.49 0-2.87 1.94-2.87 3.95V24H8.84V8.99z"/></svg>
            LinkedIn
          </a>
          <a href="https://www.facebook.com/profile.php?id=61585404126518" target="_blank" rel="noopener" class="contact-social-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M22.675 0H1.326C.593 0 0 .593 0 1.326v21.348C0 23.407.593 24 1.326 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.892-4.788 4.659-4.788 1.325 0 2.464.099 2.795.143v3.24l-1.918.001c-1.504 0-1.796.716-1.796 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.407 24 24 23.407 24 22.674V1.326C24 .593 23.407 0 22.675 0z"/></svg>
            Facebook
          </a>
          <a href="mailto:Gazaliouroukayath@gmail.com" class="contact-social-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            Email direct
          </a>
        </div>

      </div>


      <!-- ── Formulaire ── -->
      <div class="anim-fade-right">
        <div class="contact-form-wrap">

          <div class="contact-form-title">Envoyez un message</div>
          <p class="contact-form-sub">Tous les champs sont obligatoires. Je vous répondrai sous 24h.</p>

          <form id="contactForm" novalidate>
            <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>" />
            <input type="hidden" name="ajax" value="1" />

            <!-- Nom + Email -->
            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="nom">Nom complet</label>
                <input
                  type="text"
                  id="nom"
                  name="nom"
                  class="form-input"
                  placeholder="Votre nom"
                  autocomplete="name"
                  required
                />
              </div>
              <div class="form-group">
                <label class="form-label" for="email">Adresse email</label>
                <input
                  type="email"
                  id="email"
                  name="email"
                  class="form-input"
                  placeholder="votre@email.com"
                  autocomplete="email"
                  required
                />
              </div>
            </div>

            <!-- Sujet avec pills prédéfinies -->
            <div class="form-group">
              <label class="form-label" for="sujet">Sujet</label>
              <div class="sujet-pills">
                <span class="sujet-pill" data-value="Projet freelance"> Projet freelance</span>
                <span class="sujet-pill" data-value="Opportunité d'emploi"> Opportunité d'emploi</span>
                <span class="sujet-pill" data-value="Collaboration"> Collaboration</span>
                <span class="sujet-pill" data-value="Question technique"> Question technique</span>
                <span class="sujet-pill" data-value="Autre"> Autre</span>
              </div>
              <input
                type="text"
                id="sujet"
                name="sujet"
                class="form-input"
                placeholder="Objet de votre message"
                required
              />
            </div>

            <!-- Message -->
            <div class="form-group">
              <label class="form-label" for="message">Message</label>
              <textarea
                id="message"
                name="message"
                class="form-textarea"
                placeholder="Décrivez votre projet, votre besoin ou votre question..."
                maxlength="1000"
                required
              ></textarea>
              <div class="char-count" id="charCount">0 / 1000 caractères</div>
            </div>

            <!-- Bouton submit -->
            <button type="submit" class="btn-submit btn-ripple" id="submitBtn">
              <span id="submitText">Envoyer le message</span>
              <svg id="submitIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13"/><path d="M22 2L15 22l-4-9-9-4 20-7z"/></svg>
              <span class="btn-loader" id="submitLoader" style="display:none;"></span>
            </button>

            <!-- Feedback -->
            <div class="form-feedback" id="formFeedback">
              <span class="feedback-icon" id="feedbackIcon"></span>
              <span id="feedbackText"></span>
            </div>

          </form>

        </div>
      </div>

    </div>
  </div>
</section>


<!-- =====================================================
     FAQ
===================================================== -->
<section class="contact-faq">
  <div class="container">

    <div class="anim-fade-up" style="text-align:center;">
      <div class="section-label" style="justify-content:center;">Questions fréquentes</div>
      <h2 class="section-title" style="text-align:center;">
        Ce que vous voulez <span>savoir</span>
      </h2>
    </div>

    <div class="faq-grid anim-cascade">

      <div class="faq-item">
        <div class="faq-q">Dans quel délai répondez-vous ?</div>
        <p class="faq-a">Je réponds généralement sous 24h en semaine. Pour les urgences, n'hésitez pas à m'appeler directement.</p>
      </div>

      <div class="faq-item">
        <div class="faq-q">Travaillez-vous en freelance ?</div>
        <p class="faq-a">Oui, je suis disponible pour des missions freelance en développement web PHP/Laravel, design Figma et intégration frontend.</p>
      </div>

      <div class="faq-item">
        <div class="faq-q">Êtes-vous ouverte à un CDI/CDD ?</div>
        <p class="faq-a">Absolument. Je suis activement en recherche d'opportunités professionnelles à Cotonou ou en remote.</p>
      </div>

      <div class="faq-item">
        <div class="faq-q">Quelles technologies maîtrisez-vous ?</div>
        <p class="faq-a">PHP, Laravel, JavaScript, HTML/CSS, Bootstrap, MySQL, Figma et Git. Consultez ma page <a href="skills.php" style="color:var(--accent);font-weight:600;">Compétences</a> pour plus de détails.</p>
      </div>

    </div>
  </div>
</section>


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

  /* ── Pills sujet ── */
  const pills   = document.querySelectorAll('.sujet-pill');
  const sujetEl = document.getElementById('sujet');

  pills.forEach(pill => {
    pill.addEventListener('click', () => {
      pills.forEach(p => p.classList.remove('selected'));
      pill.classList.add('selected');
      sujetEl.value = pill.dataset.value;
      sujetEl.classList.remove('error');
    });
  });

  /* ── Compteur caractères textarea ── */
  const msgEl    = document.getElementById('message');
  const charEl   = document.getElementById('charCount');

  msgEl.addEventListener('input', () => {
    const len  = msgEl.value.length;
    const max  = 1000;
    charEl.textContent = len + ' / ' + max + ' caractères';
    charEl.className   = 'char-count';
    if (len > 800)  charEl.classList.add('warning');
    if (len > 950)  charEl.classList.add('danger');
  });

  /* ── Soumission formulaire AJAX ── */
  const form       = document.getElementById('contactForm');
  const submitBtn  = document.getElementById('submitBtn');
  const submitText = document.getElementById('submitText');
  const submitIcon = document.getElementById('submitIcon');
  const submitLoad = document.getElementById('submitLoader');
  const feedback   = document.getElementById('formFeedback');
  const fbIcon     = document.getElementById('feedbackIcon');
  const fbText     = document.getElementById('feedbackText');

  function showFeedback(type, message) {
    feedback.className  = 'form-feedback visible ' + type;
    fbIcon.textContent  = type === 'success' ? '✅' : '❌';
    fbText.textContent  = message;
  }

  function setLoading(loading) {
    submitBtn.disabled        = loading;
    submitText.style.display  = loading ? 'none' : 'inline';
    submitIcon.style.display  = loading ? 'none' : 'inline';
    submitLoad.style.display  = loading ? 'inline-block' : 'none';
  }

  function validateField(el) {
    const val = el.value.trim();
    if (!val) {
      el.classList.add('error');
      return false;
    }
    if (el.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) {
      el.classList.add('error');
      return false;
    }
    el.classList.remove('error');
    return true;
  }

  /* Retirer erreur au focus */
  ['nom','email','sujet','message'].forEach(id => {
    document.getElementById(id).addEventListener('input', function () {
      this.classList.remove('error');
    });
  });

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    feedback.className = 'form-feedback';

    /* Validation côté client */
    const fields  = ['nom','email','sujet','message'];
    const valid   = fields.map(id => validateField(document.getElementById(id)));
    if (valid.includes(false)) {
      showFeedback('error', 'Veuillez remplir tous les champs correctement.');
      return;
    }

    setLoading(true);

    try {
      const data = new FormData(form);
      const res  = await fetch('contact.php', { method: 'POST', body: data });
      const json = await res.json();

      if (json.success) {
        showFeedback('success', json.message);
        form.reset();
        pills.forEach(p => p.classList.remove('selected'));
        charEl.textContent = '0 / 1000 caractères';
        charEl.className = 'char-count';
      } else {
        const msg = json.errors ? json.errors.join(' ') : json.message;
        showFeedback('error', msg);
      }
    } catch (err) {
      showFeedback('error', 'Erreur réseau. Veuillez réessayer ou me contacter directement par email.');
    } finally {
      setLoading(false);
    }
  });

})();
</script>

</body>
</html>