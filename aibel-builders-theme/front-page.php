<?php
/**
 * Template Name: Home
 * front-page.php – Static front page (maps to index.html)
 */
get_header();
?>

<!-- Hero Section -->
<section id="home" class="hero">
    <div class="hero-bg" style="background-image: url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/arch_hero.png');"></div>
    <div class="hero-content">
        <h1 class="reveal fade-up">Visions Carved <br><span>In Concrete</span></h1>
        <p class="reveal fade-up delay-1">Pioneering sustainable and iconic architectural landscapes for tomorrow.</p>
        <a href="<?php echo esc_url( get_page_link( get_page_by_path('projects') ) ); ?>" class="btn reveal fade-up delay-2">Explore Projects</a>
    </div>
    <div class="scroll-indicator">
        <span>Scroll</span>
        <div class="mouse"><div class="wheel"></div></div>
    </div>
</section>

<!-- About Preview Section -->
<section id="about-preview" class="about-section">
    <div class="container">
        <div class="about-grid">
            <div class="about-text reveal fade-right">
                <h2>History &amp; Founders</h2>
                <p>Aibel Builders was established with a singular vision to redefine structural integrity and modern aesthetics. Guided by our founders' unwavering commitment to human-centric design, our studio has evolved over two decades into a powerhouse of architectural innovation.</p>
                <p>We blend uncompromising durability with fluid environments, pushing the limits of design and sustainability in every project.</p>
                <a href="<?php echo esc_url( get_page_link( get_page_by_path('about') ) ); ?>" class="btn-outline reveal fade-up delay-1" style="margin-top: 1rem; display: inline-block;">Read Full Story</a>
            </div>
            <div class="about-image-wrapper reveal fade-left">
                <div class="glass-card">
                    <p>"Architecture is not just about building walls; it's about crafting the silence between them."</p>
                    <span>- The Founders</span>
                </div>
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/founder/dibin_poulose.jpeg" alt="Founder - Dibin Poulose" class="about-img">
            </div>
        </div>
    </div>
</section>

<!-- Featured Projects Preview -->
<section id="projects-preview" class="projects-section" style="background:#080808; border-top:1px solid var(--glass-border);">
    <div class="container">
        <div class="section-header reveal fade-up">
            <h2>Featured Works</h2>
            <p>Explore our curation of award-winning structures.</p>
        </div>
        <div class="projects-grid">
            <?php
            $featured = new WP_Query([
                'post_type'      => 'project',
                'posts_per_page' => 4,
                'meta_key'       => '_project_status',
                'meta_value'     => 'completed',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ]);
            while ( $featured->have_posts() ) : $featured->the_post();
                $category  = get_post_meta( get_the_ID(), '_project_category', true );
                $year      = get_post_meta( get_the_ID(), '_project_year', true );
                $thumb_url = aibel_get_project_thumbnail( get_the_ID() );
            ?>
            <div class="project-card reveal fade-up" onclick="openProjectModal(<?php echo get_the_ID(); ?>)">
                <div class="project-img-wrapper">
                    <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>">
                    <div class="project-overlay">
                        <span class="view-btn">View Project</span>
                    </div>
                </div>
                <div class="project-info">
                    <h3><?php the_title(); ?></h3>
                    <span><?php echo esc_html( $category ); ?> &middot; <?php echo esc_html( $year ); ?></span>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="reveal fade-up delay-3" style="text-align:center; margin-top:4rem;">
            <a href="<?php echo esc_url( get_page_link( get_page_by_path('projects') ) ); ?>" class="btn">View All Projects</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
