    <!-- Global Footer -->
    <footer>
        <div class="container footer-content">
            <div class="footer-grid">
                <!-- Brand Column -->
                <div class="footer-brand footer-col">
                    <h2>AIBEL<span>.BUILDERS</span></h2>
                    <p>&copy; <?php echo date('Y'); ?> AIBEL.BUILDERS.<br>All rights reserved.</p>
                    <div class="social-links">
                        <a href="https://www.instagram.com/aibel_builders?igsh=enByMnpldDdrdDdt" target="_blank">Instagram</a>
                        <a href="#">LinkedIn</a>
                        <a href="https://www.facebook.com/profile.php?id=61579696347119" target="_blank">Facebook</a>
                    </div>
                </div>

                <!-- Quick Links Column -->
                <div class="footer-links footer-col">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url('/') ); ?>">Home</a></li>
                        <li><a href="<?php echo esc_url( get_page_link( get_page_by_path('about') ) ); ?>">About</a></li>
                        <li><a href="<?php echo esc_url( get_page_link( get_page_by_path('projects') ) ); ?>">Projects</a></li>
                        <li><a href="<?php echo esc_url( get_page_link( get_page_by_path('gallery') ) ); ?>">Gallery</a></li>
                        <li><a href="<?php echo esc_url( get_page_link( get_page_by_path('careers') ) ); ?>">Careers</a></li>
                        <li><a href="<?php echo esc_url( get_page_link( get_page_by_path('contact') ) ); ?>">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact Details Column -->
                <div class="footer-contact footer-col">
                    <h3>Contact Us</h3>
                    <address>Pulikkan HyperMarket<br>1st Floor, Bazar Road,<br>Puthukkad, Thrissur</address>
                    <div class="footer-contact-methods">
                        <a href="tel:+918075934563">Phone: 8075934563 | 9048891982</a>
                        <a href="mailto:aibeldibin@gmail.com">Email: aibeldibin@gmail.com</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Lightbox Modal (Global) -->
    <div class="lightbox" id="lightbox">
        <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
        <img id="lightbox-img" src="" alt="Expanded Image">
    </div>

    <!-- Floating Action Buttons -->
    <div class="fab-container">
        <a href="https://maps.google.com/?q=Pulikkan+HyperMarket,1st+Floor,Bazar+Road,Puthukkad,Thrissur" target="_blank" class="fab-item map-fab" aria-label="Location">
            <svg class="fab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
            <span class="fab-label">Get Directions</span>
        </a>
        <a href="mailto:aibeldibin@gmail.com" class="fab-item email-fab" aria-label="Email Us">
            <svg class="fab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
            <span class="fab-label">Email Us</span>
        </a>
        <a href="tel:+918075934563" class="fab-item phone-fab" aria-label="Call Us">
            <svg class="fab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
            <span class="fab-label">+91 8075934563</span>
        </a>
    </div>

    <?php wp_footer(); ?>
</body>
</html>
