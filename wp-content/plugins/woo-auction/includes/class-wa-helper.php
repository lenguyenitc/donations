<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( !class_exists( 'WA_Helper' ) ) {
	class WA_Helper {
		static function _HTML($f_name, $params) {
			$result_html = array(); 
			$params = self::define_variable( array("class" => "", "attr" => "", "description" => "", "placeholder" => ""), $params );
			extract($params);

			switch ($type) {
				case 'select':
					array_push( $result_html, "<select name='{$f_name}' class='{$class}' {$attr}>" );
					foreach( $options as $k=>$v ){
						$selected = ( $v == $default )? "selected" : "";
						array_push( $result_html, "<option value='{$v}' {$selected}>{$k}</option>" );
					}
					array_push( $result_html, "</select>" );
					break;
				
				case 'checkbox':
					$checked = ($default == true)? "checked" : ""; 
					array_push( $result_html, "<input type='checkbox' name='{$f_name}' value='1' {$checked} class='{$class}' {$attr}/>" );
					break;

				case 'number':
					array_push( $result_html, "<input type='number' name='{$f_name}' value='{$default}' class='wa-field-number {$class}' {$attr}>" );
					break;

				case 'auction_dates':
					array_push( $result_html, "<input type='text' name='{$f_name}[start]' class='wa-field-dates {$class}' data-dates='{$start}'/>" );
					array_push( $result_html, "<input type='text' name='{$f_name}[end]' class='wa-field-dates {$class}' data-dates='{$end}'/>" );
					break;

				case 'text':
					array_push( $result_html, "<input type='text' name='{$f_name}' placeholder='{$placeholder}' value='{$default}' class='{$class}' {$attr} />" );
					break;

				case 'textarea':
					array_push( $result_html, "<textarea name='{$f_name}' class='{$class}' {$attr}>{$default}</textarea>" );
					break;

				case 'editor': 
					array_push( $result_html, wp_editor( $default, $id, $settings = array( 'textarea_name' => $f_name ) ) );
					break;

				case 'radio':
					foreach( $options as $key => $value ) {
						$checked = ( $default == $value ) ? 'checked' : '';
						array_push( $result_html, "<label><input type='radio' value='{$value}' name='{$f_name}' {$checked}/>$key</label> " );
					}
					break;

				default:
					array_push( $result_html, "<input type='{$type}' name='{$f_name}' value='{$default}' class='{$class}' {$attr} />" );
					break;
			}

			// description field
			( $description == true )? array_push( $result_html, "<i>{$description}</i>" ) : "";

			return implode( '', $result_html );
		}

		static function define_variable( $default, $variable ){
			return array_merge($default, $variable);
		}

		static function create_list_page( $params ){
			require_once ( WA_PLUGIN_DIR . '/includes/class-wa-db.php' );

			wp_enqueue_style('style.wooauction');
			$params = self::define_variable( array(
				"manage_post_per_page" => 10,
				"manage_header_columns" => array(),
				"manage_content_columns" => array(),
				"manage_query" => array(),
				), $params );
			extract( $params );

			$pagination = self::pagination(array(
				'current_page'  => isset( $_GET['paged'] ) ? $_GET['paged'] : 1,
			    'total_record'  => count( self::create_list_page_get_all_post( $manage_query ) ),
			    'limit'         => $manage_post_per_page
				));
			$manage_datas = self::create_list_page_get_limit_post( $manage_query, $manage_post_per_page );

			ob_start();
			require_once ( WA_PLUGIN_DIR . '/views/view-create-list-page.php' );
			echo ob_get_clean();
		}

		static function create_list_page_get_all_post( $arr_query ) {
			$db = new WA_Db();

			$orders = $db->fetch($arr_query);
			return $orders;
		}

		static function create_list_page_get_limit_post( $arr_query, $post_per_page ) {
			$current_page = ( isset( $_GET['paged'] ) )? $_GET['paged'] : 1;
			$arr_query['limit'] = array(
				"start" => ( $post_per_page * $current_page ) - $post_per_page,
				"count" => $post_per_page,
				);

			$db = new WA_Db();

			$orders = $db->fetch($arr_query);
			return $orders;
		}

		static function pagination( $params ) {
			extract( $params );
			if( $total_record <= $limit ) return;
			$total_page = ceil( $total_record / $limit );

			ob_start();
			?>
			<div class="wa-custom tablenav bottom">
				<div class="tablenav-pages">
					<span class="displaying-num"><?php echo "{$total_record}" ?> items</span>
					<span class="pagination-links">
						<?php for($i = 1; $i <= $total_page; ++$i){
							if( $i == $current_page ){
								echo "<span>{$i}</span>";
							}else{
								$link = $_SERVER["REQUEST_URI"] . '&paged=' . $i;
								echo "<a href='{$link}'>{$i}</a>";
							}
						} ?>
					</span>
				</div>
			</div>
			<?php
			return ob_get_clean();
		}

		static function currency( $price = '' ) {
			$currency = get_option( 'woocommerce_currency' ); 
			$currency_position = get_option( 'woocommerce_currency_pos' ); 
			if( !empty( $price  ) )
				$price = number_format( $price, 2 );

			switch ( $currency ) {
				case 'AED' :
					$currency_symbol = 'د.إ';
					break;
				case 'AUD' :
				case 'CAD' :
				case 'CLP' :
				case 'COP' :
				case 'HKD' :
				case 'MXN' :
				case 'NZD' :
				case 'SGD' :
				case 'USD' :
					$currency_symbol = '&#36;';
					break;
				case 'BDT':
					$currency_symbol = '&#2547;&nbsp;';
					break;
				case 'BGN' :
					$currency_symbol = '&#1083;&#1074;.';
					break;
				case 'BRL' :
					$currency_symbol = '&#82;&#36;';
					break;
				case 'CHF' :
					$currency_symbol = '&#67;&#72;&#70;';
					break;
				case 'CNY' :
				case 'JPY' :
				case 'RMB' :
					$currency_symbol = '&yen;';
					break;
				case 'CZK' :
					$currency_symbol = '&#75;&#269;';
					break;
				case 'DKK' :
					$currency_symbol = 'kr.';
					break;
				case 'DOP' :
					$currency_symbol = 'RD&#36;';
					break;
				case 'EGP' :
					$currency_symbol = 'EGP';
					break;
				case 'EUR' :
					$currency_symbol = '&euro;';
					break;
				case 'GBP' :
					$currency_symbol = '&pound;';
					break;
				case 'HRK' :
					$currency_symbol = 'Kn';
					break;
				case 'HUF' :
					$currency_symbol = '&#70;&#116;';
					break;
				case 'IDR' :
					$currency_symbol = 'Rp';
					break;
				case 'ILS' :
					$currency_symbol = '&#8362;';
					break;
				case 'INR' :
					$currency_symbol = 'Rs.';
					break;
				case 'ISK' :
					$currency_symbol = 'Kr.';
					break;
				case 'KIP' :
					$currency_symbol = '&#8365;';
					break;
				case 'KRW' :
					$currency_symbol = '&#8361;';
					break;
				case 'MYR' :
					$currency_symbol = '&#82;&#77;';
					break;
				case 'NGN' :
					$currency_symbol = '&#8358;';
					break;
				case 'NOK' :
					$currency_symbol = '&#107;&#114;';
					break;
				case 'NPR' :
					$currency_symbol = 'Rs.';
					break;
				case 'PHP' :
					$currency_symbol = '&#8369;';
					break;
				case 'PLN' :
					$currency_symbol = '&#122;&#322;';
					break;
				case 'PYG' :
					$currency_symbol = '&#8370;';
					break;
				case 'RON' :
					$currency_symbol = 'lei';
					break;
				case 'RUB' :
					$currency_symbol = '&#1088;&#1091;&#1073;.';
					break;
				case 'SEK' :
					$currency_symbol = '&#107;&#114;';
					break;
				case 'THB' :
					$currency_symbol = '&#3647;';
					break;
				case 'TRY' :
					$currency_symbol = '&#8378;';
					break;
				case 'TWD' :
					$currency_symbol = '&#78;&#84;&#36;';
					break;
				case 'UAH' :
					$currency_symbol = '&#8372;';
					break;
				case 'VND' :
					$currency_symbol = '&#8363;';
					break;
				case 'ZAR' :
					$currency_symbol = '&#82;';
					break;
				default :
					$currency_symbol = '';
					break;
			}

			switch ( $currency_position ) {
				case 'right':
					$currency_price = $price . $currency_symbol;
					break;

				case 'left_space':
					$currency_price = $currency_symbol . ' ' . $price;
					break;

				case 'right_space':
					$currency_price = $price . ' ' . $currency_symbol;
					break;
				
				default:
					$currency_price = $currency_symbol . $price;
					break;
			}

			return "<span class='wa-price'>$currency_price</span>";
		}
	}
}
?>