document.addEventListener('DOMContentLoaded', () => {

    // Hero Slideshow
    const slides = document.querySelectorAll('.hero-slide');
    if (slides.length > 0) {
        let currentSlide = 0;
        setInterval(() => {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }, 5000); // change every 5 seconds
    }

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

    // --- Careers Application Form Logic ---
    const applyBtns = document.querySelectorAll('.apply-btn');
    const appContainer = document.getElementById('application-container');
    const positionInput = document.querySelector('#careerForm input[name="position"]');
    
    if (applyBtns.length > 0 && appContainer && positionInput) {
        applyBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const role = e.target.getAttribute('data-role');
                
                // Set the input value
                positionInput.value = role;
                // Add a class that simulates the floating label focus/not empty state
                positionInput.setAttribute('value', role); // ensures CSS :not(:placeholder-shown) triggers if used this way, or just let required do its job usually
                
                // Expand container
                appContainer.classList.add('active');
                
                // Scroll to form smoothly
                setTimeout(() => {
                    appContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 100);
            });
        });
    }

    // --- Dynamic Projects Rendering ---
    
    // Render Featured Projects Slider (Home Page)
    const featuredSlider = document.getElementById('featured-slider');
    if (featuredSlider && typeof aibelProjects !== 'undefined' && aibelProjects.length > 0) {
        let slideIndex = 0;
        let slideInterval;
        const slides = [];

        aibelProjects.forEach((project, index) => {
            const slide = document.createElement('div');
            slide.className = index === 0 ? 'featured-slide active' : 'featured-slide';
            slide.style.backgroundImage = `url('${project.images[0].replace(/'/g, "\\'")}')`;
            
            slide.innerHTML = `
                <div class="featured-caption">
                    <h3>${project.title}</h3>
                    <span>${project.category} / ${project.year}</span>
                    <a href="projects.html" class="view-btn" style="margin-top: 1.5rem; display: inline-block;">View Gallery</a>
                </div>
            `;
            // Append slide BEFORE the buttons so it's under them based on structure
            featuredSlider.insertBefore(slide, featuredSlider.firstChild);
            slides.push(slide); // Array order will be reversed if insertBefore is used naively, let's reverse to fix order or use append before nav
        });
        
        // Fix chronological order since we used insertBefore
        slides.reverse();

        function showSlide(index) {
            if (slides.length === 0) return;
            slides.forEach(s => s.classList.remove('active'));
            slideIndex = (index + slides.length) % slides.length;
            slides[slideIndex].classList.add('active');
        }

        function startAutoPlay() {
            if (slides.length <= 1) return;
            clearInterval(slideInterval);
            slideInterval = setInterval(() => {
                showSlide(slideIndex + 1);
            }, 6000); // 6 seconds
        }

        const prevBtn = document.getElementById('featured-prev');
        const nextBtn = document.getElementById('featured-next');

        if (prevBtn && nextBtn) {
            prevBtn.addEventListener('click', () => {
                showSlide(slideIndex - 1);
                startAutoPlay(); // Reset timer upon user interaction
            });
            nextBtn.addEventListener('click', () => {
                showSlide(slideIndex + 1);
                startAutoPlay(); // Reset timer upon user interaction
            });
        }
        
        startAutoPlay();
    }

    // --- Local Storage Project Merging ---
    const localProjects = JSON.parse(localStorage.getItem('customAibelProjects')) || [];
    const hiddenProjects = JSON.parse(localStorage.getItem('customHiddenAibelProjects')) || [];
    
    // Helper to merge local projects over hardcoded ones
    function getMergedProjects(hardcodedList, isUpcomingTarget) {
        let merged = typeof hardcodedList !== 'undefined' ? [...hardcodedList] : [];
        const targetedLocal = localProjects.filter(p => p.isUpcoming === isUpcomingTarget);
        
        targetedLocal.forEach(lp => {
            const existingIndex = merged.findIndex(p => p.id === lp.id);
            if (existingIndex !== -1) {
                merged[existingIndex] = lp; // Overwrite hardcoded with local edit
            } else {
                merged.push(lp); // Append new local project
            }
        });

        // Filter out any deleted projects
        return merged.filter(p => !hiddenProjects.includes(p.id));
    }

    const finalCompletedProjects = getMergedProjects(typeof aibelProjects !== 'undefined' ? aibelProjects : [], false);
    const finalUpcomingProjects = getMergedProjects(typeof aibelUpcomingProjects !== 'undefined' ? aibelUpcomingProjects : [], true);

    // --- Render Helper ---
    function renderProjectsToContainer(projectsArray, containerId, isUpcoming) {
        const container = document.getElementById(containerId);
        if (!container) return;
        container.innerHTML = ''; // Clear container

        projectsArray.forEach((project, index) => {
            const block = document.createElement('div');
            block.className = `reveal fade-up active`; // force active for dynamic
            block.style.marginBottom = '6rem';
            
            let imagesHtml = '';
            if (project.images && project.images.length > 0) {
                project.images.forEach(img => {
                    imagesHtml += `<div class="gallery-item" onclick="if(typeof openLightbox === 'function') openLightbox('${img}')"><img src="${img}" alt="${project.title}" style="width:100%; height:100%; object-fit:cover; aspect-ratio:1; cursor:pointer;"></div>`;
                });
            }

            block.innerHTML = `
                <div class="project-head" style="margin-bottom: 2rem; position: relative;">
                    <h2 style="font-size: 2.5rem; color: var(--accent); margin-bottom: 0.5rem; padding-right: 6rem;">${project.title}</h2>
                    <span style="display:block; color: var(--text-muted); text-transform:uppercase; letter-spacing:1px; margin-bottom: 1rem;">${project.category} / ${project.year}</span>
                    <p style="max-width: 800px; font-size: 1.1rem; color: var(--text-main); margin-bottom: 2rem;">${project.description}</p>
                </div>
                <div class="gallery-grid" style="display:grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                    ${imagesHtml}
                </div>
            `;
            container.appendChild(block);
        });
    }

    renderProjectsToContainer(finalCompletedProjects, 'full-projects-container', false);
    renderProjectsToContainer(finalUpcomingProjects, 'upcoming-projects-container', true);

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

