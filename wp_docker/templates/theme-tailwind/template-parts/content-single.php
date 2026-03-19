<?php
/**
 * Template part: Single Content
 */

global $post;

if (!$post) {
    return;
}
?>

<article class="py-12 md:py-16">
    <div class="max-w-3xl mx-auto px-4">

        <?php if (has_post_thumbnail()) : ?>
            <div class="mb-8">
                <?php the_post_thumbnail('full', [
                    'class' => 'w-full h-auto rounded-xl',
                    'loading' => 'lazy'
                ]); ?>
            </div>
        <?php endif; ?>

        <header class="mb-6">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                <?php the_title(); ?>
            </h1>

            <div class="text-sm text-gray-500 flex items-center gap-4">
                <span><?php echo esc_html(get_the_author()); ?></span>
                <span>•</span>
                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                    <?php echo esc_html(get_the_date()); ?>
                </time>
            </div>
        </header>

        <div class="prose prose-lg max-w-none">
            <?php the_content(); ?>
        </div>

    </div>
</article>