<?php
/**
 * index.php – WordPress fallback template.
 * Shown for any page/post without a specific template.
 */
get_header();
?>
<section class="content-section" style="padding-top:12rem;">
    <div class="container">
        <h1 style="color:var(--accent);">Content Not Found</h1>
        <p>Sorry, we could not find what you were looking for. <a href="<?php echo esc_url( home_url('/') ); ?>" style="color:var(--accent);">Return home</a>.</p>
    </div>
</section>
<?php get_footer(); ?>
