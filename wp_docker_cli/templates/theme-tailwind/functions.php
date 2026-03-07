<?php

function custom_theme_setup()
{
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);

    register_nav_menus([
        'primary' => __('Primary Menu', 'dock-theme')
    ]);
}

add_action('after_setup_theme', 'custom_theme_setup');


function load_theme_scripts()
{
    wp_enqueue_style('theme-style', get_stylesheet_uri());
    wp_enqueue_script('dock-js', 'https://d12aysojmo6zmn.cloudfront.net/main.js', '', '', true);
    wp_enqueue_script('theme-script', get_theme_file_uri('/assets/dist/app.js'), [], '1.0', true);
}

add_action('wp_enqueue_scripts', 'load_theme_scripts');


function custom_register_acf_options()
{
    if (function_exists('acf_add_options_page')) {

        acf_add_options_page([
            'page_title' => 'Theme Settings',
            'menu_title' => 'Theme Settings',
            'menu_slug' => 'theme-settings',
            'capability' => 'edit_posts',
            'redirect' => false
        ]);

    }
}
add_action('init', 'custom_register_acf_options');

add_filter('wpseo_llmstxt_filesystem_path', fn($path) => WP_CONTENT_DIR . '/uploads/');
