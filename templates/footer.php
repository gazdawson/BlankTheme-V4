<?php global $krank; ?>

<a href="#" id="to-top"><i class="fa fa-angle-up"></i></a>

<div class="pre-footer container">
	<div class="row">
		<div class="col-sm-12">
				<p class="lead">See what <?php echo $krank['name']; ?> can do for you!</p>
				<p>Get in contact today!</p>
				<?php
					// Krank Modal
					krank_get_template_part( 'templates/components/modal.php', array(
						'modal_id' => 'contact',
						'modal_btn_txt' => '<i class="fa fa-envelope-o"></i> Send us a message',
						'modal_header' => true,
						'modal_title' => 'Send us a message',
						'modal_template' => 'templates/components/contact-form',
						'modal_content' => '',
						'modal_footer' => true,
						'modal_footer_content' => ''
					) );
				?>
		</div>
	</div>
</div><!--/.pre-footer-->

<footer class="content-info" role="contentinfo">
	<div class="container">
		<div class="row">
			<div class="business-address">
				<?php get_template_part('templates/components/business-info-address'); ?>
			</div>
			<div class="business-contact">
				<p class="footer-title">Contact</p>
				<?php get_template_part('templates/components/business-info-contact'); ?>
			</div>
		  <div class="footer-links">
				<p class="footer-title">Links</p>
				<?php wp_nav_menu( array( 'theme_location' => 'primary_navigation' ) ); ?>
		  </div>
			<div class="site-author">
				<img src="<?php echo  get_template_directory_uri() . '/assets/img/logo@2x.png'; ?>" alt="Krank Creative Website Design, Marketing &amp; E-commerce Solutions | Kendal, Cumbria." />
				Website by: <a href="http://www.krankcreative.co.uk" title="See What Krank Creative Can Do For You! Web Design, Graphic Design, Marketing &amp; E-commerce | Kendal, Cumbria"><span>Krank Creative </span>| Website Design.</a>
			</div>
		</div>
	</div>
</footer><!--/.content-info-->

<div itemscope itemtype="http://schema.org/Place" class="location">
  <div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
    <meta itemprop="latitude" content="<?php echo $krank['location']['latitude']; ?>" />
    <meta itemprop="longitude" content="<?php echo $krank['location']['longitude']; ?>" />
  </div>
</div><!--/.location-->
