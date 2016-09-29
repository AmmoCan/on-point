<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package On_Point
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses on_point_header_style()
 * @uses on_point_admin_header_style()
 * @uses on_point_admin_header_image()
 */
function on_point_custom_header_setup() {
  
	add_theme_support( 'custom-header', apply_filters( 'on_point_custom_header_args', array(
  	'default-color'          => '0a0a0a',
		'default-image'          => '',
		'default-text-color'     => 'f5f5f5',
		'width'                  => 1920,
		'height'                 => 1080,
		'flex-height'            => true,
		'wp-head-callback'       => 'on_point_header_style',
		'admin-head-callback'    => 'on_point_admin_header_style',
		'admin-preview-callback' => 'on_point_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'on_point_custom_header_setup' );

if ( ! function_exists( 'on_point_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see on_point_custom_header_setup().
 */
function on_point_header_style() {
  $default_text_color = 'f5f5f5';
	$header_text_color = get_header_textcolor();
	$default_bkg_color = '#0a0a0a';
	$header_background_color = get_theme_mod( 'header_background_color', $default_bkg_color );
	$header_image = get_header_image();
	
	// If no header image & display site title is unchecked, let's bail.
	if ( empty( $header_image ) && ! display_header_text() ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
  <?php
		// Has a Custom Header been added?
		if ( ! empty( $header_image ) ) :
	?>
      .front-page-bkg-image:before {
        background: url(<?php header_image(); ?>) #0a0a0a no-repeat center;
      }
	<?php
  	// Has the header background color been changed?
  	elseif ( $header_background_color !== $default_bkg_color ) :
  ?>
      .site-header {
        background: <?php echo esc_attr( $header_background_color ); ?>;
      }
  <?php
		endif;
		
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
  		.site-title a,
  		.site-description {
    		clip: rect(1px, 1px, 1px, 1px);
  			position: absolute;
  		}
	<?php
		// Has the header text color been changed?
		elseif ( $header_text_color !== $default_text_color ) :
	?>
  		.site-title a:hover,
  		.site-description {
  			color: #<?php echo esc_attr( $header_text_color ); ?>;
  		}
	<?php 
  	endif; 
  ?>
	</style>
	<?php
}
endif; // on_point_header_style

if ( ! function_exists( 'on_point_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see on_point_custom_header_setup().
 */
function on_point_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; //on_point_admin_header_style
?>