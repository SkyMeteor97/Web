<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> sections and everything up till <div id="content">
 *
 * @package forest
 */
?>
<?php get_template_part('modules/header/head'); ?>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'forest' ); ?></a>

    <?php get_template_part('modules/header/jumbosearch'); ?>
    <?php get_template_part('modules/header/top','bar'); ?>
    <?php get_template_part('modules/header/masthead'); ?>
	
	<?php get_template_part('slider', 'swiper'); ?>
	<?php get_template_part('featured', 'showcase'); ?>
	
	<div class="mega-container">
		
		<?php if (class_exists('woocommerce')) : ?>	
		<?php get_template_part('framework/featured-components/coverflow', 'product'); ?>
		<?php get_template_part('framework/featured-components/featured-products','showcase'); ?>
		<?php endif; ?>
		<?php get_template_part('framework/featured-components/coverflow', 'posts'); ?>
		<?php get_template_part('framework/featured-components/featured-posts','showcase'); ?>
        <?php get_template_part('framework/featured-components/featured', 'showcase'); ?>
        <?php get_template_part('framework/featured-components/featured', 'pi'); ?>
        <?php get_template_part('framework/featured-components/featured', 'lamda'); ?>

	
		<div id="content" class="site-content container">