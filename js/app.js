jQuery(document).ready(
    function($) {
        
        //promo popup
        $('[data-reveal-id="flash"]').trigger('click');
        
        //dropdown hover on large screen
        $('.nav li.dropdown').hover(
            function() {
                if (!$('.navbar-header').is(':visible')) {
                    $(this).addClass('open');
                }
            }, 
            function() {
                if (!$('.navbar-header').is(':visible')) {
                    $(this).removeClass('open');
                }
            }
        );
        
        // handle HTML popovers
        $('[rel="popover"]').popover({
            container: 'body',
            placement: 'top',
            html: true,
            title: function () {
                return $('.popover-title').html();
            },
            content: function () {
                return $('.popover-content').html();
            }
        }).on('click hover focus',function(e) {e.preventDefault(); });
        
        $(document).on( 'click', '.popover-close',
            function() {
                $(this).parents(".popover").popover('hide');
            }
        );
    }
);
