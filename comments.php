<?php if ( comments_open() ) : ?>

    <div id="gbook">
	<div id="respond" class="panel panel-default">
            <h3><?php comment_form_title( __('LEAVE A COMMENT', 'properweb') ); ?></h3>

            <div id="cancel-comment-reply">
                    <small><?php cancel_comment_reply_link() ?></small>
            </div>

            <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
                    <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url( get_permalink() )); ?></p>
            <?php else : ?>

            <?php 
                $req = get_option('require_name_email');
                include_once 'parts/comments-form.php'; 
            ?>


            <?php endif; // If registration required and not logged in ?>
        </div>
	
<!-- COMMENTS -->
    <?php if ( have_comments() ) : ?>
        <div id="comments">	
                <h3 class="gbook-stats"><span class="glyphicon glyphicon-comment"></span> 
                    <?php printf( _n( '%1$s comment', '%1$s comments', 
                    get_comments_number(), 'properweb' ), number_format_i18n( get_comments_number() )); ?></h3>

                <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
                <div class="gbook-navigation nav-top">
                        <div class="alignright"><?php previous_comments_link(' <span class="glyphicon glyphicon-forward"></span> ') ?></div>
                        <div class="alignright"><?php next_comments_link(' <span class="glyphicon glyphicon-backward"></span> ') ?></div>
                </div>
                <div class="clearfix"></div>
                <?php endif; // check for comment navigation ?>

                <ul class="comment-list">
                        <?php wp_list_comments('type=comment&callback=pweb_comments'); //use custom comment list in functions.php ?>
                </ul>

                <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
                <div class="gbook-navigation nav-bottom">
                        <div class="alignright"><?php previous_comments_link(' <span class="glyphicon glyphicon-forward"></span> ') ?></div>
                        <div class="alignright"><?php next_comments_link(' <span class="glyphicon glyphicon-backward"></span> ') ?></div>
                </div>
                <div class="clearfix"></div>
                <?php endif; // check for comment navigation ?>

         <?php else : // this is displayed if there are no comments so far ?>
                <br>
            <div class="alert alert-info text-center">
                <span class="glyphicon glyphicon-info-sign"></span>
            <?php 
                if ( comments_open() ) {
                    _e('There are no comments yet. Be the first to leave a comment.','properweb');
                }
                else {
                    _e('Comments are closed.','properweb');
                } 
            ?>
                </div>
            <?php endif; ?>
    </div><!-- #gbook -->
<?php endif; // if you delete this the sky will fall on your head ?>
</div>
