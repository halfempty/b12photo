<?php

// Custom Taxonomies

function locations_init() {
	// create a new taxonomy
	register_taxonomy(
		'locations',
		'post',
		array(
			'label' => __( 'Locations' ),
			'sort' => true,
			'hierarchical' => true,
			'args' => array( 'orderby' => 'term_order' ),
			'rewrite' => false
		)
	);



}
add_action( 'init', 'locations_init' );



// Exclude posts from showing (hide duplicate content)
// http://www.binarymoon.co.uk/2010/03/5-wordpress-queryposts-tips/

$bmIgnorePosts = array();

/**
 * add a post id to the ignore list for future query_posts
 */
function bm_ignorePost ($id) {
	if (!is_page()) {
		global $bmIgnorePosts;
		$bmIgnorePosts[] = $id;
	}
}

/**
 * reset the ignore list
 */
function bm_ignorePostReset () {
	global $bmIgnorePosts;
	$bmIgnorePosts = array();
}

/**
 * remove the posts from query_posts
 */
function bm_postStrip ($where) {
	global $bmIgnorePosts, $wpdb;
	if (count($bmIgnorePosts) > 0) {
		$where .= ' AND ' . $wpdb->posts . '.ID NOT IN(' . implode (',', $bmIgnorePosts) . ') ';
	}
	return $where;
}

add_filter ('posts_where', 'bm_postStrip');

// End Hide Duplicates


// Featred Images in RSS
function insertThumbnailRSS($content) {
	global $post;
	if ( has_post_thumbnail( $post->ID ) ){	
    	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", get_the_post_thumbnail( $post->ID, 'medium' ) );
		$content = '' . $html . '<span>' . $content . '</span>';
	}
	return $content;
}

add_filter('the_excerpt_rss', 'insertThumbnailRSS');
add_filter('the_content_feed', 'insertThumbnailRSS');

// Show All Tags
function showalltags() {

//	$my_query = new WP_Query('posts_per_page=1');

//	while ($my_query->have_posts()) : $my_query->the_post();

	$tags = get_tags();
	$html;
	foreach ($tags as $tag){
		$tag_link = get_tag_link($tag->term_id);
			
		$html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
		$html .= "{$tag->name}</a>";
	}
//	$html .= '</div>';
	echo $html;

//	endwhile;
	
}


// Add Scripts
function add_scripts() {
	if (is_admin()) return;

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js');

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script('masonry', get_stylesheet_directory_uri() . '/js/jquery.masonry.min.js', array('jquery') );
	wp_enqueue_script('cycle', get_stylesheet_directory_uri() . '/js/jquery.cycle.all.min.js', array('jquery') );
	wp_enqueue_script('babbq', get_stylesheet_directory_uri() . '/js/jquery.ba-bbq.js', array('jquery') );
	wp_enqueue_script('cookie', get_stylesheet_directory_uri() . '/js/jquery.cookie.js', array('jquery') );
	wp_enqueue_script('behaviour', get_stylesheet_directory_uri() . '/js/behaviour.js', array('jquery','masonry','cycle','babbq','cookie') );


}



// Sidebars
// http://justintadlock.com/archives/2010/11/08/sidebars-in-wordpress

add_action( 'widgets_init', 'my_register_sidebars' );

function my_register_sidebars() {

	register_sidebar(
		array(
			'id' => 'Sidebar',
			'name' => __( 'Sidebar' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);

	register_sidebar(
		array(
			'id' => 'Utilities',
			'name' => __( 'Utilities' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);


}


// Featured Images / Post Thumbnails
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
	}

?>