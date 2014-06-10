<?php
/*
Template Name: Home Page
*/

get_header(); ?>

<?php
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $post_per_page = 5; // -1 shows all posts
  $do_not_show_stickies = 0; // 0 to show stickies
  $args=array(
    'orderby' => 'rand',
    'order' => 'DESC',
    'paged' => $paged,
    'posts_per_page' => $post_per_page,
    'caller_get_posts' => $do_not_show_stickies
  );
  $temp = $wp_query;  // assign orginal query to temp variable for later use   
  $wp_query = null;
  $wp_query = new WP_Query($args); 
  if( have_posts() ) : ?>

	<div class="post" id="content">

	<div class="homegallery">

	<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		
		<div>
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
		<p class="caption"><a href="<?php the_permalink(); ?>">&ldquo;<?php the_title(); ?>&rdquo;</a></p>
		</div>

    <?php endwhile; ?>

	</div>
	</div>

 	<?php else : ?>

	<div class="error" id="content">

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>

	</div>

	<?php endif; 
	
	$wp_query = $temp;  //reset back to original query
	
?>
</div>

<?php get_footer(); ?>