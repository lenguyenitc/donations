<?php
if($_POST){
	update_option( 'using_account', $_POST['using_account'], 'sandbox' );
	update_option( 'sandbox_account', $_POST['sandbox_account'], '' );
	update_option( 'live_account', $_POST['live_account'], '' );
	update_option( 'paypal_return', $_POST['paypal_return'], '' );
	update_option( 'include_bootstrap', $_POST['include_bootstrap'], '' );
	update_option( 'tb_currency', $_POST['tb_currency'], '' );
	update_option( 'symbol_position', $_POST['symbol_position'], 0 );
}
$using_account = get_option('using_account');
$sandbox_account = get_option('sandbox_account');
$live_account = get_option('live_account');
$paypal_return = get_option('paypal_return');
$include_bootstrap = get_option('include_bootstrap');
$tb_currency = get_option('tb_currency', 'USD');
$symbol_position = get_option('symbol_position', 0);
?>
<div class="settings_wrap">
	<h2><?php _e('Settings','tbdonations'); ?></h2>
	<form method="POST" action="">
		<table class="wp-list-table widefat">
			<tr>
				<td><?php _e('PayPal Mode','tbdonations'); ?><td>
				<td>
					<select name="using_account">
						<option <?php selected($using_account,'sandbox');?> value="sandbox"><?php _e('Sandbox','tbdonations'); ?></option>
						<option <?php selected($using_account,'live');?> value="live"><?php _e('Live','tbdonations'); ?></option>
					</select>
				<td>
			</tr>
			<tr>
				<td><?php _e('Sandbox account','tbdonations'); ?><td>
				<td>
					<input type="text" name="sandbox_account" value="<?php echo $sandbox_account;?>"/>
				<td>
			</tr>
			<tr>
				<td><?php _e('Live account','tbdonations'); ?><td>
				<td>
					<input type="text" name="live_account" value="<?php echo $live_account;?>"/>
				<td>
			</tr>
			<tr>
				<td><?php _e('PayPal Return','tbdonations'); ?><td>
				<td>
					<?php wp_dropdown_pages( array('show_option_none'=> 'Please Select','name'=>'paypal_return', 'selected'=> $paypal_return) );?>
				<td>
			</tr>			
			<tr>
				<td><?php _e('Include Bootstrap','tbdonations'); ?><td>
				<td>
					<select name="include_bootstrap">
						<option <?php selected($include_bootstrap, 0);?> value="0"><?php _e('No','tbdonations'); ?></option>
						<option <?php selected($include_bootstrap, 1);?> value="1"><?php _e('Yes, Please','tbdonations'); ?></option>
					</select>
				<td>
			</tr>			
			<tr>
				<td><?php _e('Currency','tbdonations'); ?><td>
				<td>
					<select name="tb_currency">
						<?php						
						$currency = apply_filters('tb_currency', self::$currency);
						foreach($currency as $k => $v): ?>
							<option <?php selected($tb_currency, $k);?> value="<?php echo $k;?>"><?php echo $v["title"];?></option>
						<?php endforeach;?>
					</select>
				<td>
			</tr>			
			<tr>
				<td><?php _e('Symbol Currency Position','tbdonations'); ?><td>
				<td>
					<select name="symbol_position">
						<option <?php selected($symbol_position, 0);?> value="0"><?php _e('Left','tbdonations'); ?></option>
						<option <?php selected($symbol_position, 1);?> value="1"><?php _e('Right','tbdonations'); ?></option>
					</select>
				<td>
			</tr>
			<tr>
				<td colspan="2"><input class="button button-primary button-large" type="submit" value="Save"/>
			</tr>
		</table>
	</form>
</div>