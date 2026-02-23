<?php
/**
 * The template for displaying all pages
 */
$postImg = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail');
get_header(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header col-12">
            <div class="wrap flex">
                <?php
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                }
                ?>
                <h1 class="page-title">
                    <?php the_title();; ?>
                </h1>
            </div>
        </header>
        <section class="entry-content col-12">
            <div class="wrap-md wrap-content">
                <?php
                the_content();
                ?>
            </div>
        </section>
    </article>
<?php get_footer();