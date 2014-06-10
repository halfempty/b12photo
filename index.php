<?php get_header(); ?>


<?php if (have_posts()) : ?>

	<?php if ( !is_single() && !is_page() ) { ?>
		<div id="content">

			<h2><?php single_cat_title(); ?></h2>

		<div class="grid">

			<?php while (have_posts()) : the_post(); ?>
				<a class="thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium' ); ?></a>
			<?php endwhile; ?>

		</div>

		</div>

		<?php } else if ( is_page() ) { ?>

		<div class="post" id="content">

			<h2><?php the_title(); ?></h2>

			<?php while (have_posts()) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; ?>

		</div>

		<?php } else { ?>

		<?php while (have_posts()) : the_post(); ?>
			
		<div class="post" id="content">

			<h2><em>&ldquo;<?php the_title(); ?>&rdquo;</em></h2>

				<div class="photo">
					<?php the_post_thumbnail( 'large' ); ?>
				</div>

				<div class="description">
					<?php the_content(); ?>
				</div>

				<div class="buybutton">
					<a href="#contactform">Purchase Print</a>
					<p>Prints of this photo are available for order.</p>
				</div>

				<div class="contactform modal" id="contactform">
				<input type="hidden" id="postnumber" value="<?php the_ID(); ?>" />
				<a class="close"><span>Close</span></a>
				<h3>Print Request</h3>

				<?php $field = get_post_meta($post->ID, 'sizes', true);
				if ( $field ) {
					switch ($field) {
					    case 'standard':
							echo do_shortcode('[gravityform id="1" name="Standard" title="false" description="false" ajax="true"]');
					        break;
					    case 'hipstamatic':
							echo do_shortcode('[gravityform id="2" name="Hipstamatic" title="false" description="false" ajax="true"]');
					        break;
					    case 'small':
							echo do_shortcode('[gravityform id="3" name="Small" title="false" description="false" ajax="true"]');
					        break;
					}
				} else {
					
					echo do_shortcode('[gravityform id="1" name="Standard" title="false" description="false"]');
										
				} ?>


				</div>

				<div class="categories">Filed Under: <?php the_category("<span>,</span> "); ?></div>

 				<?php the_terms( $post->id, 'locations', '<div class="tags">Places: ','<span>,</span> ','</div>' ); ?> 

				<?php the_tags('<div class="tags">Tagged: ','<span>,</span> ','</div>'); ?>

		</div>

		<?php endwhile; ?>
			
		<?php } ?>



	<?php else : ?>

		<div class="error" id="content">

			<h2 class="center">Not Found</h2>
			<p class="center">Sorry, but you are looking for something that isn't here.</p>

		</div>

	<?php endif; ?>


<?php get_footer(); ?>