// --- Project Modal Functions ---
window.openProjectModal = function(projectId, isUpcoming = false) {
    let project;
    if (isUpcoming && typeof aibelUpcomingProjects !== 'undefined') {
        project = aibelUpcomingProjects.find(p => p.id === projectId);
    } else if (typeof aibelProjects !== 'undefined') {
        project = aibelProjects.find(p => p.id === projectId);
    }
    
    if (!project) return;

    document.getElementById('modalTitle').innerText = project.title;
    document.getElementById('modalCategory').innerText = project.category;
    document.getElementById('modalYear').innerText = project.year;
    document.getElementById('modalDescription').innerText = project.description;

    const modalGallery = document.getElementById('modalGallery');
    if (modalGallery) {
        modalGallery.innerHTML = ''; // Clear previous images
        project.images.forEach(imgSrc => {
            const img = document.createElement('img');
            img.src = imgSrc;
            img.alt = project.title;
            modalGallery.appendChild(img);
        });
    }

    const modal = document.getElementById('projectModal');
    if (modal) modal.classList.add('active');
};

window.closeProjectModal = function() {
    const modal = document.getElementById('projectModal');
    if (modal) modal.classList.remove('active');
};

// Close modal when clicking outside content
document.addEventListener('DOMContentLoaded', () => {
    const projectModal = document.getElementById('projectModal');
    if (projectModal) {
        projectModal.addEventListener('click', function (e) {
            if (e.target === this) closeProjectModal();
        });
    }
});

// --- Admin CMS Functions ---
window.openAdminModal = function(projectId = null) {
    const modal = document.getElementById('adminModal');
    const form = document.getElementById('adminForm');
    form.reset();
    
    document.getElementById('adminDeleteBtn').style.display = 'none';

    if (projectId) {
        document.getElementById('adminModalTitle').innerText = "Edit Project";
        document.getElementById('adminProjectId').value = projectId;
        
        let localProjects = JSON.parse(localStorage.getItem('customAibelProjects')) || [];
        let project = localProjects.find(p => p.id === projectId);
        
        if (!project) {
            project = (typeof aibelProjects !== 'undefined' ? aibelProjects : []).find(p => p.id === projectId);
            if (project) {
                document.getElementById('adminProjectType').value = 'completed';
            } else {
                project = (typeof aibelUpcomingProjects !== 'undefined' ? aibelUpcomingProjects : []).find(p => p.id === projectId);
                if (project) document.getElementById('adminProjectType').value = 'upcoming';
            }
        } else {
            document.getElementById('adminProjectType').value = project.isUpcoming ? 'upcoming' : 'completed';
        }

        if (project) {
            document.getElementById('adminProjectTitle').value = project.title || '';
            document.getElementById('adminProjectCategory').value = project.category || '';
            document.getElementById('adminProjectYear').value = project.year || '';
            document.getElementById('adminProjectDesc').value = project.description || '';
            document.getElementById('adminOriginalIsUpcoming').value = project.isUpcoming ? "true" : "false";
            document.getElementById('adminDeleteBtn').style.display = 'block';
        }
    } else {
        document.getElementById('adminModalTitle').innerText = "Add New Project";
        document.getElementById('adminProjectId').value = 'proj-' + Date.now();
        document.getElementById('adminProjectType').value = 'completed';
        document.getElementById('adminOriginalIsUpcoming').value = "false";
    }

    if (modal) modal.classList.add('active');
};

