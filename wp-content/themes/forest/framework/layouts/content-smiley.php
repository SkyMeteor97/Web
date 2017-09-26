<?php
/**
 * @package Forest
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12 col-sm-12 col-xs-12 grid smiley'); ?>>

    <div class="featured-wrapper">
    <div class="featured-thumb col-md-6 col-sm-6 col-xs-12">
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><?php the_post_thumbnail('forest-sq-thumb'); ?></a>
        <?php else: ?>
            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/smiley-dummy.png"; ?>"></a>
        <?php endif; ?>
    </div><!--.featured-thumb-->

<!--<div class="col-md-1 col-sm-0 col-xs-1"></div>-->
    <div class="out-thumb col-md-6 col-sm-6 col-xs-12">
        <header class="entry-header">
            <h1 class="entry-title title-font"><a class="hvr-underline-reveal" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        </header><!-- .entry-header -->
    </div><!--.out-thumb-->
    </div>


    <div class="blank">
        <div class="blank-cnt">

        </div>
    </div>
</article><!-- #post-## -->