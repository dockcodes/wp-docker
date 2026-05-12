<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class("bg-white text-gray-800"); ?>>
<header class="border-b">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <a class="text-xl font-bold" href="<?php echo home_url(); ?>">
            <?php bloginfo('name'); ?>
        </a>
        <nav>
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'flex gap-6 text-sm'
            ]);
            ?>
        </nav>
    </div>
</header>