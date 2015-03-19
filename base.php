<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

  <?php
    do_action('get_header');
    get_template_part('templates/header');
  ?>
	
	<?
		// wrap content in container if page is not one of. 
		if( !is_front_page() && !is_single() ) : 
	?>
	  <div class="wrap container" role="document">
	    <div class="content row">
				
				<?php get_template_part('templates/main'); ?>
			
	    </div><!-- /.content -->
	  </div><!-- /.wrap -->
	<?php else : ?>
		
		<?php get_template_part('templates/main'); ?>
		
	<?php endif; ?>

  <?php get_template_part('templates/footer'); ?>

  <?php wp_footer(); ?>

</body>
</html>


