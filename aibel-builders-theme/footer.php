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

    <?php wp_footer(); ?>
</body>
</html>
