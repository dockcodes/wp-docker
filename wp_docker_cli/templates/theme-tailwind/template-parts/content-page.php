<article>
    <?php
    $layout = get_field('layout');
    if ($layout) {
        foreach ($layout as $section) {
            $file = locate_template('template-parts/sections/' . $section . '.php');
            if ($file) {
                get_template_part('template-parts/sections/' . $section);
            }
        }
    }
    ?>
</article>