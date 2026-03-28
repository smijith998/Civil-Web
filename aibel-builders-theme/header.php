<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<?php
// Determine body class: home page has no inner-page class
$body_class = is_front_page() ? '' : 'inner-page';
?>
<body <?php body_class( $body_class ); ?>>

    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container top-bar-content">
            <div class="top-contact">
                <a href="tel:+918075934563">Phone: 8075934563 | 9048891982</a>
                <a href="mailto:aibeldibin@gmail.com">Email: aibeldibin@gmail.com</a>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav id="navbar">
        <div class="nav-container">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="logo">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/Logo.png" alt="Aibel Builders" class="logo-img">
                <span class="logo-text">Aibel<span class="logo-accent"> Builders</span></span>
            </a>
            <ul class="nav-links">
                <li><a href="<?php echo esc_url( home_url('/') ); ?>" <?php echo is_front_page() ? 'class="active"' : ''; ?>>Home</a></li>
                <li><a href="<?php echo esc_url( get_page_link( get_page_by_path('about') ) ); ?>" <?php echo is_page('about') ? 'class="active"' : ''; ?>>About</a></li>
                <li><a href="<?php echo esc_url( get_page_link( get_page_by_path('projects') ) ); ?>" <?php echo is_page('projects') ? 'class="active"' : ''; ?>>Projects</a></li>
                <li><a href="<?php echo esc_url( get_page_link( get_page_by_path('gallery') ) ); ?>" <?php echo is_page('gallery') ? 'class="active"' : ''; ?>>Gallery</a></li>
                <li><a href="<?php echo esc_url( get_page_link( get_page_by_path('careers') ) ); ?>" <?php echo is_page('careers') ? 'class="active"' : ''; ?>>Careers</a></li>
                <li><a href="<?php echo esc_url( get_page_link( get_page_by_path('contact') ) ); ?>" <?php echo is_page('contact') ? 'class="active"' : ''; ?>>Contact</a></li>
            </ul>
            <div class="hamburger" id="hamburger">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </div>
    </nav>
