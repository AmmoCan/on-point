<?php
/**
 * On Point functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package On_Point
 */

/**
 * Load functions from the library.
 */
// Clean up functions
require_once( 'lib/cleanup.php' );

// Add pagination for posts
require_once( 'lib/pagination.php' );

// Add comments walker
require_once( 'lib/comments-walker.php' );

// Register all navigation menus
require_once( 'lib/navigation.php' );

// Add menu walkers
require_once( 'lib/front-page-walker.php' );
require_once( 'lib/socialmenu-walker.php' );

// Create widget areas in sidebar and footer
require_once( 'lib/widget-areas.php' );

// Return entry meta information for posts
require_once( 'lib/entry-meta.php' );

// Enqueue scripts
require_once( 'lib/enqueue-scripts.php' );

// Setup theme
require_once( 'lib/theme-setup.php' );

// Add open graph data
require_once( 'lib/open-graph.php' );

// Register custom profile meta-box
require_once( 'lib/profile-metabox.php' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function on_point_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'on_point_content_width', 1200 );
}
add_action( 'after_setup_theme', 'on_point_content_width', 0 );

/**
 * Add IE conditional Google Fonts to header.
 */
function on_point_add_ie_google_fonts () {
  echo '<!--[if lt IE 9]>'. "\n";
  echo '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Dosis:400,700|Open+Sans:400,700">'. "\n";
  echo '<![endif]-->'. "\n";
}
add_action( 'wp_head', 'on_point_add_ie_google_fonts' );

/**
 * Add inline Google Fonts styling to header.
 */
function on_point_add_inline_google_fonts () {
  echo '<style>'. "\n";
  echo "@font-face {font-family:'Dosis';font-style:normal;font-weight:400;src:local('Dosis Regular'),local('Dosis-Regular'),url(https://fonts.gstatic.com/s/dosis/v6/Ewe0SEXPrakEimFzbOGwB6CWcynf_cDxXwCLxiixG1c.woff)format('woff');}". "\n";
  echo "@font-face {font-family:'Dosis';font-style:normal;font-weight:700;src:local('Dosis Bold'),local('Dosis-Bold'),url(https://fonts.gstatic.com/s/dosis/v6/x-7NZTw0n-ypOAaIE8uSrnYhjbSpvc47ee6xR_80Hnw.woff)format('woff');}". "\n";
  echo "@font-face {font-family:'Open Sans';font-style:normal;font-weight:400;src:local('Open Sans'),local('OpenSans'),url(https://fonts.gstatic.com/s/opensans/v13/cJZKeOuBrn4kERxqtaUH3bO3LdcAZYWl9Si6vvxL-qU.woff)format('woff');}". "\n";
  echo "@font-face {font-family:'Open Sans';font-style:normal;font-weight:700;src:local('Open Sans Bold'),local('OpenSans-Bold'),url(https://fonts.gstatic.com/s/opensans/v13/k3k702ZOKiLJc3WVjuplzKRDOzjiPcYnFooOUGCOsRk.woff)format('woff');}". "\n";
  echo '</style>'. "\n";
}
add_action( 'wp_head', 'on_point_add_inline_google_fonts' );

/* <-- Delete everything on this line if you want to add Google Analytics to your site
  
// Add Google Analytics
function on_point_google_analytics() {
  // Enter your unique Google Analytics code inside the single quotes below.
  $googleCode =  'Enter Your Analytics Code Here';
?>
  <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', '<?php echo $googleCode ?>', 'auto');
	  ga('send', 'pageview');
  </script>
<?php 
}
add_action( 'wp_footer', 'on_point_google_analytics', 26, 1 );

Delete everything on this line if you want to add Google Analytics to your site --> */

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Remove auto paragraph tags in submitted content & excerpt.
 */
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

/**
 * Remove the WordPress generator meta tag.
 */
function on_point_remove_generator_filter() { return ''; }

if ( function_exists( 'add_filter' ) ) {
 $types = array( 'html', 'xhtml', 'atom', 'rss2', 'rdf', 'comment', 'export' );

 foreach ( $types as $type )
 add_filter( 'get_the_generator_'.$type, 'on_point_remove_generator_filter' );
}

/**
 * Remove version parameter for scripts and styles.
 */
function on_point_remove_version( $url ) {
  return remove_query_arg( 'ver', $url );
}
add_filter( 'style_loader_src', 'on_point_remove_version' );
add_filter( 'script_loader_src', 'on_point_remove_version' );

/**
 * Add excerpt functionality to pages.
 */
function on_point_add_excerpt() {
  add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'on_point_add_excerpt' );

/**
 * Modify the Read More link text inside the the_content() function
 */
function on_point_modify_read_more_link() {
  return '<button class="hollow button more-link" href="'. get_permalink() . '">Read More</button>';
}
add_filter( 'the_content_more_link', 'on_point_modify_read_more_link' );

/**
 * Filter the except length to 30 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function on_point_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'on_point_excerpt_length' );

/**
 * Replaces the excerpt "Read More" text by a link when using the the_excerpt() function
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function on_point_excerpt_more_all_the_time() {
  
	// Remove Read More Link from get_the_excerpt()	
	function more_link() {
		return '';
  }
  add_filter( 'excerpt_more', 'more_link' );
  
	// Force Read More Link on all excerpts & customize the output
	function get_read_more_link() {
  	global $post;
		$excerpt = get_the_excerpt();
    echo $excerpt . '&nbsp;...&nbsp;<a href="' . get_permalink( $post->ID ) . '" class="hollow button" title="continue reading ' . get_the_title( $post->ID ) . '">Read&nbsp;More</a>';
	}
	add_filter( 'the_excerpt', 'get_read_more_link' );
	
}
add_action( 'after_setup_theme', 'on_point_excerpt_more_all_the_time' );

?>