<?php
/*
Template Name: Places Page
*/

get_header(); ?>

	<div class="categories" id="content">

		<h2><?php the_title(); ?></h2>

		<?php $terms = get_terms('locations', array( 'taxonomy' => 'locations', 'orderby' => 'count', 'order' => 'desc') ); ?>

		<?php foreach ($terms as $term) : ?>

			<h3><?php echo $term->name; ?></h3>
		

			<?php query_posts( array ( 'locations' => $term->slug, 'showposts' => '5', 'orderby' => 'rand' ) ); ?>

			<?php if ( have_posts() ): ?>

			<ul class="thumbs">

			<?php $i = 0; ?>

			<?php while ( have_posts() ) : 

			//bm_ignorePost($post->ID);

			the_post(); ?>

			<li><a <?php if ( $i == 0 ) { ?>class="first" <?php } 
				$i++;
			?> href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(151,151)  ); ?></a></li>

	    	<?php endwhile; ?> 

			</ul>

			<?php if ($i++ > 4 ) : ?>
				<p class="more"><a href="/photo/?locations=<?php echo $term->slug; ?>">More &raquo;</a></p>
			<?php endif; ?>

			<?php endif; ?>


		<?php endforeach; ?>
	
	</div>

<?php get_footer(); ?>