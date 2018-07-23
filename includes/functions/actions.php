<?php 

add_action('woocommerce_single_product_summary', 'getbowtied_single_product_share', 31); 

add_action( 'header_sticky_socials', 'getbowtied_sticky_socials');
if ( !function_exists( 'getbowtied_sticky_socials' )) {
	function getbowtied_sticky_socials() {
		?>
		<li> 
          <a href="//facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="header-sticky-blog-facebook" target="_blank"> 
            <i class="thehanger-icons-facebook-f"></i> 
            <span><?php _e('Facebook', 'the-hanger'); ?></span> 
          </a> 
        </li> 

        <li> 
          <a href="//twitter.com/share?url=<?php the_permalink(); ?>" class="header-sticky-blog-twitter" target="_blank"> 
            <i class="thehanger-icons-twitter"></i> 
            <span><?php _e('Twitter', 'the-hanger'); ?></span> 
          </a> 
        </li> 
		<?php
	}
}
  			