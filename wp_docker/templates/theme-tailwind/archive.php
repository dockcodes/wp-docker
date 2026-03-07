<?php get_header(); ?>
    <main class="max-w-7xl mx-auto px-6 py-16">
        <header class="mb-12">
            <h1 class="text-4xl font-bold">
                <?php the_archive_title(); ?>
            </h1>
            <p class="text-gray-600">
                <?php the_archive_description(); ?>
            </p>
        </header>
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