/**
 * main.js — Roukayath Gazaliou Portfolio
 * Gestion globale : nav, animations, scroll, thème, ripple, etc.
 */

(function () {
  'use strict';

  /* ══════════════════════════════════════════════
     1. NAVIGATION — sticky + menu mobile
  ══════════════════════════════════════════════ */
  const nav = document.querySelector('.nav');
  const navToggle = document.querySelector('.nav-toggle');
  const navMenu   = document.querySelector('.nav-menu');
  const navLinks  = document.querySelectorAll('.nav-link');

  // Sticky scroll
  let lastScrollY = 0;
  function handleNavScroll() {
    const scrollY = window.scrollY;

    if (scrollY > 80) {
      nav?.classList.add('nav--scrolled');
    } else {
      nav?.classList.remove('nav--scrolled');
    }

    // Hide on scroll down, show on scroll up
    if (scrollY > lastScrollY && scrollY > 200) {
      nav?.classList.add('nav--hidden');
    } else {
      nav?.classList.remove('nav--hidden');
    }

    lastScrollY = scrollY;
  }

  window.addEventListener('scroll', handleNavScroll, { passive: true });

  // Menu hamburger toggle
  if (navToggle && navMenu) {
    navToggle.addEventListener('click', () => {
      const isOpen = navMenu.classList.toggle('nav-menu--open');
      navToggle.classList.toggle('nav-toggle--open', isOpen);
      navToggle.setAttribute('aria-expanded', String(isOpen));
      document.body.classList.toggle('menu-open', isOpen);
    });

    // Fermer le menu au clic sur un lien
    navLinks.forEach(link => {
      link.addEventListener('click', () => {
        navMenu.classList.remove('nav-menu--open');
        navToggle.classList.remove('nav-toggle--open');
        navToggle.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('menu-open');
      });
    });

    // Fermer au clic en dehors
    document.addEventListener('click', (e) => {
      if (!nav?.contains(e.target)) {
        navMenu.classList.remove('nav-menu--open');
        navToggle.classList.remove('nav-toggle--open');
        navToggle.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('menu-open');
      }
    });
  }

  // Lien actif selon la page courante
  const currentPath = window.location.pathname.split('/').pop() || 'index.php';
  navLinks.forEach(link => {
    const href = link.getAttribute('href') || '';
    if (href === currentPath || (currentPath === '' && href === 'index.php')) {
      link.classList.add('nav-link--active');
    }
  });


  /* ══════════════════════════════════════════════
     2. INTERSECTION OBSERVER — animations au scroll
  ══════════════════════════════════════════════ */
  const animClasses = [
    '.anim-fade-up',
    '.anim-fade-in',
    '.anim-slide-left',
    '.anim-slide-right',
    '.anim-cascade',
    '.anim-scale-in',
    '.section-label',
    '.section-title',
    '.section-subtitle',
    '.skill-bar',
    '.project-card',
    '.timeline-item',
    '.blog-card',
  ];

  const scrollObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('in-view');

          // Cascade : animer les enfants avec délai progressif
          if (entry.target.classList.contains('anim-cascade')) {
            const children = entry.target.children;
            Array.from(children).forEach((child, i) => {
              child.style.animationDelay = `${i * 0.12}s`;
              child.classList.add('cascade-child');
            });
          }

          scrollObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.12, rootMargin: '0px 0px -60px 0px' }
  );

  function initScrollAnimations() {
    animClasses.forEach(selector => {
      document.querySelectorAll(selector).forEach(el => {
        scrollObserver.observe(el);
      });
    });
  }

  initScrollAnimations();


  /* ══════════════════════════════════════════════
     3. RIPPLE EFFECT — boutons
  ══════════════════════════════════════════════ */
  function createRipple(e) {
    const btn    = e.currentTarget;
    const circle = document.createElement('span');
    const rect   = btn.getBoundingClientRect();
    const size   = Math.max(rect.width, rect.height);
    const x      = e.clientX - rect.left - size / 2;
    const y      = e.clientY - rect.top  - size / 2;

    circle.style.cssText = `
      width: ${size}px;
      height: ${size}px;
      left: ${x}px;
      top: ${y}px;
    `;
    circle.classList.add('ripple-effect');

    const existing = btn.querySelector('.ripple-effect');
    if (existing) existing.remove();

    btn.appendChild(circle);
    circle.addEventListener('animationend', () => circle.remove());
  }

  document.querySelectorAll('.btn-ripple').forEach(btn => {
    btn.addEventListener('click', createRipple);
  });


  /* ══════════════════════════════════════════════
     4. SMOOTH SCROLL — ancres internes
  ══════════════════════════════════════════════ */
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', (e) => {
      const id = anchor.getAttribute('href').slice(1);
      const target = document.getElementById(id);
      if (!target) return;
      e.preventDefault();
      const navHeight = nav?.offsetHeight || 80;
      const top = target.getBoundingClientRect().top + window.scrollY - navHeight - 20;
      window.scrollTo({ top, behavior: 'smooth' });
    });
  });


  /* ══════════════════════════════════════════════
     5. BARRE DE PROGRESSION — compétences
  ══════════════════════════════════════════════ */
  const skillBars = document.querySelectorAll('.skill-bar');

  if (skillBars.length > 0) {
    const barObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach(entry => {
          if (!entry.isIntersecting) return;
          const bar      = entry.target;
          const fill     = bar.querySelector('.skill-bar-fill');
          const level    = bar.dataset.level || '0';
          const percent  = bar.querySelector('.skill-percent');

          if (fill) {
            fill.style.width = '0%';
            requestAnimationFrame(() => {
              fill.style.transition = 'width 1.2s cubic-bezier(0.4, 0, 0.2, 1)';
              fill.style.width = level + '%';
            });
          }

          // Compteur numérique
          if (percent) {
            let current = 0;
            const target  = parseInt(level);
            const step    = Math.ceil(target / 60);
            const timer   = setInterval(() => {
              current = Math.min(current + step, target);
              percent.textContent = current + '%';
              if (current >= target) clearInterval(timer);
            }, 20);
          }

          barObserver.unobserve(bar);
        });
      },
      { threshold: 0.4 }
    );

    skillBars.forEach(b => barObserver.observe(b));
  }


  /* ══════════════════════════════════════════════
     6. FORMULAIRE DE CONTACT — validation + envoi
  ══════════════════════════════════════════════ */
  const contactForm = document.getElementById('contactForm');

  if (contactForm) {
    const inputs  = contactForm.querySelectorAll('input, textarea, select');
    const btnSend = contactForm.querySelector('[type="submit"]');

    // Validation live
    inputs.forEach(input => {
      input.addEventListener('blur', () => validateField(input));
      input.addEventListener('input', () => {
        if (input.classList.contains('field-error')) validateField(input);
      });
    });

    function validateField(field) {
      const wrapper = field.closest('.form-group');
      const error   = wrapper?.querySelector('.form-error');
      let msg = '';

      if (field.required && !field.value.trim()) {
        msg = 'Ce champ est obligatoire.';
      } else if (field.type === 'email' && field.value) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!re.test(field.value)) msg = 'Adresse e-mail invalide.';
      } else if (field.minLength > 0 && field.value.length < field.minLength) {
        msg = `Minimum ${field.minLength} caractères.`;
      }

      field.classList.toggle('field-error', !!msg);
      field.classList.toggle('field-valid', !msg && field.value.trim() !== '');
      if (error) error.textContent = msg;

      return !msg;
    }

    function validateAll() {
      return Array.from(inputs).every(validateField);
    }

    contactForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      if (!validateAll()) return;

      btnSend?.classList.add('btn-loading');
      btnSend.disabled = true;

      try {
        const data = new FormData(contactForm);
        const res  = await fetch(contactForm.action || 'contact.php', {
          method: 'POST',
          body: data,
        });

        const json = await res.json().catch(() => null);

        if (res.ok || json?.success) {
          showToast('Message envoyé avec succès ! Je vous répondrai bientôt.', 'success');
          contactForm.reset();
          inputs.forEach(i => {
            i.classList.remove('field-valid', 'field-error');
          });
        } else {
          throw new Error(json?.message || 'Erreur serveur');
        }
      } catch (err) {
        showToast('Une erreur est survenue. Veuillez réessayer.', 'error');
      } finally {
        btnSend?.classList.remove('btn-loading');
        btnSend.disabled = false;
      }
    });
  }


  /* ══════════════════════════════════════════════
     7. TOAST NOTIFICATIONS
  ══════════════════════════════════════════════ */
  function showToast(message, type = 'info', duration = 5000) {
    let container = document.getElementById('toastContainer');
    if (!container) {
      container = document.createElement('div');
      container.id = 'toastContainer';
      container.style.cssText = `
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        pointer-events: none;
      `;
      document.body.appendChild(container);
    }

    const icons = {
      success: '✓',
      error:   '✕',
      info:    'ℹ',
      warning: '⚠',
    };

    const toast = document.createElement('div');
    toast.style.cssText = `
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 1rem 1.5rem;
      background: ${type === 'success' ? '#0f5132' : type === 'error' ? '#58151c' : '#0c3547'};
      border: 1px solid ${type === 'success' ? '#2a9d5e' : type === 'error' ? '#e74c3c' : '#2563eb'};
      border-radius: 12px;
      color: #fff;
      font-family: var(--font-sans, 'DM Sans', sans-serif);
      font-size: 0.9rem;
      max-width: 360px;
      box-shadow: 0 8px 32px rgba(0,0,0,.4);
      pointer-events: all;
      transform: translateX(120%);
      transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    `;
    toast.innerHTML = `<span style="font-size:1.1rem;font-weight:700;">${icons[type] || icons.info}</span><span>${message}</span>`;
    container.appendChild(toast);

    requestAnimationFrame(() => {
      toast.style.transform = 'translateX(0)';
    });

    setTimeout(() => {
      toast.style.transform = 'translateX(120%)';
      toast.addEventListener('transitionend', () => toast.remove());
    }, duration);
  }

  // Rendre disponible globalement
  window.showToast = showToast;


  /* ══════════════════════════════════════════════
     8. FILTRES PROJETS — isotope léger
  ══════════════════════════════════════════════ */
  const filterBtns = document.querySelectorAll('[data-filter]');
  const projectCards = document.querySelectorAll('[data-category]');

  if (filterBtns.length && projectCards.length) {
    filterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        filterBtns.forEach(b => b.classList.remove('filter-active'));
        btn.classList.add('filter-active');

        const filter = btn.dataset.filter;

        projectCards.forEach(card => {
          const match = filter === 'all' || card.dataset.category === filter;
          card.style.transition = 'opacity 0.35s ease, transform 0.35s ease';

          if (match) {
            card.style.opacity = '1';
            card.style.transform = 'scale(1)';
            card.style.pointerEvents = 'auto';
            card.style.display = '';
          } else {
            card.style.opacity = '0';
            card.style.transform = 'scale(0.94)';
            card.style.pointerEvents = 'none';
            setTimeout(() => {
              if (card.style.opacity === '0') card.style.display = 'none';
            }, 350);
          }
        });
      });
    });
  }


  /* ══════════════════════════════════════════════
     9. LIGHTBOX — galerie projets
  ══════════════════════════════════════════════ */
  const galleryItems = document.querySelectorAll('[data-lightbox]');

  if (galleryItems.length) {
    // Créer la lightbox
    const lb = document.createElement('div');
    lb.id = 'lightbox';
    lb.innerHTML = `
      <div class="lb-backdrop"></div>
      <button class="lb-close" aria-label="Fermer">✕</button>
      <button class="lb-prev" aria-label="Précédent">‹</button>
      <button class="lb-next" aria-label="Suivant">›</button>
      <div class="lb-content">
        <img class="lb-img" src="" alt="" />
        <div class="lb-caption"></div>
      </div>
    `;
    lb.style.cssText = `
      position: fixed; inset: 0; z-index: 10000;
      display: none; align-items: center; justify-content: center;
      padding: 2rem;
    `;
    document.body.appendChild(lb);

    const lbImg     = lb.querySelector('.lb-img');
    const lbCaption = lb.querySelector('.lb-caption');
    let currentIdx  = 0;
    const items     = Array.from(galleryItems);

    function openLightbox(idx) {
      currentIdx = idx;
      const item = items[idx];
      lbImg.src        = item.dataset.lightbox;
      lbImg.alt        = item.dataset.caption || '';
      lbCaption.textContent = item.dataset.caption || '';
      lb.style.display = 'flex';
      document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
      lb.style.display = 'none';
      document.body.style.overflow = '';
    }

    items.forEach((item, i) => {
      item.style.cursor = 'zoom-in';
      item.addEventListener('click', () => openLightbox(i));
    });

    lb.querySelector('.lb-close').addEventListener('click', closeLightbox);
    lb.querySelector('.lb-backdrop').addEventListener('click', closeLightbox);
    lb.querySelector('.lb-prev').addEventListener('click', () => openLightbox((currentIdx - 1 + items.length) % items.length));
    lb.querySelector('.lb-next').addEventListener('click', () => openLightbox((currentIdx + 1) % items.length));

    document.addEventListener('keydown', (e) => {
      if (lb.style.display !== 'flex') return;
      if (e.key === 'Escape') closeLightbox();
      if (e.key === 'ArrowLeft')  openLightbox((currentIdx - 1 + items.length) % items.length);
      if (e.key === 'ArrowRight') openLightbox((currentIdx + 1) % items.length);
    });
  }


  /* ══════════════════════════════════════════════
     10. LAZY LOADING — images hors viewport
  ══════════════════════════════════════════════ */
  const lazyImages = document.querySelectorAll('img[data-src]');

  if ('IntersectionObserver' in window && lazyImages.length) {
    const imgObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach(entry => {
          if (!entry.isIntersecting) return;
          const img = entry.target;
          img.src = img.dataset.src;
          if (img.dataset.srcset) img.srcset = img.dataset.srcset;
          img.removeAttribute('data-src');
          img.classList.add('img-loaded');
          imgObserver.unobserve(img);
        });
      },
      { rootMargin: '200px 0px' }
    );

    lazyImages.forEach(img => imgObserver.observe(img));
  }


  /* ══════════════════════════════════════════════
     11. BACK TO TOP
  ══════════════════════════════════════════════ */
  const btt = document.createElement('button');
  btt.id = 'backToTop';
  btt.setAttribute('aria-label', 'Retour en haut');
  btt.innerHTML = `
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
      <path d="M18 15l-6-6-6 6"/>
    </svg>
  `;
  btt.style.cssText = `
    position: fixed;
    bottom: 2rem;
    left: 2rem;
    width: 46px;
    height: 46px;
    border-radius: 50%;
    border: 1px solid rgba(255,255,255,.15);
    background: var(--navy, #0f1f3d);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    opacity: 0;
    transform: translateY(10px);
    transition: opacity 0.3s ease, transform 0.3s ease, background 0.2s ease;
    z-index: 999;
    box-shadow: 0 4px 20px rgba(0,0,0,.3);
  `;
  document.body.appendChild(btt);

  window.addEventListener('scroll', () => {
    const show = window.scrollY > 500;
    btt.style.opacity   = show ? '1' : '0';
    btt.style.transform = show ? 'translateY(0)' : 'translateY(10px)';
    btt.style.pointerEvents = show ? 'auto' : 'none';
  }, { passive: true });

  btt.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  btt.addEventListener('mouseenter', () => {
    btt.style.background = 'var(--accent, #2563eb)';
  });
  btt.addEventListener('mouseleave', () => {
    btt.style.background = 'var(--navy, #0f1f3d)';
  });


  /* ══════════════════════════════════════════════
     12. ACTIVE NAV LINK AU SCROLL — sections
  ══════════════════════════════════════════════ */
  const sections = document.querySelectorAll('section[id]');

  if (sections.length && navLinks.length) {
    const sectionObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach(entry => {
          if (!entry.isIntersecting) return;
          const id = entry.target.id;
          navLinks.forEach(link => {
            const href = link.getAttribute('href') || '';
            link.classList.toggle('nav-link--active', href.includes(`#${id}`) || href === `${id}.php`);
          });
        });
      },
      { threshold: 0.4, rootMargin: '-80px 0px -40% 0px' }
    );

    sections.forEach(s => sectionObserver.observe(s));
  }


  /* ══════════════════════════════════════════════
     13. ACCESSIBILITÉ — focus trap menu mobile
  ══════════════════════════════════════════════ */
  document.addEventListener('keydown', (e) => {
    if (e.key !== 'Tab' || !navMenu?.classList.contains('nav-menu--open')) return;

    const focusable = navMenu.querySelectorAll(
      'a, button, input, select, textarea, [tabindex]:not([tabindex="-1"])'
    );
    const first = focusable[0];
    const last  = focusable[focusable.length - 1];

    if (e.shiftKey && document.activeElement === first) {
      last.focus(); e.preventDefault();
    } else if (!e.shiftKey && document.activeElement === last) {
      first.focus(); e.preventDefault();
    }
  });

  // Fermer menu avec Escape
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && navMenu?.classList.contains('nav-menu--open')) {
      navMenu.classList.remove('nav-menu--open');
      navToggle?.classList.remove('nav-toggle--open');
      navToggle?.setAttribute('aria-expanded', 'false');
      document.body.classList.remove('menu-open');
      navToggle?.focus();
    }
  });


  /* ══════════════════════════════════════════════
     14. PRÉCHARGEMENT — transition de page fluide
  ══════════════════════════════════════════════ */
  const loader = document.getElementById('pageLoader');
  if (loader) {
    window.addEventListener('load', () => {
      loader.classList.add('loader-done');
      setTimeout(() => loader.remove(), 600);
    });
  }

  // Transition douce entre pages
  document.querySelectorAll('a[href]').forEach(link => {
    const href = link.getAttribute('href');
    if (!href || href.startsWith('#') || href.startsWith('mailto') ||
        href.startsWith('tel') || href.startsWith('http') || link.target === '_blank') return;

    link.addEventListener('click', (e) => {
      e.preventDefault();
      document.body.classList.add('page-exit');
      setTimeout(() => {
        window.location.href = href;
      }, 300);
    });
  });

  document.body.classList.add('page-enter');
  requestAnimationFrame(() => {
    requestAnimationFrame(() => {
      document.body.classList.remove('page-enter');
    });
  });


  /* ══════════════════════════════════════════════
     15. TABS — sections avec onglets (about, skills)
  ══════════════════════════════════════════════ */
  const tabGroups = document.querySelectorAll('[data-tabs]');

  tabGroups.forEach(group => {
    const triggers = group.querySelectorAll('[data-tab]');
    const panels   = group.querySelectorAll('[data-panel]');

    triggers.forEach(trigger => {
      trigger.addEventListener('click', () => {
        const target = trigger.dataset.tab;

        triggers.forEach(t => {
          t.classList.toggle('tab-active', t.dataset.tab === target);
          t.setAttribute('aria-selected', String(t.dataset.tab === target));
        });

        panels.forEach(panel => {
          const show = panel.dataset.panel === target;
          panel.hidden = !show;
          panel.classList.toggle('panel-active', show);
        });
      });
    });

    // Activer le premier onglet par défaut
    if (triggers[0]) triggers[0].click();
  });


  /* ══════════════════════════════════════════════
     16. COPY EMAIL / PHONE — clic pour copier
  ══════════════════════════════════════════════ */
  document.querySelectorAll('[data-copy]').forEach(el => {
    el.style.cursor = 'pointer';
    el.setAttribute('title', 'Cliquer pour copier');

    el.addEventListener('click', async () => {
      const text = el.dataset.copy;
      try {
        await navigator.clipboard.writeText(text);
        showToast(`"${text}" copié !`, 'success', 2500);
      } catch {
        showToast('Copie non supportée dans ce navigateur.', 'warning');
      }
    });
  });


  /* ══════════════════════════════════════════════
     17. RESIZE OBSERVER — recalcul nav sur resize
  ══════════════════════════════════════════════ */
  if ('ResizeObserver' in window) {
    const ro = new ResizeObserver(() => {
      // Fermer le menu mobile si on passe en desktop
      if (window.innerWidth >= 768) {
        navMenu?.classList.remove('nav-menu--open');
        navToggle?.classList.remove('nav-toggle--open');
        document.body.classList.remove('menu-open');
      }
    });
    if (document.body) ro.observe(document.body);
  }


  /* ══════════════════════════════════════════════
     18. INIT PAGE LOADER — spinner pendant load
  ══════════════════════════════════════════════ */
  if (!document.getElementById('pageLoader')) {
    const loaderEl = document.createElement('div');
    loaderEl.id = 'pageLoader';
    loaderEl.innerHTML = `
      <div class="loader-spinner"></div>
    `;
    loaderEl.style.cssText = `
      position: fixed; inset: 0;
      background: var(--navy, #0f1f3d);
      display: flex; align-items: center; justify-content: center;
      z-index: 99999;
      transition: opacity 0.5s ease;
    `;
    document.body.prepend(loaderEl);

    window.addEventListener('load', () => {
      loaderEl.style.opacity = '0';
      loaderEl.style.pointerEvents = 'none';
      setTimeout(() => loaderEl.remove(), 500);
    });
  }

})();