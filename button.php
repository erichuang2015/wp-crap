<?php

// Widget to place bootstrap style button in sidebar or whereever


// Register and load the widget
function load_button_widget() {
	register_widget( 'button_widget' );
}
add_action( 'widgets_init', 'load_button_widget' );
 
// Creating the widget 
class button_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'button_widget', 
			__('Button Widget', 'button_widget_domain'), 
			array( 'description' => __( 'button', 'button_widget_domain' ), ) 
		);
	}
	// Creating widget front-end
	public function widget( $args, $instance ) {
		$buttonText = $instance['buttonText'];
		$buttonLink = $instance['buttonLink'];
		$buttonColor = $instance['buttonColor'];
		$buttonSize = $instance['buttonSize'];
		// before and after widget arguments are defined by themes
		//Starting displayed content
?>
		<div class="container donate">
			<a class="btn <?php echo esc_attr($buttonColor); ?> <?php echo esc_attr($buttonSize); ?> sr-button" href="<?php echo esc_attr($buttonLink); ?>"><?php echo esc_attr($buttonText); ?></a>
		</div>
<?php 
		//end displayed content
	}
	// Widget Backend  
	public function form( $instance ) {
		if ( isset( $instance[ 'buttonText' ] ) ) {
			$buttonText = $instance[ 'buttonText' ];
		} else {
			$buttonText = __( 'Donate Now', 'button_widget_domain' );
		}
		if ( isset( $instance[ 'buttonLink' ] ) ) {
			$buttonLink = $instance[ 'buttonLink' ];
		} else {
			$buttonLink = __( '/get-involved/ways-to-give/donate/', 'button_widget_domain' );
		}
		if ( isset( $instance[ 'buttonColor' ] ) ) {
			$buttonColor = $instance[ 'buttonColor' ];
		} else {
			$buttonColor = __( 'btn-dark', 'button_widget_domain' );
		}
		if ( isset( $instance[ 'buttonSize' ] ) ) {
			$buttonSize = $instance[ 'buttonSize' ];
		} else {
			$buttonSize = __( 'btn-xl', 'button_widget_domain' );
		}
	// Widget admin form
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'buttonText' ); ?>"><?php _e( 'Button Text:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'buttonText' ); ?>" name="<?php echo $this->get_field_name( 'buttonText' ); ?>" type="text" value="<?php echo esc_attr( $buttonText ); ?>" />

			<label for="<?php echo $this->get_field_id( 'buttonLink' ); ?>"><?php _e( 'Button Link:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'buttonLink' ); ?>" name="<?php echo $this->get_field_name( 'buttonLink' ); ?>" type="text" value="<?php echo esc_attr( $buttonLink ); ?>" />

			<label for="<?php echo $this->get_field_id( 'buttonSize' ); ?>"><?php _e( 'Button Size:' ); ?> <?php echo esc_attr( $buttonSize ); ?></label> 
			<select id="<?php echo $this->get_field_id('buttonSize'); ?>" name="<?php echo $this->get_field_name('buttonSize'); ?>" class="widefat">
				<option <?php selected( $instance['buttonSize'], 'btn-xl'); ?> value="btn-xl">XL</option>
				<option <?php selected( $instance['buttonSize'], 'btn-lg'); ?> value="btn-lg">LG</option> 
				<option <?php selected( $instance['buttonSize'], 'btn'); ?> value="btn">MD</option>
				<option <?php selected( $instance['buttonSize'], 'btn-sm'); ?> value="btn-sm">SM</option>
			</select>

			<label for="<?php echo $this->get_field_id( 'buttonColor' ); ?>"><?php _e( 'Button Color:' ); ?></label> 
			<select id="<?php echo $this->get_field_id('buttonColor'); ?>" name="<?php echo $this->get_field_name('buttonColor'); ?>" class="widefat">
				<option <?php selected( $instance['buttonColor'], 'btn-light'); ?> value="btn-light">Light</option>
				<option <?php selected( $instance['buttonColor'], 'btn-dark'); ?> value="btn-dark">Dark</option> 
				<option <?php selected( $instance['buttonColor'], 'btn-primary'); ?> value="btn-primary">Primary</option>   
				<option <?php selected( $instance['buttonColor'], 'btn-secondary'); ?> value="btn-secondary">Secondary</option>   
				<option <?php selected( $instance['buttonColor'], 'btn-outline-light'); ?> value="btn-outline-light">Outline Light</option>
				<option <?php selected( $instance['buttonColor'], 'btn-outline-dark'); ?> value="btn-outline-dark">Outline Dark</option> 
				<option <?php selected( $instance['buttonColor'], 'btn-outline-primary'); ?> value="btn-outline-primary">Outline Primary</option>   
				<option <?php selected( $instance['buttonColor'], 'btn-outline-secondary'); ?> value="btn-outline-secondary">Outline Secondary</option>   
			</select>

		</p>

<?php 
	}
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['buttonText'] = ( ! empty( $new_instance['buttonText'] ) ) ? strip_tags( $new_instance['buttonText'] ) : '';
		$instance['buttonLink'] = ( ! empty( $new_instance['buttonLink'] ) ) ? strip_tags( $new_instance['buttonLink'] ) : '';
		$instance['buttonColor'] = ( ! empty( $new_instance['buttonColor'] ) ) ? strip_tags( $new_instance['buttonColor'] ) : '';
		$instance['buttonSize'] = ( ! empty( $new_instance['buttonSize'] ) ) ? strip_tags( $new_instance['buttonSize'] ) : '';
		return $instance;
	}
} // Class ends here
