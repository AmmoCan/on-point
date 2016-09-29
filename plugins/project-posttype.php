<?php
/*
Plugin Name: Projects Post Type
Plugin URI: http://2-drops.com/
Description: A plugin that will create a custom post type for displaying Projects.
Version: 1.0
Author: AmmoCan
Author URI: http://www.linkedin.com/in/ammocan
License: GPL3
*/

/*  Copyright 2016 Two Drops (email : ammo@2-Drops.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 3, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this plugin; if not, write to the following:
    
    Free Software Foundation, Inc.,
    51 Franklin St, Fifth Floor,
    Boston, MA 02110-1301 USA
*/

/*
 * Add Projects Custom Post Type.
 *
 */

// Ensure the proper doctype is added to the HTML document.
if ( !function_exists( 'on_point_projects_posttype' ) ) :
function on_point_projects_posttype() {
  register_post_type( 'projects',
    array(
      'labels' => array(
        'name' => __('Projects'),
        'singular_name' => __('Project'), 
        'all_items' => __('All Projects'), 
        'add_new_item' => __('Add New Project'),
        'edit_item' => __('Edit Project'), 
        'view_item' => __('View Project')
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'projects'),
      'show_ui' => true, 
      'show_in_menu' => true, 
      'show_in_nav_menus' => true,
      'capability_type' => 'post', 
      'supports' => array('title', 'editor', 'thumbnail'), 
      'exclude_from_search' => true, 
      'menu_position' => 20, 
      'has_archive' => true, 
      'menu_icon' => 'dashicons-art'
    )
  );
}
add_action( 'init', 'on_point_projects_posttype');
endif;

// Place new meta box above page editor
if ( !function_exists( 'on_point_projects_metabox_context' ) ):
add_action( 'edit_form_after_title', 'on_point_projects_metabox_context' );
function on_point_projects_metabox_context( ) {
  
  # Get the globals:
  global $post, $wp_meta_boxes;

  # Output the "advanced" meta boxes:
  do_meta_boxes( get_current_screen(), 'project_metabox_holder', $post );

  # Remove the initial "advanced" meta boxes:
  unset($wp_meta_boxes['post']['project_metabox_holder']);
    
}
endif;

// Set up meta box
if ( !function_exists( 'on_point_projects_meta_box' ) ) :
add_action( 'add_meta_boxes', 'on_point_projects_meta_box' );
function on_point_projects_meta_box() {
  add_meta_box( 'on_point_project_meta_box', 'Project Details', 'on_point_project_form', 'projects', 'project_metabox_holder', 'high' );
}
endif;

if ( !function_exists( 'on_point_project_form' ) ) :
function on_point_project_form() {
  global $post;
  $values = get_post_custom( $post->ID );
  $project_type = isset( $values['project_type'] ) ? esc_attr( $values['project_type'][0] ) : '';
  $role = isset( $values['role'] ) ? esc_attr( $values['role'][0] ) : '';
  $github = isset( $values['github'] ) ? esc_attr( $values['github'][0] ) : '';
  $codepen = isset( $values['codepen'] ) ? esc_attr( $values['codepen'][0] ) : '';
  $live = isset( $values['live'] ) ? esc_attr( $values['live'][0] ) : '';
  
  wp_nonce_field( 'projects_nonce', 'project_nonce' );
?>
  <div>
    <label for="project_type">Type Of Project</label>
    <input type="text" name="project_type" id="project_type" style="margin-top:15px; margin-left:9px; margin-bottom:10px;" value="<?php echo $project_type; ?>" /><br />
    <label for="role">Role On Project</label>
    <input type="text" name="role" id="role" style="margin-left:9px; margin-bottom:10px;" value="<?php echo $role; ?>" /><br />
  </div>
  
  <div>
    <label for="github">GitHub</label>
    <input type="text" name="github" id="github" style="margin-top:15px; margin-left:60px; margin-bottom:10px;" value="<?php echo $github; ?>" /><br />
    <label for="codepen">CodePen</label>
    <input type="text" name="codepen" id="codepen" style="margin-left:47px; margin-bottom:10px;" value="<?php echo $codepen; ?>" /><br />
    <label for="live">Live Link</label>
    <input type="text" name="live" id="live" style="margin-left:49px; margin-bottom:15px;" value="<?php echo $live; ?>" />
  </div>
<?php
}
endif;

if ( !function_exists( 'on_point_project_save_meta' ) ) :
add_action( 'save_post', 'on_point_project_save_meta', 10, 2 );
function on_point_project_save_meta( $post_id ) {
  
  // Bail if we're doing an auto save
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

  // if our nonce isn't there, or we can't verify it, bail
  if ( !isset( $_POST['project_nonce'] ) || !wp_verify_nonce( $_POST['project_nonce'], 'projects_nonce' ) ) return;

  // if our current user can't edit this post, bail
  if ( !current_user_can( 'edit_post' ) ) return;

    if (isset( $_POST['project_type'] ) )
        update_post_meta( $post_id, 'project_type', esc_attr( $_POST['project_type'] ) );
        
    if (isset( $_POST['role'] ) )
        update_post_meta( $post_id, 'role', esc_attr( $_POST['role'] ) );
         
    if (isset( $_POST['github'] ) )
        update_post_meta( $post_id, 'github', esc_attr( $_POST['github'] ) );
        
    if (isset( $_POST['codepen'] ) )
        update_post_meta( $post_id, 'codepen', esc_attr( $_POST['codepen'] ) );
        
    if (isset( $_POST['live'] ) )
        update_post_meta( $post_id, 'live', esc_attr( $_POST['live'] ) );
}
endif;
 
?>