<?php
/**
 * Enable and Create (register) Custom Menus
 * http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
 */
if ( ! function_exists( 'on_point_menus' ) ) :
  function on_point_menus() {
    register_nav_menus( array(
        'primary' => __( 'Front Page Menu', 'on_point' ),
        'secondary' => __( 'Single Page Menu', 'on_point' ),
    		'social' => __( 'Social Links Menu', 'on_point' )
      )
    );
  }
endif;
add_action( 'init', 'on_point_menus' );
add_theme_support( 'menus' );

/**
 * Primary menu
 * http://codex.wordpress.org/Function_Reference/wp_nav_menu
 */
if ( ! function_exists( 'on_point_primary_menu' ) ) :
	function on_point_primary_menu() {
    wp_nav_menu( array( 
      'container' => false,                           // remove nav container
      'container_class' => '',                        // class of container
      'menu' => '',                                   // menu name
      'menu_class' => 'vertical large-horizontal menu', // adding custom nav class
      'theme_location' => 'primary',                  // where it's located in the theme
      'before' => '',                                 // before each link <a> 
      'after' => '',                                  // after each link </a>
      'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion large-dropdown">%3$s</ul>', // add in foundation 6 classes to the wrapping ul element
      'link_before' => '',                            // before each link text
      'link_after' => '',                             // after each link text
      'depth' => 5,                                   // limit the depth of the nav
      'fallback_cb' => false,                         // fallback function (see below)
      'walker' => new On_point_front_page_navwalker()
    ));
	}
endif;

/**
 * Secondary menu
 * http://codex.wordpress.org/Function_Reference/wp_nav_menu
 */
if ( ! function_exists( 'on_point_secondary_menu' ) ) :
	function on_point_secondary_menu() {
    wp_nav_menu( array( 
      'container' => false,                           // remove nav container
      'container_class' => '',                        // class of container
      'menu' => '',                                   // menu name
      'menu_class' => 'vertical large-horizontal menu', // adding custom nav class
      'theme_location' => 'secondary',                // where it's located in the theme
      'before' => '',                                 // before each link <a> 
      'after' => '',                                  // after each link </a>
      'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion large-dropdown">%3$s</ul>', // add in foundation 6 classes to the wrapping ul element
      'link_before' => '',                            // before each link text
      'link_after' => '',                             // after each link text
      'depth' => 5,                                   // limit the depth of the nav
      'fallback_cb' => false,                         // fallback function (see below)
      'walker' => new On_point_front_page_navwalker()
    ));
	}
endif;

/**
 * Social menu
 */
if ( ! function_exists( 'on_point_social_menu' ) ) :
	function on_point_social_menu() {
    wp_nav_menu( array( 
      'container' => false,                           // remove nav container
      'container_class' => '',                        // class of container
      'menu' => '',                                   // menu name
      'menu_class' => '',                             // adding custom nav class
      'theme_location' => 'social',                   // where it's located in the theme
      'before' => '',                                 // before each link <a> 
      'after' => '',                                  // after each link </a>
      'items_wrap' => '%3$s',                         // get rid of the <ul> wrap
      'link_before' => '<span class="show-for-sr">',  // before each link text
      'link_after' => '</span>',                      // after each link text
      'depth' => 2,                                   // limit the depth of the nav
      'fallback_cb' => false,                         // fallback function (see below)
      'walker' => new On_point_social_navwalker()
    ));
	}
endif;
?>