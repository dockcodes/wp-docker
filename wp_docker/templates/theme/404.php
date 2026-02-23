<?php
/**
 * The template for displaying 404 pages (not found)
 */
get_header(); ?>
    <section class="entry-content error-404 not-found col-12">
        <header class="entry-header col-12">
            <div class="wrap flex">
                <h1 class="page-title">
                    <?php _e('Nie znaleziono strony', 'docktheme') ?>
                </h1>
                <div class="buttons col-12" style="justify-content: center">
                    <a class="btn btn-primary" href="<?= get_home_url() ?>"><?php _e('Wróć do strony głównej', 'docktheme') ?></a></div>
            </div>
        </header>
        <?php get_template_part('partials/products', 'slider', ['recent' => true]);
?>
    </section>
<?php get_footer();