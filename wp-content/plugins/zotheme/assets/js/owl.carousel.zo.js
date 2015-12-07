(function ($) {
    "use strict";
    $(document).ready(function () {
        $(".zo-carousel").each(function () {
            var $this = $(this), slide_id = $this.attr('id'), slider_settings = zocarousel[slide_id];
            $this.addClass('owl-carousel owl-theme');
            $this.owlCarousel(slider_settings);
        });
    });
    $(window).load(function(){
        $('.zo-carousel-filter a').click(function(e){
            e.preventDefault();
            var parent = $(this).closest('.zo-carousel-wrap');
            $('.zo-carousel-filter a').removeClass('active');
            var filter = $(this).data('group');
            $(this).addClass('active');
            zoCarouselFilter( filter, parent );
        });
    });

    /**
     * Carousel Filter
     * @param filter category
     * @param parent
     */
    function zoCarouselFilter( filter, parent ){
        console.log(filter);
        if ( filter == 'all'){
            $('.zo-carousel-filter-hidden .zo-carousel-filter-item', parent).each(function(){
                var owl   = $(".zo-carousel", parent);
                var parentElem      = $(this).parent(),
                    elem = parentElem.html();
                owl.trigger('add.owl.carousel', [elem]).trigger('refresh.owl.carousel');
                parentElem.remove();
            });
        } else {
            $('.zo-carousel-filter-hidden .zo-carousel-filter-item.'+ filter, parent).each(function(){
                var owl = $(".owl-carousel", parent);
                var parentElem      = $(this).parent(),
                    elem = parentElem.html();
                owl.trigger('add.owl.carousel', [elem]).trigger('refresh.owl.carousel');
                parentElem.remove();
            });

            $('.zo-carousel .zo-carousel-filter-item:not(".'+filter+'")', parent)
                .each(function(){
                var owl   = $(".zo-carousel", parent);
                var parentElem = $(this).parent(),
                    targetPos = parentElem.index();
                $( parentElem ).clone().appendTo( $('.zo-carousel-filter-hidden', parent) );
                owl.trigger('remove.owl.carousel', [targetPos]).trigger('refresh.owl.carousel');
            });
        }
    }
})(jQuery);