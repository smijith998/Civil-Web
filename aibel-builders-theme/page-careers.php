<?php
/**
 * Template Name: Careers
 * page-careers.php – Career listings from Career CPT (maps to careers.html)
 */
get_header();
?>

<!-- Page Header -->
<section class="page-header" style="background-image: linear-gradient(rgba(5,5,5,0.7), rgba(5,5,5,0.9)), url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/arch_hero.png');">
    <div class="container reveal fade-up">
        <h1>Join The Studio</h1>
        <p>Shape the future of architectural design with us.</p>
    </div>
</section>

<!-- Careers Section -->
<section class="careers-section content-section">
    <div class="container">
        <div class="careers-content reveal fade-up">
            <h2>Current Opportunities</h2>
            <p>We are always looking for visionary thinkers. If you have a passion for transformative design, explore our open positions below.</p>

            <div class="jobs-list">
                <?php
                $careers = new WP_Query([
                    'post_type'      => 'career',
                    'posts_per_page' => -1,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ]);

                if ( $careers->have_posts() ) :
                    while ( $careers->have_posts() ) : $careers->the_post();
                        $location    = get_post_meta( get_the_ID(), '_career_location', true );
                        $type        = get_post_meta( get_the_ID(), '_career_type', true );
                        $description = get_post_meta( get_the_ID(), '_career_description', true );
                        $apply_link  = get_post_meta( get_the_ID(), '_career_apply_link', true );
                        $label       = trim( $type . ' · ' . $location, ' ·' );
                ?>
                <div class="job-item">
                    <div class="job-title">
                        <h3><?php the_title(); ?></h3>
                        <span><?php echo esc_html( $label ); ?></span>
                        <?php if ( $description ) : ?>
                        <p style="margin-top:0.5rem; font-size:0.95rem; color:var(--text-muted); max-width:500px;"><?php echo esc_html( $description ); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php
                    $apply_href = $apply_link ? esc_url( $apply_link ) : esc_url( get_page_link( get_page_by_path('contact') ) );
                    ?>
                    <a href="<?php echo $apply_href; ?>" class="btn-outline">Apply Now</a>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else : ?>
                <p style="color:var(--text-muted); text-align:center; margin-top:3rem;">
                    No open positions at the moment. Check back soon, or <a href="<?php echo esc_url( get_page_link( get_page_by_path('contact') ) ); ?>" style="color:var(--accent);">reach out directly</a>.
                </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
