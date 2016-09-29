<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package On_Point
 */
?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

  	<section id="contact" class="row skroll">

    	<div class="small-12 columns">
        <h2 class="section-title">Contact</h2>
      </div>
    <?php 
  		$query = new WP_Query( 'pagename=contact' );
  		// The Loop
  		if ( $query->have_posts() ) :
    ?>
        <div id="contact-wrap" class="row">
        <?php
    			while ( $query->have_posts() ) {
    				$query->the_post();
    				echo '<div class="small-12 medium-8 medium-offset-2 columns entry-content">';
    				the_content();
    				echo '</div>';
    			}
        ?>
  			</div><!-- #contact-wrap -->
    <?php
  		else :
    ?>
  		  <div id="widget-wrap" class="row small-up-1 medium-up-3 align-spaced">
        <?php
          if ( is_active_sidebar( 'footer-left-widget' )  ) :
        	  dynamic_sidebar( 'footer-left-widget' );
          endif;
        ?>
        <?php
          if ( is_active_sidebar( 'footer-center-widget' )  ) :
        	  dynamic_sidebar( 'footer-center-widget' );
          endif;
        ?>
        <?php
          if ( is_active_sidebar( 'footer-right-widget' )  ) :
        	  dynamic_sidebar( 'footer-right-widget' );
          endif;
        ?>
        </div><!-- #widget-wrap -->
    <?php
      endif;
  		// Restore original Post Data 
  		wp_reset_postdata();
    ?>
  		<div class="row align-left site-info">
  			<address>
    			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" role="contentinfo" target="_self" title="<?php bloginfo( 'name' ); ?>">
          &copy; <?php echo date( 'Y' ); ?>&nbsp;<?php bloginfo( 'name' ); ?>&nbsp;>>>&nbsp;<?php bloginfo( 'description' ); ?></a>
    			<span class="sep">&nbsp;|&nbsp;</span>
    			<a href="http://linkedin.com/in/ammocan" rel="designer">Theme by: Ammo</a>
  			</address>
  		</div><!-- .site-info -->
  		
  	</section><!-- #contact -->
  	
	</footer><!-- #colophon -->

<!-- This is where the non-css action happens -->
<?php wp_footer(); ?>

</body>
</html>