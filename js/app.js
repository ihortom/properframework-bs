jQuery(document).ready(
    function($) {
        
        $('[data-reveal-id="flash"]').trigger('click');
        
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
            placement: 'auto right',
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
        
        // add hover effect to navbar-toogle
        $('#btn-container, #navbar').hover(
            function() {
                if (!$('#navbar').is(':visible')) {
                    $('.navbar-toggle').trigger('click');
                }
            },
            function() {
                if (!$('#navbar:hover, #btn-container:hover').length) {
                    $('.navbar-toggle').trigger('click');
                }
            }
        );
    }
);
