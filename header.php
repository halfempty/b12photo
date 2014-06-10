<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('|', true, 'right'); ?> 

				<?php if ( is_single() ) { 
					
					$posttags = get_the_tags();

					$tagCount = count($posttags);
					$i = 1;

					if ($posttags) {
					  foreach($posttags as $tag) {
					    echo $tag->name; 

						if ($tagCount > $i) {
							echo ', '; 
							$i++;
						}

					  }
					echo ' | ';
					}
					 }?>

<?php bloginfo('name'); ?> <?php if ( is_home() ) { ?> | <?php bloginfo('description'); } ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="author" href="https://plus.google.com/u/1/107088748181506008352/posts" />

<?php add_scripts(); ?>

<script type="text/javascript" src="http://use.typekit.com/nto5stb.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<?php wp_head(); ?>

</head>
<body>

<div class="margin">

<div class="header">
<h1><a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>"><span><?php bloginfo('name'); ?></span></a></h1>

<form id="emailform" action="https://tinyletter.com/b12partners" method="post" target="popupwindow" onsubmit="window.open('https://tinyletter.com/b12partners', 'popupwindow', 'scrollbars=yes,width=800,height=600');return true"  tabindex="3">
	<input type="text" name="email" id="tlemail" placeholder="Email Updates" />
	
	<div class="details">
		<input type="submit" value="Subscribe" />
		<input type="hidden" value="1" name="embed"/>
		<p>Enter your email address above to receive my newsletter, containing new photos and various goings on.</p>
	</div>
</form>


<?php dynamic_sidebar( 'sidebar' ); ?>



</div>