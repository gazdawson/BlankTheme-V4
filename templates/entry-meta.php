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
	
	<?php
	    $permalink = get_permalink($post->ID);
	    $title = get_the_title();
	?>
	<div class="social-share">
      <a class="icon-twitter" href="http://twitter.com/share?text=<?php echo $title; ?>&url=<?php echo $permalink; ?>" onclick="window.open(this.href, 'twitter-share', 'width=550,height=300'); return false;">
          <span>Twitter</span>
      </a>   
          
      <a class="icon-fb" href="https://www.facebook.com/sharer/sharer.php?u=<? echo $permalink; ?>" onclick="window.open(this.href, 'facebook-share', 'width=580,height=296'); return false;">
          <span>Facebook</span>
      </a>
      
      <a class="icon-gplus" href="https://plus.google.com/share?url=<? echo $permalink; ?>" onclick="window.open(this.href, 'google-plus-share', 'width=490,height=530'); return false;">
         <span>Google+</span>
      </a>
  </div>
	
</div>

