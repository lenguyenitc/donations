<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'woocommerce_after_single_product_summary_no_tabs', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary_no_tabs', 'woocommerce_output_related_products', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 30 );
get_header( 'shop' ); ?>
        	<?php
        		/**
        		 * woocommerce_before_main_content hook
        		 *
        		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
        		 * @hooked woocommerce_breadcrumb - 20
        		 */
        		do_action( 'woocommerce_before_main_content' );

        	    while ( have_posts() ) : the_post(); 
                global $post, $product;
                $user_ID = get_current_user_id();

                $meta_fields = get_post_custom($post->ID);
                
                $dates = ( isset( $meta_fields['_auction_dates'] ) )? unserialize( $meta_fields['_auction_dates'][0] ) : "";
                $date_start = date($dates['start']);
                $date_end = date($dates['end']);
                $date_now = date('Y/m/d H:i:s');   
                
                $_extra_class = array();
                $_extra_data = array('date_start' => $dates['start'], 
                                'date_end' => $dates['end'], 
                                'view' => 'single');
                //echo $date_start, $date_now;
                if($date_start > $date_now) {
                    $date_countdown = $dates['start'];
                    $_extra_data['status'] = 'close';
                    array_push($_extra_class, 'wa-product-not-start');
                }else {
                    $date_countdown = $dates['end'];
                    $_extra_data['status'] = 'open';
                }
                
                # handle attachment
                $attachment_images = array();
                $attachment_ids = $product->get_gallery_attachment_ids();
                if ( has_post_thumbnail() ) {
                    array_push( $attachment_images, get_the_post_thumbnail( $post->ID, 'wa_thumb_product' ) );
                }

                if( count( $attachment_ids ) > 0 ) { 
                    foreach( $attachment_ids as $attachment_id ) {
                        array_push( $attachment_images, wp_get_attachment_image( $attachment_id, 'wa_thumb_product' ) );
                    }
                }
                
                # wa_countdown_format
                $wa_countdown_format = get_option( 'wa_countdown_format', '%-w week%!w %-d day%!d %H:%M:%S' );
                ?>

        		<div class="row">
                    <div id="wa-product-single-item-js" class="wa-product-single-item wa-product-single-item-style <?php echo esc_attr( implode(' ', $_extra_class) ); ?>">
                        <div class="col-md-12">
                            <div class="wa-product-images">
                                <?php 
                                    if( count( $attachment_images ) > 0 ) {
                                        $_arr_thumbs = array();
                                        foreach( $attachment_images as $index => $attachment_image ) {
                                            if( $index == 0 ){
                                                echo "<span class='wa-product-image-full'> {$attachment_image} </span>";
                                            }else{
                                                array_push( $_arr_thumbs, "<span class='wa-product-image-item'> {$attachment_image} </span>" );
                                            }
                                        }

                                        echo ( count( $_arr_thumbs ) > 0 ) ?  "<div class='wa-product-images-thumbs'>" . implode( '', $_arr_thumbs ) . "</div>" : '';
                                    } else {
                                        echo '<img src=\''. WA_PLUGIN_URL .'/assets/images/no-image.jpg\' />';
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="wa-product-info">
                                <!-- info owner -->
                                <?php if( get_option( 'wa_display_owner_info', 1 ) ) { ?>
                                <div class="wa-owner-info">
                                    <?php if( ! empty( $meta_fields['_wa_owner_description'][0] ) ) { ?>
                                    <div class="wa-owner-item-full">
                                        <?php echo $meta_fields['_wa_owner_description'][0] ?>
                                    </div>
                                    <?php } ?>
                                    <?php if( ! empty( $meta_fields['_wa_owner_name'][0] ) ) { ?>
                                    <div class="wa-owner-item">
                                        <span><i class="fa fa-user" title="<?php _e( 'Owner name', 'wa' ) ?>"></i></span>
                                        <span><?php echo $meta_fields['_wa_owner_name'][0] ?></span>
                                    </div>
                                    <?php } ?>
                                    <?php if( ! empty( $meta_fields['_wa_owner_phone'][0] ) ) { ?>
                                    <div class="wa-owner-item">
                                        <span><i class="fa fa-mobile-phone" title="<?php _e( 'Phone', 'wa' ) ?>"></i></span>
                                        <span><?php echo $meta_fields['_wa_owner_phone'][0] ?></span>
                                    </div>
                                    <?php } ?>
                                    <?php if( ! empty( $meta_fields['_wa_owner_email'][0] ) ) { ?>
                                    <div class="wa-owner-item">
                                        <span><i class="fa fa-envelope" title="<?php _e( 'Email', 'wa' ) ?>"></i></span>
                                        <span><a href="mailto:<?php echo esc_attr( $meta_fields['_wa_owner_email'][0] ); ?>"><?php echo $meta_fields['_wa_owner_email'][0]; ?></a></span>
                                    </div>
                                    <?php } ?>
                                    <?php if( ! empty( $meta_fields['_wa_owner_fax'][0] ) ) { ?>
                                    <div class="wa-owner-item">
                                        <span><i class="fa fa-mobile-phone" title="<?php _e( 'Fax', 'wa' ) ?>"></i></span>
                                        <span><?php echo $meta_fields['_wa_owner_fax'][0] ?></span>
                                    </div>
                                    <?php } ?>
                                    <?php if( ! empty( $meta_fields['_wa_owner_address'][0] ) ) { ?>
                                    <div class="wa-owner-item">
                                        <span><i class="fa fa-map-marker " title="<?php _e( 'Address', 'wa' ) ?>"></i></span>
                                        <span><?php echo $meta_fields['_wa_owner_address'][0] ?></span>
                                    </div>
                                    <?php } ?>
                                    <?php if( ! empty( $meta_fields['_wa_owner_url'][0] ) ) { ?>
                                    <div class="wa-owner-item">
                                        <span><i class="fa fa-link" title="<?php _e( 'Url', 'wa' ) ?>"></i></span>
                                        <span><a href="<?php echo esc_attr( $meta_fields['_wa_owner_url'][0] ); ?>" target="_blank"><?php echo $meta_fields['_wa_owner_url'][0]; ?></a></span>
                                    </div>
                                    <?php } ?>
                                    <div class="clearfix"></div>
                                </div>
                                <?php } ?>
                                <p class="wa-text-center"><?php _e('Current Bid:', 'wa') ?> <span id="current-bid-price" data-request-current-bid="true" data-timer="2000" data-productid="<?php echo esc_attr( $post->ID ); ?>"></span></p>
                                <ul class="wa-info-bid">
                                    <!-- display Start price -->
                                    <?php if( get_option( 'wa_display_start_price', 1 ) == 1 ) { ?>
                                    <li>
                                        <p class="wa-color-primary"><?php echo WA_Helper::currency( $meta_fields['_wa_start_price'][0] ); ?></p>
                                        <small class="wa-text-strong wa-text-uppercase"><?php _e( 'Start price', 'wa' ) ?></small>
                                    </li>
                                    <?php } ?>
    
                                    <!-- display Bid increment -->
                                    <?php if( get_option( 'wa_display_bid_increment', 1 ) == 1 ) { ?>
                                    <li>
                                        <p class="wa-color-primary"><?php echo WA_Helper::currency( $meta_fields['_wa_bid_increment'][0] ); ?></p>
                                        <small class="wa-text-strong wa-text-uppercase"><?php _e( 'Bid increment', 'wa' ) ?></small>
                                    </li>
                                    <?php } ?>

                                    <!-- display Reserve price -->
                                    <?php if( get_option( 'wa_display_reserve_price', 1 ) == 1 ) { ?>
                                    <li>
                                        <p class="wa-color-primary"><?php echo WA_Helper::currency( $meta_fields['_wa_reserve_price'][0] ); ?></p>
                                        <small class="wa-text-strong wa-text-uppercase"><?php _e( 'Reserve price', 'wa' ) ?></small>
                                    </li>
                                    <?php } ?>

                                    <!-- display Buy now price -->
                                    <?php if( get_option( 'wa_display_buy_now_price', 1 ) == 1 ) { ?>
                                    <li>
                                        <p class="wa-color-primary"><?php echo WA_Helper::currency( $meta_fields['_wa_buy_it_now_price'][0] ); ?></p>
                                        <small class="wa-text-strong wa-text-uppercase"><?php _e( 'Buy now price', 'wa' ) ?></small>
                                    </li>
                                    <?php } ?>
                                </ul>

                                <!-- Count down -->
                                <div class="wa-product-item-timer wa-text-center">
                                    <span class="countdown" data-extradata="<?php echo esc_attr(json_encode($_extra_data)); ?>" data-datatime="<?php echo esc_attr($date_countdown); ?>" data-format="<?php echo esc_attr( $wa_countdown_format ); ?>">
                                        <span class="clock"></span>
                                    </span>
                                </div>

                                <!-- button -->
                                <?php if($_extra_data['status'] == 'close') { 
                                    $_class_display = 'wa-hidden';
                                } ?>
                                <div class="wa-btn-content wa-text-center <?php echo isset($_class_display)? $_class_display : ''; ?>">
                                    <?php echo $Woo_Auction->wa_render_btn_single_page(); ?>
                                </div>
                                
                            </div>
                        </div>

                        <div class="wa-product-bid-content col-md-12">
                            <div class="wa-header-bid-tabs">
                                <?php 

                                    $num_comments = get_comments_number(); // get_comments_number returns only a numeric value

                                    if ( comments_open() ) {
                                        if ( $num_comments == 0 ) {
                                            $comments = __('0', 'wa');
                                        } elseif ( $num_comments > 1 ) {
                                            $comments = $num_comments;
                                        } else {
                                            $comments = __('1', 'wa');
                                        }
                                        $write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
                                    } else {
                                        $write_comments =  __('Comments are off for this post.', 'wa' );
                                    }

                                    $tabs_name = array(
                                    "description" => __('Description', 'wa'),
                                    "reviews" => __('Reviews', 'wa') . ' <small class="wa-text-lowercase">(' . $write_comments . ')</small>',
                                    "bids" => __('Bids', 'wa' ),
                                    );
                                    foreach( $tabs_name as $key => $tab ) {
                                        echo "<div class='wa-header-tab' data-tabkey='{$key}'>{$tab}</div>";
                                    } ?>
                            </div>
                            <div class="wa-body-bid-tabs">
                            <?php foreach( $tabs_name as $key => $tab ) {
                                switch ( $key ) {
                                    case 'description':
                                        ?>
                                        <div class="wa-body-tab wa-content-description" data-tabkey="<?php echo esc_attr( $key ); ?>">
                                            <?php the_content(); ?>
                                        </div>
                                        <?php
                                        break;

                                    case 'reviews':
                                        ?>
                                        <div class="wa-body-tab wa-content-reviews" data-tabkey="<?php echo esc_attr( $key ); ?>">
                                            <?php comments_template( '', true); ?>
                                        </div>
                                        <?php
                                        break;

                                    case 'bids':
                                        ?>
                                        <div class="wa-body-tab wa-content-bids wa-content-bids-js" data-tabkey="<?php echo esc_attr( $key ); ?>" data-productid="<?php echo esc_attr( $post->ID ); ?>">
                                            <!-- load Ajax -->
                                        </div>
                                        <?php
                                        break;
                                }
                            } ?>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade wa_product_bid_modal" id="wa_product_bid_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content wa-modal-content">
                                    <form method="POST" action="" id="wa-product-bid-form-js">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><?php _e( 'Bid ', 'wa' ); the_title(); ?></h4>
                                        </div>
                                        <div class="modal-body wa-text-center">
                                            <div class="wa-status"></div>
                                            <div class="wa-highest-bid-price-product"></div>
                                            <div class="wa-text-center">
                                                <p><label for="wa-product-bid-price"><?php _e( 'Bid price', 'wa'  ) ?> (<?php echo WA_Helper::currency(); ?>)</label></p>
                                                <p style="width: 200px; margin: auto;">
                                                    <input type="number" name="price" class="form-control wa-text-center" id="wa-product-bid-price" placeholder="00.00" required>
                                                    <small><i>(<?php _e('increment price') ?> <span><?php echo WA_Helper::currency( $meta_fields['_wa_bid_increment'][0] ); ?>)</i></span></small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>"/>
                                            
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php _e( 'Close', 'wa' ); ?></button>
                                            <button type="button" id="wa-btn-bid-js" class="btn btn-primary"><?php _e( 'Bid', 'wa' ); ?></button>     
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; // end of the loop. ?>
        	<?php
        		/**
        		 * woocommerce_after_main_content hook
        		 *
        		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
        		 */
        		do_action( 'woocommerce_after_main_content' );
        	?>
<?php get_footer( 'shop' ); ?>
