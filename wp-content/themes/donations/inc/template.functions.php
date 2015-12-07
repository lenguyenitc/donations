<?php
/**
 * Page title template
 * @since 1.0.0
 * @author ZoTheme
 */
 /* Set variable for scss */
function zo_setvariablescss($var, $output, $var_default, $var_empty = null) {
	if(trim($var_empty) == null || trim($var_empty) == '') $var_empty = $var_default;
    $var = isset($var) ? (empty($var) ? $var_empty : esc_attr($var)) : $var_default;
    echo do_shortcode($output . ':' . $var . ';'). "\n";
}

function zo_page_title(){
    global $smof_data, $zo_meta, $zo_base;

    /* page options */
    if(is_page() && isset($zo_meta->_zo_page_title) && $zo_meta->_zo_page_title){
        if(isset($zo_meta->_zo_page_title_type)){
            $smof_data['page_title_layout'] = $zo_meta->_zo_page_title_type;
        }
    }

    if($smof_data['page_title_layout']){
        $page_title_before = '<div id="page-title" class="page-title">
            <div class="container">
            <div class="row">';
        $page_title_after = '</div></div></div><!-- #page-title -->';

        $breadcrumb_before = '<div id="breadcrumb" class="breadcrumb">
            <div class="container-fluid">
            <div class="row">';
        $breadcrumb_after = '</div></div></div><!-- #breadcrumb -->';
        ?>

            <?php switch ($smof_data['page_title_layout']){
                case '1':
                    ?>
                    <?php echo do_shortcode($page_title_before); ?><div id="page-title-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><h1><?php $zo_base->getPageTitle(); ?></h1><?php zo_page_sub_title(); ?></div><?php echo do_shortcode($page_title_after); ?>
                    <?php echo do_shortcode($breadcrumb_before); ?><div id="breadcrumb-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php $zo_base->getBreadCrumb(); ?></div><?php echo do_shortcode($breadcrumb_after); ?>
                    <?php
                    break;
                case '2':
                    ?>
                    <?php echo do_shortcode($breadcrumb_before); ?><div id="breadcrumb-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php $zo_base->getBreadCrumb(); ?></div><?php echo do_shortcode($breadcrumb_after); ?>
                    <?php echo do_shortcode($page_title_before); ?><div id="page-title-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><h1><?php $zo_base->getPageTitle(); ?></h1><?php zo_page_sub_title(); ?></div><?php echo do_shortcode($page_title_after); ?>
                    <?php          
                    break;
                case '3':
                    ?>
                    <?php echo do_shortcode($page_title_before); ?><div id="page-title-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><h1><?php $zo_base->getPageTitle(); ?></h1><?php zo_page_sub_title(); ?></div><?php echo do_shortcode($page_title_after); ?>
                    <?php echo do_shortcode($breadcrumb_before); ?><div id="breadcrumb-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php $zo_base->getBreadCrumb(); ?></div><?php echo do_shortcode($breadcrumb_after); ?>
                    <?php
                    break;
                case '4':
                    ?>
                    <?php echo do_shortcode($breadcrumb_before); ?><div id="breadcrumb-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php $zo_base->getBreadCrumb(); ?></div><?php echo do_shortcode($breadcrumb_after); ?>
                    <?php echo do_shortcode($page_title_before); ?><div id="page-title-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><h1><?php $zo_base->getPageTitle(); ?></h1><?php zo_page_sub_title(); ?></div><?php echo do_shortcode($page_title_after); ?>
                    <?php
                    break;
                case '5':
                    ?>
                    <?php echo do_shortcode($page_title_before); ?><div id="page-title-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><h1><?php $zo_base->getPageTitle(); ?></h1><?php zo_page_sub_title(); ?></div><?php echo do_shortcode($page_title_after); ?>
                    <?php
                    break;
                case '6':
                    ?>
                    <?php echo do_shortcode($breadcrumb_before); ?><div id="breadcrumb-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php $zo_base->getBreadCrumb(); ?></div><?php echo do_shortcode($breadcrumb_after); ?>
                    <?php
                    break;
            } ?>

        <?php
    }
}

/**
 * Get sub page title.
 *
 * @author ZoTheme
 */
function zo_page_sub_title(){
    global $zo_meta, $post;

    if(!empty($zo_meta->_zo_page_title_sub_text)){
        echo '<div class="page-sub-title">'.esc_attr($zo_meta->_zo_page_title_sub_text).'</div>';
    } elseif (!empty($post->ID) && get_post_meta($post->ID, 'post_subtitle', true)){
        echo '<div class="page-sub-title">'.esc_attr(get_post_meta($post->ID, 'post_subtitle', true)).'</div>';
    }
}

/**
 * Get Header Layout.
 * 
 * @author ZoTheme
 */
