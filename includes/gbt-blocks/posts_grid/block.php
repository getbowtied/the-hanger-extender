<?php

// Posts Slider

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


add_action( 'enqueue_block_editor_assets', 'getbowtied_th_latest_posts_editor_assets' );

if ( ! function_exists( 'getbowtied_th_latest_posts_editor_assets' ) ) {
	function getbowtied_th_latest_posts_editor_assets() {
		
		wp_enqueue_script(
			'getbowtied-latest-posts',
			plugins_url( 'block.js', __FILE__ ),
			array( 'wp-blocks', 'wp-i18n', 'wp-element', 'jquery' ),
			filemtime( plugin_dir_path( __FILE__ ) . 'block.js' )
		);

		wp_enqueue_style(
			'getbowtied-latest-posts-grid-editor-css',
			plugins_url( 'css/editor.css', __FILE__ ),
			array( 'wp-blocks' )
		);
	}
}

add_action( 'enqueue_block_assets', 'getbowtied_th_latest_posts_assets' );

if ( ! function_exists( 'getbowtied_th_latest_posts_assets' ) ) {
	function getbowtied_th_latest_posts_assets() {
		
		wp_enqueue_style(
			'getbowtied-latest-posts-grid-css',
			plugins_url( 'css/style.css', __FILE__ ),
			array()
		);
	}
}

register_block_type( 'getbowtied/th-latest-posts-grid', array(
	'attributes'      					=> array(
		'number'						=> array(
			'type'						=> 'number',
			'default'					=> '12',
		),
		'category'						=> array(
			'type'						=> 'string',
			'default'					=> '',
		),
		'align'							=> array(
			'type'						=> 'string',
			'default'					=> 'center',
		),
		'columns'						=> array(
			'type'						=> 'number',
			'default'					=> '3'
		),
	),

	'render_callback' => 'getbowtied_render_frontend_th_latest_posts_grid',
) );

function getbowtied_render_frontend_th_latest_posts_grid( $attributes ) {

	extract( shortcode_atts( array(
		'number'	=> '12',
		'category'	=> 'All Categories',
		'align'		=> 'center',
		'columns'	=> '3'
	), $attributes ) );

	ob_start();
	?> 

	<div class="wp-block-gbt-posts-grid">

		<div class="gbt_shortcode_blog_posts <?php echo $align; ?>">
			<div class="row">
    									
				<?php

		        $args = array(
		            'post_status' 		=> 'publish',
		            'post_type' 		=> 'post',
		            'category' 			=> $category,
		            'posts_per_page' 	=> $number
		        );
		        
		        $recentPosts = get_posts( $args );

		        switch( $columns ) {
		        	case '2':
		        		$columns = '6';
		        		break;
		        	case '3':
		        		$columns = '4';
		        		break;
		        	case '4':
		        		$columns = '3';
		        		break;
		        	default:
		        		$columns = '4';
		        		break;
		        }
		        
		        if ( !empty($recentPosts) ) : ?>
		                    
		            <?php foreach($recentPosts as $post) : ?>
		        
		            	<div class="small-12 medium-4 large-<?php echo $columns; ?> columns">

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
		            
		        <?php

		        endif;
		        
		        ?> 

			</div>
		</div>

	</div>
	
	<?php

	wp_reset_query();

	return ob_get_clean();
}

add_action('wp_ajax_getbowtied_render_backend_th_latest_posts_grid', 'getbowtied_render_backend_th_latest_posts_grid');
function getbowtied_render_backend_th_latest_posts_grid() {

	$attributes = $_POST['attributes'];
	$output = '';
	$counter = 0;

	extract( shortcode_atts( array(
		'number'	=> '12',
		'category'	=> 'All Categories',
		'columns'	=> '3'
	), $attributes ) );

	$output = 'el( "div", { key: "wp-block-gbt-posts-grid", className: "wp-block-gbt-posts-grid"},';

		$output .= 'el( "div", { key: "latest_posts_grid_wrapper", className: "latest_posts_grid_wrapper columns-' . $columns . '"},';

			$args = array(
	            'post_status' 		=> 'publish',
	            'post_type' 		=> 'post',
	            'category' 			=> $category,
	            'posts_per_page' 	=> $number
	        );
	        
	        $recentPosts = get_posts( $args );

	        if ( !empty($recentPosts) ) :
	                    
	            foreach($recentPosts as $post) :
	        
	                $output .= 'el( "div", { key: "latest_posts_grid_item_' . $counter . '", className: "latest_posts_grid_item" },';

	                	$output .= 'el( "a", { key: "latest_posts_grid_link_' . $counter . '", className: "latest_posts_grid_link" },';

	                		$output .= 'el( "span", { key: "latest_posts_grid_img_container_' . $counter . '", className: "latest_posts_grid_img_container"},';
	                	
	                			if ( has_post_thumbnail($post->ID)) :

									$image_id = get_post_thumbnail_id($post->ID);
									$image_url = wp_get_attachment_image_src($image_id,'large', true);

									if( $image_url ) :

										$output .= 'el( "div", { key: "gbt_shortcode_blog_posts_image_' . $counter . '", className: "gbt_shortcode_blog_posts_image" },';
											
											$output .= 'el( "img", { src: "' . $image_url[0] . '" } ),';

										$output .= '),';

									endif;

								endif;

	                		$output .= '),';

							$output .= 'el( "p", { key: "latest_posts_grid_date_' . $counter . '", className: "latest_posts_grid_date" }, "' . esc_html(get_the_date( '', $post->ID )) . '"),';

							$output .= 'el( "span", { key: "latest_posts_grid_title_' . $counter . '", className: "latest_posts_grid_title" }, "' . esc_html($post->post_title) . '" )';

	                	$output .= ')';

	            	$output .= '),';

					$counter++;

				endforeach; 

	        endif;

		$output .= ')';

	$output .= ')';

	echo json_encode($output);
	exit;
}
