<?php
/**
 * @name : Default
 * @package : ZoTheme
 * @author : ZoTheme
 */
?>
<?php global $smof_data, $zo_meta; ?>
<?php if ($smof_data['enable_header_top'] =='1'): ?>
<div id="zo-header-top">
    <div class="container">
        <div class="row">
            <?php if (is_active_sidebar('sidebar-5')) : ?>
                 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php dynamic_sidebar('sidebar-2'); ?></div>
            <?php endif; ?>
            <?php if (is_active_sidebar('sidebar-5')) : ?>
                 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php dynamic_sidebar('sidebar-3'); ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif;?>
<div id="zo-header" class="zo-main-header <?php if (!$smof_data['menu_sticky']) {echo 'no-sticky';} ?> <?php if ($smof_data['menu_sticky_tablets']) {echo 'sticky-tablets';} ?> <?php if ($smof_data['menu_sticky_mobile']) {echo 'sticky-mobile';} ?> <?php if (!empty($zo_meta->_zo_enable_header_fixed)) {echo 'header-fixed-page';} ?>">
    <div class="container-fluid">
        <div class="row">
            <div id="zo-header-logo" class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <a href="<?php echo home_url(); ?>"><img alt="" src="<?php echo esc_url($smof_data['main_logo']['url']); ?>"></a>
            </div>
            <div id="zo-header-navigation" class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <nav id="site-navigation" class="main-navigation" role="navigation">
                    <?php
                    
                    $attr = array(
                        'menu' =>zo_menu_location(),
                        'menu_class' => 'nav-menu menu-main-menu',
                    );
                    
                    $menu_locations = get_nav_menu_locations();
                    
                    if(!empty($menu_locations['primary'])){
                        $attr['theme_location'] = 'primary';
                    }
                    
                    /* enable mega menu. */
                    if(class_exists('HeroMenuWalker')){ $attr['walker'] = new HeroMenuWalker(); }
                    
                    /* main nav. */
                    wp_nav_menu( $attr ); ?>
                </nav>
            </div>
            <div id="zo-menu-mobile" class="collapse navbar-collapse"><i class="pe-7s-menu"></i></div>
        </div>
    </div>
</div>
<!-- #site-navigation -->