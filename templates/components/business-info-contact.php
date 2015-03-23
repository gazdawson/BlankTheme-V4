<?php
	// Declare Variables
	global $krank;
?>

<div itemscope itemtype="http://schema.org/LocalBusiness" class="business-info">
	
	<div class="contact">
		<ul class="contact-info">
			<?php foreach($krank['contact'] as $key => $value) : if($value) : ?>
			<li>
			  <abbr title="<?php echo ucFirst($key); ?>"><?php echo substr($key,0,1); ?>: </abbr>
			  <?php if($key == 'telephone') : ?>
					<a href="tel:<?php echo $value; ?>" title="Call <?php echo $krank['name']; ?>"><span itemprop="<?php echo $key; ?>"><?php echo $value; ?></span></a>
				<?php elseif($key == 'email') : ?>
					<a href="mailto: <?php echo $value; ?>" title="Email <?php echo $krank['name']; ?>"><span itemprop="<?php echo $key; ?>"><?php echo $value; ?></span></a>
				<?php else : ?>
					<span itemprop="<?php echo $key; ?>"><?php echo $value; ?></span>
				<?php endif; ?>
			</li>
			<?php endif; endforeach; ?>
		</ul>
	</div><!--/.contact-->
	
</div><!--/.business-info-->