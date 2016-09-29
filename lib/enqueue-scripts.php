<?php
/**
 * Enqueue scripts and styles.
 */
if ( !function_exists( 'on_point_scripts' ) ) :
  function on_point_scripts() {
  	
  	// Enqueue Main Stylesheet
  	wp_enqueue_style( 'on-point-style', get_stylesheet_uri() );
  	
  	// Load jQuery v2.2.2 
    wp_deregister_script( 'jquery' );    
    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', array(), 'null', true );  
    wp_enqueue_script( 'jquery' );
  	
  	// Load Foundation JS
  	wp_enqueue_script( 'what-input', get_template_directory_uri() . '/bower_components/what-input/dist/what-input.min.js', array( 'jquery' ), 'null', true );
    wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/bower_components/foundation-sites/dist/foundation.min.js', array( 'jquery', 'what-input' ), 'null', true );
    wp_enqueue_script( 'foundation-init-js', get_template_directory_uri() . '/js/min/app-min.js', array( 'jquery', 'foundation-js' ), 'null', true );
  
  	wp_enqueue_script( 'on-point-skip-link-focus-fix', get_template_directory_uri() . '/js/min/skip-link-focus-fix-min.js', array(), '20160923', true );
  
  	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
  		wp_enqueue_script( 'comment-reply' );
  	}
  	
  	wp_localize_script( 'on-point-navigation', 'screenReaderText', array(
  		'expand'   => '<span class="show-for-sr">' . __( 'expand child menu', 'on-point' ) . '</span>',
  		'collapse' => '<span class="show-for-sr">' . __( 'collapse child menu', 'on-point' ) . '</span>',
  	) );
  }
  if( !is_admin() ) add_action( 'wp_enqueue_scripts', 'on_point_scripts' );
endif;
?>