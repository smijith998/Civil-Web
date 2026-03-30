<?php
/**
 * Template Name: Projects
 * page-projects.php – Full projects list with modal (maps to projects.html)
 */
get_header();
?>

<!-- Page Header -->
<section class="page-header" style="background-image: linear-gradient(rgba(5,5,5,0.7), rgba(5,5,5,0.9)), url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/arch_project1.png');">
    <div class="container reveal fade-up">
        <h1>Our Portfolio</h1>
        <p>A showcase of our landmark architectural expressions.</p>
    </div>
</section>

<!-- Completed Projects -->
<section class="projects-section content-section">
    <div class="container">
        <div class="section-header reveal fade-up">
            <h2>Completed Projects</h2>
        </div>
        <div id="full-projects-container">
            <?php
            $completed = new WP_Query([
                'post_type'      => 'project',
                'posts_per_page' => -1,
                'meta_key'       => '_project_status',
                'meta_value'     => 'completed',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ]);
            if ( $completed->have_posts() ) :
                while ( $completed->have_posts() ) : $completed->the_post();
                    $category  = get_post_meta( get_the_ID(), '_project_category', true );
                    $year      = get_post_meta( get_the_ID(), '_project_year', true );
                    $description = get_post_meta( get_the_ID(), '_project_description', true );
                    $images = aibel_get_project_images( get_the_ID() );
            ?>
            <div class="reveal fade-up active" style="margin-bottom: 6rem;">
                <div class="project-head" style="margin-bottom: 2rem; position: relative;">
                    <h2 style="font-size: 2.5rem; color: var(--accent); margin-bottom: 0.5rem; padding-right: 6rem;"><?php the_title(); ?></h2>
                    <span style="display:block; color: var(--text-muted); text-transform:uppercase; letter-spacing:1px; margin-bottom: 1rem;"><?php echo esc_html( $category ); ?> / <?php echo esc_html( $year ); ?></span>
                    <p style="max-width: 800px; font-size: 1.1rem; color: var(--text-main); margin-bottom: 2rem;"><?php echo esc_html( $description ); ?></p>
                </div>
                <div class="gallery-grid" style="display:grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                    <?php if ( $images && is_array( $images ) ) : foreach ( $images as $img ) : ?>
                    <div class="gallery-item" onclick="if(typeof openLightbox === 'function') openLightbox('<?php echo esc_url( $img ); ?>')">
                        <img src="<?php echo esc_url( $img ); ?>" alt="<?php the_title_attribute(); ?>" style="width:100%; height:100%; object-fit:cover; aspect-ratio:1; cursor:pointer;">
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); else : ?>
            <p style="color:var(--text-muted); text-align:center; width:100%;">No completed projects yet. Add some via WordPress Admin → Projects.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Upcoming Projects -->
<section class="projects-section" style="background:#080808; border-top:1px solid var(--glass-border); padding-top:6rem; padding-bottom:8rem;">
    <div class="container">
        <div class="section-header reveal fade-up">
            <h2>Upcoming Projects</h2>
            <p>A glimpse into the future of architectural innovation.</p>
        </div>
        <div id="upcoming-projects-container">
            <?php
            $upcoming = new WP_Query([
                'post_type'      => 'project',
                'posts_per_page' => -1,
                'meta_key'       => '_project_status',
                'meta_value'     => 'upcoming',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ]);
            if ( $upcoming->have_posts() ) :
                while ( $upcoming->have_posts() ) : $upcoming->the_post();
                    $category  = get_post_meta( get_the_ID(), '_project_category', true );
                    $year      = get_post_meta( get_the_ID(), '_project_year', true );
                    $description = get_post_meta( get_the_ID(), '_project_description', true );
                    $images = aibel_get_project_images( get_the_ID() );
            ?>
            <div class="reveal fade-up active" style="margin-bottom: 6rem;">
                <div class="project-head" style="margin-bottom: 2rem; position: relative;">
                    <h2 style="font-size: 2.5rem; color: var(--accent); margin-bottom: 0.5rem; padding-right: 6rem;"><?php the_title(); ?></h2>
                    <span style="display:block; color: var(--text-muted); text-transform:uppercase; letter-spacing:1px; margin-bottom: 1rem;"><?php echo esc_html( $category ); ?> / <?php echo esc_html( $year ); ?></span>
                    <p style="max-width: 800px; font-size: 1.1rem; color: var(--text-main); margin-bottom: 2rem;"><?php echo esc_html( $description ); ?></p>
                </div>
                <div class="gallery-grid" style="display:grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                    <?php if ( $images && is_array( $images ) ) : foreach ( $images as $img ) : ?>
                    <div class="gallery-item" onclick="if(typeof openLightbox === 'function') openLightbox('<?php echo esc_url( $img ); ?>')">
                        <img src="<?php echo esc_url( $img ); ?>" alt="<?php the_title_attribute(); ?>" style="width:100%; height:100%; object-fit:cover; aspect-ratio:1; cursor:pointer;">
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); else : ?>
            <p style="color:var(--text-muted); text-align:center; width:100%;">No upcoming projects yet.</p>
            <?php endif; ?>
        </div>
    </div>
</section>



<?php get_footer(); ?>
