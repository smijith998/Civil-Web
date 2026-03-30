<?php
/**
 * Template Name: Gallery
 * page-gallery.php – Gallery grid auto-populated from all project images (maps to gallery.html)
 */
get_header();
?>

<!-- Page Header -->
<section class="page-header" style="background-image: linear-gradient(rgba(5,5,5,0.7), rgba(5,5,5,0.9)), url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/arch_project2.png');">
    <div class="container reveal fade-up">
        <h1>Gallery</h1>
        <p>A visual journey through our finest structural accomplishments.</p>
    </div>
</section>

<!-- Gallery Section -->
<section class="content-section">
    <div class="container">
        <div class="section-header reveal fade-up">
            <h2>Our Architecture</h2>
        </div>

        <?php
        $gallery_query = new WP_Query([
            'post_type'      => 'project',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        if ( $gallery_query->have_posts() ) :
            while ( $gallery_query->have_posts() ) : $gallery_query->the_post();
                $images = aibel_get_project_images( get_the_ID() );
                if ( empty( $images ) ) continue;
        ?>
        <div style="margin-bottom:4rem;">
            <h3 class="gallery-category-title reveal fade-up active"><?php the_title(); ?></h3>
            <div class="gallery-grid">
                <?php foreach ( $images as $img_url ) : ?>
                <div class="gallery-item reveal active fade-up" onclick="openLightbox('<?php echo esc_url( $img_url ); ?>')">
                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
            endwhile;
            wp_reset_postdata();
        else : ?>
        <p style="color:var(--text-muted); text-align:center; margin-top:3rem;">
            No gallery images yet. Add projects with images via <strong>WordPress Admin → Projects</strong>.
        </p>
        <?php endif; ?>
    </div>
</section>



<?php get_footer(); ?>
