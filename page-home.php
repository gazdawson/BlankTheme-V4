<?php
/**
 * Template Name: Home
 * @package Krank Theme
 */
?>
<?php
	// Krank Carousel ($slide_type, $id, $controls, $indicators, $captions, $trans)
	krank_get_template_part( 'templates/carousel.php', array(
		'slide_type' => 'home_slides',
		'id' => 'home-carousel',
		'captions' => true,
		'indicators' => true,
		'controls' => true,
		'transition' => 'carousel-fade'
	) );
?>

<div class="container">
Git test test test
	<?php while (have_posts()) : the_post(); ?>
	  <?php get_template_part('templates/page', 'header'); ?>
	  <?php get_template_part('templates/content', 'page'); ?>
	<?php endwhile; ?>
</div>