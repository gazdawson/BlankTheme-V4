<div class="entry-meta">
	
	<span class="meta-author">
		<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 30 ); ?>
		</a>
		<span class="author"><?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?></span>
	</span>
	
	<time class="published" datetime="<?php echo get_the_time('c'); ?>">
		<?php if(is_single()) { ?>
			<?php echo get_the_date('F j, Y'); ?> | 
		<?php } else { ?>
			<span class="month"><?php echo get_the_date('M'); ?></span>
			<span class="day"><?php echo get_the_date('d'); ?></span>
		<?php } // endif ?> 
	</time>
	
	<span class="meta-category">
		<?php the_category(', '); ?> | 
	</span>
	
	<span class="meta-comments">
		<?php comments_popup_link( 'No comments', '1 comment', '% comments', 'comments-link', 'Comments are disabled'); ?>
	</span>
	
</div>

