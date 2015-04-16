<?php
	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	global $krank; 
?>

<?php while (have_posts()) : the_post(); ?>
	
	<div class="wrap" role="document">
		<article <?php post_class(); ?>>
			
	    <header class="entry-header">
		      <h1 class="entry-title"><?php the_title(); ?></h1>
	    </header><!-- /.entry-header -->
			
			<div class="content">
				<div class="row">
					
					<div class="entry">
				    <div class="entry-content">
				      <?php the_content(); ?>
				    </div>
						<?php if($krank['related_enable'] != 0): ?>
							<div class="relatedposts">
					    	<p class="section-header">Related Posts</p>
					    	<?php related_posts(); ?>
					    </div>
						<?php endif; ?>
				    <footer>
				      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
				    </footer>
				    <?php comments_template('/templates/comments.php'); ?>
					</div>

				</div>
			</div><!-- /.content -->
			
			<?php get_template_part('templates/entry-meta'); ?>
			
	  </article>
	</div><!-- /.wrap -->
	
<?php endwhile; ?>


