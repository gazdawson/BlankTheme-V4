<?php
	// Declare Variables
	global $krank;
?>

<div itemprop="openingHoursSpecification" itemscope itemtype="http://schema.org/OpeningHoursSpecification" class="opening-times">
	<table class="open-hours">
		<?php foreach($krank['open'] as $key => $value) : if($value) : ?>
		<tr>
			<th><span itemprop="dayOfWeek" itemscope itemtype="http://schema.org/DayOfWeek"><?php echo $key; ?></span></th>
			<td><time><?php echo $value; ?></time>
				<meta itemprop="opens" content="<?php echo substr($value,0,5).':00'; ?>"><meta itemprop="closes" content="<?php echo substr($value,8,99).':00'; ?>">
			</td>
		</tr>
		<?php endif; endforeach; ?>
	</table>
</div><!--/.opening-times-->
