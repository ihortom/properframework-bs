<?php
/**
 * The theme functions
 *
 * @package ProperWeb
 * @subpackage ProperFramework-BS
 * @since ProperFramework-BS 1.0
 * @uses Meta Box: 'rwmb_meta_boxes' @see http://metabox.io/
 * @uses Single-Choice Post Taxonomy: 'pweb_post_type' @see ../../mu-plugins/pweb_single_choice_tax.php
 * @uses Breadcrumb NavXT: 'bcn_display' @see http://mtekk.us/code/breadcrumb-navxt/
 */

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
    $content_width = 1000;
}

// Removing all the junk from wordpress head we don't need.
require_once(get_template_directory().'/functions/cleanup.php'); 

// Add relevant stylesheets and scripts within <head> tags (register scripts and stylesheets)
require_once(get_template_directory().'/functions/enqueue-scripts.php'); 

// Add menu compatible with 'foundation' framework
require_once(get_template_directory().'/functions/menu.php');
require_once(get_template_directory().'/functions/menu-walkers.php'); 

// Register new custom fields in Settings > General
require_once(get_template_directory().'/functions/admin.php'); 

// Register sidebars/widget areas
require_once(get_template_directory().'/functions/sidebars.php'); 

// Add support for meta tags (custom fields)
require_once(get_template_directory().'/functions/meta.php'); 

// Customize login page
require_once(get_template_directory().'/functions/login.php'); 

// Theme support (featured image)
require_once(get_template_directory().'/functions/theme-support.php'); 

// Pagination compatible with 'foundation' markup
require_once(get_template_directory().'/functions/pagination.php'); 

// Custom comments list
require_once(get_template_directory().'/functions/comments.php');

// Custom search form
require_once(get_template_directory().'/functions/search-form.php');

// Custom paginated gallery
require_once(get_template_directory().'/functions/gallery.php');

/* SHORTCODES */

//Create shortcode to add Guest Book on the page
//Don't confuse with comments, which are added automatically once enabled for the post
add_shortcode('gbook', 'pweb_gbook');
//usage [gbook]
function pweb_gbook() {	
    ob_start();
    include('functions/gbook.php');
    $gbook = ob_get_clean(); //Get the buffer and erase it
    return $gbook;
}

//create shortcode to mention the company name ostentatiously in articles/posts
add_shortcode('company', 'pweb_company');

//usage [company]
function pweb_company() {
    $company = get_bloginfo();
    return "«<strong><em><span class=\"company\">{$company}</span></em></strong>»";
}
  
//create shortcode to make a separator of the new article within the page
add_shortcode('article', 'pweb_article');

//usage [article title=""]
function pweb_article( $atts ) {
    return '<h2 class="title">' . $atts[title] . '</h2>';
}

//Create shortcode for promotions to use the featured image as a background image
//and to highlight the promo's startand end date
add_shortcode('promo', 'pweb_promo');

//usage [promo start="mm/dd/yy" end="mm/dd/yy" height="px" bgsize="%" line=""]
function pweb_promo( $atts, $content = null  ) {
    global $featured_image_url;
    $regex = "/^[0-1][0-9]\/[0-3][0-9]\/[1-2][0-9]$/";	//american format
    $dated = true;
    
    $atts = shortcode_atts(
        array(
            'start' => false,
            'end'   => false,
            'height'=> 'auto',
            'bgsize'=> '100',
            'line'  => '1'
        ), $atts, 'promo' );
    
    $start = preg_match($regex, trim($atts['start']), $start_date);
    $end = preg_match($regex, trim($atts['end']), $end_date);
    try {
        if ( $start && $end ) {
                $start = new DateTime($start_date[0]);
                $end = new DateTime($end_date[0]);
        }
        elseif ( $start ) {
                $start = new DateTime($start_date[0]);
        }
        elseif ( $end ) {
                $end = new DateTime($end_date[0]);
        }
        else $dated = false;
    }
    catch (Exception $e) { $dated = false; }

    if ( $dated ) { 
        if ( $start && $end ) {
                $range = date_format($start, get_option( 'date_format' )) . ' – '. date_format($end, get_option( 'date_format' ));
        }
        elseif ( $start ) $range = date_format($start, get_option( 'date_format' ));
        else $range = __('till ') . date_format($end, get_option( 'date_format' ));
        $period = 
            '<div class="row meta-data">'
            . '<p class="col-sm-12 promo-date"><span class="glyphicon glyphicon-calendar"></span> ' . $range . '</p>'
            . '<div class="clearfix"></div>'
            . '<p class="line col-sm-12"></p></div>';
    }
    else $period = '';
    return ($period . '<div class="promo" style="height:'.$atts['height'].'px;background-size:'.$atts['bgsize'].'%; background-image: url('.$featured_image_url.'); line-height:'.$atts['line'].'">'. $content . '</div>');
}

//create shortcode to make a separator of the new article within the page
add_shortcode('promo_flash', 'pweb_promo_flash');

//usage [promo_flash id="#"] where id is the relevant promo post ID
function pweb_promo_flash( $atts ) {
    
    $atts = shortcode_atts(
        array(
                'id' => '0',
        ), $atts, 'promo_flash' );
    
    $promo_post = get_posts( array( 'include' => array($atts['id'])) );
    
    return '
        <div class="alert alert-info alert-promo alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p class="flashref">'.__('Promotion','properweb').': <a href="#flash" class="alert-link" data-toggle="modal">«'.$promo_post[0]->post_title.'»</a></p>
        </div>
        <div id="flash" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="flashTitle">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <span class="glyphicon glyphicon-remove"></span>
                        </button>
                        <h2 id="flashTitle" class="title modal-title">'.strip_tags($promo_post[0]->post_title).'</h2>                   
                    </div>
                    <div class="modal-body">'.
                        wpautop( do_shortcode($promo_post[0]->post_content) ) .
                    '</div>
                </div>
            </div>
        </div>';
}

//Load translations
add_action('after_setup_theme', 'pweb_theme_setup');

function pweb_theme_setup(){
    load_theme_textdomain('properweb', get_template_directory() . '/lang');
}

// CHANGE LOCAL LANGUAGE
// for translations debug purposes (ex. www.example.com/?l=ru_RU)
// must be called before load_theme_textdomain()
add_filter( 'locale', 'pweb_theme_localized' );

function pweb_theme_localized( $locale )
{
    if ( isset( $_GET['l'] ) ) {
        return sanitize_key( $_GET['l'] );
    }

    return $locale;
}

?>
