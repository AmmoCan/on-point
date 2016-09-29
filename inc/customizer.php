<?php
/**
 * On Point Theme Customizer.
 *
 * @package On_Point
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function on_point_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	/**
	* Custom Customizer Customizations
	*/

	// Create heading background color setting
	$wp_customize->add_setting( 'header_background_color' , array(
		'default'              => '#0a0a0a',
		'type'                 => 'theme_mod',
		'sanitize_callback'    => 'sanitize_hex_color',
		'transport'            => 'postMessage',
	) );

	// Add the controls for header background color
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
		'label' => __( 'Header Background Color', 'on_point' ),
		'description' => __( 'Applied to the header when there is no header image.', 'on_point' ),
		'section' => 'colors',
  ) ) );
  
  // Add an additional description to the header textcolor section.
	$wp_customize->get_control( 'header_textcolor' )->description = __( 'Color is applied to the site title on mouse hover or mobile tap.', 'on_point' );

}
add_action( 'customize_register', 'on_point_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function on_point_customize_preview_js() {
	wp_enqueue_script( 'on_point_customizer', get_template_directory_uri() . '/js/min/customizer-min.js', array( 'customize-preview' ), '20160923', true );
}
add_action( 'customize_preview_init', 'on_point_customize_preview_js' );


/**
 * Sanitize layout options:
 * If something goes wrong and one of the three specified options are not used,
 * apply the default (no-sidebar).
 */
function on_point_sanitize_layout( $value ) {
  if ( ! in_array( $value, array( 'sidebar-left', 'sidebar-right', 'no-sidebar' ) ) )
    $value = 'no-sidebar';

  return $value;
}