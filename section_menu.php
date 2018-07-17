<?php
// figure out parent section then show menu with parent as top link
// make it cleaner - use walker and remove all the extra classes wp throws in 

class RH3_Section_Menu extends WP_Widget {
	public function __construct() {
		$widget_options = array( 
			'classname' => 'rh3_section_menu',
			'description' => 'Display section menus in a widget',
		);
		parent::__construct( 'rh3_section_menu', 'HC Section Menu', $widget_options );
	}

	public function widget( $args, $instance ) {
		function rh3_section_menu_check_for_parent_page() {
			global $post;
			if ( $post->post_parent ) {
				$parents = array_reverse( get_post_ancestors( $post->ID ) );
				return $parents[0];
			}
			return $post->ID;
		}
		$parent_id = rh3_section_menu_check_for_parent_page();
		$args = array(
			'child_of' => $parent_id,
			'depth' => '3',
			'title_li' => '',
			'sort_column'  => 'menu_order, post_title',
		);
		// Step 2: Search for any subpages
		$subpages = get_pages( $args );
		// Step 3: If there are subpages, return them as a list
		if ( $subpages ) {
			// Start a list with the parent page on top
			?>
			<nav class="section-menu">
				<h3><a href="<?php echo get_permalink( $parent_id ); ?>"><?php echo get_the_title( $parent_id ); ?></a></h3>
				<ul class="menu">
					<?php wp_list_pages( $args );	?>
				</ul>
			</nav>
		<?php
		}
	}

	// Outputs the options form on admin
	public function form( $instance ) {
		?>
			<p>Display section menus in a widget</p>
		<?php
	}

	// Processing widget options on save
	public function update( $new_instance, $old_instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		return $instance;
	}
}

function load_rh3_section_menu_widget() {
	register_widget( 'RH3_Section_Menu' );
}
add_action( 'widgets_init', 'load_rh3_section_menu_widget' );
