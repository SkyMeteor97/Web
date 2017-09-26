<header id="masthead" class="site-header" role="banner">
    <div class="container masthead-container">
        <div class="site-branding">
            <?php if ( forest_has_logo() ) : ?>
                <div id="site-logo">
                    <?php forest_logo(); ?>
                </div>
            <?php endif; ?>
            <div id="text-title-desc">
                <h1 class="site-title title-font"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
            </div>
        </div>

        <div id="slickmenu"></div>
        <?php get_template_part('modules/navigation/menu','primary'); ?>

        <div id="top-links">
            <?php if (class_exists('woocommerce')) : ?>
                <div id="top-cart">
                    <div class="top-cart-icon">


                        <a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'forest'); ?>">
                            <div class="count"><?php echo sprintf(_n('%d item', '%d items', WC()->cart->cart_contents_count, 'forest'), WC()->cart->cart_contents_count);?></div>
                            <div class="total"> <?php echo WC()->cart->get_cart_total(); ?>
                            </div>
                        </a>

                        <i class="fa fa-shopping-cart"></i>
                    </div>
                </div>

                <div id="userlinks">
                    <?php if ( is_user_logged_in() ) { ?>
                        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','forest'); ?>"><?php _e('My Account','forest'); ?></a>
                    <?php }
                    else { ?>
                        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','forest'); ?>"><?php _e('Login / Register','forest'); ?></a>
                    <?php } ?>
                </div>

            <?php endif; ?>

            <div id="searchicon">
                <i class="fa fa-search"></i>
            </div>

        </div>
    </div><!--#top-links-->

</header><!-- #masthead -->