<?php
/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
 
if ( !function_exists( 'on_point_widgets_init' ) ) :

function on_point_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Left', 'on-point' ),
		'id'            => 'footer-left-widget',
		'description'   => esc_html__( 'Add left footer widget here.', 'on-point' ),
		'before_widget' => '<div id="%1$s" class="column widget widget-left %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Center', 'on-point' ),
		'id'            => 'footer-center-widget',
		'description'   => esc_html__( 'Add center footer widget here.', 'on-point' ),
		'before_widget' => '<div id="%1$s" class="column widget widget-center %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Right', 'on-point' ),
		'id'            => 'footer-right-widget',
		'description'   => esc_html__( 'Add right footer widget here.', 'on-point' ),
		'before_widget' => '<div id="%1$s" class="column widget widget-right %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'on_point_widgets_init' );
endif;
?>