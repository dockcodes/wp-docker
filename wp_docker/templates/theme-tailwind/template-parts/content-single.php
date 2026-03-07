<article>
    <h1 class="text-4xl font-bold mb-6">
        <?php the_title(); ?>
    </h1>
    <div class="text-sm text-gray-500 mb-10">
        <?php echo get_the_date(); ?>
    </div>
    <div class="prose max-w-none">
        <?php the_content(); ?>
    </div>
</article>