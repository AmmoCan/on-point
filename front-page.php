<?php
/**
 * The custom template for the one-page style front page, which initiates automatically.
 */
get_header(); ?>
 
<?php
global $more;
?>

  <div id="primary" class="content-area onpoint-page">
    <main id="main" class="site-main" role="main">
          
  <?php
    $args = array(
      'posts_per_page' => 6,
      'orderby' => 'date',
      'order' => 'ASC',
      'post_type' => 'services'
    );
    
    $query = new WP_Query( $args );
    // The loop
		if ( $query->have_posts() ) {
  ?>
      <section id="services" class="row skroll">
        
        <div class="small-12 columns">
          <h2 class="section-title"><?php $obj = get_post_type_object( 'services' ); echo $obj->labels->name;?></h2>
        </div>
        
        <div id="services-wrap" class="row small-up-1 medium-up-2 large-up-3">
          <?php
    			while ( $query->have_posts() ) {
    				$query->the_post();
    				$more = 0;
    				$icon = get_post_meta( get_the_ID(), 'service_icon', true );
    				echo '<div class="column">';
    				echo '<div class="service">';
    				echo '<div class="service-icon-box">';
            echo '<span class="fa-stack fa-lg">';
            echo '<i class="fa fa-circle fa-stack-2x" aria-hidden="true"></i>';
            if( ! empty( $icon ) ) {
              echo '<i class="fa ' . $icon . ' fa-stack-1x fa-inverse" aria-hidden="true"></i>';
            }
            echo '</span>';
            echo '</div>';
            echo '<h3 class="service-heading">' . get_the_title() . '</h3>';
            echo '<p class="service-description">';
            the_content();
            echo '</p>';
    				echo '</div>';
    				echo '</div>';
    			}
    			?>
    		</div><!-- #services-wrap -->
    		
      </section><!-- #services -->
  <?php
    }
    /* Restore original Post Data */
    wp_reset_postdata();
  ?>
 
  <?php
    $args = array(
      'posts_per_page' => 3,
      'orderby' => 'rand',
      'post_type' => 'testimonials'
    );
    
    $query = new WP_Query( $args );
    // The loop
    if ( $query->have_posts() ) {
  ?>
      <section id="testimonials" class="row skroll">
        
        <div class="small-12 columns">
          <h2 class="section-title"><?php $obj = get_post_type_object( 'testimonials' ); echo $obj->labels->name;?></h2>
        </div>
        
        <div id="testimonials-wrap" class="row align-center small-up-1 medium-up-2 large-up-3">
          <?php
    			while ( $query->have_posts() ) {
    				$query->the_post();
    				$more = 0;
    				$client = get_post_meta( get_the_ID(), 'client_name', true );
    				$company = get_post_meta( get_the_ID(), 'company', true );
    				$link = get_post_meta( get_the_ID(), 'link', true );
    				echo '<article class="column">';
    				echo '<div class="testimonial-content entry-content">';
    				echo '<div class="testimonial-img">';
    				if ( ! empty( $link ) ) :
              echo '<a href="' . $link . '" title="clients image">';
              the_post_thumbnail( array(100, 100), array( 'class' => 'th' ) );
              echo '</a>';
            else :
              the_post_thumbnail( array(100, 100), array( 'class' => 'th' ) );
            endif;
            echo '</div>';
            if( ! empty( $client && $company && $link ) ) {
              echo '<div class="client-info">';
              echo '<h6>';
              echo '<a href="' . $link . ' title="learn more about the client">';
              echo '<cite>' . $client . '</cite>';
              echo '</a>&#44; ' . $company;
              echo '</h6>';
              echo '</div>';
            }
            echo '<div class="post-excerpt">';
            echo '<blockquote>';
            the_content();
            echo '</blockquote>';
            echo '</div>';
    				echo '</div>';
    				echo '</article>';
    			}
    			?>
    		</div><!-- #testimonials-wrap -->
    		
      </section><!-- #testimonials -->
  <?php
    }
    /* Restore original Post Data */
		wp_reset_postdata();
  ?>
      
  <?php
    $args = array(
      'posts_per_page' => 3,
      'orderby' => 'rand',
      'post_type' => 'projects'
    );
    
    $query = new WP_Query( $args );
    // The loop
    if ( $query->have_posts() ) {
  ?>
      <section id="projects" class="row skroll">
        
        <div class="small-12 columns">
          <h2 class="section-title">Featured <?php $obj = get_post_type_object( 'projects' ); echo $obj->labels->name;?></h2>
        </div>
        
        <div id="projects-wrap" class="row align-center small-up-1 medium-up-2 large-up-3">
          <?php
    			while ( $query->have_posts() ) {
    				$query->the_post();
    				$more = 0;
    				$type = get_post_meta( get_the_ID(), 'project_type', true );
    				$role = get_post_meta( get_the_ID(), 'role', true );
    				$github = get_post_meta( get_the_ID(), 'github', true );
    				$codepen = get_post_meta( get_the_ID(), 'codepen', true );
    				$live = get_post_meta( get_the_ID(), 'live', true );
    				echo '<article class="columns">';
    				echo '<div class="project-item">';
    				echo '<div class="project-item-img">';
            the_post_thumbnail();
            echo '<div class="project-item-detail">';
            echo '<h4 class="font-alt normal">';
            the_title();
            echo '</h4>';
            echo '<p class="project-item-descr">';
            the_content();
            echo '</p>';
            echo '<div class="project-social-links">';
            echo '<ul>';
            if( ! empty( $github ) ) {
              echo '<li><a href="' . $github . '" target="_blank" title="see project on github"><i class="fa fa-github" aria-hidden="true"></i></a></li>';
            }
            if( ! empty( $codepen ) ) {
              echo '<li><a href="' . $codepen . '" target="_blank" title="see project on codepen"><i class="fa fa-codepen" aria-hidden="true"></i></a></li>';
            }
            if( ! empty( $live ) ) {
              echo '<li><a href="' . $live . '" target="_blank" title="see project live"><i class="fa fa-globe" aria-hidden="true"></i></a></li>';
            }
            echo '</ul>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            if( ! empty( $type && $role ) ) {
              echo '<div class="project-item-meta font-alt">';
              echo '<div class="project-item-type">' . $type . '</div>';
              echo '<div class="project-item-role">' . $role . '</div>';
              echo '</div>';
    				}
    				echo '</div>';
    				echo '</article>';
    			}
          ?>
        </div><!-- #projects-wrap -->
        
      </section><!-- #projects -->
  <?php
    }
    /* Restore original Post Data */
		wp_reset_postdata();
  ?>
  
  <?php
    $args = array(
      'posts_per_page' => 3,
      'orderby' => 'rand',
      'post_type' => 'post'
    );
      
    $query = new WP_Query( $args );
    // The loop
    if ( $query->have_posts() ) {
  ?>
      <section id="blog" class="row skroll">
        
        <div class="small-12 columns">
          <h2 class="section-title">Featured Posts</h2>
        </div>
        
        <div id="blog-wrap" class="row align-center small-up-1 medium-up-2 large-up-3">
          <?php
    			while ( $query->have_posts() ) {
    				$query->the_post();
    				$more = 0;
    				echo '<article id="post-' . $post->ID . '" class="column">';
            echo '<div class="post-item hero">';
            echo '<div class="post-image" role="image" aria-label="post image" style="background-image: url(' . get_the_post_thumbnail_url() . ');"></div>';
            echo '<header class="post-header">';
            echo '<div class="date">';
            the_time( 'jS M Y' );
            echo '</div>';
            echo '<ul class="post-share-links">';
            echo '<li>';
            echo '<a href="http://www.linkedin.com/shareArticle?mini=true&url=' . esc_url( get_permalink() ) . '&title=' . get_the_title() . '&source=' . esc_url( home_url() ) . '" target="_blank" title="share this post on linkedin">';
            echo '<i class="fa fa-linkedin" aria-hidden="true"></i>';
            echo '</a>';
            echo '</li>';
            echo '<li>';
            echo '<a href="http://twitter.com/intent/tweet?status=' . get_the_title() . '+' . esc_url( get_permalink() ) .'" target="_blank" title="share this post on twitter">';
            echo '<i class="fa fa-twitter" aria-hidden="true"></i>';
            echo '</a>';
            echo '</li>';
            echo '<li>';
            echo '<a href="mailto:?subject=' . get_the_title() . '&amp;body=' . esc_url( get_permalink() ) .'" title="send this post to a friend">';
            echo '<i class="fa fa-envelope" aria-hidden="true"></i>';
            echo '</a>';
            echo '</li>';
            echo '</ul>';
            echo '</header>';
            echo '<div class="data">';
            echo '<div class="post-content">';
            echo '<span class="author">';
            the_author();
            echo '</span>';
    		    if ( is_single() ) :
    			    the_title( '<h1 class="title">', '</h1>' );
        		else :
        			the_title( '<h2 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        		endif;
    		    echo '<p class="text">';
    			  the_excerpt();
    			  echo '</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</article>';
    		  }
    		  ?>
    		</div><!-- #blog-wrap -->
    		
      </section><!-- #blog -->
  <?php
    }   
    /* Restore original Post Data */
    wp_reset_postdata();
  ?>
    </main><!-- #main -->
  </div><!-- #primary -->
      
<?php get_footer(); ?>
