<?php
/**
 * Aibel Builders – functions.php
 * Registers Custom Post Types, Meta Boxes, and enqueues assets.
 */

// ============================================================
// 1. ENQUEUE STYLES & SCRIPTS
// ============================================================
add_action( 'wp_enqueue_scripts', 'aibel_enqueue_assets' );
function aibel_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style(
        'aibel-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap',
        [],
        null
    );
    // Main theme stylesheet
    wp_enqueue_style( 'aibel-style', get_stylesheet_uri(), [ 'aibel-google-fonts' ], '1.0.0' );

    // Main JS
    wp_enqueue_script( 'aibel-script', get_template_directory_uri() . '/js/script.js', [], '1.0.0', true );
}

// ============================================================
// 2. THEME SUPPORTS
// ============================================================
add_action( 'after_setup_theme', 'aibel_theme_setup' );
function aibel_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );
}

// ============================================================
// 3. REGISTER CUSTOM POST TYPES
// ============================================================
add_action( 'init', 'aibel_register_post_types' );
function aibel_register_post_types() {

    // ----- PROJECT -----
    register_post_type( 'project', [
        'labels' => [
            'name'               => 'Projects',
            'singular_name'      => 'Project',
            'add_new'            => 'Add New Project',
            'add_new_item'       => 'Add New Project',
            'edit_item'          => 'Edit Project',
            'new_item'           => 'New Project',
            'view_item'          => 'View Project',
            'search_items'       => 'Search Projects',
            'not_found'          => 'No projects found',
            'all_items'          => 'All Projects',
            'menu_name'          => 'Projects',
        ],
        'public'              => true,
        'has_archive'         => false,
        'rewrite'             => [ 'slug' => 'aibel-project' ],
        'supports'            => [ 'title', 'thumbnail' ],
        'show_in_rest'        => true,
        'menu_icon'           => 'dashicons-building',
        'menu_position'       => 5,
    ] );

    // ----- CAREER -----
    register_post_type( 'career', [
        'labels' => [
            'name'               => 'Careers',
            'singular_name'      => 'Career',
            'add_new'            => 'Add New Job',
            'add_new_item'       => 'Add New Job Listing',
            'edit_item'          => 'Edit Job Listing',
            'new_item'           => 'New Job',
            'view_item'          => 'View Job',
            'search_items'       => 'Search Jobs',
            'not_found'          => 'No job listings found',
            'all_items'          => 'All Job Listings',
            'menu_name'          => 'Careers',
        ],
        'public'              => true,
        'has_archive'         => false,
        'rewrite'             => [ 'slug' => 'aibel-career' ],
        'supports'            => [ 'title' ],
        'show_in_rest'        => true,
        'menu_icon'           => 'dashicons-id',
        'menu_position'       => 6,
    ] );
}

// ============================================================
// 4. REGISTER META BOXES
// ============================================================
add_action( 'add_meta_boxes', 'aibel_register_meta_boxes' );
function aibel_register_meta_boxes() {
    // Project Details
    add_meta_box(
        'aibel_project_details',
        'Project Details',
        'aibel_project_details_cb',
        'project',
        'normal',
        'high'
    );
    // Project Images Gallery
    add_meta_box(
        'aibel_project_images',
        'Project Gallery Images',
        'aibel_project_images_cb',
        'project',
        'normal',
        'high'
    );
    // Career Details
    add_meta_box(
        'aibel_career_details',
        'Job Details',
        'aibel_career_details_cb',
        'career',
        'normal',
        'high'
    );
}

