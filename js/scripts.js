
(function ($) {
"use strict";

    jQuery(document).ready(function() {
        
        /*----------------------------
                isotop type 1 active
            ------------------------------*/
        jQuery('.portfolio-menu li').on('click', function() {
            jQuery('.portfolio-menu li.active').removeClass('active');
            jQuery(this).addClass('active');
        });
       
        /*----------------------------
                   Isotop type 3 active
            ------------------------------*/
        jQuery('.portfolio_container').imagesLoaded(function() {

            jQuery('.portfolio-menu li').on('click', function() {
                var filterValue = jQuery(this).attr('data-filter');
                $folios3.isotope({
                    filter: filterValue
                });
            });
            var $folios3 = jQuery('.all-folio').isotope({
                itemSelector: '.folios-item',
                percentPosition: true,
                transitionDuration: '0.9s',
                // only opacity for reveal/hide transition
                hiddenStyle: {
                    opacity: 0
                },
                visibleStyle: {
                    opacity: 1
                },
                masonry: {
                    // use outer width of grid-sizer for columnWidth
                    columnWidth: '.folios-item'
                }
            });
        });

    });


}(jQuery)); 


    