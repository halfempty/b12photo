<?php
/*
Template Name: Categories Page
*/

get_header(); ?>

	<div class="categories" id="content">

		<h2><?php the_title(); ?></h2>

		<?php $categories = get_categories( array ('orderby' => 'count', 'order' => 'desc' ) ); foreach ($categories as $category) : ?>

		<?php query_posts( array ( 'category_name' => $category->slug, 'showposts' => '5', 'orderby' => 'rand' ) ); ?>
		
		<h3><?php single_cat_title(); ?></h3>

		<?php if ( have_posts() ): ?>

		<ul class="thumbs">

		<?php $i = 0; ?>

		<?php while ( have_posts() ) : 

		bm_ignorePost($post->ID);
		
		the_post(); ?>

		<li><a <?php if ( $i == 0 ) { ?>class="first" <?php } 
			$i++;
		?> href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(151,151)  ); ?></a></li>

    	<?php endwhile; ?> 

		</ul>

		<p class="more"><a href="/photo/category/<?php echo $category->slug; ?>">More &raquo;</a></p>

		<?php endif; ?>
		

		<?php endforeach; ?>
	
	</div>

<?php get_footer(); ?>