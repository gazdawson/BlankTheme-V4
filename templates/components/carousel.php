<div id="<?php echo $this->id; ?>" class="carousel slide <?php echo $this->transition; ?>" data-ride="carousel">
	<div class="carousel-inner">
		
<?php
	// Declare vars
	global $krank;
	$count = 0;
	$indicator = '';
	
	// Loop over krank carousels
	foreach($krank[$this->slide_type] as $slides) :
		
		$title = $slides['title'];
		$description = $slides['description'];
		$link = $slides['url'];
		$images	= $slides['image'];
		$images_height = $slides['height'];
		$images_width =	$slides['width'];
		
		// .active class for first slide
		if ($count === 0 ) {
			$active = ' active'; 
		}
		else {
			$active = ''; 
		}
		
		// add indicators
		$indicator .= '<li data-target="#'.$this->id.'" data-slide-to="'.$count.'" class="'.$active.'"></li>';

	// Carousel Items
?>

		<div class="item <?php echo $active; ?>">
			<a href="<?php echo $link; ?>" title="<?php echo $title; ?>">
		
				<?php if($images != "") : // Carousel Images ?>
					<img src="<?php echo $images; ?>" alt="<?php echo $title; ?>" class="carousel-img" width="<?php echo $images_width; ?>" height="<?php echo $images_height; ?>" />
				<?php endif; ?>
		
				<?php if ($this->captions != false) : // Carousel Captions ?>
					 	<div class="carousel-caption">
					 		<span class="carousel-title"><?php echo $title; ?></span>
					 		<p class="carousel-description"><?php echo $description; ?></p>
					 	</div>
				<?php endif; ?>
			
			</a>
		</div>

<?php $count++; endforeach; ?>

	</div><!--/.carousel-inner-->

<?php if ($this->indicators != false) : // Carousel Indicators ?>

	<ol class="carousel-indicators">
		<?php echo $indicator; ?>
	</ol>

<?php endif; ?>
	
<?php if ($this->controls != false) : // Show carousel controls if enabled ?>

	<a class="left carousel-control" href="#<?php echo $this->id; ?>" data-slide="prev">
		<span class="fa fa-angle-left"></span>
	</a>
	<a class="right carousel-control" href="#<?php echo $this->id; ?>" data-slide="next">
		<span class="fa fa-angle-right"></span>
	</a>
	
<?php endif; ?>

</div><!--/#<?php echo $this->id; ?>-->
		 