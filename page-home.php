<?php
/**
 * Template Name: Home
 * @package Krank Theme
 */
?>
<?php
	// krank_carousel($slide_type, $id, $controls, $indicators, $captions, $trans)
	if ($krank['home_slides_switch'] == 1) {
		carousel('home_slides', 'home-carousel', true, true, true, 'slide'); 
	}
?>
<div class="container">
	<?php while (have_posts()) : the_post(); ?>
	  <?php get_template_part('templates/page', 'header'); ?>
	  <?php get_template_part('templates/content', 'page'); ?>
	<?php endwhile; ?>
</div>

