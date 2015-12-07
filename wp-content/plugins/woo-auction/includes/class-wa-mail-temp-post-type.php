<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'WA_Mail_Template_Post_Type' ) ) {
	class WA_Mail_Template_Post_Type {
		function __construct() {

		}
	}
}
new WA_Mail_Template_Post_Type();
?>