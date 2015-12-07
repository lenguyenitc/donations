<div class="settings_wrap_wa">
	<h2><?php _e('Settings','wa'); ?></h2>
	<div class="settings_wrap_wa_inner">
		<form method="POST" action="">
			<button class="button wa-setting-btn-save" type="submit">Save <i class="fa fa-save"></i></button>
			<?php
			$header_tabs = array();
			$body_tabs = array();

			foreach( $options as $key => $item ) {
				$first_active = ($key == 'general') ? 'active' : '';
				
				ob_start(); 
				echo "<div class='wa-setting-header-tab'><a href='#' class='{$first_active}' data-keytab='{$key}'>{$item['title']}</a></div>";
				array_push( $header_tabs, ob_get_clean() );

				ob_start(); 
				echo "<div class='wa-setting-body-tab {$first_active}' data-keytab='{$key}'>";
				if( count( $item['options'] ) > 0 ) {
					foreach( $item['options'] as $f_name => $option ) {
						switch ( $option['type'] ) {
							case 'title':
								echo isset($option['title']) ? $option['title'] : '';
								echo isset($option['description']) ? "<i>{$option['description']}</i>" : '';
								break;
							
							default:
								?>
								<div class="wa_options_group">
									<?php if( !empty( $option['title'] ) ) { ?>
									<label class="wa-label" for="<?php echo esc_attr($f_name); ?>"><?php echo "{$option['title']}"; ?></label>							
									<div class="wa-field"><?php echo WA_Helper::_HTML( $f_name, $option ); ?></div>
									<?php }else { ?>
									<div class="wa-field-full"><?php echo WA_Helper::_HTML( $f_name, $option ); ?></div>
									<?php } ?>
								</div>
								<?php
								break;
						}
					}
				}
				echo "</div>";
				array_push( $body_tabs, ob_get_clean() );
			}

			echo implode( '', $header_tabs );
			echo implode( '', $body_tabs );
			?>
		</form>
	</div>
</div>