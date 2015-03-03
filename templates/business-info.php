<?php
	// Declare Variables
	global $krank;
?>

<div itemscope itemtype="http://schema.org/LocalBusiness" class="business-info">
	
	<span class="copy">&copy; <?php echo date('Y'); ?></span>
	
	<?php if($krank['name']) : ?>
		<span itemprop="name" class="name"><?php echo $krank['name']; ?> | </span>
	<?php endif; ?>
	
	<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" class="address">
		<?php // Address Loop
			foreach($krank['address'] as $key => $value) :
				if($value) :
		?>
			<span itemprop="<?php echo $key; ?>"><?php echo $value; ?></span>
		<?php 
				endif; 
			endforeach;
		?>
	</div><!--/.address-->
	
	<div class="contact">
		<?php // Contact Loop
			foreach($krank['contact'] as $key => $value) :
				if($value) :
		?>
			<abbr title="<?php echo ucFirst($key); ?>"><?php echo substr($key,0,1); ?>: </abbr>
			<span itemprop="<?php echo $key; ?>"><?php echo $value; ?></span>
		<?php 
				endif; 
			endforeach;
		?>
	</div><!--/.contact-->
	
	<div itemprop="openingHoursSpecification" itemscope itemtype="http://schema.org/OpeningHoursSpecification" class="opening-times">
		<?php // Contact Loop
			foreach($krank['open'] as $key => $value) :
				if($value) :
		?>
			<span itemprop="dayOfWeek" itemscope itemtype="http://schema.org/DayOfWeek">
				<span itemprop="name"><?php echo $key; ?></span>
			</span>
			<meta itemprop="opens" content="<?php echo substr($value,0,5).':00'; ?>">
			<meta itemprop="closes" content="<?php echo substr($value,8,99).':00'; ?>">
		<?php 
				endif; 
			endforeach;
		?>
	</div><!--/.opening-times-->
	
</div><!--/.business-info-->

<div itemscope itemtype="http://schema.org/Place" class="location">
  <div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
    <meta itemprop="latitude" content="<?php echo $krank['location']['latitude']; ?>" />
    <meta itemprop="longitude" content="<?php echo $krank['location']['longitude']; ?>" />
  </div>
</div><!--/.location-->