<?PHP
// widget to make a grid for a bootstrap layout
// set it up so it can be more flexible
// this version only does 4

// Register and load the widget
function rh3_load_widget() {
	register_widget( 'rh3_grid_widget' );
}
add_action( 'widgets_init', 'rh3_load_widget' );
 
// Creating the widget 
class rh3_grid_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'rh3_grid_widget', 
			// Widget name will appear in UI
			__('HC Display Grid', 'rh3_grid_widget_domain'), 
			// Widget description
			array( 'description' => __( 'Display Grid of 4 pages with feature images', 'rh3_grid_widget_domain' ), ) 
		);
	}
	// Creating widget front-end
	public function widget( $args, $instance ) {
		$title = $instance['title'];
		$myPageID = $instance['myPageID'];
		// before and after widget arguments are defined by themes
?>
<section class=" nopad" id="">
	<div class="container">
		<div class="row no-gutters popup-gallery">
<?php
		$query = array('post_parent' => $myPageID, 'post_type' => 'page', 'post_status'=> 'publish', 'orderby' => 'menu_order','order' => 'asc');
		$loop = new WP_Query($query);
		//if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
		if ($loop->have_posts()) : $count == 0;
		while ( $loop -> have_posts() ) : $loop -> the_post();  $count++;  if ($count <= 4) :
?>
			<div class="col-lg-6 col-sm-6">
				<a class="portfolio-box" href="<?php $post_url = get_permalink($post_id); echo $post_url ?>">
					<img class="img-fluid" src="<?php echo get_the_post_thumbnail_url() ;?>" alt="" height="350" width="650" >
					<div class="portfolio-box-caption">
						<div class="portfolio-box-caption-content">
							<div class="project-category "><?php echo $title ?></div>
							<div class="project-name"><?php the_title(); ?></div>
						</div>
					</div>
				</a>
			</div>
<?php endif; endwhile; endif; ?>
		</div>
	</div>
</section>
<?php
	}
	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
		$title = __( 'Category Name', 'rh3_grid_widget_domain' );
		}
		if ( isset( $instance[ 'myPageID' ] ) ) {
			$myPageID = $instance[ 'myPageID' ];
		} else {
		$myPageID = __( '0', 'rh3_grid_widget_domain' );
		}
	// Widget admin form
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Category Name:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			<label for="<?php echo $this->get_field_id( 'myPageID' ); ?>"><?php _e( 'Page ID:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'myPageID' ); ?>" name="<?php echo $this->get_field_name( 'myPageID' ); ?>" type="text" value="<?php echo esc_attr( $myPageID ); ?>" />
		</p>
<?php 
	}
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['myPageID'] = ( ! empty( $new_instance['myPageID'] ) ) ? strip_tags( $new_instance['myPageID'] ) : '';
		return $instance;
	}
} // Class rh3_grid_widget ends here
