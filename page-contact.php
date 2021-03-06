<?php global $krank; ?>

<?php if (!empty($krank['location']['latitude']) && !empty($krank['location']['longitude'])) : ?>
	<div id="map"></div>
<?php endif; ?>

  <div class="wrap container" role="document">
    <div class="content row">
			<?php while (have_posts()) : the_post(); ?>
			  <?php get_template_part('templates/page', 'header'); ?>
			  <?php get_template_part('templates/content', 'page'); ?>
			<?php endwhile; ?>
			<div class="content">
				
				<div class="contact-form">
					<h2>Send us a Message</h2>
					<?php get_template_part('templates/components/contact-form'); ?>
				</div>
				<div class="business-info">
					<div class="business-address">
						<h2>Location</h2>
						<?php get_template_part('templates/components/business-info-address'); ?>
					</div>
					<div class="business-contact">
						<h2>Contact Info</h2>
						<?php get_template_part('templates/components/business-info-contact'); ?>
					</div>
					
				</div>
				
			</div>
		</div>
	</div>

<?php
	// Load Krank Options
	$address = '';
	if (!empty($krank['location']['latitude']) && !empty($krank['location']['longitude'])) {
		$location = $krank['location']['latitude'].', '.$krank['location']['longitude'];
		$name = $krank['name'];
		foreach($krank['contact'] as $add) {
			$address .= $add.'<br/>';
		}
		$infoWindow = '<div class="infoWindow"><h4>'.$name.'</h4>'.'<p>'.$address.'</p></div>';
?>

<script>
// Google Map
	function initialize() {
		var myLatlng = new google.maps.LatLng(<?php echo $location; ?>);
		var mapOptions = {
			zoom: 17,
			center: myLatlng
		};

		var map = new google.maps.Map(document.getElementById('map'), mapOptions);

		var contentString = '<?php echo $infoWindow; ?>';

		var infowindow = new google.maps.InfoWindow({
		  content: contentString,
		  minWidth: 200,
		  minHeight: 200
		});

		var marker = new google.maps.Marker({
		  position: myLatlng,
		  map: map,
		  animation: google.maps.Animation.DROP
		});
	
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map,marker);
		});
	}
	google.maps.event.addDomListener(window, 'load', initialize);
</script>

<?php } // endif ?>