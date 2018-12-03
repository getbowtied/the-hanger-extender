<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

include_once 'functions/function-setup.php';
include_once 'functions/function-helpers.php';

//==============================================================================
//	Frontend Output
//==============================================================================
function gbt_18_th_render_frontend_posts_grid( $attributes ) {

	extract( shortcode_atts( array(
		'number'				=> '12',
		'categoriesSavedIDs'	=> '',
		'align'					=> 'center',
		'orderby'				=> 'date_desc',
		'columns'				=> '3'
	), $attributes ) );

	$args = array(
        'post_status' 		=> 'publish',
        'post_type' 		=> 'post',
        'posts_per_page' 	=> $number
    );

    switch ( $orderby ) {
    	case 'date_asc' :
			$args['orderby'] = 'date';
			$args['order']	 = 'asc';
			break;
		case 'date_desc' :
			$args['orderby'] = 'date';
			$args['order']	 = 'desc';
			break;
		case 'title_asc' :
			$args['orderby'] = 'title';
			$args['order']	 = 'asc';
			break;
		case 'title_desc':
			$args['orderby'] = 'title';
			$args['order']	 = 'desc';
			break;
		default: break;
	}

    if( substr($categoriesSavedIDs, - 1) == ',' ) {
		$categoriesSavedIDs = substr( $categoriesSavedIDs, 0, -1);
	}

	if( substr($categoriesSavedIDs, 0, 1) == ',' ) {
		$categoriesSavedIDs = substr( $categoriesSavedIDs, 1);
	}

    if( $categoriesSavedIDs != '' ) $args['category'] = $categoriesSavedIDs;
    
    $recentPosts = get_posts( $args );

    $post_columns = '4';

    switch( $columns ) {
    	case '1':
    		$post_columns = '12';
    		break;
    	case '2':
    		$post_columns = '6';
    		break;
    	case '3':
    		$post_columns = '4';
    		break;
    	case '4':
    		$post_columns = '3';
    		break;
    	default:
    		$post_columns = '4';
    		break;
    }

	ob_start();
	        
    if ( !empty($recentPosts) ) : ?>

	    <div class="wp-block-gbt-posts-grid">

			<div class="gbt_shortcode_blog_posts <?php echo $align; ?>">
				<div class="row">
			                    
			        <?php foreach($recentPosts as $post) : ?>
			    
			        	<div class="small-12 medium-4 large-<?php echo $post_columns; ?> columns">

							<div class="gbt_shortcode_blog_post">

								<?php if ( has_post_thumbnail($post->ID) ) : ?>
								<div class="gbt_shortcode_blog_posts_image">
									<a href="<?php echo get_post_permalink($post->ID); ?>">
										<?php echo get_the_post_thumbnail($post->ID, 'large'); ?>
										<?php echo get_the_post_thumbnail($post->ID, 'thumbnail'); ?>
									</a>
								</div>
								<?php endif; ?>

								<div class="gbt_shortcode_blog_posts_content">
									<div class="gbt_shortcode_blog_posts_meta">
										<a href="<?php echo get_post_permalink($post->ID); ?>" rel="bookmark">
											<time class="entry-date published" datetime="<?php echo get_the_date( DATE_W3C, $post->ID ); ?>">
												<?php echo get_the_date( '', $post->ID ); ?>
											</time>
										</a>
									</div>
									<h4 class="gbt_shortcode_blog_posts_title site-secondary-font">
										<a href="<?php echo get_post_permalink($post->ID); ?>">
											<?php echo $post->post_title; ?>
										</a>
									</h4>
								</div>

							</div>

						</div>

			        <?php endforeach; // end of the loop. ?>

	        	</div>
	        </div>
	    </div>

    <?php

    endif;
	        
	wp_reset_query();

	return ob_get_clean();
}