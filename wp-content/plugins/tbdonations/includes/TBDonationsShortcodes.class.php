<?php			
if(!session_id()) {
	session_start();
}
/**
 * Class to handle all custom post type definitions for Restaurant Reservations
 */
if ( !defined( 'ABSPATH' ) )
	exit;

if ( !class_exists( 'TBDonationsShortcodes' ) ) {
	class TBDonationsShortcodes {
		
		public function __construct() {

			// Call when plugin is initialized on every page load		
			require_once( TBDONS_PLG_DIR . '/includes/TBDonationsDB.class.php' );
			$this->db = new TBDonationsDB();
			add_action( 'wp_enqueue_scripts', array( $this, 'tbdonations_register_script' ) );
			add_shortcode( 'tbdonations_form', array( $this, 'tbdonations_form_render') );
			add_shortcode( 'tbdonations_success', array( $this, 'tbdonations_success_render') );
			add_shortcode( 'tbdonations_list', array( $this, 'tbdonations_list_render') );
			
			add_action( 'wp_ajax_savepayment', array( $this,'savepayment') );
			add_action( 'tb_getmetadonors', array( $this,'getMetaDonors'), 10, 1 );
			add_action( 'wp_ajax_nopriv_savepayment', array( $this,'savepayment') );

		}
		
		public function tbdonations_register_script() {
			wp_register_script('bootstrap.min', TBDONS_PLG_URL . '/js/bootstrap.min.js' );
			wp_register_script('tbdonations', TBDONS_PLG_URL . '/js/tbdonations.js' );
			wp_register_style('tbdonations', TBDONS_PLG_URL . '/css/tbdonations.css' );
			wp_register_style('bootstrap.min', TBDONS_PLG_URL . '/css/bootstrap.min.css' );
			
		}
		
		function tbdonations_form_render($atts, $content = null) {			
			extract(shortcode_atts(array(
				'el_class'             => 'default',
				'donation_id'             => 0 ,
				'label_btn'             => 'Donate',
			), $atts));
			ob_start();			
			$include_bootstrap = get_option('include_bootstrap');
			$ajaxurl = admin_url('admin-ajax.php');
			$tbdonations = array(
				'ajaxurl' => $ajaxurl,
				'honmeurl' => home_url( '/' ),
			);
			wp_localize_script( 'tbdonations', 'tbdonations', $tbdonations );
			wp_enqueue_script('tbdonations');
			wp_enqueue_style('tbdonations');
			if($include_bootstrap == 1):
				wp_enqueue_script('bootstrap.min');
				wp_enqueue_style('bootstrap.min');
			endif;
			$template = TBDONS_PLG_DIR.'/views/tbdonations.form.php';
			$template = apply_filters('tbdonations_form',$template);
			include( $template );
			return ob_get_clean();
		}
		
		function tbdonations_success_render($atts, $content = null) {			
			extract(shortcode_atts(array(
				'el_class'             => 'default',
			), $atts));
			ob_start();
			if(isset($_SESSION['last_id'])):
				$last_id = $_SESSION['last_id'];
				$this->db->update('tbdonations_payment', array('paid'=>1), array('id'=>$last_id));
				session_destroy ();
				$ajaxurl = admin_url('admin-ajax.php');
				$tbdonations = array(
					'ajaxurl' => $ajaxurl,
					'honmeurl' => home_url( '/' ),
					'success' => true,
				);
				wp_localize_script( 'tbdonations', 'tbdonations', $tbdonations );
				wp_enqueue_script('tbdonations');
			endif;
			return ob_get_clean();
		}
		
		function tbdonations_list_render($atts, $content = null) {			
			extract(shortcode_atts(array(
				'el_class'             => '',
				'template'             => 'list',
				'trim_words'             => 20,
				'category'             => '',
				'col_xs'             => 'col-xs-12',
				'col_sm'             => 'col-sm-12',
				'col_md'             => 'col-md-3',
				'col_lg'             => 'col-lg-3',
				'crop_image'             => false,
				'width_image'             => 300,
				'height_image'             => 200,
				'order'             => 'ASC',
				'orderby'           => 'id',
				'posts_per_page'    => '12',
				'show_pagination'    => true,
			), $atts));
			ob_start();
			$paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
			$args = array(
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'paged' => $paged,
            'post_type' => 'tbdonations',
            'post_status' => 'publish');
			if (isset($category) && $category != '') {
				$cats = explode(',', $category);
				$category = array();
				foreach ((array) $cats as $cat) :
				$category[] = trim($cat);
				endforeach;
				$args['tax_query'] = array(
										array(
											'taxonomy' => 'tbdonationcategory',
											'field' => 'id',
											'terms' => $category
										)
								);
			}
			$wp_query = new WP_Query($args);
			$template = TBDONS_PLG_DIR.'/views/tbdonations.'.$template.'.php';
			$template = apply_filters('tbdonations_list',$template);
			require_once( $template );
			wp_reset_postdata();
			return ob_get_clean();
		}	

		function savepayment(){
			$last_id = null;
			$url_payment = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
			$url_return = get_option('paypal_return');
			if($url_return==''){
				$url_return = home_url( '/' );
			}else{
				$url_return = get_page_link($url_return);
			}
			$result = array();
			$using_account = get_option('using_account');
			$account = get_option('sandbox_account');
			$live_account = get_option('live_account');
			if($using_account != 'sandbox'){
				$account = $live_account;
				$url_payment = 'https://www.paypal.com/cgi-bin/webscr';
			}
			if(isset($_POST)){
				$data = $_POST['data'];
				$today = date("Y-m-d H:i:s");
				$donation_id = $data['donation_id'];
				$amount = $data['amount'];
				$custom_amount = $data['custom_amount']?$data['custom_amount']:$amount;
				$first_name = $data['first_name'];
				$last_name = $data['last_name'];
				$email = $data['email'];
				$phone = $data['phone'];
				$address = $data['address'];
				$notes = $data['notes'];
				$sign_up = isset($data['sing_up'])?$data['sing_up']:0;
				$last_id = $this->db->insert( 
					'tbdonations_payment', 
					array( 
						'donations_id' => $donation_id,
						'transaction_id' => $donation_id,
						'date' => $today,
						'firstname' => $first_name,
						'lastname' => $last_name,
						'email' => $email,
						'phone' => $phone,
						'address' => $address,
						'addition_notes' => $notes,
						'mailing_list' => $sign_up,
						'amount' => $custom_amount,
					)
				);
			}
			if($last_id){			
				if(!session_id()) {
					session_start();
				}
				$tb_currency = get_option('tb_currency', 'USD');
				$_SESSION['last_id'] = $last_id;
				$result['success'] = $url_payment . '?cmd=_xclick&business= ' . $account . '&amount=' .$custom_amount. '&item_number=1&item_name=Donate&currency_code='. $tb_currency .'&return='.urlencode($url_return);
			}else{
				$result['error'] = 'Payment store failed!';
			}
			echo json_encode($result);exit();
		}
		
		function getMetaDonors($id){
			$result = array('raised'=> 0, 'donors'=> 0);
			//print_r($result);
			$data = $this->db->fetch('tbdonations_payment',"donations_id=$id AND paid=1");
			if($data):
				$result['donors'] = count($data);
				foreach($data as $k=>$v):
					$result['raised'] = $result['raised'] + $v['amount'];
				endforeach;
			endif;
			return $result;
		}
		
	}
}
