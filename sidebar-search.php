<?php
/**
 * The sidebar apearing in the search results and 404 pages
 *
 * @package ProperWeb
 * @subpackage ProperFramework-BS
 * @since ProperFramework-BS 1.0
 */
 ?>

    <li class="widget">
        <?php get_search_form(); ?>
    </li>       

    <li class="widget">		
        <h3><?php _e('Posts you might be interested in','properweb'); ?>:</h3>
        <ul>
            <?php
                $args = array( 
                    'numberposts' => '20',
                    'orderby' => 'name',
                    'order' => 'ASC',
                    'post_type' => 'post'
                );
                $recent_posts = wp_get_recent_posts( $args );
                foreach( $recent_posts as $recent ){
                    echo '<li><a href="' . get_permalink($recent["ID"]) . '">' . $recent["post_title"].'</a></li> ';
                }
            ?>
        </ul>
    </li>
    <?php 
        dynamic_sidebar( 'Post Aside' );
    ?>
