<?php/** * The Post template * * @package ProperWeb * @subpackage ProperFramework-BS * @since ProperFramework-BS 1.0 */?><?php get_header(); ?><?php if(have_posts()): while(have_posts()): the_post(); ?>        <?php if ( has_post_thumbnail() ) : ?>        <div class="row">            <div class="col-lg-12">                <div class="featured-image">                <?php the_post_thumbnail( 'post-featured-image' ); ?>                </div>            </div>        </div>    <?php endif; ?>            <div class="row row-with-sidebar">        <div class="cell">            <div class="article article-with-sidebar box full-width">                <h2 class="title"><?php the_title(); ?></h2>                <div class="row meta-data">                    <p class="col-sm-12 secondary">                    <time datetime="<?php the_date(); ?>"><span class="glyphicon glyphicon-calendar"></span>                        <?php the_time( get_option( 'date_format' ) ); ?>                    </time>                    </p>                    <div class="clearfix"></div>                    <p class="line col-sm-12"></p>                </div>                <?php the_content(); ?>            </div>            <br>            <?php if (comments_open()) : ?>                <div id="comments_wrap" class="article article-with-sidebar box full-width">                    <h2 class="title">Comments</h2>                    <?php comments_template(); ?>                </div>            <?php endif; ?>                    </div>            <?php get_sidebar(); ?>        </div>    <?php endwhile; endif; ?><?php get_footer(); ?>