<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package On_Point
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'row' ); ?>>
  
  <header class="small-12 medium-3 large-3 large-offset-1 columns single-post-header">
    <div class="author-image">
      <?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>
    </div>
    
    <div class="author-meta">
      <div class="author-link">
        <a href="<?php echo get_the_author_meta( 'url' ); ?>" target="_blank" title="connect with <?php esc_attr( the_author() ); ?>">
          <i class="fa fa-globe" aria-hidden="true"></i>
          <cite class="author"><?php the_author(); ?></cite>
        </a>
      </div>
    </div>
    
    <div class="post-meta">
      <div class="date"><?php the_time( 'jS M Y' ); ?></div>
      <p class="title"><?php the_title(); ?></p>
    </div>
  </header>
  
  <section class="small-12 medium-9 large-7 columns single-post-content-wrap">
    <div class="single-post-content">
      <?php the_content(); ?>
    </div>
  </section>
  
  <footer class="small-12 medium-9 medium-offset-3 large-7 large-offset-4 entry-footer">
		<?php on_point_entry_footer(); ?>
	</footer>
	
</article>