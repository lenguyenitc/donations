<div id="woo_auction_tab" class="panel woocommerce_options_panel wc-metaboxes-wrapper">
	<?php
	foreach($wa_fields as $f_name => $params){
		?>
		<div class="options_group">
			<p class="form-field">
				<label for="<?php echo esc_attr($f_name); ?>"><?php echo "{$params['title']}"; ?></label>
				<?php echo WA_Helper::_HTML( $f_name, $params ); ?>
			</p>
		</div>
		<?php
	}
	?>
</div>