<?php
//
// Recommended way to include parent theme styles.
//  (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
//  
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    //wp_enqueue_style( 'child-style',
    //    get_stylesheet_directory_uri() . '/style.css',
    //    array('parent-style')
    //);
    
    wp_enqueue_style( 'header', get_stylesheet_directory_uri() .'/css/header.css' );
    wp_enqueue_style( 'footer', get_stylesheet_directory_uri() .'/css/footer.css' );
    wp_enqueue_style( 'page', get_stylesheet_directory_uri() .'/css/page.css' );
    wp_enqueue_style( 'global', get_stylesheet_directory_uri() .'/css/global.css' );
    wp_enqueue_style( 'responsive', get_stylesheet_directory_uri() .'/css/responsive.css' );
    
    wp_enqueue_style( 'slick-theme', get_stylesheet_directory_uri() .'/css/slick-theme.css' );
    wp_enqueue_style( 'slick', get_stylesheet_directory_uri() .'/css/slick.css' );
	wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/js/slick.min.js', array('jquery'), null, true );    
	wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), null, true );
}



// create slider for post

/*Shortcode   Latest Post*/
function latest_post() {
	ob_start();
	?>
<?php

	$args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => '-1',
        'oderby' => 'date',
        'order' => 'DESC',
        );

      $query = new WP_Query($args);
      if ($query->have_posts()) { ?>
      	<div class="latest_post_inner">
      		<?php
        while ($query->have_posts()) : $query->the_post(); ?>
        	<div class="post_inner">					
						<div class="post_img">
						<?php echo get_the_post_thumbnail(get_the_id(), 'full'); ?>
						</div>
						<div class="post_ttl">
						<h3><?php the_title();?></h3>
						<p><?php the_content(); ?></p>
						<a href="<?php get_post_permalink(the_permalink())?>">Read More</a>						
					</div>
						
						</div>            
        	  <?php endwhile; ?>
            </div>
       <?php  }
	$event_post = ob_get_clean();
	return $event_post;
}

add_shortcode('latest_post', 'latest_post');

// Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more) {
       global $post;
  return '<a class="moretag" href="'. get_permalink($post->ID) . '"> READ MORE</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');