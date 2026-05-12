<?php
/**
 * Template part: Post Card
 */

global $post;

if (!$post) {
    return;
}
?>

<article class="flex flex-col overflow-hidden rounded-2xl shadow-md bg-white">

    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>" class="block overflow-hidden">
            <?php the_post_thumbnail('medium_large', [
                'class' => 'w-full h-56 object-cover transition-transform duration-300 hover:scale-105',
                'loading' => 'lazy'
            ]); ?>
        </a>
    <?php endif; ?>

    <div class="flex flex-col flex-1 p-6">

        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="text-sm text-gray-500 mb-2">
            <?php echo esc_html(get_the_date()); ?>
        </time>

        <h3 class="text-lg font-semibold text-gray-900 mb-3">
            <a href="<?php the_permalink(); ?>" class="hover:text-gray-700">
                <?php the_title(); ?>
            </a>
        </h3>

        <?php if (has_excerpt()) : ?>
            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                <?php echo esc_html(get_the_excerpt()); ?>
            </p>
        <?php endif; ?>

        <div class="mt-auto">
            <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-sm font-medium text-black hover:underline">
                <?php esc_html_e('Read more', 'docktheme'); ?>
            </a>
        </div>
    </div>
</article>