function zo_header(){
    global $smof_data, $zo_meta;
    /* header for page */
    if(isset($zo_meta->_zo_header) && $zo_meta->_zo_header){
        if(isset($zo_meta->_zo_header_layout)){
            $smof_data['header_layout'] = $zo_meta->_zo_header_layout;
        }
    }
    /* load template. */
    get_template_part('inc/header/header', $smof_data['header_layout']);
}

/**
 * Get menu location ID.
 * 
 * @param string $option
 * @return NULL
 */
function zo_menu_location($option = '_zo_primary'){
    global $zo_meta;
    /* get menu id from page setting */
    return (isset($zo_meta->$option) && $zo_meta->$option) ? $zo_meta->$option : null ;
}

function zo_get_page_loading() {
    global $smof_data;
    
    if($smof_data['enable_page_loadding']){
        echo '<div id="zo-loadding">';
        switch ($smof_data['page_loadding_style']){
            case '2':
                echo '<div class="ball"></div>';
                break;
            default:
                echo '<div class="loader"></div>';
                break;
        }
        echo '</div>';
    }
}

/**
 * Add page class
 * 
 * @author ZoTheme
 * @since 1.0.0
 */
function zo_page_class(){
    global $smof_data;
    
    $page_class = '';
    /* check boxed layout */
    if($smof_data['body_layout']){
        $page_class = 'zo-boxed';
    } else {
        $page_class = 'zo-wide';
    }
    
    echo apply_filters('zo_page_class', $page_class);
}

/**
 * Add main class
 * 
 * @author ZoTheme
 * @since 1.0.0
 */
function zo_main_class(){
    global $zo_meta;
    
    $main_class = '';
    /* chect content full width */
    if(is_page() && isset($zo_meta->_zo_full_width) && $zo_meta->_zo_full_width){
        /* full width */
        $main_class = "container-fluid";
    } else {
        /* boxed */
        $main_class = "container";
    }
    
    echo apply_filters('zo_main_class', $main_class);
}

/**
 * Single detail
 *
 * @author ZoTheme
 * @since 1.0.0
 */
function zo_single_detail(){
    
}

/**
 * Show post like.
 *
 * @since 1.0.0
 */
function zo_get_post_like(){

    $likes = get_post_meta(get_the_ID() , '_zo_post_likes', true);

    if(!$likes) $likes = 0;

    ?>
    <span class="zo-post-like" data-id="<?php the_ID(); ?>"><i class="<?php echo !isset($_COOKIE['zo_post_like_'. get_the_ID()]) ? 'fa fa-heart-o' : 'fa fa-heart' ; ?>"></i><span><?php echo esc_attr($likes); ?></span></span>
<?php
}

/**
 * Archive detail
 * 
 * @author ZoTheme
 * @since 1.0.0
 */
function zo_archive_detail(){
    ?>
    <ul>
        <li class="detail-date"><i class="fa fa-calendar"></i> <?php echo get_the_date("d M Y"); ?></li>
        <?php if(has_category()): ?>
            <li class="detail-terms"><?php the_terms( get_the_ID(), 'category', '<i class="fa fa-folder-o"></i>', ' / ' ); ?></li>
        <?php endif; ?>
        <li class="detail-author"><i class="fa fa-pencil-square-o"></i><?php _e('By', THEMENAME); ?> <?php the_author_posts_link(); ?></li>
        <li class="detail-like"><?php zo_get_post_like(); ?> <?php _e('Likes', THEMENAME); ?></li>
        <li class="detail-comment"><i class="fa fa-comments-o"></i><a href="<?php the_permalink(); ?>"><?php echo comments_number('0','1','%'); ?> <?php _e('Comments', THEMENAME); ?></a></li>
    </ul>
    <?php
}

/**
 * Archive readmore
 * 
 * @author ZoTheme
 * @since 1.0.0
 */
function zo_archive_readmore(){
    echo '<a class="btn btn-default" href="'.get_the_permalink().'" title="'.get_the_title().'" >'.__('Continue Reading', THEMENAME).'</a>';
}

/**
 * Media Audio.
 * 
 * @param string $before
 * @param string $after
 */
function zo_archive_audio() {
	global $zo_base, $smof_data;
    /* get shortcode audio. */
    $shortcode = $zo_base->getShortcodeFromContent('audio', get_the_content());
    
    if($shortcode){
        echo do_shortcode($shortcode);
        
        return true;
        
    } elseif(has_post_thumbnail()){
        the_post_thumbnail();
    }
    
}

/**
 * Media Video.
 *
 * @param string $before
 * @param string $after
 */
