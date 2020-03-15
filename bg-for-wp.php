<?php
/**
 * Plugin Name: My First Plugin
 * Plugin URI: https://www.bhargav.blog/bg-for-wp
 * Description: Hello World Shortcode plugin, Custom Widget Plugin.
 * Version: 1.0
 * Author: Bhargav Mehta
 * Author URI: https://www.bhargav.blog
 */

function bg_for_wp_shortcode() {
	$message = 'Hello World!';
	return $message;
}

	add_shortcode( 'hello-world', 'bg_for_wp_shortcode' );

function wpbg_load_widget() {
	register_widget( 'Wpbg_Widget' );
}
add_action( 'widgets_init', 'wpbg_load_widget' );
class Wpbg_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'wpbg_widget',
			__( 'Custom Widget', 'wpbg_text_domain' ),
			array( 'description' => __( 'Custom Widget for testing Widget Skills', 'wpbg_text_domain' ) )
		);
	}

	public function widget( $args, $instance ) {
		$title    = apply_filters( 'widget_title', $instance['title'] );
		$checkbox = apply_filters( 'widget_checkbox', $instance['checkbox'] );
		$text     = apply_filters( 'widget_text', $instance['text'] );

		echo $args['before_widget'];

		if ( ! empty( $title ) && $checkbox ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		if ( ! empty( $text ) && $checkbox ) {
			echo '<p>' . $text . '</p>';
		}
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = __( 'New title', 'wpbg_text_domain' );
		}
		if ( isset( $instance['checkbox'] ) ) {
			$checkbox = $instance['checkbox'];
		} else {
			$checkbox = 0;
		}
		if ( isset( $instance['text'] ) ) {
			$text = $instance['text'];
		} else {
			$text = __( 'New text', 'wpbg_text_domain' );
		}
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title', 'bg_for_wp_widget_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<input id="<?php echo esc_attr( $this->get_field_id( 'checkbox' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'checkbox' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'checkbox' ) ); ?>"><?php _e( 'Visible', 'bg_for_wp_widget_domain' ); ?></label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php _e( 'Text:', 'bg_for_wp_widget_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>" />
		</p>
		<?php
	}
	public function update( $new_instance, $old_instance ) {
		$instance             = array();
		$instance['title']    = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['checkbox'] = isset( $new_instance['checkbox'] ) ? 1 : false;
		$instance['text']     = isset( $new_instance['text'] ) ? wp_strip_all_tags( $new_instance['text'] ) : '';
		return $instance;
	}
}
