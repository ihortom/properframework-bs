<?php 
// Borrowed from FoundationPress
class Top_Bar_Walker extends Walker_Nav_Menu {
    function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
        $element->has_children = ! empty( $children_elements[ $element->ID ] );
        $element->classes[] = ( $element->current || $element->current_item_ancestor ) ? 'active' : '';
        $element->classes[] = ( $element->has_children && 1 !== $max_depth ) ? 'dropdown' : '';
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
    function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
        $item_html = '';
        parent::start_el( $item_html, $object, $depth, $args );
        //$output .= ( 0 == $depth ) ? '<li class="divider"></li>' : '';
        $classes = empty( $object->classes ) ? array() : (array) $object->classes;
        if ( in_array( 'dropdown', $classes ) ) {
                $item_html = preg_replace( '/<a[^>]*>(.*)<\/a>/iU', '<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">$1 <span class="caret"></span></a>', $item_html );
        }
        if ( in_array( 'divider', $classes ) ) {
                $item_html = preg_replace( '/<a[^>]*>( .* )<\/a>/iU', '', $item_html );
        }
                $output .= $item_html;
    }
    function start_lvl( &$output, $depth = 0, $args = array() ) {
            $output .= "\n<ul class=\"sub-menu dropdown-menu\">\n";
    }
}

class Offcanvas_Walker extends Walker_Nav_Menu {
    function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
        $element->has_children = ! empty( $children_elements[ $element->ID ] );
        $element->classes[] = ( $element->current || $element->current_item_ancestor ) ? 'active' : '';
        $element->classes[] = ( $element->has_children && 1 !== $max_depth ) ? 'has-submenu' : '';
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
    function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
        $item_html = '';
        parent::start_el( $item_html, $object, $depth, $args );
        $classes = empty( $object->classes ) ? array() : (array) $object->classes;
        if ( in_array( 'label', $classes ) ) {
                $item_html = preg_replace( '/<a[^>]*>(.*)<\/a>/iU', '<label>$1</label>', $item_html );
        }
        $output .= $item_html;
    }
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= "\n<ul class=\"left-submenu\">\n<li class=\"back\"><a href=\"#\">". __( 'Back', 'properweb' ) ."</a></li>\n";
    }
}
?>