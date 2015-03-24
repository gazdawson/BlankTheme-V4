<?php
/**
 * Krank Custom Functions
 * @package Krank
*/

// =======================
// = Blog Post Functions =
// =======================

// Related Posts Based on post tags
function related_posts() {
	global $post;
	global $krank;
	$orig_post = $post;
	$tags = wp_get_post_tags($post->ID);

	if ($tags) {
	    $tag_ids = array();
			foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
	    $args=array(
	        'tag__in' => $tag_ids,
	        'post__not_in' => array($post->ID),
	        'posts_per_page' => $krank['related_number'], // Number of related posts to display.
	        'ignore_sticky_posts'=> 1
	    );

	$my_query = new wp_query( $args );

	while( $my_query->have_posts() ) {
	    $my_query->the_post();
			$excerpt = strip_tags(get_the_excerpt()); // get excerpt and strip tags
			
	    $output = 
				'<div class="relatedthumb">
					<div class="thumbnail">
		        <a rel="external" href="'.get_the_permalink().'">'
							.get_the_post_thumbnail( $post->ID ).
							'<div class="caption">'.
								'<p class="related-title">'.get_the_title().'</p>'.
								'<p class="related-excerpt">'.$excerpt.'</p>'.
							'</div>
		        </a>
					</div>
	    	</div>';
					
			echo $output;

		}
	}
	else {
		echo 'No Related Posts';
	}
	$post = $orig_post;
	wp_reset_query();
}


// Wrap video embeds ind bootstrap responsive embed code.
add_filter('embed_oembed_html', 'responsive_embed_html', 99, 4);
// Theme
function responsive_embed_html($html, $url, $attr, $post_id) {
  return '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
}

// =======================
// = Template Functions =
// =======================

// pass varibles to template file class
if ( ! class_exists('krank_templateView') ) {
    class krank_templateView {
        private $args;
        private $file;
 
        public function __get($name) {
            return $this->args[$name];
        }
 
        public function __construct($file, $args = array()) {
            $this->file = $file;
            $this->args = $args;
        }
 
        public function __isset($name){
            return isset( $this->args[$name] );
        }
 
        public function render() {
            if( locate_template($this->file) ){
                include( locate_template($this->file) ); // Theme Check free. Child themes support.
            }
        }
    }
}
// pass varibles to template file function
if( ! function_exists('krank_get_template_part') ){
    function krank_get_template_part($file, $args = array()){
        $template = new krank_templateView($file, $args);
        $template->render();
    }
}