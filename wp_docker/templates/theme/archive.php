<?php
/**
 * The template for displaying archive pages
 */
get_header();
?>
    <header class="entry-header blog-header col-12">
        <div class="wrap flex">
            <h1 class="page-title">
                <?php single_cat_title(); ?>
            </h1>
            <?php get_template_part('partials/blog', 'filters'); ?>
        </div>
    </header>
    <section class="entry-content col-12">
        <div class="wrap d-flex archive-wrap">
        <?php
        while (have_posts()) : the_post();
            if (isset($post) && is_object($post) && isset($post->ID)) {
                $link = get_permalink($post->ID);
                $thumbnail_id = get_post_thumbnail_id($post->ID);

                if ($thumbnail_id) {
                    $url = wp_get_attachment_url($thumbnail_id, 'thumbnail');
                } else {
                    $url = '';
                }
            } else {
                $link = $url = '';
            }
            get_template_part('partials/archive', 'post');
        endwhile;

        the_posts_pagination(array(
            'prev_text' => '',
            'next_text' => '',
            'before_page_number' => '',
        ));

        ?>
        </div>
    </section>
<?php get_footer();