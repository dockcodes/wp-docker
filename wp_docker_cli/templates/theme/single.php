<?php

/**
 * The template for displaying post
 */


$imagePost = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail');

get_header(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header col-12 single-header">
        <div class="wrap flex">

            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
            }
            ?>
            <h1 class="page-title">
                <?php
                the_title();
                ?>
            </h1>
            <div class="col-12 d-flex entry-first badge">
                <?php echo get_the_date(); ?>
                <?= $postExcerpt ?>
            </div>

        </div>
    </header>
    <section class="entry-content col-12 d-flex">
        <div class="wrap d-flex wrap-content">
            <div class="col-12 row-image lazybg" data-lazybg="<?= $imagePost ?>"></div>
            <div class="row-single-content d-flex-nw">
                <div class="right-single">
                    <?php if (has_excerpt()) { ?>
                        <div class="col-12 row-content d-flex text-center big-text"><?php the_excerpt()  ?></div>
                    <?php } ?>
                    <div class="col-12 row-content no-flex">
                        <?php
                        the_content();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>
<?php get_footer();
