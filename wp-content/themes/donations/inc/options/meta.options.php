<?php
/**
 * Meta options
 * 
 * @author ZoTheme
 * @since 1.0.0
 */
class ZOMetaOptions
{
    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('admin_enqueue_scripts', array($this, 'admin_script_loader'));
    }
    /* add script */
    function admin_script_loader()
    {
        global $pagenow;
        if (is_admin() && ($pagenow == 'post-new.php' || $pagenow == 'post.php')) {
            wp_enqueue_style('metabox', get_template_directory_uri() . '/inc/options/css/metabox.css');
            
            wp_enqueue_script('easytabs', get_template_directory_uri() . '/inc/options/js/jquery.easytabs.min.js');
            wp_enqueue_script('metabox', get_template_directory_uri() . '/inc/options/js/metabox.js');
        }
    }
    /* add meta boxs */
    public function add_meta_boxes()
    {
        $this->add_meta_box('template_page_options', __('Setting', THEMENAME), 'page');
        $this->add_meta_box('rating_option', __('Testimonial Rating', THEMENAME), 'testimonial');
        $this->add_meta_box('pricing_option', __('Pricing Option', THEMENAME), 'pricing');
        $this->add_meta_box('donation_option', __('Donation Option', THEMENAME), 'zodonations');
        $this->add_meta_box('event_option', __('Event Option', THEMENAME), 'event');
        $this->add_meta_box('team_option', __('Team About', THEMENAME), 'team');
    }
    
    public function add_meta_box($id, $label, $post_type, $context = 'advanced', $priority = 'default')
    {
        add_meta_box('_zo_' . $id, $label, array($this, $id), $post_type, $context, $priority);
    }
    /* --------------------- PAGE ---------------------- */
    function template_page_options() {
        ?>
        <div class="tab-container clearfix">
	        <ul class='etabs clearfix'>
	           <li class="tab"><a href="#tabs-general"><i class="fa fa-server"></i><?php _e('General', THEMENAME); ?></a></li>
	           <li class="tab"><a href="#tabs-header"><i class="fa fa-diamond"></i><?php _e('Header', THEMENAME); ?></a></li>
	           <li class="tab"><a href="#tabs-page-title"><i class="fa fa-connectdevelop"></i><?php _e('Page Title', THEMENAME); ?></a></li>
	        </ul>
	        <div class='panel-container'>
                <div id="tabs-general">
                <?php
                zo_options(array(
                    'id' => 'full_width',
                    'label' => __('Full Width',THEMENAME),
                    'type' => 'switch',
                    'options' => array('on'=>'1','off'=>''),
                ));
                ?>
                </div>
                <div id="tabs-header">
                <?php
                /* header. */
                zo_options(array(
                    'id' => 'header',
                    'label' => __('Header',THEMENAME),
                    'type' => 'switch',
                    'options' => array('on'=>'1','off'=>''),
                    'follow' => array('1'=>array('#page_header_enable'))
                ));
                ?>  <div id="page_header_enable"><?php
                zo_options(array(
                    'id' => 'header_layout',
                    'label' => __('Layout',THEMENAME),
                    'type' => 'imegesselect',
                    'options' => array(
                        '' => get_template_directory_uri().'/inc/options/images/header/h-default.png'
                    )
                ));
                zo_options(array(
                    'id' => 'enable_header_fixed',
                    'label' => __('Header Fixed',THEMENAME),
                    'type' => 'switch',
                    'options' => array('on'=>'1','off'=>''),
                    'follow' => array('1'=>array('#page_header_fixed_enable'))
                ));
                ?> <div id="page_header_fixed_enable"><?php
                zo_options(array(
                    'id' => 'header_fixed_bg_color',
                    'label' => __('Background Color',THEMENAME),
                    'type' => 'color',
                    'default' => '#fff',
                    'rgba' => true
                ));
                zo_options(array(
                    'id' => 'header_fixed_menu_color',
                    'label' => __('Menu Color - First Level',THEMENAME),
                    'type' => 'color',
                    'default' => ''
                ));
                zo_options(array(
                    'id' => 'header_fixed_menu_color_hover',
                    'label' => __('Menu Color - First Level',THEMENAME),
                    'type' => 'color',
                    'default' => ''
                ));
                zo_options(array(
                    'id' => 'header_fixed_menu_color_active',
                    'label' => __('Menu Active - First Level',THEMENAME),
                    'type' => 'color',
                    'default' => ''
                ));
                ?> </div><?php
                $menus = array();
                $menus[''] = 'Default';
                $obj_menus = wp_get_nav_menus();
                foreach ($obj_menus as $obj_menu){
                    $menus[$obj_menu->term_id] = $obj_menu->name;
                }
                $navs = get_registered_nav_menus();
                foreach ($navs as $key => $mav){
                    zo_options(array(
                    'id' => $key,
                    'label' => $mav,
                    'type' => 'select',
                    'options' => $menus
                    ));
                }
                ?>
                </div>
                </div>
                <div id="tabs-page-title">
                <?php
                /* page title. */
                zo_options(array(
                    'id' => 'page_title',
                    'label' => __('Page Title',THEMENAME),
                    'type' => 'switch',
                    'options' => array('on'=>'1','off'=>''),
                    'follow' => array('1'=>array('#page_title_enable'))
                ));
                ?>  <div id="page_title_enable"><?php
                zo_options(array(
                    'id' => 'page_title_text',
                    'label' => __('Title',THEMENAME),
                    'type' => 'text',
                ));
                zo_options(array(
                    'id' => 'page_title_sub_text',
                    'label' => __('Sub Title',THEMENAME),
                    'type' => 'text',
                ));
                zo_options(array(
                    'id' => 'page_title_margin',
                    'label' => __('Page Title Margin',THEMENAME),
                    'type' => 'text',
                ));
                zo_options(array(
                    'id' => 'page_title_type',
                    'label' => __('Layout',THEMENAME),
                    'type' => 'imegesselect',
                    'options' => array(
                        '' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-0.png',
                        '1' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-1.png',
                        '2' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-2.png',
                        '3' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-3.png',
                        '4' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-4.png',
                        '5' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-5.png',
                        '6' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-6.png',
                    )
                ));
                ?>
                </div>
                </div>
            </div>
        </div>
        <?php
    }
    /* --------------------- RATING TESTIMONIAL ---------------------- */
    function rating_option(){
        ?>
        <div class="testimonial-rating">
            <?php
                zo_options(array(
                    'id' => 'testimonial_rating',
                    'label' => __('Rating',THEMENAME),
                    'type' => 'select',
                    'options' => array(
                        ''=>'None',
                        '1star'=>'1 Start',
                        '2star'=>'2 Start',
                        '3star'=>'3 Start',
                        '4star'=>'4 Start',
                        '5star'=>'5 Start'
                    )
                ));
            ?>
        </div>
        <?php
    }
    /* --------------------- PRICING ---------------------- */

    function pricing_option() {
        ?>
        <div class="pricing-option-wrap">
            <table class="wp-list-table widefat fixed">
                <tr>
                    <td>
                        <?php
                        zo_options(array(
                            'id' => 'sub_title',
                            'label' => __('Sub Title',THEMENAME),
                            'type' => 'text',
                        )); ?>
                    </td>
                    <td>
                        <?php
                        zo_options(array(
                            'id' => 'price',
                            'label' => __('Price',THEMENAME),
                            'type' => 'text',
                        )); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        zo_options(array(
                            'id' => 'value',
                            'label' => __('Value',THEMENAME),
                            'type' => 'select',
                            'options' => array(
                                'Month' => 'Month',
                                'Year' => 'Year'
                            )
                        )); ?>
                    </td>
                    <td>
                        <?php
                        zo_options(array(
                            'id' => 'option1',
                            'label' => __('Option 1',THEMENAME),
                            'type' => 'text',
                        )); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        zo_options(array(
                            'id' => 'option2',
                            'label' => __('Option 2',THEMENAME),
                            'type' => 'text',
                        )); ?>
                    </td>
                    <td>
                        <?php
                        zo_options(array(
                            'id' => 'option3',
                            'label' => __('Option 3',THEMENAME),
                            'type' => 'text',
                        )); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        zo_options(array(
                            'id' => 'option4',
                            'label' => __('Option 4',THEMENAME),
                            'type' => 'text',
                        )); ?>
                    </td>
                    <td>
                        <?php
                        zo_options(array(
                            'id' => 'option5',
                            'label' => __('Option 5',THEMENAME),
                            'type' => 'text',
                        )); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        zo_options(array(
                            'id' => 'option6',
                            'label' => __('Option 6',THEMENAME),
                            'type' => 'text',
                        )); ?>
                    </td>
                    <td>
                        <?php
                        zo_options(array(
                            'id' => 'option7',
                            'label' => __('Option 7',THEMENAME),
                            'type' => 'text',
                        )); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        zo_options(array(
                            'id' => 'option8',
                            'label' => __('Option 8',THEMENAME),
                            'type' => 'text',
                        )); ?>
                    </td>
                    <td>
                        <?php
                        zo_options(array(
                            'id' => 'option9',
                            'label' => __('Option 9',THEMENAME),
                            'type' => 'text',
                        )); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        zo_options(array(
                            'id' => 'option10',
                            'label' => __('Option 10',THEMENAME),
                            'type' => 'text',
                        )); ?>
                    </td>
                    <td>
                        <?php
                        zo_options(array(
                            'id' => 'button_url',
                            'label' => __('Button Url',THEMENAME),
                            'type' => 'text',
                        )); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        zo_options(array(
                            'id' => 'button_text',
                            'label' => __('Button Text',THEMENAME),
                            'type' => 'text',
                        )); ?>
                    </td>
                    <td>
                        <?php
                        zo_options(array(
                            'id' => 'is_feature',
                            'label' => __('Is feature',THEMENAME),
                            'type' => 'switch',
                            'options' => array('on'=>'1','off'=>''),
                        )); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php
                        zo_options(array(
                            'id' => 'best_value',
                            'label' => __('Best Value',THEMENAME),
                            'type' => 'text',
                        ));?>
                    </td>
                </tr>
            </table>
        </div>
    <?php
    }
    /* --------------------- PRICING ---------------------- */
    function donation_option(){
        ?>
        <div class="zo-donation">
            <?php
            zo_options(array(
                'id' => 'donation_startdate',
                'label' => __('Start Date',THEMENAME),
                'type' => 'datetime',
                'placeholder' => '',
                'format' => 'Y/m/d H:s'
            ));
            zo_options(array(
                'id' => 'donation_phone',
                'label' => __('Phone',THEMENAME),
                'type' => 'text',
                'placeholder' => '+84123456789'
            ));
            zo_options(array(
                'id' => 'donation_email',
                'label' => __('Email',THEMENAME),
                'type' => 'text',
                'placeholder' => 'example@domain.com'
            ));
            ?>
        </div>
    <?php
    }
    /* --------------------- PRICING ---------------------- */
    function event_option()
    {
        ?>
        <div class="event-options">
            <?php
            zo_options(array(
                'id' => 'event_startdate',
                'label' => __('Start Date', THEMENAME),
                'type' => 'datetime',
                'placeholder' => '',
                'format' => 'Y/m/d H:s'
            ));
            zo_options(array(
                'id' => 'event_enddate',
                'label' => __('End Date', THEMENAME),
                'type' => 'datetime',
                'placeholder' => '',
                'format' => 'Y/m/d H:s'
            ));
            zo_options(array(
                'id' => 'event_location',
                'label' => __('Location', THEMENAME),
                'type' => 'text',
                'placeholder' => '123 address'
            ));
            zo_options(array(
                'id' => 'event_phone',
                'label' => __('Phone', THEMENAME),
                'type' => 'text',
                'placeholder' => '+84123456789'
            ));
            zo_options(array(
                'id' => 'event_email',
                'label' => __('Email', THEMENAME),
                'type' => 'text',
                'placeholder' => 'example@domain.com'
            ));
            ?>
        </div>
    <?php
    }
    /*-----------------------TEAM-------------------------*/
    function team_option() {
        ?>
        <div class="event-options">
            <?php
            zo_options(array(
                'id' => 'team_position',
                'label' => __('Position', THEMENAME),
                'type' => 'text',
                'placeholder' => '',
            ));
            zo_options(array(
                'id' => 'team_facebook',
                'label' => __('Facebook', THEMENAME),
                'type' => 'text',
                'placeholder' => '',
            ));
            zo_options(array(
                'id' => 'team_twitter',
                'label' => __('Twitter', THEMENAME),
                'type' => 'text',
                'placeholder' => '',
            ));
            zo_options(array(
                'id' => 'team_linkedin',
                'label' => __('Linkedin', THEMENAME),
                'type' => 'text',
                'placeholder' => '',
            ));
            ?>
        </div>
        <?php
    }
}

new ZOMetaOptions();