window.closeAdminModal = function() {
    const modal = document.getElementById('adminModal');
    if (modal) modal.classList.remove('active');
};

function readImagesAsBase64(files) {
    return Promise.all(Array.from(files).map(file => {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = e => resolve(e.target.result);
            reader.onerror = reject;
            reader.readAsDataURL(file);
        });
    }));
}

window.saveAdminProject = async function() {
    const title = document.getElementById('adminProjectTitle').value;
    const category = document.getElementById('adminProjectCategory').value;
    const year = document.getElementById('adminProjectYear').value;
    const desc = document.getElementById('adminProjectDesc').value;
    const type = document.getElementById('adminProjectType').value;
    const isUpcoming = (type === 'upcoming');
    const id = document.getElementById('adminProjectId').value;
    const imageFiles = document.getElementById('adminProjectImages').files;

    if (!title || !category || !year || !desc) {
        alert("Please fill out all text fields.");
        return;
    }

    if (!id.startsWith('proj-') && imageFiles.length === 0) {
        // Handled
    } else if (imageFiles.length === 0 && id.startsWith('proj-')) {
        alert("Please upload at least one image for a new project.");
        return;
    }

    let newImages = [];
    if (imageFiles.length > 0) {
        newImages = await readImagesAsBase64(imageFiles);
    }

    let localProjects = JSON.parse(localStorage.getItem('customAibelProjects')) || [];
    let existingIndex = localProjects.findIndex(p => p.id === id);

    let projectObj = {
        id: id,
        title: title,
        category: category,
        year: year,
        description: desc,
        isUpcoming: isUpcoming,
        images: newImages
    };

    if (existingIndex !== -1) {
        if (imageFiles.length === 0) projectObj.images = localProjects[existingIndex].images;
        localProjects[existingIndex] = projectObj;
    } else {
        if (imageFiles.length === 0) {
           let oldProject = (typeof aibelProjects !== 'undefined' ? aibelProjects : []).find(p => p.id === id);
           if (!oldProject) oldProject = (typeof aibelUpcomingProjects !== 'undefined' ? aibelUpcomingProjects : []).find(p => p.id === id);
           if (oldProject) projectObj.images = oldProject.images;
        }
        localProjects.push(projectObj);
    }

    localStorage.setItem('customAibelProjects', JSON.stringify(localProjects));
    closeAdminModal();
    window.location.reload();
};

window.deleteAdminProject = function() {
    const id = document.getElementById('adminProjectId').value;
    if (confirm("Are you sure you want to delete this project?")) {
        let localProjects = JSON.parse(localStorage.getItem('customAibelProjects')) || [];
        localProjects = localProjects.filter(p => p.id !== id);
        
        let hiddenProjects = JSON.parse(localStorage.getItem('customHiddenAibelProjects')) || [];
        hiddenProjects.push(id);
        localStorage.setItem('customHiddenAibelProjects', JSON.stringify(hiddenProjects));
        
        localStorage.setItem('customAibelProjects', JSON.stringify(localProjects));
        closeAdminModal();
        window.location.reload();
    }
};

