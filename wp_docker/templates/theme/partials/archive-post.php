<?php

/**
 * Archive post
 */
if (isset($post) && isset($post->ID)) {
    $postLink = get_permalink($post->ID);
} else {
    $postLink = '';
}
$postImg = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail');
?>

<a class="single-post d-flex col-6" href="<?php echo $postLink; ?>">
    <?php if (has_post_thumbnail()) { ?>
        <div class="post-thumb col-12 lazybg" data-lazybg="<?= $postImg ?>">
            <div class="next-event-date ">
                <span class="date-day"><?php echo get_the_modified_date('j'); ?></span><span class="smalltime"><?php echo get_the_modified_date('M Y'); ?></span>
            </div>
        </div>
    <?php } ?>
    <div class="post-bottom d-flex col-12">
        <h3 class="post-title col-12">
            <?= the_title() ?>
        </h3>
        <?php echo get_sentences_excerpt(2); ?>
        <button class="btn btn-white"><?php _e('Read more', 'docktheme') ?></button>
    </div>
</a>