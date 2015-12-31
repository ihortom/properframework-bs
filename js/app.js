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

        //gallery pagination
        var total_pages = parseInt($('.gallery').attr('gallery-pages'));
        var imgs_per_page = parseInt($('.gallery').attr('imgs-per-page'));
        var current_page = 1;
        
        //$('.gallery-item').slice(imgs_per_page).hide();
        //$('.gallery-item').slice(0,imgs_per_page).show();
        //$('#fast-backward, #backward').addClass('disabled');
        
        $('.gallery-fast-backward a').click(function() {
            var gallery = $(this).parents('.gallery');
            var gallery_nav = $(this).parents('.gallery-nav');
            gallery.children('.gallery-item').hide();
            gallery.children('.gallery-item').slice(0,imgs_per_page).fadeToggle();
            if (!gallery_nav.find('.gallery-fast-backward').hasClass('disabled')) {
                gallery_nav.find('.gallery-fast-backward').addClass('disabled');
            }
            if (!gallery_nav.find('.gallery-backward').hasClass('disabled')) {
                gallery_nav.find('.gallery-backward').addClass('disabled');
            }
            if (gallery_nav.find('.gallery-fast-forward').hasClass('disabled')) {
                gallery_nav.find('.gallery-fast-forward').removeClass('disabled');
            }
            if (gallery_nav.find('.gallery-forward').hasClass('disabled')) {
                gallery_nav.find('.gallery-forward').removeClass('disabled');
            }
            gallery_nav.find('.gallery_page').text('1');
            current_page = 1;
            return false;
        });
        $('.gallery-backward a').click(function() {
            var gallery = $(this).parents('.gallery');
            var gallery_nav = $(this).parents('.gallery-nav');
            if (current_page > 1) {                
                current_page--;
                gallery_nav.find('.gallery_page').text(current_page.toString());
                gallery.children('.gallery-item').hide();
                gallery.children('.gallery-item').slice((current_page-1)*imgs_per_page,(current_page-1)*imgs_per_page + imgs_per_page).fadeToggle();
                              
                if (gallery_nav.find('.gallery-forward').hasClass('disabled')) {
                    gallery_nav.find('.gallery-forward').removeClass('disabled');
                }
                if (gallery_nav.find('.gallery-fast-forward').hasClass('disabled')) {
                    gallery_nav.find('.gallery-fast-forward').removeClass('disabled');
                }
                if (current_page == 1) {
                    if (!gallery_nav.find('.gallery-fast-backward').hasClass('disabled')) {
                        gallery_nav.find('.gallery-fast-backward, #backward').addClass('disabled');
                    }
                    if (!gallery_nav.find('.gallery-backward').hasClass('disabled')) {
                        gallery_nav.find('.gallery-backward').addClass('disabled');
                    } 
                }
            }
            $(this).blur();
            return false;
        });
        $('.gallery-forward a').click(function() {
            var gallery = $(this).parents('.gallery');
            var gallery_nav = $(this).parents('.gallery-nav');
            if (current_page < total_pages) {                
                current_page++;
                gallery_nav.find('.gallery_page').text(current_page.toString());
                gallery.children('.gallery-item').hide();
                gallery.children('.gallery-item').slice((current_page-1)*imgs_per_page,(current_page-1)*imgs_per_page + imgs_per_page).fadeToggle();
                              
                if (gallery_nav.find('.gallery-backward').hasClass('disabled')) {
                    gallery_nav.find('.gallery-backward').removeClass('disabled');
                }
                if (gallery_nav.find('.gallery-fast-backward').hasClass('disabled')) {
                        gallery_nav.find('.gallery-fast-backward').removeClass('disabled');
                    }
                if (current_page == total_pages) {
                    if (!gallery_nav.find('.gallery-fast-forward').hasClass('disabled')) {
                        gallery_nav.find('.gallery-fast-forward').addClass('disabled');
                    }
                    if (!gallery_nav.find('.gallery-forward').hasClass('disabled')) {
                        gallery_nav.find('.gallery-forward').addClass('disabled');
                    } 
                }
            }
            $(this).blur();
            return false;
        });
        $('.gallery-fast-forward a').click(function() {
            var gallery = $(this).parents('.gallery');
            var gallery_nav = $(this).parents('.gallery-nav');
            current_page = total_pages;
            gallery.children('.gallery-item').hide();
            gallery.children('.gallery-item').slice((current_page-1)*imgs_per_page,(current_page-1)*imgs_per_page + imgs_per_page).fadeToggle();
            if (!gallery_nav.find('.gallery-fast-forward').hasClass('disabled')) {
                gallery_nav.find('.gallery-fast-forward').addClass('disabled');
            }
            if (!gallery_nav.find('.gallery-forward').hasClass('disabled')) {
                gallery_nav.find('.gallery-forward').addClass('disabled');
            }
            if (gallery_nav.find('.gallery-fast-backward').hasClass('disabled')) {
                gallery_nav.find('.gallery-fast-backward').removeClass('disabled');
            }
            if (gallery_nav.find('.gallery-backward').hasClass('disabled')) {
                gallery_nav.find('.gallery-backward').removeClass('disabled');
            }
            gallery_nav.find('.gallery_page').text(current_page.toString());
            return false;
        });
    }
);
