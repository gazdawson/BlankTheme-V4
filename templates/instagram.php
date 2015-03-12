<?
/**
 * Template Name: Instagram
 * @package Krank Theme
 * Jquery Instagram Feed Based On http://stuffthatspins.com/2014/03/11/display-instagram-hashtag-and-user-picture-stream-really-easy-with-jquery-and-json/
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>


<?php
	// Get Instagram setting from theme options
	//http://instagram.com/developer/authentication/
	//http://www.pinceladasdaweb.com.br/instagram/access-token/
	global $krank;
	$access_token = $krank['instagram_access_token'];
	$user_id = $krank['instagram_user_id'];
	$instagram_profile = $krank['instagram_profile'];
	
	
	$output = 
		'<script type="text/javascript" >'.
			'var access_token ="'.$access_token.'";'.
			'var user_id = "'.$user_id.'";'.
			'var resolution = "thumbnail";
			var hashtag = ""; // #hashtag
			var last_url = "";
		</script>';
?>

<?php echo $output; // output instagram variables ?>

<a href="<?php echo $instagram_profile; ?>" class="instagram-btn btn" title="Follow <?php echo bloginfo('name'); ?> on Instagram">
	<i class="fa fa-instagram"></i>Follow us on Instagram
</a>

<div id="instagram"></div>
<div id="showMore">
	<a id='more' next_url='"+next_url+"' href='#'>Load More</a>
</div>

<?php
	// Add instagram.js to the footer only on instagram pages
	function instagram_jquery() {
	    wp_enqueue_script( 'instagram', get_template_directory_uri().'/assets/js/vendor/instagram.js', true);
	}
	add_action( 'wp_footer', 'instagram_jquery' );
?>