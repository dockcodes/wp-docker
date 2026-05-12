<?php
get_header(); ?>
    <main>
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                if (have_rows('page_sections')) :
                    while (have_rows('page_sections')) : the_row();
                        $section_name = get_row_layout();
                        get_template_part('template-parts/sections/' . $section_name);
                    endwhile;
                endif;
            endwhile;
        endif;
        ?>
    </main>
<?php get_footer(); ?>