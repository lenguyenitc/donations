<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'woocommerce_after_single_product_summary_no_tabs', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary_no_tabs', 'woocommerce_output_related_products', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 30 );
get_header( 'shop' ); ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        	<?php
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
                $_extra_data = ['date_start' => $dates['start'], 
                                'date_end' => $dates['end'], 
                                'view' => 'single'];
                
                if($date_start > $date_now) {
                    $date_countdown = $dates['start'];
                    $_extra_data['status'] = 'close';
                    array_push($_extra_class, 'wa-item-close');
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
                    <div id="wa-product-single-item-js" class="wa-product-single-item <?php echo esc_attr( implode(' ', $_extra_class) ); ?>">
                        <div class="col-md-7">
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
                        <div class="col-md-5">
                            <div class="wa-product-info">
                                <h1 class="wa-text-transform"><?php the_title(); ?></h1>
                                <!-- Count down -->
                                <div class="wa-product-item-timer">
                                    <span class="countdown" data-extradata="<?php echo esc_attr( json_encode( $_extra_data ) ); ?>" data-datatime="<?php echo esc_attr($date_countdown); ?>" data-format="<?php echo esc_attr( $wa_countdown_format ); ?>">
                                        <span class="clock"></span>
                                    </span>
                                    <!-- dateend -->
                                    <?php $_date_end_display_class = ($_extra_data['status'] == 'close')? 'wa-hidden' : ''; ?>
                                    <p class="auction-date-ends <?php echo esc_attr($_date_end_display_class); ?>">
                                        <?php _e('Auction ends:', THEMENAME) ?> <?php
                                        $_end_date = new DateTime( $dates['end'] );
                                        $_end_date = $_end_date->format('M d,Y H:i:s');
                                        echo do_shortcode($_end_date);
                                        echo do_shortcode(' (' . get_option('timezone_string') . ')');
                                        ?>
                                    </p>
                                </div>

                                <!-- info owner -->
                                <?php if( get_option( 'wa_display_owner_info', 1 ) ) { ?>
                                <h2><?php _e('Product Owner:', THEMENAME); ?></h2>
                                <div class="wa-owner-info">
                                    <?php if( ! empty( $meta_fields['_wa_owner_name'][0] ) ) { ?>
                                    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12 wa-owner-item">
                                        <span><i class="fa fa-user" title="<?php _e( 'Owner name', THEMENAME ) ?>"></i></span>
                                        <span><?php echo esc_attr($meta_fields['_wa_owner_name'][0]) ?></span>
                                    </div>
                                    <?php } ?>
                                    <?php if( ! empty( $meta_fields['_wa_owner_phone'][0] ) ) { ?>
                                    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12 wa-owner-item">
                                        <span><i class="fa fa-mobile-phone" title="<?php _e( 'Phone', THEMENAME ) ?>"></i></span>
                                        <span><?php echo esc_attr($meta_fields['_wa_owner_phone'][0]) ?></span>
                                    </div>
                                    <?php } ?>
                                    <?php if( ! empty( $meta_fields['_wa_owner_email'][0] ) ) { ?>
                                    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12 wa-owner-item">
                                        <span><i class="fa fa-envelope" title="<?php _e( 'Email', THEMENAME ) ?>"></i></span>
                                        <span><a href="mailto:<?php echo esc_attr( $meta_fields['_wa_owner_email'][0] ); ?>"><?php echo esc_attr($meta_fields['_wa_owner_email'][0]); ?></a></span>
                                    </div>
                                    <?php } ?>
                                    <?php if( ! empty( $meta_fields['_wa_owner_fax'][0] ) ) { ?>
                                    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12 wa-owner-item">
                                        <span><i class="fa fa-mobile-phone" title="<?php _e( 'Fax', THEMENAME ) ?>"></i></span>
                                        <span><?php echo esc_attr($meta_fields['_wa_owner_fax'][0]) ?></span>
                                    </div>
                                    <?php } ?>
                                    <?php if( ! empty( $meta_fields['_wa_owner_address'][0] ) ) { ?>
                                    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12 wa-owner-item">
                                        <span><i class="fa fa-map-marker " title="<?php _e( 'Address', THEMENAME ) ?>"></i></span>
                                        <span><?php echo esc_attr($meta_fields['_wa_owner_address'][0]) ?></span>
                                    </div>
                                    <?php } ?>
                                    <?php if( ! empty( $meta_fields['_wa_owner_url'][0] ) ) { ?>
                                    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12 wa-owner-item">
                                        <span><i class="fa fa-link" title="<?php _e( 'Url', THEMENAME ) ?>"></i></span>
                                        <span><a href="<?php echo esc_url( $meta_fields['_wa_owner_url'][0] ); ?>" target="_blank"><?php echo esc_attr($meta_fields['_wa_owner_url'][0]); ?></a></span>
                                    </div>
                                    <?php } ?>
                                    <?php if( ! empty( $meta_fields['_wa_owner_description'][0] ) ) { ?>
                                    <div class="col-md-12 wa-owner-item">
                                        <?php echo esc_attr($meta_fields['_wa_owner_description'][0]) ?>
                                    </div>
                                    <?php } ?>
                                    <div class="clearfix"></div>
                                </div>
                                <?php } ?>
                                
                                <h2><?php _e('Product Price: ', THEMENAME) ?></h2>
                                <ul class="wa-info-bid">
                                    <!-- display Start price -->
                                    <?php if( get_option( 'wa_display_start_price', 1 ) == 1 ) { ?>
                                    <li>
                                        <span><?php _e('Current bid: ', THEMENAME) ?></span>
                                        <span id="current-bid-price" data-request-current-bid="true" data-timer="2000" data-productid="<?php echo esc_attr( $post->ID ); ?>"></span>
                                        <span>(<?php _e('Init price:', THEMENAME) ?> <?php echo WA_Helper::currency( $meta_fields['_wa_start_price'][0] ); ?>)</span>
                                    </li>
                                    <?php } ?>
    
                                    <!-- display Bid increment -->
                                    <?php if( get_option( 'wa_display_bid_increment', 1 ) == 1 ) { ?>
                                    <?php } ?>

                                    <!-- display Reserve price -->
                                    <?php if( get_option( 'wa_display_reserve_price', 1 ) == 1 ) { ?>
                                    <li>
                                        <span><?php _e('Reserve price: ', THEMENAME) ?></span> <span><?php echo WA_Helper::currency( $meta_fields['_wa_reserve_price'][0] ); ?></span>
                                    </li>
                                    <?php } ?>

                                    <!-- display Buy now price -->
                                    <?php if( get_option( 'wa_display_buy_now_price', 1 ) == 1 ) { ?>
                                    <li>
                                        <span><?php _e('Buy now price: ', THEMENAME) ?></span> <span><?php echo WA_Helper::currency( $meta_fields['_wa_buy_it_now_price'][0] ); ?></span>
                                    </li>
                                    <?php } ?>
                                </ul>

                                <!-- button -->

                                <?php $_btn_display_class = ($_extra_data['status'] == 'close')? 'wa-hidden' : ''; ?>
                                
                                <div class="wa-btn-content wa-text-center <?php echo esc_attr($_btn_display_class); ?>">
                                    <?php echo do_shortcode( $Woo_Auction->wa_render_btn_single_page() ); ?>
                                </div>
                            </div>
                        </div>

                        <div class="wa-product-bid-content col-md-12">
                            <div class="wa-header-bid-tabs">
                                <?php 

                                    $num_comments = get_comments_number(); // get_comments_number returns only a numeric value

                                    if ( comments_open() ) {
                                        if ( $num_comments == 0 ) {
                                            $comments = __('0', THEMENAME);
                                        } elseif ( $num_comments > 1 ) {
                                            $comments = $num_comments;
                                        } else {
                                            $comments = __('1', THEMENAME);
                                        }
                                        $write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
                                    } else {
                                        $write_comments =  __('Comments are off for this post.', THEMENAME );
                                    }

                                    $tabs_name = array(
                                    "description" => __('Description', THEMENAME),
                                    "reviews" => __('Reviews', THEMENAME) . ' <small class="wa-text-lowercase">(' . $write_comments . ')</small>',
                                    "bids" => __('Bids', THEMENAME ),
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
                                            <h4 class="modal-title"><?php _e( 'Bid ', THEMENAME ); the_title(); ?></h4>
                                        </div>
                                        <div class="modal-body wa-text-center">
                                            <div class="wa-status"></div>
                                            <div class="wa-highest-bid-price-product"></div>
                                            <div class="">
                                                <p><label for="wa-product-bid-price"><?php _e( 'Bid price', THEMENAME  ) ?> (<?php echo WA_Helper::currency(); ?>)</label></p>
                                                <p style="width: 200px; margin: auto;">
                                                    <input type="number" name="price" class="form-control wa-text-center" id="wa-product-bid-price" placeholder="00.00" required>
                                                    <small><i>(<?php _e('increment price', THEMENAME) ?> <span><?php echo WA_Helper::currency( $meta_fields['_wa_bid_increment'][0] ); ?>)</i></span></small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>"/>
                                            
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php _e( 'Close', THEMENAME ); ?></button>
                                            <button type="button" id="wa-btn-bid-js" class="btn btn-primary"><?php _e( 'Bid', THEMENAME ); ?></button>     
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; // end of the loop. ?>
        	<?php
        		do_action( 'woocommerce_after_main_content' );
        	?>
        </div>
    </div>
</div>
<?php get_footer( 'shop' ); ?>
