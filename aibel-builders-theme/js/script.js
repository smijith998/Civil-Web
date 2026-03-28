/**
 * Aibel Builders – WordPress Theme JS
 * Handles: navbar scroll, mobile menu, scroll-reveal animations, hero parallax, contact form AJAX.
 * Dynamic project data is handled via PHP/WordPress on the server; no localStorage needed.
 */
document.addEventListener('DOMContentLoaded', () => {

    // ── Navbar scroll effect ──────────────────────────────────
    const navbar = document.getElementById('navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });
    }

    // ── Mobile Menu Toggle ────────────────────────────────────
    const hamburger = document.getElementById('hamburger') || document.querySelector('.hamburger');
    const navLinks   = document.querySelector('.nav-links');

    if (hamburger && navLinks) {
        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('open');
            hamburger.classList.toggle('active');
        });
        // Close on link click
        navLinks.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('open');
                hamburger.classList.remove('active');
            });
        });
    }

    // ── Scroll Reveal (Intersection Observer) ─────────────────
    const revealEls = document.querySelectorAll('.reveal');
    if (revealEls.length) {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('active');
                obs.unobserve(entry.target);
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -50px 0px' });

        revealEls.forEach(el => observer.observe(el));
    }

    // ── Hero Parallax ─────────────────────────────────────────
    const heroBg = document.querySelector('.hero-bg');
    if (heroBg) {
        window.addEventListener('scroll', () => {
            const sv = window.scrollY;
            if (sv < window.innerHeight) {
                heroBg.style.transform = `scale(1.05) translateY(${sv * 0.4}px)`;
            }
        });
    }

    // ── Contact Form – Formspree AJAX ─────────────────────────
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = contactForm.querySelector('button[type="submit"]');
            const originalText = btn.innerText;
            btn.innerText = 'Sending…';
            btn.style.opacity = '0.7';

            try {
                const response = await fetch(contactForm.action, {
                    method: 'POST',
                    body: new FormData(contactForm),
                    headers: { Accept: 'application/json' }
                });

                if (response.ok) {
                    btn.innerText = 'Message Sent ✓';
                    btn.style.background = '#4CAF50';
                    btn.style.color = 'white';
                    btn.style.opacity = '1';
                    contactForm.reset();
                } else {
                    btn.innerText = 'Oops! Try again.';
                    btn.style.background = '#f44336';
                    btn.style.color = 'white';
                    btn.style.opacity = '1';
                }
            } catch {
                btn.innerText = 'Network error.';
                btn.style.background = '#f44336';
                btn.style.color = 'white';
                btn.style.opacity = '1';
            }

            setTimeout(() => {
                btn.innerText = originalText;
                btn.style.background = 'var(--accent)';
                btn.style.color = 'var(--bg-color)';
                btn.style.opacity = '1';
            }, 4000);
        });
    }
});