// ---- Project Details Meta Box ----
function aibel_project_details_cb( $post ) {
    wp_nonce_field( 'aibel_project_nonce_action', 'aibel_project_nonce' );
    $category    = get_post_meta( $post->ID, '_project_category', true );
    $year        = get_post_meta( $post->ID, '_project_year', true );
    $description = get_post_meta( $post->ID, '_project_description', true );
    $status      = get_post_meta( $post->ID, '_project_status', true ) ?: 'completed';
    ?>
    <table class="form-table" style="width:100%;">
        <tr>
            <th style="width:150px;"><label for="project_category">Category</label></th>
            <td><input type="text" id="project_category" name="project_category" value="<?php echo esc_attr( $category ); ?>" placeholder="e.g. Residential" style="width:100%;" /></td>
        </tr>
        <tr>
            <th><label for="project_year">Year</label></th>
            <td><input type="text" id="project_year" name="project_year" value="<?php echo esc_attr( $year ); ?>" placeholder="e.g. 2025" style="width:100%;" /></td>
        </tr>
        <tr>
            <th><label for="project_description">Description</label></th>
            <td><textarea id="project_description" name="project_description" rows="5" style="width:100%;"><?php echo esc_textarea( $description ); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="project_status">Status</label></th>
            <td>
                <select id="project_status" name="project_status" style="width:100%;">
                    <option value="completed" <?php selected( $status, 'completed' ); ?>>Completed</option>
                    <option value="upcoming"  <?php selected( $status, 'upcoming' ); ?>>Upcoming</option>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

// ---- Project Images Meta Box ----
function aibel_project_images_cb( $post ) {
    $image_ids = get_post_meta( $post->ID, '_project_image_ids', true );
    $image_ids = $image_ids ? $image_ids : '';
    ?>
    <div id="aibel-gallery-wrap">
        <div id="aibel-gallery-preview" style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:15px;">
            <?php
            if ( $image_ids ) {
                $ids_array = explode( ',', $image_ids );
                foreach ( $ids_array as $img_id ) {
                    $img_url = wp_get_attachment_image_url( (int) $img_id, 'thumbnail' );
                    if ( $img_url ) {
                        echo '<img src="' . esc_url( $img_url ) . '" style="width:100px;height:100px;object-fit:cover;border-radius:4px;border:2px solid #555;" />';
                    }
                }
            }
            ?>
        </div>
        <input type="hidden" id="aibel_project_image_ids" name="aibel_project_image_ids" value="<?php echo esc_attr( $image_ids ); ?>" />
        <button type="button" class="button button-primary" id="aibel-upload-images-btn">
            <?php echo $image_ids ? 'Change / Add Images' : 'Upload Images'; ?>
        </button>
        <?php if ( $image_ids ) : ?>
            <button type="button" class="button" id="aibel-clear-images-btn" style="margin-left:10px;color:#a00;border-color:#a00;">Remove All Images</button>
        <?php endif; ?>
        <p class="description" style="margin-top:8px;">Select multiple images using the WordPress media library. These will appear in the Gallery page and the project modal.</p>
    </div>

    <script type="text/javascript">
    jQuery(document).ready(function($) {
        var mediaFrame;

        $('#aibel-upload-images-btn').on('click', function(e) {
            e.preventDefault();
            if (mediaFrame) { mediaFrame.open(); return; }
            mediaFrame = wp.media({
                title: 'Select Project Images',
                button: { text: 'Use These Images' },
                multiple: true
            });
            mediaFrame.on('select', function() {
                var attachments = mediaFrame.state().get('selection').toJSON();
                var ids = attachments.map(function(a) { return a.id; }).join(',');
                $('#aibel_project_image_ids').val(ids);
                var preview = $('#aibel-gallery-preview');
                preview.empty();
                attachments.forEach(function(att) {
                    var src = att.sizes && att.sizes.thumbnail ? att.sizes.thumbnail.url : att.url;
                    preview.append('<img src="' + src + '" style="width:100px;height:100px;object-fit:cover;border-radius:4px;border:2px solid #c0a062;" />');
                });
            });
            mediaFrame.open();
        });

        $('#aibel-clear-images-btn').on('click', function(e) {
            e.preventDefault();
            $('#aibel_project_image_ids').val('');
            $('#aibel-gallery-preview').empty();
        });
    });
    </script>
    <?php
}

// Enqueue media scripts in admin for project post type
add_action( 'admin_enqueue_scripts', 'aibel_admin_scripts' );
function aibel_admin_scripts( $hook ) {
    global $post;
    if ( ( $hook === 'post-new.php' || $hook === 'post.php' ) && isset( $post ) && $post->post_type === 'project' ) {
        wp_enqueue_media();
    }
}

// ---- Career Details Meta Box ----
function aibel_career_details_cb( $post ) {
    wp_nonce_field( 'aibel_career_nonce_action', 'aibel_career_nonce' );
    $location    = get_post_meta( $post->ID, '_career_location', true );
    $type        = get_post_meta( $post->ID, '_career_type', true ) ?: 'Full-time';
    $description = get_post_meta( $post->ID, '_career_description', true );
    $apply_link  = get_post_meta( $post->ID, '_career_apply_link', true );
    ?>
    <table class="form-table" style="width:100%;">
        <tr>
            <th style="width:150px;"><label for="career_location">Location</label></th>
            <td><input type="text" id="career_location" name="career_location" value="<?php echo esc_attr( $location ); ?>" placeholder="e.g. Thrissur / Remote" style="width:100%;" /></td>
        </tr>
        <tr>
            <th><label for="career_type">Employment Type</label></th>
            <td>
                <select id="career_type" name="career_type" style="width:100%;">
                    <option value="Full-time"  <?php selected( $type, 'Full-time' ); ?>>Full-time</option>
                    <option value="Part-time"  <?php selected( $type, 'Part-time' ); ?>>Part-time</option>
                    <option value="Contract"   <?php selected( $type, 'Contract' ); ?>>Contract</option>
                    <option value="Internship" <?php selected( $type, 'Internship' ); ?>>Internship</option>
                    <option value="Remote"     <?php selected( $type, 'Remote' ); ?>>Remote</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="career_description">Role Description</label></th>
            <td><textarea id="career_description" name="career_description" rows="4" style="width:100%;"><?php echo esc_textarea( $description ); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="career_apply_link">Apply Link / Email</label></th>
            <td><input type="text" id="career_apply_link" name="career_apply_link" value="<?php echo esc_attr( $apply_link ); ?>" placeholder="https://... or mailto:..." style="width:100%;" /></td>
        </tr>
    </table>
    <?php
}

// ============================================================
// 5. SAVE META BOX DATA
// ============================================================
add_action( 'save_post_project', 'aibel_save_project_meta' );
function aibel_save_project_meta( $post_id ) {
    // Security checks
    if ( ! isset( $_POST['aibel_project_nonce'] ) || ! wp_verify_nonce( $_POST['aibel_project_nonce'], 'aibel_project_nonce_action' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $fields = [
        'project_category'    => '_project_category',
        'project_year'        => '_project_year',
        'project_description' => '_project_description',
        'project_status'      => '_project_status',
    ];
    foreach ( $fields as $key => $meta_key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[ $key ] ) );
        }
    }
    // Save image IDs (comma-separated)
    if ( isset( $_POST['aibel_project_image_ids'] ) ) {
        $raw_ids = sanitize_text_field( $_POST['aibel_project_image_ids'] );
        update_post_meta( $post_id, '_project_image_ids', $raw_ids );
    }
}

