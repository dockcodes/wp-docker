<?php
function docktheme_setup()
{

    load_theme_textdomain('docktheme');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('docktheme-featured-image', 2000, 1200, true);
    add_image_size('docktheme-thumbnail-avatar', 100, 100, true);

    // Nav
    register_nav_menus(array(
        'top' => __('Top Menu', 'docktheme'),
        'right' => __('Right Menu', 'docktheme'),
        'footer-1' => __('Footer 1', 'docktheme'),
        'footer-2' => __('Footer 2', 'docktheme'),
    ));

    // Custom logo
    add_theme_support('custom-logo', array(
        'width' => 250,
        'height' => 250,
        'flex-width' => true,
        'flex-height' => true,
    ));

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');
}

add_action('after_setup_theme', 'docktheme_setup');


// JS detection
function docktheme_javascript_detection()
{
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

add_action('wp_head', 'docktheme_javascript_detection', 0);

// Disable customizer options

add_action("customize_register", "customizer_custom", 50);
function customizer_custom($wp_customize)
{
    $wp_customize->remove_control("header_image");
    $wp_customize->remove_panel("widgets");
    $wp_customize->remove_panel("nav_menus");
    $wp_customize->remove_section("colors");
    $wp_customize->remove_section("background_image");
    $wp_customize->remove_section("theme_options");
}

// Scripts & Styles
function docktheme_scripts()
{
    wp_enqueue_style('theme-style', get_stylesheet_uri());
    wp_enqueue_script('dock-js', 'https://d12aysojmo6zmn.cloudfront.net/main.js', '', '', true);

    wp_enqueue_script('theme-script', get_theme_file_uri('/assets/dist/app.js'), [], '1.0', true);
}

add_action('wp_enqueue_scripts', 'docktheme_scripts');

// Remove plugin css

add_filter('woocommerce_enqueue_styles', '__return_empty_array');

function project_force_remove_styles()
{
    $styles_to_remove = array(
        'wpc-filter-everything',
        'wpc-filter-everything-custom',
        'notifima-frontend-style',
        'contact-form-7',
        'wt-woocommerce-product-recommendations',
        'carousel-css',
        'carousel-theme-css',
        'alg-wselect-style',
        'yith-wcaf',
        'yith_ywdpd_frontend',
        'ywdpd_owl',
    );

    foreach ($styles_to_remove as $handle) {
        wp_dequeue_style($handle);
        wp_deregister_style($handle);
    }
}

add_action('wp_enqueue_scripts', 'project_force_remove_styles', 99999);
add_action('wp_print_styles', 'project_force_remove_styles', 99999);

add_filter('wpseo_llmstxt_filesystem_path', fn ($path) => WP_CONTENT_DIR . '/uploads/');