function zo_archive_video() {
    
    global $wp_embed, $zo_base, $smof_data;
    /* Get Local Video */
    $local_video = $zo_base->getShortcodeFromContent('video', get_the_content());
    
    /* Get Youtobe or Vimeo */
    $remote_video = $zo_base->getShortcodeFromContent('embed', get_the_content());
    
    if($local_video){
        /* view local. */
        echo do_shortcode($local_video);
        
        return true;
        
    } elseif ($remote_video) {
        /* view youtobe or vimeo. */
        echo do_shortcode($wp_embed->run_shortcode($remote_video));
        
        return true;
        
    } elseif (has_post_thumbnail()) {
        /* view thumbnail. */
        the_post_thumbnail();
    }
}

/**
 * Gallerry Images
 * 
 * @author ZoTheme
 * @since 1.0.0
 */
function zo_archive_gallery(){
	global $zo_base, $smof_data;
    /* get shortcode gallery. */
    $shortcode = $zo_base->getShortcodeFromContent('gallery', get_the_content());
    
    if($shortcode != ''){
        preg_match('/\[gallery.*ids=.(.*).\]/', $shortcode, $ids);
        
        if(!empty($ids)){
        
            $array_id = explode(",", $ids[1]);
            ?>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                <?php $i = 0; ?>
                <?php foreach ($array_id as $image_id): ?>
        			<?php
                    $attachment_image = wp_get_attachment_image_src($image_id, 'full', false);
                    if($attachment_image[0] != ''):?>
        				<div class="item <?php if( $i == 0 ){ echo 'active'; } ?>">
                    		<img style="width:100%;" data-src="holder.js" src="<?php echo esc_url($attachment_image[0]);?>" alt="" />
                    	</div>
                    <?php $i++; endif; ?>
                <?php endforeach; ?>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        		    <span class="fa fa-angle-left"></span>
        		</a>
        		<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        		    <span class="fa fa-angle-right"></span>
        		</a>
        	</div>
            <?php
            
            return true;
        
        } else {
            return false;
        }
    } elseif(has_post_thumbnail()){
            the_post_thumbnail();
    }
}

/**
 * Quote Text.
 * 
 * @author ZoTheme
 * @since 1.0.0
 */
function zo_archive_quote() {
    global $smof_data;
    /* get text. */
    preg_match('/\<blockquote\>(.*)\<\/blockquote\>/', get_the_content(), $blockquote);
    
    if(!empty($blockquote[0])){
        echo ''.$blockquote[0].'';
        return true;
    } elseif(has_post_thumbnail()){
        the_post_thumbnail();
    }
}

/**
 * Get icon from post format.
 * 
 * @return multitype:string Ambigous <string, mixed>
 * @author ZoTheme
 * @since 1.0.0
 */
function zo_archive_post_icon() {
    $post_icon = array('icon'=>'fa fa-file-text-o','text'=>__('STANDARD', THEMENAME));
    switch (get_post_format()) {
        case 'gallery':
            $post_icon['icon'] = 'fa fa-camera-retro';
            $post_icon['text'] = __('GALLERY', THEMENAME);
            break;
        case 'link':
            $post_icon['icon'] = 'fa fa-external-link';
            $post_icon['text'] = __('LINK', THEMENAME);
            break;
        case 'quote':
            $post_icon['icon'] = 'fa fa-quote-left';
            $post_icon['text'] = __('QUOTE', THEMENAME);
            break;
        case 'video':
            $post_icon['icon'] = 'fa  fa-youtube-play';
            $post_icon['text'] = __('VIDEO', THEMENAME);
            break;
        case 'audio':
            $post_icon['icon'] = 'fa fa-volume-up';
            $post_icon['text'] = __('AUDIO', THEMENAME);
            break;
        default:
            $post_icon['icon'] = 'fa fa-image';
            $post_icon['text'] = __('STANDARD', THEMENAME);
            break;
    }
    echo '<i class="'.$post_icon['icon'].'"></i>';
}

/**
 * Get social share link
 *
 * @return string
 * @author Zacky
 * @since 1.0.0
 */

 function zo_social_share() {
     ?>
     <ul class="social-list">
         <li class="box"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink(); ?>" onclick="javascript:void window.open(this.href,'','width=600,height=300,resizable=true,left=200px,top=200px');return false;"><i class="fa fa-facebook"></i></a></li>
         <li class="box"><a href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&url=<?php echo get_the_permalink(); ?>" onclick="javascript:void window.open(this.href,'','width=600,height=300,resizable=true,left=200px,top=200px');return false;"><i class="fa fa-twitter"></i></a></li>
         <li class="box"><a href="https://www.linkedin.com/cws/share?url=<?php echo get_the_permalink(); ?>" onclick="javascript:void window.open(this.href,'','width=600,height=300,resizable=true,left=200px,top=200px');return false;"><i class="fa fa-linkedin"></i></a></li>
         <li class="box"><a href="https://plus.google.com/share?url=<?php echo get_the_permalink(); ?>" onclick="javascript:void window.open(this.href,'','width=600,height=300,resizable=true,left=200px,top=200px');return false;"><i class="fa fa-google-plus"></i></a></li>
     </ul>
    <?php
 }