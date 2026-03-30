/**
 * Aibel Builders – WordPress Theme JS
 * Handles: navbar scroll, mobile menu, scroll-reveal animations, hero parallax, contact form AJAX.
 * Dynamic project data is handled via PHP/WordPress on the server; no localStorage needed.
 */
document.addEventListener('DOMContentLoaded', () => {

    // ── Hero Slideshow (Ported from static JS) ────────────────
    const slides = document.querySelectorAll('.hero-slide');
    if (slides.length > 0) {
        let currentSlide = 0;
        setInterval(() => {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }, 5000); // change every 5 seconds
    }

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
            navLinks.classList.toggle('active');
            hamburger.classList.toggle('active');
        });
        // Close on link click
        navLinks.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
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

    // ── Contact & Career Forms – Formspree AJAX ─────────────────────────
    const forms = [document.getElementById('contactForm'), document.getElementById('careerForm')];
    forms.forEach(form => {
        if (!form) return;
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = form.querySelector('button[type="submit"]');
            const originalText = btn.innerText;
            btn.innerText = 'Sending…';
            btn.style.opacity = '0.7';

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: { Accept: 'application/json' }
                });

                if (response.ok) {
                    btn.innerText = 'Sent ✓';
                    btn.style.background = '#4CAF50';
                    btn.style.color = 'white';
                    btn.style.opacity = '1';
                    form.reset();
                } else {
                    btn.innerText = 'Error!';
                    btn.style.background = '#f44336';
                    btn.style.color = 'white';
                }
            } catch {
                btn.innerText = 'Network Error';
                btn.style.background = '#f44336';
                btn.style.color = 'white';
            }

            setTimeout(() => {
                btn.innerText = originalText;
                btn.style.background = 'var(--accent)';
                btn.style.color = 'var(--bg-color)';
            }, 4000);
        });
    });

    // --- Careers Application Form Logic ---
    const applyBtns = document.querySelectorAll('.apply-btn');
    const appContainer = document.getElementById('application-container');
    const positionInput = document.querySelector('#careerForm input[name="position"]');
    
    if (applyBtns.length > 0 && appContainer && positionInput) {
        applyBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const role = e.target.getAttribute('data-role');
                positionInput.value = role;
                positionInput.setAttribute('value', role); 
                appContainer.classList.add('active');
                setTimeout(() => {
                    appContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 100);
            });
        });
    }

    // --- Featured Projects Slider (Home Page)
    const featuredSlider = document.getElementById('featured-slider');
    if (featuredSlider) {
        const slides = Array.from(document.querySelectorAll('.featured-slide'));
        if (slides.length > 0) {
            let slideIndex = slides.findIndex(s => s.classList.contains('active'));
            if (slideIndex === -1) slideIndex = 0;
            let slideInterval;

            function showSlide(index) {
                slides.forEach(s => s.classList.remove('active'));
                slideIndex = (index + slides.length) % slides.length;
                slides[slideIndex].classList.add('active');
            }

            function startAutoPlay() {
                if (slides.length <= 1) return;
                clearInterval(slideInterval);
                slideInterval = setInterval(() => { showSlide(slideIndex + 1); }, 6000);
            }

            const prevBtn = document.getElementById('featured-prev');
            const nextBtn = document.getElementById('featured-next');

            if (prevBtn && nextBtn) {
                prevBtn.addEventListener('click', () => { showSlide(slideIndex - 1); startAutoPlay(); });
                nextBtn.addEventListener('click', () => { showSlide(slideIndex + 1); startAutoPlay(); });
            }
            startAutoPlay();
        }
    }

    // --- Team Carousel Logic (Coverflow) ---
    const teamCarousel = document.getElementById('team-carousel');
    const teamPrevBtn = document.getElementById('team-prev');
    const teamNextBtn = document.getElementById('team-next');
    
    if (teamCarousel) {
        const employeeFiles = [
            "Arya Anush-Accounts Manager.jpeg",
            "Asika NB-Civil Draftsman and site supervisor.jpeg",
            "Astin jose- Site Supervisor.jpeg",
            "Jinu Jossy-Marketing Director.jpeg",
            "Sayooj VS-Project manager.jpeg",
            "Seli Huraira Beegum K-Marketing Manager.jpeg",
            "Sona KM-#D visualizer & Site Supervisor.jpeg",
            "Srijith Vijayan-Site Engineer.jpeg",
            "Sunilkumar EN-site engineer.jpeg"
        ];

        function capitalizeWords(str) {
            return str.split(' ').map(word => {
                if (word.length === 0) return word;
                if (word.toLowerCase() === 'and') return 'and';
                return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
            }).join(' ');
        }

        const cards = [];
        const themeDir = typeof aibelThemeUrl !== 'undefined' ? aibelThemeUrl : '';

        employeeFiles.forEach((filename, index) => {
            const nameWithoutExt = filename.substring(0, filename.lastIndexOf('.'));
            const parts = nameWithoutExt.split('-');
            
            let name = parts[0] ? parts[0].trim() : 'Team Member';
            let title = parts[1] ? parts[1].trim() : '';
            
            if (title.includes('#D')) title = title.replace('#D', '3D');
            if (title.toLowerCase().includes('manger')) title = title.replace(/manger/i, 'Manager');
            title = capitalizeWords(title);

            const memberCard = document.createElement('div');
            memberCard.className = 'team-member';
            memberCard.dataset.title = title;
            memberCard.innerHTML = `
                <div class="team-member-img-wrapper">
                    <img src="${themeDir}/employees/${encodeURIComponent(filename)}" alt="${name}">
                </div>
                <div class="team-member-info">
                    <h3>${name}</h3>
                    <span>${title}</span>
                </div>
            `;
            
            memberCard.addEventListener('click', () => { updateCarousel(index); });
            teamCarousel.appendChild(memberCard);
            cards.push(memberCard);
        });

        let currentIndex = cards.findIndex(card => card.dataset.title === 'Marketing Director');
        if (currentIndex === -1) currentIndex = Math.floor(cards.length / 2);

        function updateCarousel(newIndex) {
            if (cards.length === 0) return;
            
            if (newIndex < 0) newIndex = cards.length - 1;
            if (newIndex >= cards.length) newIndex = 0;
            
            currentIndex = newIndex;

            cards.forEach((card, i) => {
                card.className = 'team-member';
                let diff = (i - currentIndex + cards.length) % cards.length;
                if (diff > cards.length / 2) diff -= cards.length;
                
                if (diff === 0) card.classList.add('active');
                else if (diff === -1) card.classList.add('prev');
                else if (diff === 1) card.classList.add('next');
                else if (diff === -2) card.classList.add('prev-prev');
                else if (diff === 2) card.classList.add('next-next');
            });
        }

        if(teamPrevBtn) teamPrevBtn.addEventListener('click', () => updateCarousel(currentIndex - 1));
        if(teamNextBtn) teamNextBtn.addEventListener('click', () => updateCarousel(currentIndex + 1));

        updateCarousel(currentIndex);
    }
});