window.exportProjectData = function() {
    // Collect all data
    const hardcodedProjects = typeof aibelProjects !== 'undefined' ? aibelProjects : [];
    const hardcodedUpcoming = typeof aibelUpcomingProjects !== 'undefined' ? aibelUpcomingProjects : [];
    
    // Merge with local storage edits
    const localProjects = JSON.parse(localStorage.getItem('customAibelProjects')) || [];
    const hiddenProjects = JSON.parse(localStorage.getItem('customHiddenAibelProjects')) || [];

    function merge(hardcoded, isUpcoming) {
        let merged = [...hardcoded];
        const targetedLocal = localProjects.filter(p => p.isUpcoming === isUpcoming);
        
        targetedLocal.forEach(lp => {
            const existingIndex = merged.findIndex(p => p.id === lp.id);
            if (existingIndex !== -1) {
                merged[existingIndex] = lp;
            } else {
                merged.push(lp);
            }
        });
        return merged.filter(p => !hiddenProjects.includes(p.id));
    }

    const finalCompleted = merge(hardcodedProjects, false);
    const finalUpcoming = merge(hardcodedUpcoming, true);

    // Format as projects-data.js content
    const fileContent = `const aibelProjects = ${JSON.stringify(finalCompleted, null, 4)};\n\nconst aibelUpcomingProjects = ${JSON.stringify(finalUpcoming, null, 4)};\n`;

    // Trigger download
    const blob = new Blob([fileContent], { type: 'text/javascript' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'projects-data.js';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
    
    alert("Project data exported! Please replace the existing 'projects-data.js' file with this one and then run the 1-Click-Upload tool.");
};

// --- Team Carousel Logic (Coverflow) ---
document.addEventListener('DOMContentLoaded', () => {
    const teamCarousel = document.getElementById('team-carousel');
    const prevBtn = document.getElementById('team-prev');
    const nextBtn = document.getElementById('team-next');
    
    if (teamCarousel) {
        // Filenames from the employees directory
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

        // Format string properly
        function capitalizeWords(str) {
            return str.split(' ').map(word => {
                if (word.length === 0) return word;
                if (word.toLowerCase() === 'and') return 'and';
                return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
            }).join(' ');
        }

        const cards = [];

        employeeFiles.forEach((filename, index) => {
            const nameWithoutExt = filename.substring(0, filename.lastIndexOf('.'));
            const parts = nameWithoutExt.split('-');
            
            let name = parts[0] ? parts[0].trim() : 'Team Member';
            let title = parts[1] ? parts[1].trim() : '';
            
            if (title.includes('#D')) {
                title = title.replace('#D', '3D');
            }
            if (title.toLowerCase().includes('manger')) {
                title = title.replace(/manger/i, 'Manager');
            }
            
            title = capitalizeWords(title);

            const memberCard = document.createElement('div');
            memberCard.className = 'team-member';
            memberCard.dataset.title = title;
            memberCard.innerHTML = `
                <div class="team-member-img-wrapper">
                    <img src="employees/${encodeURIComponent(filename)}" alt="${name}">
                </div>
                <div class="team-member-info">
                    <h3>${name}</h3>
                    <span>${title}</span>
                </div>
            `;
            
            // Allow clicking a side card to make it active
            memberCard.addEventListener('click', () => {
                updateCarousel(index);
            });
            
            teamCarousel.appendChild(memberCard);
            cards.push(memberCard);
        });

        // Default State: Start with 'Marketing Director'
        let currentIndex = cards.findIndex(card => card.dataset.title === 'Marketing Director');
        if (currentIndex === -1) currentIndex = Math.floor(cards.length / 2); // Fallback

        function updateCarousel(newIndex) {
            if (cards.length === 0) return;
            
            // Handle wrapping
            if (newIndex < 0) newIndex = cards.length - 1;
            if (newIndex >= cards.length) newIndex = 0;
            
            currentIndex = newIndex;

            cards.forEach((card, i) => {
                card.className = 'team-member'; // Reset classes
                
                // Calculate distance considering wrap-around
                let diff = (i - currentIndex + cards.length) % cards.length;
               
                // Wrap logic for determining left vs right
                if (diff > cards.length / 2) {
                    diff -= cards.length;
                }
                
                if (diff === 0) {
                    card.classList.add('active');
                } else if (diff === -1) {
                    card.classList.add('prev');
                } else if (diff === 1) {
                    card.classList.add('next');
                } else if (diff === -2) {
                    card.classList.add('prev-prev');
                } else if (diff === 2) {
                    card.classList.add('next-next');
                }
            });
        }

        if(prevBtn) prevBtn.addEventListener('click', () => updateCarousel(currentIndex - 1));
        if(nextBtn) nextBtn.addEventListener('click', () => updateCarousel(currentIndex + 1));

        // Initial setup
        updateCarousel(currentIndex);
    }
});
