<?php

/**
 * The header for our theme
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg animate">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php get_template_part('svg') ?>



    <header id="masthead" class="site-header navigation-top" role="banner">

    </header>