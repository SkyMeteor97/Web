<?php
/**
 * @package Forest
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12 col-sm-12 grid calender'); ?>>
    <div class="wrapper">
        <div class="cal-title">

            <div class="fill-1">
                <header class="entry-header">
                    <h1 class="entry-title title-font"><a class="hvr-underline-reveal" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
                </header>
            </div>

        </div>
        <div class="col-md-12 col-sm-12 cal-img">
            <div class="col-md-4 col-sm-4 blank-2.1"></div>
            <div class="featured-thumb col-md-4 col-sm-4">
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><?php the_post_thumbnail('forest-smiley-thumb'); ?></a>
                <?php else: ?>
                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/placeholder2.jpg"; ?>"></a>
                <?php endif; ?>
                <div class="col-md-4 col-sm-4 blank-2.2"></div>
            </div><!--.featured-thumb-->

        </div>
        <div class="col-md-12 col-sm-12 cal-excerpt">
            <div class="col-md-1 blank-3.1"></div>
            <div class="out-thumb col-md-10 col-sm-12 xs-12">
                <header class="entry-header">

                    <span class="entry-excerpt"><?php echo get_the_excerpt(); ?></span>
                    <span class="readmore"><a class="hvr-underline-from-center" href="<?php the_permalink() ?>"><?php _e('Read More','forest'); ?></a></span>
                </header><!-- .entry-header -->
            </div><!--.out-thumb-->
            <div class="col-md-1 blank-3.3"></div>
        </div>
        <div class="divider"></div>
    </div>
</article><!-- #post-## -->