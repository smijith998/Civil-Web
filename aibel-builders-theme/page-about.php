<?php
/**
 * Template Name: About
 * page-about.php – About page (maps to about.html)
 */
get_header();
?>

<!-- Page Header -->
<section class="page-header" style="background-image: linear-gradient(rgba(5,5,5,0.7), rgba(5,5,5,0.9)), url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/arch_project2.png');">
    <div class="container reveal fade-up">
        <h1>Our Philosophy</h1>
        <p>Crafting boundaries that define freedom.</p>
    </div>
</section>

<!-- Full About Section -->
<section class="about-section content-section">
    <div class="container">
        <div class="about-grid">
            <div class="about-text reveal fade-right">
                <h2>Vision &amp; History</h2>
                <p>Aibel Builders is a trusted home construction company in Kerala, specializing in modern house construction, architectural design, interior works, and complete turnkey solutions. With a proven track record of delivering excellence across state lines, we have successfully completed over 50 projects in Bangalore and more than 60 works throughout Kerala.</p>
                <div class="stats">
                    <div class="stat-item">
                        <?php
                        $completed_count = wp_count_posts('project');
                        $count = $completed_count->publish ?? '..';
                        ?>
                        <h3><?php echo esc_html($count); ?> + </h3>
                        <span>Projects Completed</span>
                    </div>
                </div>
            </div>
            <div class="about-image-wrapper reveal fade-left">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/founder/dibin_poulose.jpeg" alt="Founder - Dibin Poulose" class="about-img">
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="team-section content-section">
    <div class="container">
        <div class="section-header reveal fade-up">
            <h2>Meet Our Team</h2>
            <p>The dedicated professionals behind Aibel Builders.</p>
        </div>

        <div class="team-carousel-container reveal fade-up delay-1">
            <button class="carousel-btn prev-btn" id="team-prev" aria-label="Previous">&#10094;</button>
            <div class="team-carousel" id="team-carousel">
            </div>
            <button class="carousel-btn next-btn" id="team-next" aria-label="Next">&#10095;</button>
        </div>
    </div>
</section>

<?php get_footer(); ?>
