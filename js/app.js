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
            html: true,
            content: function () {
                var clone = $($(this).data('popover-content')).clone(true).show();
                return clone;
            }
        }).on('click hover focus',function(e) {e.preventDefault(); });
    
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
