<?php
/*
 * Template Name: Attachment
 * @package ProperWeb
 * @subpackage ProperFramework-BS
 * @since ProperFramework-BS 1.2
 */
?>

<?php get_header(); ?>

<div class="row">
    
    <?php if(have_posts()): while(have_posts()): the_post(); ?>
	<div class="box full-width article article-attachment">
            <h2 class="title"><?php the_title(); ?></h2>
            <?php echo wp_get_attachment_image( get_the_ID(), 'large', false, array('class' => 'attachment img-responsive') ); ?>
            <?php 
                $caption = get_the_excerpt();
                if (trim($caption) != '')
                echo '<h3>'.preg_replace('/(<p>)?(.*)(<\/p>)?/', '$2', $caption).'</h3>';?>
            <?php the_content(); //image description ?>
            <p><a href="<?php echo get_permalink($post->post_parent); ?>">
                    <span class="glyphicon glyphicon-level-up"></span><?php _e('Return to parent page', 'properweb'); ?></a></p>
        </div>

    <?php endwhile; endif; ?>

</div>
    
<?php get_footer(); ?> 