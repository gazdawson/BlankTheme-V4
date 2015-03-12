<?php
/**
 * Template Name: Home
 * @package Krank Theme
 */
?>
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

<div class="container">
	<?php while (have_posts()) : the_post(); ?>
	  <?php get_template_part('templates/page', 'header'); ?>
	  <?php get_template_part('templates/content', 'page'); ?>
	<?php endwhile; ?>
	
	<?php
		// Krank Modal
		krank_get_template_part( 'templates/components/modal.php', array(
			'modal_id' => 'contact',
			'modal_btn_txt' => 'Contact Btn',
			'modal_header' => true,
			'modal_title' => 'Send us a message',
			'modal_template' => 'templates/components/contact-form',
			'modal_content' => '',
			'modal_footer' => true,
			'modal_footer_content' => '<a href="#" class="btn btn-primary">Submit</a>'
		) );
	?>
</div>
