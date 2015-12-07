<?php
$moneyraise = get_post_meta( $donation_id, 'zodonations_moneyraise', true );
$currency = apply_filters('zo_currency', ZoDonationsPageSetting::$currency);
$zo_currency = get_option('zo_currency', 'USD');
$symbol_position = get_option('symbol_position', 0);
$symbol = $currency[$zo_currency]['symbol'];
?>
<a href="#" data-toggle="modal" data-target="#site_donate_form<?php echo $donation_id; ?>" class="top_donate_link"><?php echo $label_btn; ?></a>
<div class="modal fade site_donate_form" id="site_donate_form<?php echo $donation_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="popup_title">
                <?php
					if($donation_id==0):
						_e('Donate','tbdonations');
					else:
						_e('You are donating to:','tbdonations') ?>
						<h4><?php echo get_the_title($donation_id);?></h4>
					<?php endif;
				?>
				<div class="close_popup" data-dismiss="modal">x</div>
            </div>
            <div class="popup_content">
                <form method="post" action="" id="site_donation_popup_form<?php echo $donation_id; ?>" class="site_donation_popup_form">
                    <div class="amount_wrapper">
                        <p><?php _e('How much would you like to donate?','tbdonations'); ?></p>
						<?php
							if($donation_id==0 || $moneyraise == null): ?>
								<input type="radio" id="amount10" name="donor[amount]" checked="checked" value="10" /><label for="amount10" class="button active"><?php echo $symbol_position != 1 ? "{$symbol}10":"10{$symbol}" ?></label>
								<input type="radio" id="amount20" name="donor[amount]" value="20" /><label for="amount20" class="button bordered_1"><?php echo $symbol_position != 1 ? "{$symbol}20":"20{$symbol}" ?></label>
								<input type="radio" id="amount30" name="donor[amount]" value="30" /><label for="amount30" class="button bordered_1"><?php echo $symbol_position != 1 ? "{$symbol}30":"30{$symbol}" ?></label>			
							<?php else:
								$moneyraise = explode(',',$moneyraise);
								foreach($moneyraise as $k=>$v): ?>	
									<?php if($k==0):?>
									<input type="radio" id="amount<?php echo $v;?>" checked="checked" name="donor[amount]" value="<?php echo $v;?>" /><label for="amount<?php echo $v;?>" class="button active"><?php echo $symbol_position != 1 ? "{$symbol}{$v}":"{$v}{$symbol}" ?></label>
									<?php else:?>							
									<input type="radio" id="amount<?php echo $v;?>" name="donor[amount]" value="<?php echo $v;?>" /><label for="amount<?php echo $v;?>" class="button bordered_1"><?php echo $symbol_position != 1 ? "{$symbol}{$v}":"{$v}{$symbol}" ?></label>
									<?php endif;?>
								<?php endforeach;
							endif; ?>
								<input type="text" class="custom-amount form-control" name="donor[custom_amount]" placeholder="Your amount (<?php echo $zo_currency;?>)" />
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="site_donor_first_name"><?php _e('First Name *','tbdonations'); ?></label>
                                <input type="text" name="donor[first_name]" class="form-control" id="site_donor_first_name" value="" required />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="site_donor_last_name"><?php _e('Last name *','tbdonations'); ?></label>
                                <input type="text" name="donor[last_name]" class="form-control" id="site_donor_last_name" value="" required />
                            </div>
						</div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="site_donor_email"><?php _e('E-mail *','tbdonations'); ?></label>
                                <input type="email" name="donor[email]" class="form-control" id="site_donor_email" value="" required />
                            </div>
						</div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="site_donor_phone"><?php _e('Phone *','tbdonations'); ?></label>
                                <input type="tel" name="donor[phone]" class="form-control" id="site_donor_phone" value="" required />
                            </div>
						</div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="site_donor_address"><?php _e('Address','tbdonations'); ?></label>
                                <textarea id="site_donor_address" class="form-control" name="donor[address]"></textarea>
                            </div>
						</div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="site_donor_notes"><?php _e('Additional Note','tbdonations'); ?></label>
                                <textarea id="site_donor_notes" class="form-control" name="donor[notes]"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row subscription">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-checkbox"><input type="checkbox" name="donor[sign_up]" value="1"> <span><?php _e('Sign up for mailing list','tbdonations'); ?></span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row action">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <button type="submit" class="button button_donate"><?php _e('Donate','tbdonations'); ?></button>
                                <div class="loading"><i class="fa fa-circle-o-notch fa-spin"></i></div>
                                <input type="hidden" name="action" value="donate" />
                                <input type="hidden" name="donor[donation_id]" value="<?php echo $donation_id; ?>" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <img class="paypal_icon" alt="" src="<?php echo ZODONS_PLG_URL.'/css/paypal.png';?>"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	</div>
</div>