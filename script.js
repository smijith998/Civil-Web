document.addEventListener('DOMContentLoaded', () => {
    
    // Navbar scroll effect
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Mobile Menu Toggle
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');
    const links = document.querySelectorAll('.nav-links li a');

    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        hamburger.classList.toggle('active');
    });

    // Close mobile menu when link is clicked
    links.forEach(link => {
        link.addEventListener('click', () => {
            navLinks.classList.remove('active');
            hamburger.classList.remove('active');
        });
    });

    // Reveal on Scroll (Intersection Observer)
    const revealElements = document.querySelectorAll('.reveal');

    const revealOptions = {
        threshold: 0.15,
        rootMargin: "0px 0px -50px 0px"
    };

    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            
            entry.target.classList.add('active');
            observer.unobserve(entry.target);
        });
    }, revealOptions);

    revealElements.forEach(el => {
        revealObserver.observe(el);
    });

    // Form Submission Handling (with Formspree)
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = contactForm.querySelector('button[type="submit"]');
            const originalText = btn.innerText;
            
            // Loading state
            btn.innerText = 'Sending...';
            btn.style.opacity = '0.7';

            const formData = new FormData(contactForm);

            try {
                const response = await fetch(contactForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                
                if (response.ok) {
                    btn.innerText = 'Message Sent';
                    btn.style.background = '#4CAF50';
                    btn.style.color = 'white';
                    btn.style.borderColor = '#4CAF50';
                    btn.style.opacity = '1';
                    contactForm.reset();
                } else {
                    const data = await response.json();
                    if (Object.hasOwn(data, 'errors')) {
                        btn.innerText = data.errors.map(error => error.message).join(", ");
                    } else {
                        btn.innerText = 'Oops! There was a problem.';
                    }
                    btn.style.background = '#f44336';
                    btn.style.borderColor = '#f44336';
                    btn.style.color = 'white';
                    btn.style.opacity = '1';
                }
            } catch (error) {
                btn.innerText = 'Oops! There was a problem.';
                btn.style.background = '#f44336';
                btn.style.borderColor = '#f44336';
                btn.style.color = 'white';
                btn.style.opacity = '1';
            }
            
            // Reset button after 4 seconds
            setTimeout(() => {
                btn.innerText = originalText;
                btn.style.background = 'var(--accent)';
                btn.style.color = 'var(--bg-color)';
                btn.style.borderColor = 'none';
            }, 4000);
        });
    }

    // Interactive Parallax effect on hero background
    const heroBg = document.querySelector('.hero-bg');
    if (heroBg) {
        window.addEventListener('scroll', () => {
            const scrollValue = window.scrollY;
            if (scrollValue < window.innerHeight) {
                heroBg.style.transform = `scale(1.05) translateY(${scrollValue * 0.4}px)`;
            }
        });
    }
});
