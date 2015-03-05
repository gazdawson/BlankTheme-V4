<?php
/**
 * Krank Custom Functions
 * @package Krank
*/

// Wrap video embeds ind bootstrap responsive embed code.
add_filter('embed_oembed_html', 'responsive_embed_html', 99, 4);

function responsive_embed_html($html, $url, $attr, $post_id) {
  return '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
}


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