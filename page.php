<?php/** * The Page template * * @package ProperWeb * @subpackage ProperFramework * @since ProperFramework 1.0 */?><?php get_header(); ?><div class="row row-with-sidebar no-gutters">    <div class="cell"><?php if(have_posts()): while(have_posts()): the_post(); ?>	<div class="article article-with-sidebar box full-width">		<h2 class="title"><?php the_title(); ?></h2>		<?php the_content(); ?>	</div>    <?php endwhile; endif; ?>    </div>    <div id="aside" class="right-sidebar">        <div  class="box with-pads">            <ul id="aside-sidebar" class="sidebar">                <?php get_sidebar('default'); ?>                 <?php dynamic_sidebar( 'Page Aside' ); ?>            </ul>        </div>    </div></div><?php get_footer(); ?>