add_action( 'save_post_career', 'aibel_save_career_meta' );
function aibel_save_career_meta( $post_id ) {
    if ( ! isset( $_POST['aibel_career_nonce'] ) || ! wp_verify_nonce( $_POST['aibel_career_nonce'], 'aibel_career_nonce_action' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $fields = [
        'career_location'    => '_career_location',
        'career_type'        => '_career_type',
        'career_description' => '_career_description',
        'career_apply_link'  => '_career_apply_link',
    ];
    foreach ( $fields as $key => $meta_key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[ $key ] ) );
        }
    }
}

// ============================================================
// 6. HELPER FUNCTION – Get Project Image URLs
// ============================================================
function aibel_get_project_images( $post_id ) {
    $image_ids = get_post_meta( $post_id, '_project_image_ids', true );
    $urls = [];
    if ( $image_ids ) {
        foreach ( explode( ',', $image_ids ) as $img_id ) {
            $url = wp_get_attachment_image_url( (int) $img_id, 'large' );
            if ( $url ) $urls[] = $url;
        }
    }
    return $urls;
}

function aibel_get_project_thumbnail( $post_id ) {
    $images = aibel_get_project_images( $post_id );
    return $images ? $images[0] : get_template_directory_uri() . '/assets/arch_project1.png';
}

// ============================================================
// 7. FORCE CORRECT TEMPLATES BY PAGE SLUG
//    This bypasses manual template assignment in WP Admin.
//    As long as pages exist with the correct slugs, the right
//    template is automatically loaded.
// ============================================================
add_filter( 'template_include', 'aibel_force_page_templates' );
function aibel_force_page_templates( $template ) {
    if ( ! is_page() ) return $template;

    $slug_map = [
        'about'    => 'page-about.php',
        'projects' => 'page-projects.php',
        'gallery'  => 'page-gallery.php',
        'careers'  => 'page-careers.php',
        'contact'  => 'page-contact.php',
    ];

    $slug = get_post_field( 'post_name', get_queried_object_id() );

    if ( isset( $slug_map[ $slug ] ) ) {
        $custom_template = get_template_directory() . '/' . $slug_map[ $slug ];
        if ( file_exists( $custom_template ) ) {
            return $custom_template;
        }
    }

    return $template;
}
