<?php
/**
 * Front Page Template
 */

get_header(); ?>
<main>
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            $page_sections = get_field('page_sections');
            if ($page_sections) {
                foreach ($page_sections as $section) {
                    $section_name = str_replace('_', '-', $section['acf_fc_layout']);
                    $file = locate_template('template-parts/sections/' . $section_name . '.php');
                    if ($file) {
                        get_template_part('template-parts/sections/' . $section_name, null, ['section_data' => $section]);
                    }
                }
            }
        endwhile;
    endif;
    ?>
</main>
<?php get_footer(); ?>