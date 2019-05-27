<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class eCommerce_Info_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'theme_ecommerce_info', // Base ID
			__('eCommerce Info', 'the-hanger'), // Name
			array( 'description' => __( 'A widget that displays eCommerce Infos', 'the-hanger' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		$icon = apply_filters( 'widget_icon', $instance['icon'] );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$subtitle = apply_filters( 'widget_subtitle', $instance['subtitle'] );

		print $args['before_widget'];


		echo '<div class="ecommerce-info-widget-txt-wrapper">';
		
			if ( ! empty( $title ) ) echo '<div class="ecommerce-info-widget-title"><div class="ecommerce-info-widget-icon"><i class="' . $icon .'"></i></div>' . $args['before_title'] . $title . $args['after_title'] . '</div>';
			
			if ( ! empty( $subtitle ) ) echo '<div class="ecommerce-info-widget-subtitle">' . $subtitle .'</div>';

		echo '</div>';
		
		print $args['after_widget'];
	}

	public function form( $instance ) {

		if ( isset( $instance[ 'icon' ] ) ) {
			$icon = $instance[ 'icon' ];
		} else {
			$icon = "thehanger-icons-alignment_align-all-1";
		}
		
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = __( 'eCommerce Info Title', 'the-hanger' );
		}

		if ( isset( $instance[ 'subtitle' ] ) ) {
			$subtitle = $instance[ 'subtitle' ];
		} else {
			$subtitle = __( 'eCommerce Info Subtitle', 'the-hanger' );
		}

		?>

		<p>
			<input class="widefat icon_picker_input" id="<?php echo esc_attr($this->get_field_id( 'icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon' )); ?>" type="hidden" value="<?php echo esc_attr( $icon ); ?>">
			<div id="preview_icon_picker" data-target="#<?php echo esc_attr($this->get_field_id( 'icon' )); ?>" class="button icon-picker <?php echo esc_attr($icon); ?>"></div>
		</p>
		
        <p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'the-hanger' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'subtitle' )); ?>"><?php _e( 'Subtitle:', 'the-hanger' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'subtitle' )); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>">
		</p>
		
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['icon'] = ( ! empty( $new_instance['icon'] ) ) ? strip_tags( $new_instance['icon'] ) : '';
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['subtitle'] = ( ! empty( $new_instance['subtitle'] ) ) ? strip_tags( $new_instance['subtitle'] ) : '';

		return $instance;
	}

}

function register_ecommerce_info_widget() {
	register_widget( 'eCommerce_Info_Widget' );
}
add_action( 'widgets_init', 'register_ecommerce_info_widget' );
