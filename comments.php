<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package On_Point
 * @since On_Point 1.0.0
 */

if ( have_comments() ) :
	if ( ( is_page() || is_single() ) && ( ! is_home() && ! is_front_page() ) ) :
?>
	<section id="comments" class="row align-left">
  	
  <?php
		wp_list_comments(
			array(
				'walker'            => new On_point_Comments(),
				'max_depth'         => '',
				'style'             => 'ol',
				'callback'          => null,
				'end-callback'      => null,
				'type'              => 'all',
				'reply_text'        => __( 'Reply', 'on_point' ),
				'page'              => '',
				'per_page'          => '',
				'avatar_size'       => 48,
				'reverse_top_level' => null,
				'reverse_children'  => '',
				'format'            => 'html5',
				'short_ping'        => false,
				'echo'  	    => true,
				'moderation' 	    => __( 'Your comment is awaiting moderation.', 'on_point' ),
			)
		);
  ?>

 	</section>
<?php
	endif;
endif;
?>

<?php
	/*
	Do not delete these lines.
	Prevent access to this file directly
	*/
	defined( 'ABSPATH' ) or die( __( 'Please do not load this page directly. Thanks!', 'on_point' ) );

	if ( post_password_required() ) {
?>
  	<section id="comments" class="row align-center">
  		<div class="notice">
  			<p class="bottom"><?php _e( 'This post is password protected. Enter the password to view comments.', 'on_point' ); ?></p>
  		</div>
  	</section>
<?php
		return;
	}
?>

<?php
if ( comments_open() ) :
	if ( ( is_page() || is_single() ) && ( ! is_home() && ! is_front_page() ) ) :
?>
    <section id="respond" class="row align-center">
      
      <div class="small-12 columns">
    	  <h2 class="section-title">
      	  <?php comment_form_title( __( 'Leave a Reply', 'on_point' ), __( 'Leave a Reply to %s', 'on_point' ) ); ?>
        </h2>
      </div>
      
      <div id="respond-wrap" class="column small-12 medium-7 large-5">
      	<p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
      	
  <?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) : ?>
      	  <p class="login-to-comment">
        	  <?php printf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'on_point' ), wp_login_url( get_permalink() ) ); ?>
          </p>
          
  <?php else : ?>
      	  <form action="<?php echo get_option( 'siteurl' ); ?>/wp-comments-post.php" method="post" id="commentform">
        	  
    <?php if ( is_user_logged_in() ) : ?>
        		<p><?php printf( __( 'Logged in as <a href="%s/wp-admin/profile.php">%1$s</a>.', 'on_point' ), get_option( 'siteurl' ), $user_identity ); ?>
        		  <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php __( 'Log out of this account', 'on_point' ); ?>"><?php _e( 'Log out &raquo;', 'on_point' ); ?></a>
        		</p>
        		
    <?php else : ?>
        		<p>
        			<label for="author">
        				<?php
        					_e( 'Name', 'on_point' ); if ( $req ) { _e( ' (required)', 'on_point' ); }
        				?>
        			</label>
        			<input type="text" class="five" name="author" id="author" value="<?php echo esc_attr( $comment_author ); ?>" size="22" tabindex="1" <?php if ( $req ) { echo "aria-required='true'"; } ?>>
        		</p>
        		
        		<p>
        			<label for="email">
        				<?php
        					_e( 'Email (will not be published)', 'on_point' ); if ( $req ) { _e( ' (required)', 'on_point' ); }
        				?>
        			</label>
        			<input type="text" class="five" name="email" id="email" value="<?php echo esc_attr( $comment_author_email ); ?>" size="22" tabindex="2" <?php if ( $req ) { echo "aria-required='true'"; } ?>>
        		</p>
        		
        		<p>
        			<label for="url">
        				<?php
        					_e( 'Website', 'on_point' );
        				?>
        			</label>
        			<input type="text" class="five" name="url" id="url" value="<?php echo esc_attr( $comment_author_url ); ?>" size="22" tabindex="3">
        		</p>
    <?php endif; // If user is logged in is true. ?>
    
        		<p>
        			<label for="comment">
        					<?php
        						_e( 'Comment', 'on_point' );
        					?>
        			</label>
        			<textarea name="comment" id="comment" tabindex="4"></textarea>
        		</p>
        		
        		<p id="allowed_tags" class="small"><strong>XHTML:</strong>
        			<?php
        				_e( 'You can use these tags:','on_point' );
        			?>
        			<code>
        				<?php echo allowed_tags(); ?>
        			</code>
        		</p>
        		
        		<p>
          		<input name="submit" class="hollow button" type="submit" id="submit" tabindex="5" value="<?php esc_attr_e( 'Submit Comment', 'on_point' ); ?>">
            </p>
        		<?php comment_id_fields(); ?>
        		<?php do_action( 'comment_form', $post->ID ); ?>
      	  </form><!-- #commentform -->
  <?php endif; // If registration required and not logged in. ?>
  
      </div><!-- #respond-wrap -->
      
    </section><!-- #respond -->
<?php
	endif; // If a page or single post is true and not home and front-page is true.
endif; // If comments are open is true.