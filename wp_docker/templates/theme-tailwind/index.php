<?php get_header(); ?>
    <main class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid md:grid-cols-3 gap-10">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();

                    get_template_part('template-parts/post', 'card');

                endwhile;
            endif;
            ?>
        </div>
    </main>
<?php get_footer(); ?>