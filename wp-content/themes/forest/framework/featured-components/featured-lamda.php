<?php if(get_theme_mod('forest_farea2_enable') && is_front_page()):?>
<div id="featured-lamda" class="featured-section-area">
    <div class="col-md-12 col-sm-12">
	    
        <?php if(get_theme_mod('forest_farea2_title')):?>
	        <div class="section-title">
	            <?php echo get_theme_mod('forest_farea2_title'); ?>
	        </div>
        <?php endif;?>
        
        <?php /* Start the Loop */ $count=0; ?>
        <?php
        $args = array( 'posts_per_page' => 3, 'category' => get_theme_mod('forest_farea2_cat') );
        $lastposts = get_posts( $args );
        foreach ( $lastposts as $post ) :
            setup_postdata( $post ); ?>
            

            <div class="lamda-wrapper col-md-4 col-sm-4">
                    <div class="featured-thumb">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><?php the_post_thumbnail('forest-thumb'); ?></a>
                        <?php else : ?>
                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/placeholder2.jpg"; ?>"></a>
                        <?php endif; ?>
                        
                        <p class="description">
                        	<?php echo substr(get_the_excerpt(),0,120).(get_the_excerpt() ? "..." : "" ); ?>
                        </p>
                        
                        <h2><?php the_title(); ?></h2>
                        
                    </div>
                    
                        
                        
            </div>
            
            
            <?php $count++;
            if ($count == 4) break;
        endforeach; ?>
        
        
        <?php wp_reset_postdata(); ?>
    </div>

</div>
<?php endif;?>