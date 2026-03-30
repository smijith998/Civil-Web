<?php
/**
 * Template Name: Home
 * front-page.php – Static front page (maps to index.html)
 */
get_header();
?>

<!-- Hero Section -->
<section id="home" class="hero">
    <div class="hero-slideshow">
        <div class="hero-slide active" style="background-image: url('<?php echo esc_url( get_template_directory_uri() ); ?>/Scroll-Home/img1.jpeg');"></div>
        <div class="hero-slide" style="background-image: url('<?php echo esc_url( get_template_directory_uri() ); ?>/Scroll-Home/img2.jpeg');"></div>
        <div class="hero-slide" style="background-image: url('<?php echo esc_url( get_template_directory_uri() ); ?>/Scroll-Home/img3.jpeg');"></div>
        <div class="hero-slide" style="background-image: url('<?php echo esc_url( get_template_directory_uri() ); ?>/Scroll-Home/img4.jpeg');"></div>
        <div class="hero-slide" style="background-image: url('<?php echo esc_url( get_template_directory_uri() ); ?>/Scroll-Home/img5.jpeg');"></div>
        <div class="hero-slide" style="background-image: url('<?php echo esc_url( get_template_directory_uri() ); ?>/Scroll-Home/img6.jpeg');"></div>
    </div>
    <div class="hero-overlay"></div>
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
                    <span>-Dibin Poulose-</span>
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
        <div class="featured-slider-container reveal fade-up delay-1" id="featured-slider">
            <?php
            $featured = new WP_Query([
                'post_type'      => 'project',
                'posts_per_page' => 4,
                'meta_key'       => '_project_status',
                'meta_value'     => 'completed',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ]);
            $is_first = true;
            while ( $featured->have_posts() ) : $featured->the_post();
                $category  = get_post_meta( get_the_ID(), '_project_category', true );
                $year      = get_post_meta( get_the_ID(), '_project_year', true );
                $thumb_url = aibel_get_project_thumbnail( get_the_ID() );
                $active_class = $is_first ? ' active' : '';
                $is_first = false;
            ?>
            <div class="featured-slide<?php echo $active_class; ?>" style="background-image: url('<?php echo esc_url( $thumb_url ); ?>');">
                <div class="featured-caption">
                    <h3><?php echo esc_html( get_the_title() ); ?></h3>
                    <span><?php echo esc_html( $category ); ?> / <?php echo esc_html( $year ); ?></span>
                    <a href="<?php echo esc_url( get_page_link( get_page_by_path('projects') ) ); ?>" class="view-btn" style="margin-top: 1.5rem; display: inline-block;">View Gallery</a>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
            <button class="slider-nav-btn prev-btn" id="featured-prev" aria-label="Previous Project">&#10094;</button>
            <button class="slider-nav-btn next-btn" id="featured-next" aria-label="Next Project">&#10095;</button>
        </div>
        <div class="reveal fade-up delay-3" style="text-align:center; margin-top:4rem;">
            <a href="<?php echo esc_url( get_page_link( get_page_by_path('projects') ) ); ?>" class="btn">View All Projects</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
