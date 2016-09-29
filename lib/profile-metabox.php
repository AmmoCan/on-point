<?php
/**
 * Custom meta box for Profile section on front-page.
 */
 
// Place new meta box above page editor
if ( !function_exists( 'on_point_new_metabox_context' ) ):
add_action( 'edit_form_after_title', 'on_point_new_metabox_context' );
function on_point_new_metabox_context( ) {
  
  do_meta_boxes( 'custom_metabox_holder', 'high', null );
    
}
endif;

// Set up meta box
if ( !function_exists( 'on_point_custom_meta_box' ) ) :
add_action( 'add_meta_boxes', 'on_point_custom_meta_box' );
function on_point_custom_meta_box() {
  global $post;
  $frontpage_id = get_option( 'page_on_front' );
  
  // only add this meta box to the page selected as front page:
  if( $post->ID == $frontpage_id ):
    add_meta_box( 'on_point_profile_meta_box', 'Profile Info', 'on_point_profile_form', 'custom_metabox_holder', 'high' );
  endif;
}
endif;

// Create function to render the content of the meta box
if ( !function_exists( 'on_point_profile_form' ) ) :
function on_point_profile_form() {
  global $post;
  $values = get_post_custom( $post->ID );
  $name = isset( $values['name'] ) ? esc_attr( $values['name'][0] ) : '';
  $title = isset( $values['title'] ) ? esc_attr( $values['title'][0] ) : '';
  $social = isset( $values['social'] ) ? esc_attr( $values['social'][0] ) : '';
  $cta_text = isset( $values['cta_text'] ) ? esc_attr( $values['cta_text'][0] ) : '';
  $cta_link = isset( $values['cta_link'] ) ? esc_attr( $values['cta_link'][0] ) : '';
  
  wp_nonce_field( 'on_point_profile_nonce', 'profile_nonce' );
  
  // #on_point_profile_meta_box to style the metabox container
?>
  <div>
    <label for="name">Your Name</label>
    <input type="text" name="name" id="name" style="margin-top:15px; margin-left:9px; margin-bottom:10px;" value="<?php echo $name; ?>" /><br />
    <label for="title">Prof. Title</label>
    <input type="text" name="title" id="title" style="margin-left:17px; margin-bottom:10px;" value="<?php echo $title; ?>" /><br />
    <label for="social">Social Title</label>
    <input type="text" name="social" id="social" style="margin-left:9px; margin-bottom:10px;" value="<?php echo $social; ?>" /><br />
  </div>
  <div>
    <label for="cta_text">CTA Text</label>
    <input type="text" name="cta_text" id="cta_text" style="margin-top:15px; margin-left:21px; margin-bottom:10px;" value="<?php echo $cta_text; ?>" /><br />
    <label for="cta_link">CTA Link</label>
    <input type="text" name="cta_link" id="cta_link" style="margin-left:21px; margin-bottom:10px;" value="<?php echo $cta_link; ?>" /><br />
  </div>
<?php
}
endif;

// Create save post function to be used when saving
if ( !function_exists( 'on_point_profile_save' ) ) :
add_action( 'save_post', 'on_point_profile_save', 10, 2 );
function on_point_profile_save( $post_id ) {
  
  // Bail if we're doing an auto save
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

  // if our nonce isn't there, or we can't verify it, bail
  if ( !isset( $_POST['profile_nonce'] ) || !wp_verify_nonce( $_POST['profile_nonce'], 'on_point_profile_nonce' ) ) return;

  // if our current user can't edit this post, bail
  if ( !current_user_can( 'edit_post' ) ) return;
  
    if (isset( $_POST['name'] ) )
        update_post_meta( $post_id, 'name', esc_attr( $_POST['name'] ) );  

    if (isset( $_POST['title'] ) )
        update_post_meta( $post_id, 'title', esc_attr( $_POST['title'] ) );
        
    if (isset( $_POST['social'] ) )
        update_post_meta( $post_id, 'social', esc_attr( $_POST['social'] ) );
        
    if (isset( $_POST['cta_text'] ) )
        update_post_meta( $post_id, 'cta_text', esc_attr( $_POST['cta_text'] ) );
        
    if (isset( $_POST['cta_link'] ) )
        update_post_meta( $post_id, 'cta_link', esc_attr( $_POST['cta_link'] ) );
}
endif;
?>