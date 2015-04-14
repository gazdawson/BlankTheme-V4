<?php
/**
 * Template Name: Home
 * @package Krank Theme
 */
?>
<div class="row">
	<?php
		// Krank Carousel
		krank_get_template_part( 'templates/components/carousel.php', array(
			'slide_type' => 'home_slides',
			'id' => 'home-carousel',
			'captions' => true,
			'indicators' => true,
			'controls' => true,
			'transition' => 'carousel-fade'
		) );
	?>
</div>

<div class="wrap container">
	<div class="content row">
		<div class="col-sm-12">
			<?php while (have_posts()) : the_post(); ?>
			  <?php get_template_part('templates/page', 'header'); ?>
			  <?php get_template_part('templates/content', 'page'); ?>
			<?php endwhile; ?>
		</div>
	</div>
</div>


