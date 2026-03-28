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
        <div class="projects-grid">
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
            <?php endwhile; wp_reset_postdata();
            else : ?>
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
        <div class="projects-grid">
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
                    <br><span style="color:var(--accent); font-size:0.8rem; text-transform:uppercase; letter-spacing:1px;">Upcoming</span>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata();
            else : ?>
            <p style="color:var(--text-muted); text-align:center; width:100%;">No upcoming projects yet.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Project Detail Modal -->
<div class="lightbox" id="projectModal">
    <span class="lightbox-close" onclick="closeProjectModal()">&times;</span>
    <div class="modal-container">
        <div class="modal-info">
            <h2 id="modalTitle">Project Title</h2>
            <p class="modal-meta"><span id="modalCategory">Category</span> / <span id="modalYear">Year</span></p>
            <p id="modalDescription">Description goes here.</p>
        </div>
        <div class="modal-gallery" id="modalGallery"></div>
    </div>
</div>

<!-- Project data for JS modal (encoded as JSON) -->
<script type="text/javascript">
var aibelWpProjects = <?php
    $all_projects_data = [];
    $all_projects = new WP_Query([
        'post_type'      => 'project',
        'posts_per_page' => -1,
    ]);
    while ( $all_projects->have_posts() ) :
        $all_projects->the_post();
        $pid = get_the_ID();
        $all_projects_data[] = [
            'id'          => $pid,
            'title'       => get_the_title(),
            'category'    => get_post_meta( $pid, '_project_category', true ),
            'year'        => get_post_meta( $pid, '_project_year', true ),
            'description' => get_post_meta( $pid, '_project_description', true ),
            'images'      => aibel_get_project_images( $pid ),
        ];
    endwhile;
    wp_reset_postdata();
    echo json_encode( $all_projects_data );
?>;

function openProjectModal(postId) {
    var project = aibelWpProjects.find(function(p) { return p.id === postId; });
    if (!project) return;
    document.getElementById('modalTitle').innerText = project.title;
    document.getElementById('modalCategory').innerText = project.category;
    document.getElementById('modalYear').innerText = project.year;
    document.getElementById('modalDescription').innerText = project.description;
    var gallery = document.getElementById('modalGallery');
    gallery.innerHTML = '';
    if (project.images && project.images.length) {
        project.images.forEach(function(src) {
            var img = document.createElement('img');
            img.src = src;
            img.alt = project.title;
            img.onclick = function() { openLightbox(src); };
            gallery.appendChild(img);
        });
    }
    document.getElementById('projectModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeProjectModal() {
    document.getElementById('projectModal').classList.remove('active');
    document.body.style.overflow = '';
}
document.getElementById('projectModal').addEventListener('click', function(e) {
    if (e.target === this) closeProjectModal();
});

function openLightbox(src) {
    var lb = document.getElementById('lightbox');
    document.getElementById('lightbox-img').src = src;
    lb.classList.add('active');
}
function closeLightbox() {
    document.getElementById('lightbox').classList.remove('active');
}
</script>

<!-- Lightbox -->
<div class="lightbox" id="lightbox">
    <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
    <img id="lightbox-img" src="" alt="Expanded Image">
</div>

<?php get_footer(); ?>
