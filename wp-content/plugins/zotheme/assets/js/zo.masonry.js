/**
 * Created by John Nguyen on 03-08-2015.
 */
jQuery(document).ready(function ($) {
    "use strict";
    $('.zo-masonry').each(function(){
        var $grid = $(this),
            $parent = $grid.parent().attr('id'),
            $filter = $grid.parent().find('.zo-masonry-filter'),
            options = zoMasonry[$parent];
        $grid.find('.zo-masonry-item').append('<div class="shuffle__sizer"></div>');
        options.columnWidth = zo_masonry_col_width($grid, options);

        $grid.imagesLoaded(function(){
            $grid.shuffle({
                itemSelector:'.zo-masonry-item',
                sizer: $grid.find('.shuffle__sizer')
            });
        });
        $(window).resize(function(){
            if($grid.data('resize') == true){
                zo_masonry_col_width($grid, options);
                $grid.shuffle('update');
            }
        });
        if($filter){
            $filter.find('a').click(function(e){
                e.preventDefault();
                // set active class
                $filter.find('a').removeClass('active');
                $(this).addClass('active');

                // get group name from clicked item
                var groupName = $(this).attr('data-group');
                // reshuffle grid
                $(this).parent().parent().parent().parent().find('.zo-masonry').shuffle('shuffle', groupName );
            });
        }
    });



    function zo_masonry_col_width($container, options){
        //var w = $container.width(),
        var ww = $(window).width(),
            w = $container.width(),
            columnNum = 1,
            columnWidth = 0,
            columnHeight = 0;
        if(ww < 768){
            columnNum = options.grid_cols_xs;
        } else if(ww >= 768 && ww < 992){
            columnNum = options.grid_cols_sm;
        } else if(ww >= 992 && ww < 1200){
            columnNum = options.grid_cols_md;
        } else if(ww >= 1200){
            columnNum = options.grid_cols_lg;
        }
        columnWidth = Math.floor((w-options.grid_margin*(columnNum-1))/columnNum);
        columnHeight = columnWidth*options.grid_ratio;
        $container.find('.shuffle__sizer').css({
            width: columnWidth,
            margin: options.grid_margin
        });

        $container.find('.zo-masonry-item').each(function() {
            var $item = $(this),
                multiplier_w = $item.attr('class').match(/item-w(\d)/),
                multiplier_h = $item.attr('class').match(/item-h(\d)/),
                width = columnNum==1?columnWidth:multiplier_w[1]*columnWidth + (multiplier_w[1]-1)*options.grid_margin,
                height = columnNum==1?columnHeight:multiplier_h[1]*columnHeight +(multiplier_h[1]-1)*options.grid_margin;
            $item.css({
                width: width,
                height: height,
                marginBottom: options.grid_margin
            });
        });
        return columnWidth;
    }
});