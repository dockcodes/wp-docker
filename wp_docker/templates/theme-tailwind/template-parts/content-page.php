<?php
/**
 * Template part: Page Content
 */

global $post;

if (!$post) {
    return;
}
?>

<article class="py-12 md:py-16">
    <div class="max-w-4xl mx-auto px-4">
        <header class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">
                <?php echo esc_html(get_the_title()); ?>
            </h1>
        </header>
        <div class="prose prose-lg max-w-none">
            <?php the_content(); ?>
        </div>
    </div>
</article>