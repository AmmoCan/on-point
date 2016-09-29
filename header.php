<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package On_Point
 */
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?> dir="ltr">
<head>
<!--
    Theme: On Point
    Developed by: Ammo
    Date: 28 SEP 2016 
-->
<!-- Basic Page Needs
  ================================================== -->
  <meta charset="<?php bloginfo( 'charset' ); ?>">
<!-- Browser Specific Metas
  ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- RSS
  ================================================== -->
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <link rel="alternate" type="application/rss+xml" title="On Point » Feed" href="<?php echo home_url( '/' ); ?>feed/">
<!-- Styling and Scripts
  ================================================== --> 
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<a class="skip-link show-for-sr" href="#content"><?php esc_html_e( 'Skip to content', 'on-point' ); ?></a>
<?php
if ( get_header_image() && is_front_page() ) :
?>
  <header id="masthead" class="row align-center site-header front-page-bkg-image skroll" role="banner">
	  <div class="small-12 columns blur"></div>
<?php
elseif ( is_single() && ! is_front_page() ) :
?>
  <header id="masthead" class="row align-center site-header single-post-bkg-image" role="banner" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
<?php
else :
?>
  <header id="masthead" class="row align-center site-header" role="banner">
<?php
endif;
?>
  <?php //display site logo or first letter of title if no logo is provided ?>
    <div class="site-branding small-12 columns">
      
      <div class="site-logo">
        <?php $site_title = get_bloginfo( 'name' ); ?>
  			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
    			<span class="show-for-sr">
  					<?php printf( esc_html__( 'Go to the home page of %1$s', 'on-point' ), $site_title ); ?>
  				</span>
			<?php
				// Display logo if Custom Logo or Site Icon is defined, otherwise display First Letter
				if ( has_custom_logo() ) :
					echo the_custom_logo();
				else : 
			?>
					<div class="site-firstletter" aria-hidden="true">
						<?php echo substr( $site_title, 0, 1 ); ?>
					</div>
			<?php
				endif; 
		  ?>
  			</a>
  	  </div>
  	  
  <?php
		if ( is_front_page() ) :
  ?>
			<h1 class="site-title">
  			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
    			<?php bloginfo( 'name' ); ?>
    			<span class="show-for-sr">
					  <?php printf( esc_html__( 'Go to the home page of %1$s', 'on-point' ), $site_title ); ?>
				  </span>
    		</a>
  		</h1>
  <?php
    else : 
  ?>
			<p class="site-title">
  			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
    			<?php bloginfo( 'name' ); ?>
    			<span class="show-for-sr">
					  <?php printf( esc_html__( 'Go to the home page of %1$s', 'on-point' ), $site_title ); ?>
				  </span>
    		</a>
  		</p>
  <?php
		endif;
  ?>
    </div><!-- .site-branding -->
    
  <?php
    // Display the profile markup if we are on the front-page
    // and we have a header background image
    if ( is_front_page() && get_header_image() ) :
  ?>
    <div id="profile-wrap" class="small-11 medium-6 large-5 columns">
      
      <div class="profile">
        <div class="profile-flipper">
          
          <div class="profile-front">
            <div class="profile-img-box">
              <?php the_post_thumbnail( array(200, 200), array( 'class' => 'profile-img' ) ); ?>
              <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x" aria-hidden="true"></i>
                <i class="fa fa-info fa-stack-1x fa-inverse" aria-hidden="true"></i>
                <span class="show-for-sr">more information revealed here</span>
              </span>
            </div>
            
            <div class="profile-heading">
            <?php
              $name = get_post_meta( get_the_ID(), 'name', true );
              $title = get_post_meta( get_the_ID(), 'title', true );
              if( ! empty( $name && $title ) ) {
                echo '<h4>' . $name . '</h4>';
                echo '<small>' . $title . '</small>';
              }
            ?>
            </div>
          </div><!-- .profile-front -->
          
          <div class="profile-back">
            <div class="profile-description">
            <?php
              $query = new WP_Query( 'pagename=home' );
              // The loop
              if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                  $query->the_post();
                  echo '<p>';
                  the_content();
                  echo '</p>';
                }
              }
              /* Restore original Post Data */
              wp_reset_postdata();
            ?>
            <?php
              $cta_text = get_post_meta( get_the_ID(), 'cta_text', true );
              $cta_link = get_post_meta( get_the_ID(), 'cta_link', true );
              if( ! empty( $cta_text && $cta_link ) ) {
                echo '<a href="' . $cta_link . '" class="hollow button" title="take action">' . $cta_text . '</a>';
              }
            ?>
            </div>
          </div><!-- .profile-back -->
          
        </div><!-- .profile-flipper -->
      </div><!-- .profile -->
      
      <div class="social">
        <ul class="accordion" data-accordion data-allow-all-closed="true" role="tablist">
          <li class="accordion-item" data-accordion-item>
          <?php
            $social = get_post_meta( get_the_ID(), 'social', true );
            if( ! empty( $social ) ) {
              echo '<a href="#" class="accordion-title" aria-controls="rbld11-accordion" role="tab" id="rbld11-accordion-label" aria-expanded="false" aria-selected="false">' . $social .'</a>';
            }
          ?>
            <div class="accordion-content" data-tab-content role="tabpanel" aria-labelledby="rbld11-accordion-label" aria-hidden="true" id="rbld11-accordion" style="display: none;">
              <ul>
                <?php on_point_social_menu(); ?><!-- Insert social-menu -->
              </ul>
            </div>
          </li>
        </ul>
      </div><!-- .social -->
      
    </div><!-- #profile-wrap -->
    
  <?php
    // Display the title of the post or page in the header
    // if we are not on the front-page
    elseif ( is_single() || is_home() || is_404() ) :
  ?>
    <div id="single-post-title-wrap" class="column small-12 medium-10 large-6">
    <?php
  		if ( is_single() ) :
  			the_title( '<h1 class="title">', '</h1>' );
    ?>
  			<ul class="single-post-share-links">
          <li>
            <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php esc_url( the_permalink() ); ?>&title=<?php the_title(); ?>&source=<?php echo esc_url( home_url() ); ?>" target="_blank" title="share this post on linkedin">
              <i class="fa fa-linkedin" aria-hidden="true"></i>
            </a>
          </li>
          <li>
            <a href="http://twitter.com/intent/tweet?status=<?php the_title(); ?>+<?php esc_url( the_permalink() ); ?>" target="_blank" title="share this post on twitter">
              <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
          </li>
          <li>
            <a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php esc_url( the_permalink() ); ?>" title="send this post to a friend">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </a>
          </li>
        </ul>
    <?php
      elseif ( is_home() ) :
        echo '<h1 class="title">Blog</h1>';
      elseif ( is_404() ) :
        echo '<h1 class="title">404</h1>';
  		else :
  			the_title( '<h2 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" title="go read the full ' . esc_attr( the_title_attribute() ) . ' article">', '</a></h2>' );
  		endif;
    ?>
    </div><!-- #single-post-title-wrap -->
  <?php
    endif;
  ?>
	</header><!-- #masthead -->
	
	<nav id="site-navigation" class="main-navigation" role="navigation">
  	
  	<?php
    // Adjust the breakpoint of the title-bar by adjusting this variable
    $breakpoint = "large"; ?>
  	
		<div class="title-bar" data-responsive-toggle="on-point-menu" data-hide-for="<?php echo $breakpoint ?>">
			<div class="title-bar-left">
        <button class="menu-icon" type="button" data-toggle></button>
        <span class="title-bar-title"><?php esc_html_e( 'Menu', 'on-point' ); ?></span>
			</div>
    </div>
    
    <div class="top-bar" id="on-point-menu">
      <div class="top-bar-left">
      <?php
        if ( is_front_page() ) :
          on_point_primary_menu(); ?><!-- Insert primary front-page-menu -->
      <?php
        else:
          on_point_secondary_menu(); ?><!-- Insert secondary single-page-menu -->
      <?php
        endif; ?>
      </div>
    </div>
    
	</nav><!-- #site-navigation -->

	<div id="content" class="site-content">