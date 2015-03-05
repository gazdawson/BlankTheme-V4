<?php global $krank; ?>
<header class="banner navbar navbar-default navbar-static-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <i class="fa fa-bars"></i>
      </button>
		  <?php
				$background = '';
				if (!empty($krank['logo']['url'])) {
					$background = 'background: url(\''.$krank['logo']['url'].'\') no-repeat;';
				}
		  ?>
		  <a class="navbar-brand" href="<?php echo home_url(); ?>/" title="<?php bloginfo('name'); ?>" style="<?php echo $background; ?>">
			  <span class="name"><?php bloginfo('name'); ?></span>
		  </a>
    </div>

    <nav class="collapse navbar-collapse" role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'walker' => new Roots_Nav_Walker(), 'menu_class' => 'nav navbar-nav'));
        endif;
      ?>
    </nav>
  </div>
</header>
