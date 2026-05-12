<?php get_header(); ?>
<section class="py-32 text-center">
    <h1 class="text-6xl font-bold mb-6">
        404
    </h1>
    <p class="text-gray-600 mb-8">
        <?php esc_html_e('Page not found', 'docktheme') ?>
    </p>
    <a href="/" class="bg-black text-white px-6 py-3 rounded">
        <?php esc_html_e('Back to homepage', 'docktheme') ?>
    </a>
</section>
<?php get_footer(); ?>