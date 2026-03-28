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
                <p>Aibel Builders is a trusted home construction company in Kerala, specializing in modern house construction, architectural design, interior works, and complete turnkey solutions.</p>
                <div class="stats">
                    <div class="stat-item">
                        <?php
                        $completed_count = wp_count_posts('project');
                        $count = $completed_count->publish ?? '..';
                        ?>
                        <h3><?php echo esc_html($count); ?>+</h3>
                        <span>Projects Completed</span>
                    </div>
                    <div class="stat-item">
                        <h3>..</h3>
                        <span>Awards</span>
                    </div>
                </div>
            </div>
            <div class="about-image-wrapper reveal fade-left">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/arch_project2.png" alt="Interior Architecture" class="about-img">
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
