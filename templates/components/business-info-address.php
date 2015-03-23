<?php
	// Declare Variables
	global $krank;
?>

<div itemscope itemtype="http://schema.org/LocalBusiness" class="business-info">
	
	<div class="address">
		<?php if($krank['name']) : ?>
			<span itemprop="name" class="name"><?php echo $krank['name']; ?></span>&nbsp;<span class="copy">&copy; <?php echo date('Y'); ?></span>
		<?php endif; ?>
		<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			<?php foreach($krank['address'] as $key => $value) : if($value) : ?>
				<span itemprop="<?php echo $key; ?>"><?php echo $value; ?>, </span>
			<?php  endif; endforeach; ?>
		</div>
	</div><!--/.address-->
	
</div><!--/.business-info-->