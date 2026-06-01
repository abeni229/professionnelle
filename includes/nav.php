<?php
// Détection de la page active
$current = basename($_SERVER['PHP_SELF'], '.php');
function isActive($page, $current) {
    return $page === $current ? 'active' : '';
}
?>

<!-- ======= LOADER PAGE ======= -->
<div class="page-loader" id="pageLoader">
  <div class="loader-logo">Roukayath<span>.</span></div>
  <div class="loader-bar">
    <div class="loader-bar-fill"></div>
  </div>
  <div class="loader-text">Chargement...</div>
</div>

<!-- ======= BARRE DE PROGRESSION SCROLL ======= -->
<div class="scroll-progress" id="scrollProgress"></div>

<!-- ======= NAVIGATION ======= -->
<nav class="navbar" id="navbar">
  <div class="container">
    <div class="navbar-inner">

      <!-- Logo -->
      <a href="index.php" class="navbar-logo">
        Roukayath<span>.</span>
      </a>

      <!-- Liens -->
      <ul class="navbar-links" id="navLinks">
        <li><a href="index.php"       class="<?= isActive('index', $current) ?>">Accueil</a></li>
        <li><a href="about.php"       class="<?= isActive('about', $current) ?>">À propos</a></li>
        <li><a href="skills.php"      class="<?= isActive('skills', $current) ?>">Compétences</a></li>
        <li><a href="projects.php"    class="<?= isActive('projects', $current) ?>">Projets</a></li>
        <li><a href="experience.php"  class="<?= isActive('experience', $current) ?>">Expérience</a></li>
        <li><a href="blog.php"        class="<?= isActive('blog', $current) ?>">Blog</a></li>
        <li>
          <a href="contact.php" class="navbar-cta <?= isActive('contact', $current) ?>">
            Me contacter
          </a>
        </li>
      </ul>

      <!-- Burger (mobile) -->
      <button class="navbar-burger" id="navBurger" aria-label="Menu" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
      </button>

    </div>
  </div>
</nav>

<!-- ======= BOUTON BACK TO TOP ======= -->
<button class="back-to-top" id="backToTop" aria-label="Retour en haut">
  ↑
</button>

<!-- ======= SCRIPTS GLOBAUX NAV ======= -->
<script>
(function () {
  const navbar     = document.getElementById('navbar');
  const navLinks   = document.getElementById('navLinks');
  const burger     = document.getElementById('navBurger');
  const progress   = document.getElementById('scrollProgress');
  const backToTop  = document.getElementById('backToTop');
  const loader     = document.getElementById('pageLoader');

  /* --- Loader --- */
  window.addEventListener('load', () => {
    setTimeout(() => {
      loader.classList.add('hidden');
    }, 1500);
  });

  /* --- Scroll : navbar + progress + back-to-top --- */
  window.addEventListener('scroll', () => {
    const scrollY   = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;

    // Navbar scrolled
    navbar.classList.toggle('scrolled', scrollY > 60);

    // Barre de progression
    progress.style.width = (scrollY / docHeight * 100) + '%';

    // Back to top
    backToTop.classList.toggle('visible', scrollY > 400);
  }, { passive: true });

  /* --- Burger menu mobile --- */
  burger.addEventListener('click', () => {
    const isOpen = navLinks.classList.toggle('open');
    burger.classList.toggle('active', isOpen);
    burger.setAttribute('aria-expanded', isOpen);
    document.body.style.overflow = isOpen ? 'hidden' : '';
  });

  // Fermer le menu en cliquant sur un lien
  navLinks.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      navLinks.classList.remove('open');
      burger.classList.remove('active');
      burger.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    });
  });

  /* --- Back to top --- */
  backToTop.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  /* --- Scroll Reveal (IntersectionObserver) --- */
  function initScrollReveal() {
    const revealClasses = [
      '.anim-fade-up',
      '.anim-fade-left',
      '.anim-fade-right',
      '.anim-zoom',
      '.anim-cascade',
      '.about-img-wrap',
    ];

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          if (entry.target.classList.contains('about-img-wrap')) {
            entry.target.classList.add('revealed');
          } else {
            entry.target.classList.add('visible');
          }
          // Déclencher les barres de compétences
          entry.target.querySelectorAll('.skill-bar').forEach(bar => {
            bar.style.width = bar.dataset.level + '%';
          });
          observer.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.15,
      rootMargin: '0px 0px -40px 0px'
    });

    document.querySelectorAll(revealClasses.join(',')).forEach(el => {
      observer.observe(el);
    });
  }

  window.addEventListener('load', initScrollReveal);

  /* --- Ripple effect sur les boutons .btn-ripple --- */
  document.querySelectorAll('.btn-ripple').forEach(btn => {
    btn.addEventListener('click', function (e) {
      const ripple = document.createElement('span');
      ripple.classList.add('ripple-effect');
      const rect = this.getBoundingClientRect();
      ripple.style.left = (e.clientX - rect.left) + 'px';
      ripple.style.top  = (e.clientY - rect.top)  + 'px';
      this.appendChild(ripple);
      setTimeout(() => ripple.remove(), 700);
    });
  });

})();
</script>