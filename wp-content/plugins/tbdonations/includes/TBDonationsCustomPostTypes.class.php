<?php
/**
 * Class to handle all custom post type definitions for Restaurant Reservations
 */

if ( !defined( 'ABSPATH' ) )
	exit;

if ( !class_exists( 'TBDonationsCustomPostTypes' ) ) {
	class TBDonationsCustomPostTypes {
		
		public function __construct() {

			// Call when plugin is initialized on every page load
			add_action( 'init', array( $this, 'load_cpts' ) );
			add_action( 'init', array( $this, 'create_tbdonationcategory_taxonomy' ) );
			add_filter ("manage_edit-tbdonations_columns", array( $this, "tbdonations_edit_columns" ) );
			add_action ("manage_posts_custom_column", array( $this, "tbdonations_custom_columns" ) );
			add_action( 'admin_init', array( $this, 'tbdonations_metafields' ) );
			add_action ('save_post', array( $this, 'save_tbdonations' ) );

		}

		/**
		 * Initialize custom post types
		 * @since 0.1
		 */
		public function load_cpts() {
			// Define the booking custom post type
			$args = array(
				'labels' => array(
					'name'               => __( 'Donations', 'tbdonations' ),
					'singular_name'      => __( 'Donations', 'tbdonations' ),
					'menu_name'          => __( 'Donations', 'tbdonations' ),
					'name_admin_bar'     => __( 'Donations', 'tbdonations' ),
					'add_new'            => __( 'Add New', 'tbdonations' ),
					'add_new_item'       => __( 'Add New Donation', 'tbdonations' ),
					'edit_item'          => __( 'Edit Donation', 'tbdonations' ),
					'new_item'           => __( 'New Donation', 'tbdonations' ),
					'view_item'          => __( 'View Donation', 'tbdonations' ),
					'search_items'       => __( 'Search Donations', 'tbdonations' ),
					'not_found'          => __( 'No donations found', 'tbdonations' ),
					'not_found_in_trash' => __( 'No donations found in trash', 'tbdonations' ),
					'all_items'          => __( 'All Donations', 'tbdonations' ),
				),
				'menu_icon' => 'dashicons-awards',
				'public' => true,
				'supports' => array(
					'title',
					'editor',
					'thumbnail',
					'revisions',
                    'comments'
				)
			);

			// Create filter so addons can modify the arguments
			$args = apply_filters( 'tbdonations_args', $args );

			// Add an action so addons can hook in before the post type is registered
			do_action( 'tbdonation_pre_register' );

			// Register the post type
			register_post_type( 'tbdonations', $args );

			// Add an action so addons can hook in after the post type is registered
			do_action( 'tbdonation_post_register' );
		}
		/* Taxanomy */
		function create_tbdonationcategory_taxonomy() {

			$labels = array(
				'name' => _x( 'Categories', 'taxonomy general name' ),
				'singular_name' => _x( 'Category', 'taxonomy singular name' ),
				'search_items' =>  __( 'Search Categories', 'tbdonations'  ),
				'popular_items' => __( 'Popular Categories', 'tbdonations'  ),
				'all_items' => __( 'All Categories', 'tbdonations'  ),
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => __( 'Edit Category', 'tbdonations'  ),
				'update_item' => __( 'Update Category', 'tbdonations'  ),
				'add_new_item' => __( 'Add New Category', 'tbdonations'  ),
				'new_item_name' => __( 'New Category Name', 'tbdonations'  ),
				'separate_items_with_commas' => __( 'Separate categories with commas', 'tbdonations'  ),
				'add_or_remove_items' => __( 'Add or remove categories', 'tbdonations'  ),
				'choose_from_most_used' => __( 'Choose from the most used categories', 'tbdonations'  ),
			);
			register_taxonomy('tbdonationcategory','tbdonations', array(
				'label' => __('Donations Category', 'tbdonations' ),
				'labels' => $labels,
				'hierarchical' => true,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'tbdonationcategory' ),
			));
		}
		/* Custom colums */
		
		function tbdonations_edit_columns($columns) {
		 
			$columns = array(
				"cb" => "<input type=\"checkbox\" />",
				"title" => __("Title", "tbdonations"),
				"tbdonations_goals" => __("Goals", "tbdonations"),
				"tbdonations_location" => __("Location", "tbdonations"),
				"tbdonations_raise" => __("Raise", "tbdonations"),
				"tbdonations_endday" => __("End Date", "tbdonations"),
				);
			return $columns;
		}
		 
		function tbdonations_custom_columns($column)
		{
			global $post;
			$custom = get_post_custom();
			switch ($column)
			{
				case "title":
					the_title();
				break;
				case "tbdonations_goals":
					echo isset($custom['tbdonations_goals'][0])?$custom['tbdonations_goals'][0]:'';
				break;
				case "tbdonations_location":
					echo isset($custom['tbdonations_location'][0])?$custom['tbdonations_location'][0]:'';
				break;
				case "tbdonations_raise":
					$result = apply_filters('tb_getmetadonors', $post->ID);
					echo $result['raised'];
				break;
				case "tbdonations_endday":
					echo isset($custom['tbdonations_endday'][0])?$custom['tbdonations_endday'][0]:'';
				break;			 
			}
		}
		
		/* Metabox */
		function tbdonations_metafields() {
			add_meta_box('tbdonations_meta', __('Donation setting', 'tbdonations'), array($this,'tbdonations_meta'), 'tbdonations');
		}
		 
		function tbdonations_meta () {		 
			global $post;
			wp_register_script('jquery.datetimepicker', TBDONS_PLG_URL . '/js/jquery.datetimepicker.js' );
			wp_register_style('jquery.datetimepicker', TBDONS_PLG_URL . '/css/jquery.datetimepicker.css' );
			wp_register_script('tbdonations', TBDONS_PLG_URL . '/js/tbdonations.js' );
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery.datetimepicker');
			wp_enqueue_script('tbdonations');
			wp_enqueue_style('jquery.datetimepicker');
			$custom = get_post_custom($post->ID);
			$tbdonations_goals = isset($custom["tbdonations_goals"][0])?$custom["tbdonations_goals"][0]:'';
			$tbdonations_location = isset($custom["tbdonations_location"][0])?$custom["tbdonations_location"][0]:'';
			$tbdonations_raise = isset($custom["tbdonations_raise"][0])?$custom["tbdonations_raise"][0]:'';
			$tbdonations_moneyraise = isset($custom["tbdonations_moneyraise"][0])?$custom["tbdonations_moneyraise"][0]:'';
			$tbdonations_endday = isset($custom["tbdonations_endday"][0])?$custom["tbdonations_endday"][0]:'';
			echo '<input type="hidden" name="tbdonations-nonce" id="tbdonations-nonce" value="' .
			wp_create_nonce( 'tbdonations-nonce' ) . '" />';		 
			?>
			<div class="tbdonations-meta">
				<table>
					<tr>
						<td><label><?php _e('Goals', 'tbdonations');?></label></td>
						<td>
							<input name="tbdonations_goals" class="tbdonations_goals" value="<?php echo $tbdonations_goals; ?>" />
						</td>
					</tr>
					<tr>
						<td><label><?php _e('Location', 'tbdonations');?></label></td>
						<td>
							<input name="tbdonations_location" class="tbdonations_location" value="<?php echo $tbdonations_location; ?>" />
						</td>
					</tr>
					<tr>
						<td><label><?php _e('Money raise', 'tbdonations');?></label></td>
						<td>
							<input name="tbdonations_moneyraise" class="tbdonations_moneyraise" value="<?php echo $tbdonations_moneyraise; ?>" />
						</td>
					</tr>
					<tr>
						<td><label><?php _e('End Date', 'tbdonations');?></label></td>
						<td>
							<input name="tbdonations_endday" class="tbdonations_endday tbdate" value="<?php echo $tbdonations_endday; ?>" />
						</td>
					</tr>
				</table>
			</div>
			<?php
		}
		/* Save donations */
		function save_tbdonations(){ 
			global $post;
			if(isset($post->ID)):
				if ( !wp_verify_nonce( $_POST['tbdonations-nonce'], 'tbdonations-nonce' )) {
					return $post->ID;
				}				 
				if ( !current_user_can( 'edit_post', $post->ID ))
					return $post->ID;
				 
				if(!isset($_POST["tbdonations_moneyraise"])):
					return $post;
				endif;			 
				if(!isset($_POST["tbdonations_goals"])):
					return $post;
				endif;
				$tbdonations_moneyraise = $_POST["tbdonations_moneyraise"];
				$tbdonations_goals = $_POST["tbdonations_goals"];
				$tbdonations_location = $_POST["tbdonations_location"];
				$tbdonations_endday = $_POST["tbdonations_endday"];
				update_post_meta($post->ID, "tbdonations_moneyraise", $tbdonations_moneyraise );
				update_post_meta($post->ID, "tbdonations_goals", $tbdonations_goals );
				update_post_meta($post->ID, "tbdonations_location", $tbdonations_location );
				update_post_meta($post->ID, "tbdonations_endday", $tbdonations_endday );
			endif;
		}
	}
}
