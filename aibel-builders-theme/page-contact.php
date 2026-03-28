<?php
/**
 * Template Name: Contact
 * page-contact.php – Contact page with Formspree form (maps to contact.html)
 */
get_header();
?>

<!-- Page Header -->
<section class="page-header" style="background-image: linear-gradient(rgba(5,5,5,0.7), rgba(5,5,5,0.9)), url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/arch_project2.png');">
    <div class="container reveal fade-up">
        <h1>Start a Conversation</h1>
        <p>Have a visionary project in mind? Let's bring it to life.</p>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section content-section">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-info reveal fade-right">
                <h2>Reach Out</h2>
                <p>Whether you are considering a new sustainable project or exploring opportunities, our team is ready to connect.</p>
                <div class="contact-details">
                    <div class="detail">
                        <span>Email</span>
                        <a href="mailto:aibeldibin@gmail.com">aibeldibin@gmail.com</a>
                    </div>
                    <div class="detail">
                        <span>Phone</span>
                        <a href="tel:+918075934563">8075934563</a> | <a href="tel:+919048891982">9048891982</a>
                    </div>
                    <div class="detail">
                        <span>Studio</span>
                        <address>Pulikkan HyperMarket<br>1st Floor, Bazar Road,<br>Puthukkad, Thrissur</address>
                        <a href="https://www.google.com/maps/search/?api=1&query=Pulikkan+HyperMarket,+Bazar+Road,+Puthukkad,+Thrissur" target="_blank" class="btn-outline map-btn" style="margin-top:1rem; display:inline-flex; align-items:center; gap:0.5rem; font-size:0.8rem; padding:0.5rem 1rem;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            View on Google Maps
                        </a>
                    </div>
                </div>
            </div>

            <div class="contact-form-wrapper reveal fade-left">
                <form id="contactForm" class="glass-form" action="https://formspree.io/f/mvzwjooq" method="POST">
                    <div class="input-group">
                        <input type="text" id="name" name="name" required placeholder=" ">
                        <label for="name">Your Name</label>
                    </div>
                    <div class="input-group">
                        <input type="email" id="email" name="email" required placeholder=" ">
                        <label for="email">Email Address</label>
                    </div>
                    <div class="input-group">
                        <select id="inquiry" name="inquiry" required>
                            <option value="" disabled selected>Nature of Inquiry</option>
                            <option value="residential">Residential Project</option>
                            <option value="commercial">Commercial Project</option>
                            <option value="career">Job Application</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <textarea id="message" name="message" rows="4" required placeholder=" "></textarea>
                        <label for="message">Project Details</label>
                    </div>
                    <button type="submit" class="btn btn-full">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
