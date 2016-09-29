<?php
/*
 * Add Open Graph Tags to head.
 *
 */

// Ensure the proper doctype is added to the HTML document.
if ( !function_exists( 'on_point_doctype_og' ) ) :
function on_point_doctype_og( $output ) {
  return $output . '
  xmlns:og="http://opengraphprotocol.org/schema/"';
}
add_filter( 'language_attributes', 'on_point_doctype_og' );
endif;

// Add proper metadata for Open Graph
if ( !function_exists( 'on_point_opengraph' ) ) :
function on_point_opengraph() {
  global $post;
  
  if ( is_front_page() || is_single() ) :
    if ( has_post_thumbnail( $post->ID ) ) : // check if the post has a Post Thumbnail assigned to it.
      $image_url = get_the_post_thumbnail_url();
    else :
      $image_url = get_stylesheet_directory_uri() . "/images/default.jpg";
    endif;
    
    if ( $excerpt = $post->post_excerpt ) :
      $excerpt = strip_tags( $post->post_excerpt );
      $excerpt = str_replace( "", "'", $excerpt );
    else :
      $excerpt = get_bloginfo( 'description' );
    endif;
    
  elseif ( is_404() || is_home() ) :
    $image_url = get_stylesheet_directory_uri() . "/images/default.jpg";
    $excerpt = get_bloginfo( 'description' );
  endif;
    ?>
      <meta property="og:image" content="<?php echo $image_url; ?>"/>
      <meta property="og:locale" content="en_US"/>
      <meta property="og:type" content="<?php if ( is_front_page() ) : echo 'website'; else : echo 'article'; endif; ?>"/>
      <meta property="og:title" content="<?php echo the_title(); ?>"/>
      <meta property="og:description" content="<?php echo $excerpt; ?>"/>
      <meta property="og:url" content="<?php echo get_permalink(); ?>"/>
      <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
<?php
}
add_action('wp_head', 'on_point_opengraph' );
endif;
?>